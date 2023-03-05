<?php

namespace App\Models\DataBaseModels;

use CodeIgniter\Database\Exceptions\DatabaseException;
use CodeIgniter\Database\Exceptions\DataException;
use CodeIgniter\Exceptions\ModelException;

class QuestionPXIModel extends QuestionModel
{
    public function __construct($dbData) {
        parent::__construct($dbData);
    }

    /**
     * Inserts this PXI question, options and construct in tables a21ux04.Question2, a21ux04.QuestionHasOption and a21ux04.QuestionHasConstruct
     *
     * @param array $questions    :   array of rows with each row in form of [description, language, type, options, construct, sequenceNumber, pageBreak]
     *                                !options is a 1D array of option strings. null for open questions.
     *
     * @returns $questions  :   return value not used.
     */
    public function insertQuestionsDB(array $questions) : array{
        //Substitute the language, type, options and construct with their respective IDs.
        for($row = 0; $row < count($questions); $row++) {
            if (count($questions[$row]) != 7) throw new \UnexpectedValueException(
                'Provide the questions in correct 2D array format with each row having 7 parameters 
                 as this function description prescribes.');
            $questions[$row][2] = $this->getTypeID($questions[$row][2]);
            $questions[$row][1] = $this->getLanguageID($questions[$row][1]);
            $questions[$row][4] = $this->getConstructID($questions[$row][4]);
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
        $this->insertQuestionHasConstruct($questions);
        return [$questions];
    }

    /**
     * Helper function Called in insertQuestionDB. Inserts many-to-many in a21ux04.PXIHasConstruct
     *
     * @param $questions   :   array of rows with each row in form of [questionID, languageID, typeID, optionIDs, constructID]
     *
     */
    private function insertQuestionHasConstruct($questions) {
        $rows = [];
        foreach($questions as $question) {
            array_push($rows, [$question[0], $question[4]]);
        }
        $queryInsertQHC = $this->queryRowsTable('INSERT', ['questionId', 'constructId'], 'QuestionHasConstruct', $rows);
        $this->db->transStart();
        $insert = $this->db->query($queryInsertQHC['queryText'], $queryInsertQHC['nameBinding']);
        $this->error_check();
        $this->db->transComplete();
    }


    /**
     * Select all PXI question descriptions/IDs of given language by their construct description/ID. Optionally fetch the option descriptions/IDs.
     *
     * @param $language         :      the language of the Questions to select.
     * @param $return           :      'DESCR'    :  return the readable descriptions of questions, constructs (and options) together with question IDs.
     *                                 'IDS'      :  return the IDS of the questions, constructs (and options).
     * @param $includeOptions   :      if 0, omits the PXI options. If 1, includes the PXI options.
     *
     * @return array        :   an array of (key, [value]) pairs where
     *                          'Key'   = construct description/ID
     *                          'Value' = array with elements [question description/Id, (option description/Id) ]
     */
    public function getPXI($language, $return, $includeOptions) {
        $languageID = $this->getLanguageID($language);
        if($return == 'DESCR') {
            if(!$includeOptions) {
                $selectPXIQuery = 'SELECT DISTINCT Q2.idQuestion, Q2.description as Q2descr, C2.description AS C2descr
                           FROM QuestionHasConstruct as QHC, QuestionHasoption as QHO, Question2 as Q2, Construct2 as C2
                           WHERE Q2.idQuestion IN (SELECT DISTINCT questionId 
												   FROM QuestionHasConstruct)
                           AND   QHC.questionID = Q2.idQuestion
                           AND   QHC.constructid = C2.idConstruct
                           AND   Q2.idLanguage = :languageId:';
            }
            else {
                $selectPXIQuery = 'SELECT Q2.idQuestion,, Q2.description as Q2descr, C2.description AS C2descr, O.description as Odescr
                           FROM QuestionHasConstruct as QHC, QuestionHasoption as QHO, Question2 as Q2, Construct2 as C2, a21ux04.Option as O
                           WHERE Q2.idQuestion IN (SELECT DISTINCT questionId 
												   FROM QuestionHasConstruct)
                           AND   QHC.questionID = Q2.idQuestion
                           AND   QHC.constructid = C2.idConstruct
                           AND   QHO.idQuestion = Q2.idQuestion
                           AND	 QHO.idOption = O.idOption
                           AND   Q2.idLanguage = :languageId:';
            }
            $this->db->transStart();
            $select = $this->db->query($selectPXIQuery, ['languageId' => $languageID]);
            $result = [];
            foreach($select->getResult() as $row) {
                if (!isset($result[$row->C2descr])) {
                    $result[$row->C2descr] = [];
                };
                if($includeOptions) array_push($result[$row->C2descr], [$row->Q2descr, $row->Odescr]);
                else array_push($result[$row->C2descr], [$row->idQuestion, $row->Q2descr]);

            }
            return $result;
        }
        elseif ($return = 'IDS') {
            if(!$includeOptions) {
                $selectPXIQuery = 'SELECT DISTINCT Q2.idQuestion as Q2id, C2.idConstruct AS C2id
                           FROM QuestionHasConstruct as QHC, QuestionHasoption as QHO, Question2 as Q2, Construct2 as C2
                           WHERE Q2.idQuestion IN (SELECT DISTINCT questionId 
												   FROM QuestionHasConstruct)
                           AND   QHC.questionID = Q2.idQuestion
                           AND   QHC.constructid = C2.idConstruct
                           AND   Q2.idLanguage = :languageId:';
            }
            else {
                $selectPXIQuery = 'SELECT Q2.idQuestion as Q2id, C2.idConstruct as C2id, O.idOption as Oid
                           FROM QuestionHasConstruct as QHC, QuestionHasoption as QHO, Question2 as Q2, Construct2 as C2, a21ux04.Option as O
                           WHERE Q2.idQuestion IN (SELECT DISTINCT questionId 
												   FROM QuestionHasConstruct)
                           AND   QHC.questionID = Q2.idQuestion
                           AND   QHC.constructid = C2.idConstruct
                           AND   QHO.idQuestion = Q2.idQuestion
                           AND	 QHO.idOption = O.idOption
                           AND   Q2.idLanguage = :languageId:';
            }
            $this->db->transStart();
            $select = $this->db->query($selectPXIQuery, ['languageId' => $languageID]);
            $result = [];
            foreach($select->getResult() as $row) {
                if (!isset($result[$row->C2id])) {
                    $result[$row->C2id] = [];
                };
                if($includeOptions) array_push($result[$row->C2id], [$row->Q2id, $row->Oid]);
                else array_push($result[$row->C2id], [$row->Q2id]);

            }
            return $result;
        }

        elseif ($return == 'IDDescr') {
            $selectPXIQuery = 'SELECT Q2.idQuestion as Q2id, Q2.description as Q2descr, C2.idConstruct as C2id, C2.description AS C2descr,  O.idOption as Oid, O.description as Odescr
                           FROM QuestionHasConstruct as QHC, QuestionHasoption as QHO, Question2 as Q2, Construct2 as C2, a21ux04.Option as O
                           WHERE Q2.idQuestion IN (SELECT DISTINCT questionId 
												   FROM QuestionHasConstruct)
                           AND   QHC.questionID = Q2.idQuestion
                           AND   QHC.constructid = C2.idConstruct
                           AND   QHO.idQuestion = Q2.idQuestion
                           AND	 QHO.idOption = O.idOption
                           AND   Q2.idLanguage = :languageId:';
        }
    }

    /**
     * Select all PXI questionIDs of given description, optionally with the PXI optionIDs.
     *
     * @param $descriptions     :      a 2D array with rows [description, getTypeId('PXI')]
     * @param $includeOptions   :      if 0, omits the PXI options. If 1, includes the PXI options.
     *
     * @return array-key            :   if $includeOptions:  an array of key-value pairs where
     *                                      'Key' = strtolower(description)
     *                                      'Value' = array-2D. e.g.:  [[idQuestion1, idOption1], [[idQuestion1, idOption2], ...]
     *                                  if !$includeOptions: an array of key-value pairs where
     *                                      'Key' = strtolower(description)
     *                                      'Value' = idQuestion
     */
    public function getPXIByDescriptions($descriptions, $includeOptions) : array {
        $selectQuestionIDsQuery = $this->queryRowsTable('SELECT', ['idType', 'description'], 'Question2', $descriptions);
        $this->db->transStart();
        $selectqid = $this->db->query($selectQuestionIDsQuery['queryText'], $selectQuestionIDsQuery['nameBinding']);
        $result = [];
        $qIDS = [];
        foreach($selectqid->getResult() as $row) {
            if ($includeOptions) {
                $result[strtolower($row->description)]= $row->idQuestion;
                array_push($qIDS, [$row->idQuestion]);
            }
            else $result[strtolower($row->description)]= $row->idQuestion;
        }
        if($includeOptions) {
            $selectOptionIDsQuery = $this->queryRowsTable('SELECT', ['idQuestion'], 'QuestionHasoption', $qIDS);
            $selectoid = $this->db->query($selectOptionIDsQuery['queryText'], $selectOptionIDsQuery['nameBinding']);

            $tempResult = [];
            foreach($selectoid->getResult() as $row) {
                $key = array_search($row->idQuestion, $result);
                if (!isset($tempResult[$key])) {
                    $tempResult[$key] = [];
                }
                $qID = $result[array_search($row->idQuestion, $result)];

                array_push($tempResult[$key], [$qID, $row->idOption]);

                //$result[array_search($row->idQuestion, $result)] = [$qID, $row->idOption];
                //array_push($row->idOption);


                //array_push($result[array_search($row->idQuestion, $result)], $row->idOption);
            }
            $result = $tempResult;
        }
        $this->db->transComplete();

        return $result;
    }

    public function getPXIByID($language, $questionID, $includeOptions){
        //not yet implemented, not needed?
    }

    public function getPXIByConstruct($language, $includeOptions){
            //not yet implemented, not needed?
    }

}