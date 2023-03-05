<?php

namespace App\Models\DataBaseModels;

use CodeIgniter\Database\Exceptions\DatabaseException;
use CodeIgniter\Database\Exceptions\DataException;
use CodeIgniter\Model;

abstract class DatabaseModel extends Model
{
    private $dbData;

    protected function __construct($dbData)
    {
        parent::__construct();
        $this->dbData = $dbData;

        $this->db = \Config\Database::connect();
        //$this->db = \Config\Database::connect('manual);
    }

/**
     * -------------QUERY FUNCTIONS THE DATABASE TABLE----------------------------
     */

    /**
     * Used to insert new Genres, GameTitles, Tags or Options in the database.
     * @param $columnNames array (1D)  :   1D-array of strings with the table column names. First columnNames is the ID column. Second one is the description!
     * @param $table string            :   the tablename in the database
     * @param $values array (2D)       :   2D array of new values to add
     * @return array                   :    array of new value indices
     */
    protected function insertUniqueValues(string $table, array $columnNames, array $values) : array {
        if (count($values[0]) != 1) throw new \UnexpectedValueException('Trying to add unique values :"'.print_r($values).'" which are not in a 2D array format.');
        $queryInsertUnique = $this->queryRowsTable('INSERT', [$columnNames[1]], $table, $values);
        $queryFetchNewValueIDs = 'SELECT '. $columnNames[0].'
                                FROM '.$table.'
                                WHERE '.$columnNames[0].' BETWEEN (SELECT last_insert_id()) AND (SELECT last_insert_id()) + :affectedRows: - 1';
        $this->db->transStart();
        $insertValues = $this->db->query($queryInsertUnique['queryText'], $queryInsertUnique['nameBinding']);
        $affectedRows = $this->db->affectedRows();
        $fetchIDs = $this->db->query($queryFetchNewValueIDs, ['affectedRows' => $affectedRows]);
        if (count($values) != count($fetchIDs->getResult()) )throw new DatabaseException('Something went wrong while inserting new unique values in table "'.$table.'".');
        for ($indexID = 0; $indexID < count($fetchIDs->getResult()); $indexID++ ){
            eval("\$values[\$indexID] = \$fetchIDs->getResult()[\$indexID]->$columnNames[0];");
        }
        $this->error_check();
        $this->db->transComplete();
        return($values);
    }

    /**
     * Inserts rows in a many-to-many relationship in the database where one of two IDs remains constant.
     *
     * @param $table string       :   the tablename where to insert
     * @param $columnNames array  :   the columnnames, mind the order!
     * @param $constantID int     :   the constant ID of the many to many relationship (e.g. surveyID or qustionId)
     * @param $varyingIDs array   :   1D array of the varying ID integers
     *
     */
    protected function insertManyToMany(string $table, array $columnNames, int $constantID, array $varyingIDs) {
        if ($varyingIDs[0] == null) return;
        $rows = [];
        foreach($varyingIDs as $varyingID) {
            array_push($rows, [$constantID, $varyingID]);
        }
        $queryBuild = $this->queryRowsTable('INSERT',$columnNames, $table, $rows);
        $this->db->transStart();
        $query = $this->db->query($queryBuild['queryText'], $queryBuild['nameBinding']);
        $this->error_check();
        $this->db->transComplete();
    }

    /**
     * This function builds the query text to INSERT or DELETE multiple rows in a table.
     * @param array $columns : an array containing column names as defined in the database.
     * @param array $rows    : a 2-D array containing the row elements.
     *                         N.B.: !Values in a row must align with the column array!
     * @param string $table  : the name of the database table
     * @param string $mode   : 'INSERT': Inserts the rows into the table
     *                         'DELETE': Deletes the rows from the table. Not every column is necessary.
     *                         'SELECT': Selects the rows from the table. Not every column is necessary.
     *
     * @returns array-key : array of two (key value) pairs where
     *      pair 1 = ('queryText' => string) : a string containing the query text to pass to the DB.
     *      pair 2 = ('namebinding' => array-key) : an array of key-value pairs which binds he data to the query-string.
     *
     * @throws \UnexpectedValueException when there is a mismatch between number of column and row elements
     *                                  OR when there is a mismatch between number of row elements.
     */
    public function queryRowsTable($mode, $columns, $table, $rows): array
    {
        $nameBinding = [];
        $valueString = '';
        $columnString = '';
        $columnIndex = [];
        $z = 0;
        $selectCond = [];
        if($mode == 'INSERT' || 'DELETE') {
            foreach ($columns as $column) {
                $columnIndex[$column] = $z;
                $columnString = $columnString . $column . ', ';
                $z++;
            }
        } elseif ($mode == 'SELECT') {
            foreach ($columns as $column) {
                $columnIndex[$column] = $z;
                $selectCond[$column] = [];
                $z++;
            }
        }
        $columnString = substr($columnString, 0, -2);
        $i = 0;
        $j = 0;
        $numberRowElements = count($rows[0]);

        if (count($columns) - $numberRowElements != 0) {
            throw new \UnexpectedValueException('Number of columns does not match the number of elements in the first row.');
        }
        if(($mode == 'INSERT') || ($mode == 'DELETE')) {

            foreach ($rows as $row) {
                if (count($row) - $numberRowElements != 0) {
                    throw new \UnexpectedValueException('Number of elements in current row "' . print_r($row) .
                        '" (' . count($row) . ' elements) does not match number of elements of the first row.(' . $numberRowElements . ' elements")');
                }
                $temp_valueString = '';
                foreach ($columns as $col) {
                    $nameBinding[$col . $i] = $row[$columnIndex[$col]];
                    $j++;
                    $temp_valueString = $temp_valueString . ':' . $col . $i . ':, ';
                }
                $temp_valueString = substr($temp_valueString, 0, -2);
                $valueString = $valueString . '(' . $temp_valueString . '), ';
                $i++;
            }
        }
        if ($mode=='SELECT') {
            $temp_valueString = [];
            foreach ($columns as $col) {
                $i = 0;
                $temp_valueString[$col] = '';
                foreach ($rows as $row) {
                    if (count($row) - $numberRowElements != 0) {
                        throw new \UnexpectedValueException('Number of elements in current row "' . print_r($row) .
                            '" (' . count($row) . ' elements) does not match number of elements of the first row.(' . $numberRowElements . ' elements")');
                    }
                    $nameBinding[$col . $i] = $row[$columnIndex[$col]];
                    $temp_valueString[$col] = $temp_valueString[$col] . ':' . $col . $i . ':, ';
                    $i++;

                }
                $temp_valueString[$col] = substr($temp_valueString[$col], 0, -2);
                $selectCond[$col] = '(' . $temp_valueString[$col] . ')';
            }
        }


        $valueString = substr($valueString, 0, -2);
        if($mode == 'INSERT') {
            $query_text = 'INSERT INTO ' . $table . ' (' . $columnString . ')
                                VALUES ' . $valueString;
        }
        elseif ($mode == 'DELETE') {

            $query_text = 'DELETE FROM '.$table. ' WHERE ' .$columnString. ' IN ' .$valueString;
        }
        elseif ($mode == 'SELECT') {

            $conditionsString = '';
            foreach ($columns as $col) {
                $conditionsString = $conditionsString.' AND '. $col.' IN '.$selectCond[$col];
            }
            $conditionsString = substr($conditionsString, 4);
            $query_text = 'SELECT * FROM '.$table. ' WHERE '.$conditionsString;

        }
        return ['queryText' => $query_text, 'nameBinding' => $nameBinding];



        /* $query_text = 'INSERT INTO Option` (`Name`)
                      VALUES (:gameTitle:)';
         foreach($columnNames)

         $i = 0;
         foreach ($ as $gameTitle) {
             $gameTitleID = $this->getGameTitleID($gameTitle);
             $valueString = '';
             if($i + 1 == $numberOf) {
                 $valueString = $valueString . '(:surveyID:, :titleID' . $i . ':)';
             }else {
                 $valueString = $valueString . '(:surveyID:, :titleID' . $i . ':), ';
             }
             $queryBinding['titleID' . $i] = $gameTitleID;
             $queryBinding['surveyID'] = $surveyID;
             $i++;*/

    }

    /**
     * Checks whether an insertion or deletion query was effective.
     * Only runs when the db connection in the constructor is set on 'manual'.
     * @throws DatabaseException when query did not perform.
     */
    protected function error_check() {
        if($this->db->DBDebug == true) {
            //Codeigniter debug already running.
            return;
        }
        if($this->db->affectedRows() == 0) {
            echo('No affected rows for query: '. $this->db->getLastQuery());
        }

        if ($this->db->transStatus() === false) {
            //echo('Tried to perform query: "' . $this->db->getLastQuery() . '" but got error '.$this->db->error()['code'].': ' . $this->db->error()['message']);
            print_r($this->db);
            throw new DatabaseException('Query error! Be careful: id autoincrement has increased although no entry was inserted.');
        }
    }


 /**
     * -------------GET UNIQUE VALUES FROM THE DATABASE TABLE----------------------------
     */

    /**
     * @Returns array-key with (key, value) pairs containing the stored database game constructs.
     * The constructs need to be explicitly loaded in the controller method of the page using the basecontroller function 'loadDBData'
     *   'key'    = Construct2.idConstruct
     *   'value'  = Construct2.description
     */
    public function getAllConstructs(): array{
        return $this->dbData['Construct2'];
    }

    /**
     * @Returns array-key with (key, value) pairs containing the stored database game titles.
     * The gametitles need to be explicitly loaded in the controller method of the page using the basecontroller function 'loadDBData'
    *   'key'    = GameTitle.idGameTit
    *   'value'  = GameTitle.Name
    */
    public function getAllGameTitles(): array {
        return $this->dbData['GameTitle'];
    }

    /**
     * @Returns array-key with (key, value) pairs containing the stored database genres
     * The genres need to be explicitly loaded in the controller method of the page using the basecontroller function 'loadDBData'
     *  'key'    = Genre.genreID
     *  'value'  = Genre.description
     */
    public function getAllGenres(): array {
        return $this->dbData['Genre'];
    }

    /**
     * @Returns array-key with (key, value) pairs containing the stored database languages
     * The languages need to be explicitly loaded in the controller method of the page using the basecontroller function 'loadDBData'
     *  'key'    = Language2.idLanguage
     *  'value'  = Language2.description
     */
    public function getAllLanguages(): array
    {
        return $this->dbData['Language2'];
    }

    /**
     * @Returns array-key with (key, value) pairs containing the stored database options
     * The options need to be explicitly loaded in the controller method of the page  using the basecontroller function 'loadDBData'
     *  'key'    = Option.idOption
     *  'value'  = Option.description
     */
    public function getAllOptions(): array {
        return $this->dbData['Option'];
    }

    /**
     * @Returns array-key with (key, value) pairs containing the stored database question types
     * The types need to be explicitly loaded in the controller method of the page  using the basecontroller function 'loadDBData'
     *  'key'    = QuestionTypes.questionTypesID
     *  'value'  = QuestionTypes.type
     */
    public function getAllQuestionTypes() : array {
        return $this->dbData['QuestionType'];
    }

    /**
     * @Returns array-key with (key, value) pairs containing the stored database tags
     *  The tags need to be explicitly loaded in the controller method of the page  using the basecontroller function 'loadDBData'
     *  'key'    = Tags.idtags
     *  'value'  = Tags.tagname
     */
    public function getAllTags(): array {
            return $this->dbData['Tags'];
    }

    public function getDbData() {
        return $this->dbData;
    }



 /**
 * -------------GET UNIQUE VALUE IDs----------------------------
 */

    /**
     * @Returns int ID of the given string.
     * @Throws  DatabaseException when the string is not present in the database tabe.
     */

    protected function getConstructID($construct) {
        $construct = strtolower($construct);
        $constructs = $this->getAllConstructs();
        $constructID = array_search($construct, $constructs);
        if($constructID == null) {
            throw new DatabaseException('Construct "'.$construct.'" does not exist in the database');
        }
        return($constructID);
    }

    protected function getGameTitleID($gameTitle) {
        $gameTitle = strtolower($gameTitle);
        $gameTitles = $this->getAllGameTitles();
        $gameTitleID = array_search($gameTitle, $gameTitles);
        if($gameTitleID == null) {
            throw new DatabaseException('Genre "'.$gameTitle.'" does not exist in the database');
        }
        return($gameTitleID);
    }

    protected function getGenreID($genre) {
        $genre = strtolower($genre);
        $genres = $this->getAllGenres();
        $genreID = array_search($genre, $genres);
        if($genreID == null) {
            throw new DatabaseException('Genre "'.$genre.'" does not exist in the database');
        }
        return($genreID);
    }

    protected function getLanguageID($language) {
        $language = strtolower($language);
        $languages = $this->getAllLanguages();
        $languageID = array_search($language, $languages);
        if($languageID == null) {
            throw new DatabaseException('Language "'.$language.'" does not exist in the database');
        }
        return($languageID);
    }

    protected function getOptionID($option) {
        $option = strtolower($option);
        $options = $this->getAllOptions();

        $optionID = array_search($option, $options);
        if($optionID == null) {
            throw new DatabaseException('Option "'.$option.'" does not exist in the database');
        }
        return($optionID);
    }

    protected function getTagID($tag) {
        $tag = strtolower($tag);
        $tags = $this->getAllTags();
        $tagID = array_search($tag, $tags);
        if($tagID == null) {
            throw new DatabaseException('Genre "'.$tag.'" does not exist in the database');
        }
        return($tagID);
    }

    protected function getTypeID($questionType) {
        $questionType = strtolower($questionType);
        $types = $this->getAllQuestionTypes();
        $typeID = array_search($questionType, $types);
        if($typeID == null) {
            throw new DatabaseException('Type "'.$questionType.'" does not exist in the database');
        }
        return($typeID);
    }




}