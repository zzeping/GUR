<?php

namespace App\Models;

use CodeIgniter\Database\MySQLi\PreparedQuery;

class SurveyModel
{
    private $db;
    //private $idSurvey;

    /**
     * SurveyModel constructor.
     */
    public function __construct() {
        $this->db = \Config\Database::connect();
        //$this->idSurvey = $ID;

    }

    /**
     * Starting queries for every table
     */
    public $full_query2 = "select * from Survey inner join SurveyRole on Survey.surveyId = SurveyRole.surveyId where PersonId = ";
    public $full_query4 = "SELECT *  FROM Survey";


    /**
     * "And" function for table "Survey"
     */
    public function add_and() {
        $query_text_add = " AND ";
        $this->full_query4 = $this->full_query4.$query_text_add;
        print $this->full_query4;
    }

    /**
     * "And" function for table "Survey"
     */
    public function where() {
        $query_text_add = " WHERE ";
        $this->full_query4 = $this->full_query4.$query_text_add;
        print $this->full_query4;
    }

    /**
     * returns the result of the query
     */
    public function get_query() {
        $query = $this->db->query($this->full_query4);
        return $query->getResult();
    }

    /**
     * returns a limited amount of surveys (20/50/100)
     */
    public function get_limitedAmountOfSurveys() {
        $limit = $_POST['limit'];
        $query_text_add = " limit ";
        $this->full_query4 = $this->full_query4.$query_text_add.$limit;
        print $this->full_query4;
    }

    /**
     * returns all surveys
     */
    public function get_all_surveys() {
        $query = $this->db->query($this->full_query4);
        return $query->getResult();
    }

    /**
     * returns the surveys form a person
     */
    public function get_numberOfSurveys_one($PersonId) {
        $this->full_query2 = $this->full_query2.$PersonId;
        $query = $this->db->query($this->full_query2);
        return $query->getResult();
    }

    /**
     * returns the number of surveys smaller than "surveyId"
     */
    public function get_numberOfSurveys() {
        $surveyss = $_POST['surveyss'];
        $query_text_add = " surveyid < ";
        $this->full_query4 = $this->full_query4.$query_text_add.$surveyss;
        print $this->full_query4;
    }

    /**
     * returns that are short
     */
    public function get_longShortZero() {
        $query_text_add = " longShortBoolean = 0";
        $this->full_query4 = $this->full_query4.$query_text_add;
        print $this->full_query4;
    }

    /**
     * returns that are long
     */
    public function get_longShortOne() {
        $query_text_add = " longShortBoolean = 1";
        $this->full_query4 = $this->full_query4.$query_text_add;
        print $this->full_query4;
    }

    /**
     * returns surveys in ascending alphabetic order
     */
    public function get_SurveyAlphabeticAsc () {
        $query_text_add = " ORDER BY surveyName asc";
        $this->full_query4 = $this->full_query4.$query_text_add;
        print $this->full_query4;
    }

    /**
     * returns surveys in descending alphabetic order
     */
    public function get_SurveyAlphabeticDesc () {
        $query_text_add = " ORDER BY surveyName desc";
        $this->full_query4 = $this->full_query4.$query_text_add;
        print $this->full_query4;
    }

    /**
     * returns surveys in ascending opening dates
     */
    public function get_SurveyOpeningDatesAsc () {
        $query_text_add = " ORDER BY open asc";
        $this->full_query4 = $this->full_query4.$query_text_add;
        print $this->full_query4;
    }

    /**
     * returns surveys in descending opening dates
     */
    public function get_SurveyOpeningDatesDesc () {
        $query_text_add = " ORDER BY open desc";
        $this->full_query4 = $this->full_query4.$query_text_add;
        print $this->full_query4;
    }

    /**
     * returns closed surveys in descending dates
     */
    public function get_ClosedSurveysDesc() {
        $query_text_add = " close <= curdate() ORDER BY close desc";
        $this->full_query4 = $this->full_query4.$query_text_add;
        print $this->full_query4;
    }

    /**
     * returns closed surveys in ascending dates
     */
    public function get_ClosedSurveysAsc() {
        $query_text_add = " close <= curdate() ORDER BY close asc";
        $this->full_query4 = $this->full_query4.$query_text_add;
        print $this->full_query4;
    }

    /**
     * returns surveys sorted by last change
     */
    public function get_LastChangedSurveys() {
        $query_text_add = " ORDER BY SurveyInitDate desc";
        $this->full_query2 = $this->full_query2.$query_text_add;
        //print $this->full_query4;
        $query = $this->db->query($this->full_query2);
        return $query->getResult();
    }

    /**
     * returns surveys in chosen language
     */
    public function get_surveyOnLanguage() {
        $language = $_POST['lang'];
        $query_text_add = " languageId = ";
        $this->full_query4 = $this->full_query4.$query_text_add.$language;
        print $this->full_query4;
    }

    /**
     * returns surveys in chosen language
     */
    public function get_languages() {
        $query_text_add = "SELECT languageId, description from Language";
        $query = $this->db->query($query_text_add);
        return $query->getResultArray();
    }

    /**
     * returns surveys in chosen language (possible this doesn't work yet because of apostrophes)
     */
    public function get_all_compare($PersonId) {
        $this->full_query2 = $this->full_query2.$PersonId;
        $query = $this->db->query($this->full_query2);
        return $query->getResultArray();
    }

    /**
     * returns all the questions from a chosen type
     */
    public function get_questions($typeid) {
        $query_text_add = " WHERE typeid = ";
        $this->full_query3 = $this->full_query3.$query_text_add.$typeid;
        $query = $this->db->query($this->full_query3);
        return $query->getResult();
    }

    /**
     * inserts a tag in the "Tag" table
     */
    public function set_tag() {
        if(isset($_POST['btn6']))
        {
            $tagname = $_POST['tagname'];

            $insert_text = 'INSERT INTO Tags (tagname) VALUES (:tagname:)';
            $query = $this->db->query($insert_text, ['tagname' => $tagname]);
        }
    }

    /**
     * inserts a description in the "Genre" table
     */
    public function set_description() {
        if(isset($_POST['btn7']))
        {
            $description = $_POST['description'];

            $insert_text = 'INSERT INTO Genre (description) VALUES (:description:)';
            $query = $this->db->query($insert_text, ['description' => $description]);
        }
    }

    /**
     * inserts a name in the "Gametitle" table
     */
    public function set_gametitle() {
        if(isset($_POST['btn8']))
        {
            $name= $_POST['name'];

            $insert_text = 'INSERT INTO GameTitle (name) VALUES (:name:)';
            $query = $this->db->query($insert_text, ['name' => $name]);
        }
    }


    /**
     * inserts the answers in the "Answers" table
     */
    public function set_answers() {
        if(isset($_POST['btn2']))
        {
            $answerdescription = $_POST['answerdescription'];
            $surveyquestionid = $_POST['surveyquestionid'];
            $Personid = $_POST['Personid'];

            $insert_text = 'INSERT INTO MCAnswers (answerdescription, surveyquestionid, Personid) VALUES (:answerdescription:, :surveyquestionid:, :Personid:)';
            $query = $this->db->query($insert_text, ['answerdescription' => $answerdescription, 'surveyquestionid' => $surveyquestionid, 'Personid' => $Personid]);
        }
    }

    /**
     * inserts a surveyQuestion into "SurveyQuestion" table
     */
    public function set_surveyQuestion() {
        if(isset($_POST['btn4']))
        {
            $surveyName = $_POST['surveyName'];
            $questionDesc = $_POST['questionDesc'];

            $insert_text = 'INSERT INTO SurveyQuestions(surveyId, questionId) VALUES ((SELECT surveyId from Survey WHERE description = :surveyName:), (select questionId from Question WHERE description = :questionDesc:))';

            $query = $this->db->query($insert_text, ['surveyName' => $surveyName, 'questionDesc' => $questionDesc]);
        }
    }


    /**
     * inserts a question into "Question" table
     */
    public function set_question() {
        if(isset($_POST['btn4']))
        {
            $description = $_POST['description'];
            $typeId = $_POST['typeId'];

            $insert_text = 'INSERT INTO Question (description, typeId) VALUES (:description:, :typeId:)';

            $query = $this->db->query($insert_text, ['description' => $description, 'typeId' => $typeId]);
        }
    }


    /**
     * inserts a survey into "Survey" table
     */
    public function set_survey() {
        if(isset($_POST['btn3']))
        {
            $description = $_POST['description'];
            $open = $_POST['open'];
            $close = $_POST['close'];
            $languageId = $_POST['languageId'];
            $longShortBoolean = $_POST['longShortBoolean'];

            $insert_text = 'INSERT INTO Survey (description, open, close, languageId, longShortBoolean) VALUES (:description:, :open:, :close:, :languageId:, :longShortBoolean:)';

            $query = $this->db->query($insert_text, ['description' => $description, 'open' => $open, 'close' => $close, 'languageId' => $languageId, 'longShortBoolean' => $longShortBoolean]);
        }
    }

    /**
     * returns the blob with id from table "Test"
     */
    public function getPDF($surveyId) {
        //var_dump($surveyId);
        $query_text = 'SELECT image FROM Survey WHERE surveyId = :surveyId:';
        $query = $this->db->query($query_text, [ 'surveyId' => $surveyId]);
        //print_r($query);


        $row = $query->getRow();
        //var_dump($surveyId);
        //var_dump($row);
        return $query->getRow();
        ///$this->setContentType('image/jpeg')->setBody($row->image)->send();

    }

    public function getpicture($id) {
        $query_text = 'SELECT data , type FROM Test WHERE id = :id:';
        $query = $this->db->query($query_text, [ 'id' => $id]);
        $row = $query->getRow();
        // $this->response->setContentType('image/jpeg')->setBody($row->image)->send();
        $this->response->setContentType($row->type)->setBody($row->data)->send();
    }

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

    /**
     * Testing
     */
    public function get_database() {
        $query_text = 'SELECT id, name, type  FROM Test';
        $query = $this->db->query($query_text);
        return $query->getResult();
    }

    public function get_database_where_1() {
        $query_text_add = " WHERE id = 1";
        $this->full_query = $this->full_query.$query_text_add;
        $query = $this->db->query($this->full_query);
        return $query->getResult();
    }

    public function getQuestionOptionResults($idSurvey, $questionID, $option) {
        $followUp = " and surveyId = ";
        $otherFollowUp = " and Question.questionId = ";
        $query_text_add = "SELECT count(NumberOfOptionAnswer) as a from MCAnswers inner join SurveyQuestions on MCAnswers.surveyquestionId = SurveyQuestions.surveyQuestionsId inner join Question on SurveyQuestions.questionId = Question.questionId where NumberOfOptionAnswer = ";
        $query_text_add = $query_text_add.$option.$followUp.$idSurvey.$otherFollowUp.$questionID;
        $query = $this->db->query($query_text_add);
        return $query->getResult();
    }

    public function getQuestionDescription($id) {
        $query_text_add = "SELECT description From Question WHERE questionId = ";
        $query_text_add = $query_text_add.$id;
        $query = $this->db->query($query_text_add);
        return $query->getResult();
    }

    //Creates a 2D array with following structure:
    // [ Q1String  |  Totalanswersoption-3   |  Totalanswersoption-2     |  Totalanswersoption-1    |  Totalanswersoption0    | Totalanswersoption1     |  Totalanswersoption2   | Totalanswersoption3   ]
    // [ Q2String  |  Totalanswersoption-3   |  Totalanswersoption-2     |  Totalanswersoption-1    |  Totalanswersoption0    | Totalanswersoption1     |  Totalanswersoption2   | Totalanswersoption3   ]
    // [ ...|....  |  Totalanswersoption-3   |  Totalanswersoption-2     |  Totalanswersoption-1    |  Totalanswersoption0    | Totalanswersoption1     |  Totalanswersoption2   | Totalanswersoption3   ]
    // [ Q29String |  Totalanswersoption-3   |  Totalanswersoption-2     |  Totalanswersoption-1    |  Totalanswersoption0    | Totalanswersoption1     |  Totalanswersoption2   | Totalanswersoption3   ]
    // [ Q30String |  Totalanswersoption-3   |  Totalanswersoption-2     |  Totalanswersoption-1    |  Totalanswersoption0    | Totalanswersoption1     |  Totalanswersoption2   | Totalanswersoption3   ]

    //QiString equals the database 'description' in the question table. It is queried using getQuestionDescription.
    //TotalansweroptionX equals the total answers on an option given by all users who filled in this survey.

    public function getAnswers()
    {
        $answers = array();
        //Create each row of the answers
        for ($question = 0; $question < 30; $question++) {
            //Create an empty row
            $questionresults =[];

            //Get the 'QiString' description and put it as a first element.
            $questionresults[0] = $this->getQuestionDescription($question+4);
            $questionresults[1] = $question + 4;
            //Get the aggregated results from the question and append them one after one to the row.
            for ($option = -3; $option < 4; $option++) {
                    $questionresults[$option + 5] = $this->getQuestionOptionResults($question+4, $option);
                }
            //Add the question with its results to the final answers matrix.
            $answers[$question] = $questionresults;
        }
        return $answers;
    }


    public function getSurveyOnId($surveyId){

        $query_text = 'SELECT * FROM a21ux04.Survey WHERE surveyId = :surveyId:';
        $query = $this->db->query($query_text,[ 'surveyId' => $surveyId]);
        return $query->getResult();
    }

    public function getSurveyId($surveyName){

        /*
        $query_text = 'SELECT surveyId as s FROM Survey WHERE surveyName = ":surveyName:"';
        $query = $this->db->query($query_text,[ 'surveyName' => $surveyName]);
        print $query_text;
        return $query->getRow();
        */

        $query_text_add = 'SELECT surveyId as s FROM Survey WHERE surveyName = "';
        $other = '"';
        $query_text_add = $query_text_add.$surveyName.$other;
        $query = $this->db->query($query_text_add);
        return $query->getResult();
    }

    public function getPXIfromSurvey($surveyId){

        $query_text = 'SELECT Question.description, Question.questionId, SurveyQuestions.surveyQuestionsId, QuestionTypes.type, ConstructTypes.construct FROM a21ux04.Question
        INNER JOIN a21ux04.SurveyQuestions ON SurveyQuestions.questionId = Question.questionId
        INNER JOIN a21ux04.QuestionTypes ON Question.typeID = QuestionTypes.questiontypesID
        INNER JOIN a21ux04.ConstructTypes ON ConstructTypes.questionId = Question.questionID
        WHERE surveyId = :surveyId: AND LanguageID = 9;';
        $query = $this->db->query($query_text,[ 'surveyId' => $surveyId]);
        return $query->getResult();
    }
    public function getPXIAnswersfromSurvey($surveyId){

        $query_text = 'SELECT description, NumberOfOptionAnswer, Question.questionId from a21ux04.MCAnswers inner join a21ux04.SurveyQuestions on MCAnswers.surveyquestionId = SurveyQuestions.surveyQuestionsId inner join Question on SurveyQuestions.questionId = Question.questionId where surveyId = :surveyId:';
        $query = $this->db->query($query_text,[ 'surveyId' => $surveyId]);
        return $query->getResult();
    }


    public function getOnlineSurveys($surveyId) {
        $query_text = 'SELECT * FROM a21ux04.Survey WHERE ((curdate() >= open) AND (curdate() <= close) AND (surveyId =:surveyId:))';
        $query = $this->db->query($query_text,[ 'surveyId' => $surveyId]);
        return $query->getResult();
    }

    public function getOflineSurveys($surveyId) {
        $query_text = 'SELECT * FROM a21ux04.Survey WHERE ((curdate() <= open) OR (close <= curdate()) AND (surveyId =:surveyId:))';
        $query = $this->db->query($query_text,[ 'surveyId' => $surveyId]);
        return $query->getResult();
    }

    public function getSurveyTags($surveyId) {
        $query_text = 'SELECT Tags.tagname from a21ux04.Surveytags INNER JOIN a21ux04.Tags ON Tags.idTags = Surveytags.tagid WHERE surveyid = :surveyId:';
        $query = $this->db->query($query_text,[ 'surveyId' => $surveyId]);
        return $query->getResult();
    }

    public function getPictureSurvey($surveyId) {
        $query_text = 'SELECT image FROM Survey WHERE surveyid = :surveyId:';
        $query = $this->db->query($query_text,[ 'surveyId' => $surveyId]);
        return $query->getResult();

    }


    public function deleteSurvey($surveyId) {
        $query_text = 'DELETE FROM a21ux04.Survey WHERE surveyId =:surveyId:;';
        $query = $this->db->query($query_text,[ 'surveyId' => $surveyId]);
    }
    public function addAnswer($surveyquestionId, $answer,  $PersonId ){
        $query_text = 'INSERT INTO `a21ux04`.`MCAnswers` (`NumberOfOptionAnswer`, `surveyquestionId`, `PersonId`) VALUES (:answer:, :surveyquestionId: , :personId:);';
        return $query = $this->db->query($query_text,[ 'answer' => $answer, 'surveyquestionId' => $surveyquestionId, 'personId' => $PersonId]);

    }
    public function getNumberOfRespondents($surveyId) {
        $query_text = 'SELECT count(distinct PersonId) AS numberOfRespondents FROM a21ux04.SurveyQuestionnaires
                       INNER JOIN a21ux04.SurveyQuestions
                       ON SurveyQuestions.surveyId = SurveyQuestionnaires.surveyId
                       WHERE SurveyQuestionnaires.surveyId = :surveyId:';
        $query = $this->db->query($query_text,[ 'surveyId' => $surveyId]);
        return $query->getResult()[0]->numberOfRespondents;
    }
    /*
     * Returns the title string of this survey. (query on $this->surveyID)
     */
    public function getTitle() {
        return "TO DO: implement a query for getTitle() in SurveyModel";
    }

    /**
     * Final Queries
     */

    /**
     * @param $answer
     * @param $surveyId
     * @param $questionId
     * Inserting the answers for the open questions (Louis en Pieter)
     */
    public function insertAnswerOpen($answer, $surveyId, $questionId) {

        $insert_text = 'INSERT INTO a21ux04.OpenAnswers (description, surveyQuestionId)
                        VALUES (:answer: , (SELECT surveyQuestionsId FROM a21ux04.SurveyQuestions WHERE QuestionId = :questionId: AND surveyId = :surveyId: ))';
        $query = $this->db->query($insert_text, ['answer' => $answer, 'surveyId' => $surveyId, 'questionId', $questionId]);

    }


    /**
     * @param $questionId
     * @param $surveyId
     * @param $option
     * @return array|array[]|object[]
     * Inserting the answers for the multiple choice questions (Louis en Pieter)
     */
    public function getPreviousValue($questionId, $surveyId, $option){

        $query_text = 'SELECT NumberOfOptionAnswer FROM a21ux04.MCAnswers WHERE surveyquestionId = (SELECT surveyQuestionsId from a21ux04.SurveyQuestions WHERE questionId = :questionId: AND surveyId = :surveyId: ) AND QuestionOption = (SELECT idoptions FROM a21ux04.questionoptions WHERE options = :options: AND questionid = :questionId: )';
        $query = $this->db->query($query_text,[ 'questionId' => $questionId, 'surveyId' => $surveyId, 'options' => $option]);
        return $query->getResult();
    }


    /**
     * @param $questionId
     * @param $surveyId
     * @param $option
     * @param $previous
     * @return array|array[]|object[]
     * Inserting the answers for the multiple choice questions (Louis en Pieter)
     */
    public function updateValue($questionId, $surveyId, $option, $previous){

        $query_text = 'UPDATE a21ux04.MCAnswers SET NumberOfOptionAnswer = (:previous: + 1) WHERE surveyquestionId = (SELECT surveyQuestionsId FROM a21ux04.SurveyQuestions WHERE surveyId = :surveyId: AND questionId = :questionId: ) AND QuestionOption = (SELECT idoptions FROM a21ux04.questionoptions WHERE options = :options: AND questionid = :questionId: )';
        $query = $this->db->query($query_text,[ 'questionId' => $questionId, 'surveyId' => $surveyId, 'options' => $option, 'previous' => $previous]);
        //return $query->getResult();
    }
    public function updateValue1($questionId, $surveyId, $option){

        $query_text = 'UPDATE a21ux04.MCAnswers SET NumberOfOptionAnswer = NumberOfOptionAnswer + 1 WHERE surveyquestionId = (SELECT surveyQuestionsId FROM a21ux04.SurveyQuestions WHERE surveyId = :surveyId: AND questionId = :questionId: ) AND QuestionOption = (SELECT idoptions FROM a21ux04.questionoptions WHERE options = :options: AND questionid = :questionId: )';
        $query = $this->db->query($query_text,[ 'questionId' => $questionId, 'surveyId' => $surveyId, 'options' => $option]);
        //return $query->getResult();
    }

    /**
     * @param $questionId
     * @param $surveyId
     * @return array|array[]|object[]
     * Getting the results of the open questions (Louis)
     */
    public function getOpenAnswers($questionId, $surveyId){

        $query_text = 'SELECT description FROM a21ux04.OpenAnswers
                       WHERE surveyQuestionId = (SELECT surveyQuestionId FROM a21ux04.SurveyQuestions WHERE surveyId = :surveyId: AND questionId = :questionId:)';
        $query = $this->db->query($query_text,[ 'questionId' => $questionId, 'surveyId' => $surveyId]);
        return $query->getResult();
    }

    /**
     * @param $questionId
     * @param $surveyId
     * @return array|array[]|object[]
     * Getting the MCanswers number of each option from a given question (Louis)
     */
    public function getMcAnswers($surveyId){

        $query_text = 'SELECT NumberOfOptionAnswer, questionoptions.questionid, options, MCAnswers.surveyquestionId FROM a21ux04.MCAnswers LEFT JOIN SurveyQuestions ON  SurveyQuestions.surveyQuestionsId = MCAnswers.surveyquestionId 
        LEFT JOIN questionoptions ON questionoptions.idoptions = MCAnswers.QuestionOption 
        WHERE surveyId = :surveyId: ';
        $query = $this->db->query($query_text,['surveyId' => $surveyId]);
        return $query->getResult();
    }


    /**
     * @param $surveyId
     * @return array|array[]|object[]
     * Select all the information of a survey, so sequencenumber, questions, … (Louis)
     */
    public function getSurveyInfo($surveyId){

        $query_text = 'SELECT SurveyQuestions.SequenceNumber, SurveyQuestions.Pagebreak, SurveyQuestions.questionId, Question.description, QuestionTypes.type FROM a21ux04.Question
                       INNER JOIN a21ux04.SurveyQuestions ON SurveyQuestions.questionId = Question.questionId
                       INNER JOIN a21ux04.QuestionTypes ON Question.typeId = QuestionTypes.questionTypesID
                        WHERE surveyId = :surveyId:';
        $query = $this->db->query($query_text,['surveyId' => $surveyId]);
        return $query->getResult();
    }



}
