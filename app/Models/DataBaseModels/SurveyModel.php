<?php

namespace App\Models\DataBaseModels;

use CodeIgniter\Database\Exceptions\DatabaseException;
use CodeIgniter\Database\MySQLi\PreparedQuery;
use CodeIgniter\Exceptions\ModelException;
use App\Models\DataBaseModels\QuestionModel;


class SurveyModel extends DatabaseModel
{

    private $surveyID;
    private $PXIModel;
    private $QuestionModel;

    public function __construct($dbData) {
        parent::__construct($dbData);
        $this->PXIModel = new QuestionPXIModel($dbData);
        $this->questionModel = new QuestionModel($dbData);
    }

    /**
     * @param $personId
     * @param $language
     * @param $title
     * @param $questions          : array of rows with each row representing a custom question or a PXI question
     *                            in form of [description, language, type, options, sequenceNumber, pageBreak]
     *                            !options is a 1D array of option strings. null for open questions.
     * @param null $description
     * @param null $open        : use format '1998-01-23 12:45:56'
     * @param null $close       : use format '1998-01-23 12:45:56'

     * @param null $image
     * @param null $gameTitles
     * @param null $genres
     * @param null $tags
     */
    public function createSurvey($personId,
                                 $language,
                                 $title,
                                 $questions,
                                 $description = null,
                                 $open = null,
                                 $close = null,
                                 $image = null,
                                 $gameTitles = null,
                                 $genres = null,
                                 $tags = null) {
        if ($this->getSurveyID() != null) {
            throw new ModelException('A new survey cannot be added when the surveyId of the Model is not null');
        }
        //getIDs and insert rows if necessary
        $gameTitleIDs = $this->fetchGameTitleIDs($gameTitles);
        $genreIDs = $this->fetchGenreIDs($genres);
        $tagIDs = $this->fetchTagIDs($tags);
        $languageID = $this->getLanguageID($language);


        //Insert 1 row in survey Table
        $surveyRow = [[$languageID, $title, $description, $open, $close, $image]];
        $this->setSurveyID($this->insertSurveyDB($surveyRow));

        //Insert ManyToMany's
        $this->insertManyToMany('SurveyHasGenre', ['surveyId', 'genreId'], $this->getSurveyID(), $genreIDs);
        $this->insertManyToMany('SurveyHasTitle', ['surveyId', 'gametitleId'], $this->getSurveyID(), $gameTitleIDs);
        $this->insertManyToMany('SurveyHasTag', ['surveyId', 'tagId'], $this->getSurveyID(), $tagIDs);
        $this->insertManyToMany('PersonHasSurvey', ['personId', 'surveyId'], $personId, [$this->getSurveyID()]);

        //Get and insert SQA rows for every question.
        $SQARows = $this->getSQARows($questions);
        $this->insertSQARows($SQARows);

    }

    /**
     * Insert a survey in a21ux04.Survey2 table.
     *
     * @param $survey                    : a 2D array containing the row information of the survey.
     *                                     e.g.: [[languageID, title, description, open, close, image]]
     * @throws \UnexpectedValueException : when the provided array is not a 2D array.
     * @return int surveyID             : the surveyID of the new survey

     */
    protected function insertSurveyDB($survey){
        $queryInsertSurvey = $this->queryRowsTable('INSERT', ['idLanguage', 'title', 'description', 'open', 'close', 'image'],
            'Survey2', $survey);
        $queryFetchNewGameSurveyID = 'SELECT DISTINCT last_insert_id() AS surveyId
                                      FROM a21ux04.Survey2';

        $this->db->transStart();
        $insertSurvey = $this->db->query($queryInsertSurvey['queryText'], $queryInsertSurvey['nameBinding']);
        $fetchID =$this->db->query($queryFetchNewGameSurveyID);
        if (count($fetchID->getResult())  != 1 )throw new DatabaseException('Something went wrong while inserting new survey in the DB');
        $this->error_check();
        $this->db->transComplete();
        return $fetchID->getResult()[0]->surveyId;
    }

    /**
     * Helper function which returns the IDs of the provided gameTitles. Inserts gametitles in the database if they
     * not yet exist.
     *
     *
     * @param $gameTitles   :   the gameTitles to add.
     * @return array        :   an array of gameTitles to add.
     * @return null[]       :   when no gameTitles need to be added.
     */
    protected function fetchGameTitleIDs($gameTitles) : array {
        if ($gameTitles == null) {
            return [null];
        }
        $gameTitlesToAdd = [];
        foreach ($gameTitles as $gameTitle) {
            try {
                $this->getGameTitleID($gameTitle);
            } catch (DatabaseException $dbe) {
                //If in the meantime the data would have been added by another user, we can try to reload the gameTitle and its ID from the database
                $this->getAllGameTitles(1);
                try {
                    $this->getGameTitleID($gameTitle);
                    //If the genre again does not exist, add it to table 'Genre'
                } catch (DatabaseException $dbe) {
                    array_push($gameTitlesToAdd, [$gameTitle]);
                }
            }
        }
        //INSERT NEW GAMETITLES IN THE DB
        if (count($gameTitlesToAdd) != 0) {
            $newGameTitleIds = $this->insertUniqueValues('GameTitle', ['idGameTit','Name'], $gameTitlesToAdd);
            for ($i = 0; $i < count($newGameTitleIds); $i++) {
                $gameTitleMap[$newGameTitleIds[$i]] = $gameTitlesToAdd[$i][0];
            }
        }
        for ($gameTitleIndex = 0; $gameTitleIndex < count($gameTitles); $gameTitleIndex++) {
            try {
                $gameTitles[$gameTitleIndex] = $this->getGameTitleID($gameTitles[$gameTitleIndex]);
            } catch (DatabaseException $dbe) {
                $gameTitles[$gameTitleIndex] = array_search($gameTitles[$gameTitleIndex], $gameTitleMap);
            }
        }
        return $gameTitles;
    }

    /**
     * Helper function which returns the IDs of the provided genres. Inserts genres in the database if they
     * not yet exist.
     *
     *
     *
     * @param $genres       :   the genres to add
     * @return array        :   an array of genres to add
     * @return null[]       :   when no genres need to be added.
     */
    protected function fetchGenreIDs($genres) : array {
        if ($genres == null) {
            return [null];
        }
        $genresToAdd = [];
        foreach ($genres as $genre) {
            try {
                $this->getGenreID($genre);
            } catch (DatabaseException $dbe) {
                //If in the meantime the data would have been added by another user, we can try to reload the genre and its ID from the database
                $this->getAllGenres(1);
                try {
                    $this->getGenreID($genre);
                    //If the genre again does not exist, add it to table 'Genre'
                } catch (DatabaseException $dbe) {
                    array_push($genresToAdd, [$genre]);
                }
            }
        }
        //INSERT NEW GENRES IN THE DB
        if (count($genresToAdd) != 0) {
            $newGenreIds = $this->insertUniqueValues('Genre', ['genreId','description'], $genresToAdd);
            for ($i = 0; $i < count($newGenreIds); $i++) {
                $genreMap[$newGenreIds[$i]] = $genresToAdd[$i][0];
            }
        }
        for ($genreIndex = 0; $genreIndex < count($genres); $genreIndex++) {
            try {
                $genres[$genreIndex] = $this->getGenreID($genres[$genreIndex]);
            } catch (DatabaseException $dbe) {
                $genres[$genreIndex] = array_search($genres[$genreIndex], $genreMap);
            }
        }
        return $genres;
    }

    /**
     * Helper function which returns the IDs of the provided tags.
     * Inserts tags in the database if they not yet exist.
     *
     * @param $tags         :   the tags to add
     * @return array        :   an array of tags to add
     * @return null[]       :   when no tags need to be added.
     */
    protected function fetchTagIDs($tags) : array {
        if ($tags == null) {
            return [null];
        }
        $tagsToAdd = [];
        foreach ($tags as $tag) {
            try {
                $this->getTagID($tag);
            } catch (DatabaseException $dbe) {
                //If in the meantime the data would have been added by another user, we can try to reload the tag and its ID from the database
                $this->getAllTags(1);
                try {
                    $this->getTagID($tag);
                    //If the tag again does not exist, add it to table 'Tags'
                } catch (DatabaseException $dbe) {
                    array_push($tagsToAdd, [$tag]);
                }
            }
        }
        //INSERT NEW TAGS IN THE DB
        if (count($tagsToAdd) != 0) {
            $newTagIds = $this->insertUniqueValues('Tags', ['idTags','tagname'], $tagsToAdd);
            for ($i = 0; $i < count($newTagIds); $i++) {
                $tagMap[$newTagIds[$i]] = $tagsToAdd[$i][0];
            }
        }
        for ($tagIndex = 0; $tagIndex < count($tags); $tagIndex++) {
            try {
                $tags[$tagIndex] = $this->getTagID($tags[$tagIndex]);
            } catch (DatabaseException $dbe) {
                $tags[$tagIndex] = array_search($tags[$tagIndex], $tagMap);
            }
        }
        return $tags;

    }

    /**
     * Get the current surveyId of this SurveyModel
     * @return $this->surveyId
     */
    protected function getSurveyID() {
        return $this->surveyID;
    }

    /**
     * Set the surveyId for this SurveyModel
     * @param $surveyId int:   The new surveyId for this SurveyModel
     */
    public function setSurveyID(int $surveyId) {
        $this->surveyID = $surveyId;
    }

    /**
     *  Get appropriate SurveyQuestionAnswer Rows for the given questions.
     *  Inserts custom questions appropriately in the database
     * @param $questions    :   array of rows with each row representing a custom question or a PXI questio in form of:
     *                              [description, language, type, options, sequenceNumber, pageBreak]
     *                              !options is a 1D array of option strings. null for open questions.
     * @after (if question->getType != PXI): database contains question.
     * @return array
     */
    protected function getSQARows($questions) : array {
        $SQARows = [];
        $PXIQuestions = [];
        $customQuestions = [];
        $PXIDescriptions = [];
        //Separate PXI questions from CustomQuestions based on the PXI type
        foreach ($questions as $question) {
            if($question[2] != 'PXI') array_push($customQuestions, $question);
            else {
                array_push($PXIQuestions, $question);
                array_push($PXIDescriptions, [$this->getTypeID($question[2]), $question[0]]);
            }
        }

        //ADD SQARows from PXI QUESTIONS based on their description and type
        $PXIQuestOptIDs = $this->PXIModel->getPXIByDescriptions($PXIDescriptions, 1);
        foreach($PXIQuestions as $question) {
            foreach($PXIQuestOptIDs[strtolower($question[0])] as $QuestOptIDs) {
                array_push($SQARows, [$this->getSurveyID(), $QuestOptIDs[0], $QuestOptIDs[1], $question[4], $question[5]]);
            }
        }
        //ADD SQARows for custom QUESTIONS based on their newly inserted ID
        $SQARowsCustom = $this->questionModel->insertQuestionsDB($customQuestions);

        foreach($SQARowsCustom as $SQARow) {
            array_push($SQARows, [$this->getSurveyID(), $SQARow[0], $SQARow[1], $SQARow[2], $SQARow[3]]);
        }
        return $SQARows;
    }

    /**
     * Insert rows in table SurveyQuestionAswer
     * @param $SQARows array    :   The rows to insert into SurveyQuestionAnswer
     */
    protected function insertSQARows($SQARows) {
        $insertSQA = $this->queryRowsTable('INSERT', ['surveyId', 'questionId',
            'idOption', 'sequenceNumber','pagebreak'], 'SurveyQuestionAnswer', $SQARows);
        $this->db->transStart();
        $insertValues = $this->db->query($insertSQA['queryText'], $insertSQA['nameBinding']);

        $this->error_check();
        $this->db->transComplete();
    }

    /**
     * Returns for each surveyID in surveyIDS information from the survey table
     * @param $surveyIDs    :   2DArray with surveyIDs [[surveyIDs]]
     * @returns $surveys   :   Associative array of key values where
     *                         KEY = surveyID, VALUE = [language, title, description, open,
     *                                                  close, image, creationDate]
     */
    public function getSurveys($surveyIDs) {

        $dbLanguages = $this->getAllLanguages();
        $queryBuilder = $this->queryRowsTable('SELECT', ['idSurvey'], 'Survey2', $surveyIDs);
        $this->db->transStart();
        $rows = $this->db->query($queryBuilder['queryText'], $queryBuilder['nameBinding']);
        $this->error_check();
        $this->db->transComplete();
        $result = [];
        foreach($rows->getResult() as $row) {
            if (isset($result[$row->idSurvey])) throw new \UnexpectedValueException('Every row should have unique surveyIDs!');
            $result[$row->idSurvey] = [];
            $result[$row->idSurvey]['language']  = $dbLanguages[$row->idLanguage];
            $result[$row->idSurvey]['title'] = $row->title;
            $result[$row->idSurvey]['description'] = $row->description;
            $result[$row->idSurvey]['open'] = $row->open;
            $result[$row->idSurvey]['close'] = $row->close;
            $result[$row->idSurvey]['creation-date'] = $row->creationDate;
            $result[$row->idSurvey]['image'] = $row->image; //-> see function getImage($surveyId)

            if (($row->open < date('Y-m-d h:i:s', time())) &&(date('Y-m-d h:i:s', time()) <$row->close)) {
                $result[$row->idSurvey]['status'] = 'online';
            } else $result[$row->idSurvey]['status'] = 'offline';
        }
        return $result;
    }

    /**
     * Returns for each surveyID in surveyIDS information from the survey table
     * @param $surveyIDs            :   2DArray with surveyIDs [[surveyIDs]]
     * @returns $surveyGametitles   :   Associative array of key values where
     *                                  KEY = surveyID, VALUE = [GameTitles]
     *
     */
    public function getSurveyGenres($surveyIDs) {
        $queryBuilder = $this->queryRowsTable('SELECT', ['surveyId'], 'SurveyHasGenre', $surveyIDs);
        $this->db->transStart();
        $rows = $this->db->query($queryBuilder['queryText'], $queryBuilder['nameBinding']);
        $this->error_check();
        $this->db->transComplete();
        $result = [];

        foreach($rows->getResult() as $row) {
            if(!isset($result[$row->surveyId])) {
                $result[$row->surveyId] = [];
            }
            array_push($result[$row->surveyId], $this->getAllGenres()[$row->genreId]);
        }
        return $result;
    }

    /**
     * Returns for every surveyID information from the survey table
     * @param $surveyIDs    :   2DArray with surveyIDs [[surveyIDs]]
     * @returns $surveyTags   :   Associative array of key values where
     *                             KEY = surveyID, VALUE = [Tags]
     */
    public function getSurveyTags($surveyIDs) {
        $queryBuilder = $this->queryRowsTable('SELECT', ['surveyId'], 'SurveyHasTag', $surveyIDs);
        $this->db->transStart();
        $rows = $this->db->query($queryBuilder['queryText'], $queryBuilder['nameBinding']);
        $this->error_check();
        $this->db->transComplete();
        $result = [];
        foreach($rows->getResult() as $row) {
            if(!isset($result[$row->surveyId])) {
                $result[$row->surveyId] = [];
            }
            array_push($result[$row->surveyId], $this->getAllTags()[$row->tagId]);
        }
        return $result;
    }

    /**
     * Returns for every surveyID information from the survey table
     * @param $surveyIDs    :   2DArray with surveyIDs [[surveyIDs]]
     * @returns $surveyGenres   :   Associative array of key values where
     *                             KEY = surveyID, VALUE = [genres]
     */
    public function getSurveyGametitles($surveyIDs) {
        $queryBuilder = $this->queryRowsTable('SELECT', ['surveyId'], 'SurveyHasTitle', $surveyIDs);
        $this->db->transStart();
        $rows = $this->db->query($queryBuilder['queryText'], $queryBuilder['nameBinding']);
        $this->error_check();
        $this->db->transComplete();
        $result = [];
        foreach($rows->getResult() as $row) {
            if(!isset($result[$row->surveyId])) {
                $result[$row->surveyId] = [];
            }
            array_push($result[$row->surveyId], $this->getAllGameTitles()[$row->gametitleId]);
        }
        return $result;

    }

    public function getLongEnjoyment($surveyIDs) {
        $this->db->transStart();
        $result = [];
        foreach ($surveyIDs as $surveyID) {
            $queryPXIQuestions = ' SELECT count(DISTINCT QHA.questionId) AS numberPXI
                                   FROM SurveyQuestionAnswer AS QHA, Question2 AS Q
                                   WHERE Q.idType = :typeId:
                                   AND Q.idQuestion = QHA.questionId
                                   AND QHA.surveyId = :surveyID:';
            $rows = $this->db->query($queryPXIQuestions, ['typeId' => $this->getTypeID('PXI'), 'surveyID' => $surveyID[0]]);
            $this->error_check();
            if ($rows->getResult()[0]->numberPXI == 33) {
                $result[$surveyID[0]] = [1, 1]; //Long and enjoyment
            } elseif ($rows->getResult()[0]->numberPXI == 30) {
                $result[$surveyID[0]] = [1, 0]; //Long, no enjoyment
            } elseif ($rows->getResult()[0]->numberPXI == 11) {
                $result[$surveyID[0]] = [0, 1]; //Short and enjoyment
            } elseif ($rows->getResult()[0]->numberPXI == 10) {
                $result[$surveyID[0]] = [0, 0];//Short, no enjoyment
            } else {
                //echo('Something went wrong when fetching long/enjoyment of userSurveys');
                $result[$surveyID[0]] = [0, 0];
            }
        }
        $this->db->transComplete();
        return($result);
    }

    /**
     * Returns for every surveyID information from the survey table
     * @param $surveyIDs    :   2DArray with surveyIDs (bulk retrieve)
     * @returns $surveyRespondents   :   Associative array of key values where
     *                             KEY = surveyID, VALUE = numberOfRespondents
     */
    public function getNumberOfRespondents($surveyIDs) {

        for ($i = 0; $i < count($surveyIDs); $i++) {
            $surveyIDs[$i] = $surveyIDs[$i][0];
        }
        $this->db->transStart();
        $result = [];
        foreach ($surveyIDs as $surveyID) {
            $queryPXIQuestions = 'SELECT sum(SQA.numberOfAnswers) AS numberResponses
                                  FROM SurveyQuestionAnswer AS SQA, Question2 AS Q
                                  WHERE SQA.surveyId = :surveyID:
                                  AND SQA.questionId = Q.idQuestion
                                  AND Q.idType = :typeId:';

            $rows = $this->db->query($queryPXIQuestions, ['typeId' => $this->getTypeID('PXI'), 'surveyID' => $surveyID]);
            $this->error_check();
            $result[$surveyID] = $rows->getResult()[0]->numberResponses;
        }
        $queryPXIOptions = 'SELECT count(DISTINCT QHO.idOption) AS numberOptions
                            FROM QuestionHasoption AS QHO, Question2 AS Q
                            WHERE Q.idType = :idType:
                            AND QHO.idQuestion = Q.idQuestion';
        $rows = $this->db->query($queryPXIOptions, ['idType' => $this->getTypeID('PXI')]);
        $numberOptions = $rows->getResult()[0]->numberOptions;
        $this->db->transComplete();
        foreach($result as $row) {
            $row = $row/$numberOptions;
        }
        return $result;


    }

    /**
     * returns the blob with from table Survey2 where idSurvey == surveyId
     * @param $surveyId int : the id of the survey.
     */
    public function getImage($surveyId)
    {
        $query_text = 'SELECT image 
                        FROM Survey2 
                        WHERE idSurvey = :surveyId:';
        $query = $this->db->query($query_text, ['surveyId' => $surveyId]);
        return $query->getRow();
    }

    /**
     * Runtime type check of this SurveyModel.
     * @Throws ModelException  $this->surveyID is non-existent in the database.
     */
    protected function runtimeTypeCheck()
    {
        if (ENVIRONMENT !== 'production') {
            try {
                $dbType = $this->selectType();
                if ($dbType != $this->getRuntimeType()) {
                    throw new ModelException('Trying to use a "'.$this->getRuntimeType().'"" QuestionModel 
                    for question with questionID "' . $this->getQuestionID() . '" 
                    but it is stored in the database as question with type: '. $dbType);
                }
            } catch (DatabaseException $dbe) {
                if($this->getQuestionID() != null)
                    throw new ModelException('Trying to use a "'.$this->getRuntimeType().'""  QuestionModel 
                    for question with questionID "' . $this->getQuestionID() . '" 
                    but this question does not exist in the database.');
                else
                    print('Using QuestionModel with QuestionID equal to null. 
                    Only used to add new questions to the database.');
            }
        }
    }

    /**
     * Returns all the survey IDs of surveys which are published at the current database servertime.
     *
     * @returns : surveyIDs of published surveys in 2D array. (suitable data format for queryRowsTable function).
     */
    public function getPublishedSurveyIDs() : array {
        $queryOpenSurveyIDs = ' SELECT idSurvey 
                                FROM Survey2
                                WHERE (SELECT SYSDATE() FROM DUAL) > Survey2.open
                                AND (SELECT SYSDATE() FROM DUAL) < Survey2.close';
        $this->db->transStart();
        $surveyIDs = $this->db->query($queryOpenSurveyIDs);
        $this->error_check();
        $this->db->transComplete();
        $result = [];
        foreach ($surveyIDs->getResult() as $row) {
            array_push($result, [$row->idSurvey]);
        }
        return $result;
    }



    //*--------------------------------------EOF-----------------------------------------------------------------------

    /**
     * inserts a blob in the table "Test"
     */
    public function set_PDF() {
        if(isset($_POST['btn2'])){

            //$name = $_FILES['myfile']['name'];
           // $type = $_FILES['myfile']['type'];

            $description = $_POST['description'];
            $open = $_POST['open'];
            $close = $_POST['close'];
            $languageId = $_POST['languageId'];
            $longShortBoolean = $_POST['longShortBoolean'];
            $surveyName = $_POST['surveyName'];
            $image = file_get_contents($_FILES['myfile']['tmp_name']);

            $insert_text = 'INSERT INTO Survey (description, open , close, languageId, longShortBoolean, surveyName, image) VALUES (:description:, :open:, :close:, :languageId:, :longShortBoolean:, :surveyName:, :image:)';
            $query = $this->db->query($insert_text, ['description' => $description, 'open' => $open, 'close' => $close, 'languageId' => $languageId, 'longShortBoolean'=>$longShortBoolean, 'surveyName'=>$surveyName, 'image'=>$image]);
        }
    }

}
