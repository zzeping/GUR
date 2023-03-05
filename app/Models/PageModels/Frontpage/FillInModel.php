<?php

namespace App\Models\PageModels\Frontpage;

use http\Exception\UnexpectedValueException;

class FillInModel extends TemplateModel
{


    /**
     * @var \CodeIgniter\Database\BaseConnection
     */


    public function __construct($languageID)
    {
        parent::__construct($languageID);
        $this->db = \Config\Database::connect();
        //NECESSARY: Set custom template data. Implement this function below.
        $this->setTemplateData($languageID);


    }
    //NECESSARY: Implement this function
    private function setTemplateData($languageID) {
        parent::setHeroImage(base_url(). '');
        if($languageID == 'en') {
            parent::setPageTitle('');
            parent::setTemplateTitle('');
            parent::setTemplateSubtitle('');
        }
        else if ($languageID == 'nl') {
            parent::setPageTitle('');
            parent::setTemplateTitle('');
            parent::setTemplateSubtitle('');
        }

    }

    //for every question in this particular survey: order by sequence number [questiondescr, pagebreak, type, option, qid]
    public function getQuestions($surveyid) {

        $query_text = "SELECT distinct Question2.description, SurveyQuestionAnswer.questionId, SurveyQuestionAnswer.SequenceNumber, SurveyQuestionAnswer.Pagebreak, QuestionType.description as type
					   FROM a21ux04.Question2, a21ux04.QuestionType, a21ux04.SurveyQuestionAnswer, a21ux04.QuestionHasoption
				       WHERE SurveyQuestionAnswer.surveyId = :surveyid:
					   AND Question2.IdType = QuestionType.idType 
					   AND SurveyQuestionAnswer.questionId = Question2.idQuestion 
					   AND QuestionHasoption.idQuestion = Question2.idQuestion
					   ORDER BY SurveyQuestionAnswer.SequenceNumber ASC";
        $query = $this->db->query($query_text, [ 'surveyid' => $surveyid]);
        return $query->getResult();

    }
    public function getQuestionsAndOptions($surveyid){
        $query_text = "SELECT distinct Question2.description as questiondescription, SurveyQuestionAnswer.questionId, SurveyQuestionAnswer.SequenceNumber, SurveyQuestionAnswer.Pagebreak, QuestionType.description, Option.description 
                       FROM a21ux04.Question2, a21ux04.QuestionType, a21ux04.SurveyQuestionAnswer, a21ux04.Option, a21ux04.QuestionHasoption
                       WHERE SurveyQuestionAnswer.surveyId = :surveyid:
                       AND Question2.IdType = QuestionType.idType 
                       AND SurveyQuestionAnswer.questionId = Question2.idQuestion 
                       AND Option.idOption = QuestionHasoption.idOption 
                       AND QuestionHasoption.idQuestion = Question2.idQuestion
                       ORDER BY SurveyQuestionAnswer.SequenceNumber ASC";
        $query = $this->db->query($query_text, [ 'surveyid' => $surveyid]);
        return $query->getResult();
    }

    //for each MC question call this query
    public function insertAnswersMC($questionId, $surveyId, $option){

        $query_text = "UPDATE a21ux04.SurveyQuestionAnswer
                       SET numberOfAnswers = numberOfAnswers + 1
                       WHERE questionId = :questionId: 
                       AND surveyId = :surveyId: 
                       AND idOption = (SELECT idOption from a21ux04.Option WHERE Option.description = :option:)";

        return $query = $this->db->query($query_text,[ 'option' => $option, 'questionId' => $questionId, 'surveyId' => $surveyId]);
    }

    public function insertAnswersOpen($questionId, $surveyId, $description){

        $query_text = "Insert INTO a21ux04.OpenAnswer(surveyId, questionId, description)
                       VALUES (:surveyId:, :questionId:, :description:)";

        return $query = $this->db->query($query_text,[ 'description' => $description, 'questionId' => $questionId, 'surveyId' => $surveyId]);
    }
    public function getTitle($surveyid) {
        $query_text ="SELECT title from a21ux04.Survey2 where idSurvey = :surveyid:";
        $query = $this->db->query($query_text, [ 'surveyid' => $surveyid]);
        return $query->getResult();
    }


}


