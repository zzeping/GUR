<?php

namespace App\Models\ComponentModels;

class QueryBuilder
{
    private $db;

    public function __construct() {
        $this->db = \Config\Database::connect();
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
    public function get_limitedAmountOfSurveys($limit) {
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

}