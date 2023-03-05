<?php

namespace App\Models\PageModels\Dashboard;

use http\Exception\UnexpectedValueException;

class ResultsModel extends TemplateModel
{
    //OPTIONALLY: Add here there different data structures that you want to use in your view.

    public function __construct($language)
    {
        parent::__construct($language);
        $this->db = \Config\Database::connect();
        //NECESSARY: Set custom template data. Implement this function below.
        $this->setTemplateData($language);
        //OPTIONALLY: Set custom data for this page.


    }

    //NECESSARY: Implement this function
    private function setTemplateData($language) {
        if($language == 'en') {
            parent::setPageTitle('');

        }
        else if ($language == 'nl') {
            parent::setPageTitle('');
        }

    }


    //questions [questiondescription, construct]
    public function getQuestions($surveyid) {
        $surveyid = $this->db->escape($surveyid);
        $surveyid = str_replace('\'','',$surveyid);
        $query_text = "SELECT distinct Question2.idQuestion, Question2.description as questiondescription, Construct2.description as construct
                       FROM a21ux04.Question2, a21ux04.Construct2, a21ux04.QuestionHasConstruct, a21ux04.SurveyQuestionAnswer
                       WHERE SurveyQuestionAnswer.surveyId = :surveyid:
                       AND Construct2.IdConstruct = QuestionHasConstruct.constructId 
                       AND Question2.idQuestion = QuestionHasConstruct.questionId 
                       AND SurveyQuestionAnswer.questionId = Question2.idQuestion";
        $query = $this->db->query($query_text, [ 'surveyid' => $surveyid]);

        return $query->getResult();

    }

    //questionanswers [questiondescription, optiondescription, numberofanswers]
    public function getQuestionAnswers($surveyid) {
        $surveyid = $this->db->escape($surveyid);
        $surveyid = str_replace('\'','',$surveyid);
        $query_text = "SELECT Question2.description as questiondescription, SurveyQuestionAnswer.numberOfAnswers, Option.description as optiondescription  FROM a21ux04.SurveyQuestionAnswer
                       INNER JOIN a21ux04.Question2 ON SurveyQuestionAnswer.questionId = Question2.idQuestion
                       INNER JOIN a21ux04.Option ON SurveyQuestionAnswer.idOption = Option.idOption
                       WHERE surveyId = :surveyid:";
        $query = $this->db->query($query_text, [ 'surveyid' => $surveyid]);
        //print_r($query);
        return $query->getResult();

    }
    public function getTitle($surveyid) {
        $surveyid = $this->db->escape($surveyid);
        $surveyid = str_replace('\'','',$surveyid);
        $query_text ="SELECT title from a21ux04.Survey2 where idSurvey = :surveyid:";
        $query = $this->db->query($query_text, [ 'surveyid' => $surveyid]);
        return $query->getResult();
    }
}


