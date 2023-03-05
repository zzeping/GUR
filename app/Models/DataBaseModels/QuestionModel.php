<?php

namespace App\Models\DataBaseModels;

use CodeIgniter\Database\Exceptions\DataException;
use CodeIgniter\Database\MySQLi\PreparedQuery;
use CodeIgniter\Exceptions\ModelException;
use http\Exception\UnexpectedValueException;
use \CodeIgniter\Database\Exceptions\DatabaseException;

class QuestionModel extends DatabaseModel

{
    public function __construct($dbData) {
        parent::__construct($dbData);
    }

    /**
     * Inserts the given questions with their options in tables a21ux04.Question2 and a21ux04.QuestionHasOption
     *
     * @param $questions array    :   array of rows with each row in form of [description, language, type, options, sequenceNumber, pageBreak]
     *                           !options is a 1D array of option strings. null for open questions.
     *
     *
     * @returns array-key   :   array of rows for each possible [question, option] combination with
     *                              'row[0]' = questionId
     *                              'row[1]' = optionId
     *                              'row[2]' = sequenceNumber
     *                              'row[3]' = pageBreak
     */
    public function insertQuestionsDB(array $questions) : array{
        if($questions[0] == null ) {
            return [null];
        }
        //Substitute the language, type, options and construct with their respective IDs.
        for($row = 0; $row < count($questions); $row++) {

            if (count($questions[$row]) != 6) throw new \UnexpectedValueException(
                'Provide the questions in correct 2D array format with each row having 6 parameters 
                 as this function description prescribes.');
            $questions[$row][2] = $this->getTypeID($questions[$row][2]);
            $questions[$row][1] = $this->getLanguageID($questions[$row][1]);
            $optionsToAdd = [];
            for($option = 0; $option < count($questions[$row][3]); $option++) {
                try {
                    $this->getOptionID($questions[$row][3][$option]);
                } catch (DatabaseException $dbe) {
                    //$this->getAllOptions(1);
                    try {
                        $this->getOptionID($questions[$row][3][$option]);
                    } catch (DatabaseException $dbe) {
                        array_push($optionsToAdd, [$questions[$row][3][$option]]);

                    }
                }
            }
            if (count($optionsToAdd) != 0) {
                $newOptionIds = $this->insertUniqueValues('a21ux04.Option', ['idOption','description'], $optionsToAdd);
                for ($i = 0; $i < count($newOptionIds); $i++) {
                    $optionsMap[$newOptionIds[$i]] = $optionsToAdd[$i][0];
                }
            }
            for($option = 0; $option < count($questions[$row][3]); $option++) {
                try {$questions[$row][3][$option] = $this->getOptionID($questions[$row][3][$option]);}
                catch (DatabaseException $dbe){
                    $questions[$row][3][$option] = array_search($questions[$row][3][$option], $optionsMap);
                }
            }
        }
        //Insert the questions
        $questions = $this->insertQuestionTable($questions);
        $this->insertQuestionHasOption($questions);
        $rows = [];
        foreach($questions as $question){
            foreach ($question[3] as $option) {
                array_push($rows, [$question[0], $option, $question[4], $question[5]]);
            }
        }
        return($rows);
    }

    /**
     * Helper function Called in insertQuestionDB. Inserts questions in a21ux04.Question2
     *
     * @param   $questions   :   array of rows with each row in form of [description, languageID, typeID, optionIDs, constructID]
     *
     * @returns $questions   :   array of rows with each row in form of [questionId, languageID, typeID, optionIDs, constructID]
     */
    protected function insertQuestionTable($questions) : array {
        $rows = [];
        foreach($questions as $question) {
            array_push($rows, [$question[1], $question[2], $question[0]]);
        }
        $queryFetchNewQuestionIDs = 'SELECT idQuestion
                                    FROM a21ux04.Question2 as Q2
                                    WHERE Q2.idQuestion BETWEEN (SELECT last_insert_id()) AND (SELECT last_insert_id()) + :affectedRows: - 1';
        $queryInsertQ = $this->queryRowsTable('INSERT', ['idLanguage', 'idType','description'], 'Question2', $rows);
        $this->db->transStart();

        $insert = $this->db->query($queryInsertQ['queryText'], $queryInsertQ['nameBinding']);
        $affectedRows = $this->db->affectedRows();
        $fetchIDs = $this->db->query($queryFetchNewQuestionIDs, ['affectedRows' => $affectedRows]);
        if (count($rows) != count($fetchIDs->getResult()) )throw new DatabaseException('Something went wrong while inserting new Questions in a21uxO4.Question2');
        for ($indexID = 0; $indexID < count($fetchIDs->getResult()); $indexID++ ){
            $questions[$indexID][0] = $fetchIDs->getResult()[$indexID]->idQuestion;
        }
        $this->error_check();
        $this->db->transComplete();

        return($questions);

    }

    /**
     * Helper function Called in insertQuestionDB. Inserts many-to-many in a21ux04.QuestionHasOption
     *
     * @param   $questions   :   array of rows with each row in form of [questionID, languageID, typeID, optionIDs, constructID]
     *
     */
    protected function insertQuestionHasOption($questions) {
        $rows = [];
        foreach($questions as $question) {
            foreach($question[3] as $optionID)
                array_push($rows, [$question[0], $optionID]);
        }

        $queryInsertQHO = $this->queryRowsTable('INSERT', ['idQuestion', 'idOption'], 'QuestionHasoption', $rows);
        $this->db->transStart();
        $insert = $this->db->query($queryInsertQHO['queryText'], $queryInsertQHO['nameBinding']);
        $this->error_check();
        $this->db->transComplete();
    }

    //abstract public function removeQuestionSurvey($surveyID);


}
