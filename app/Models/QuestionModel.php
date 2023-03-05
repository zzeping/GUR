<?php

namespace App\Models;

class QuestionModel
{
    private $db;

    public function __construct() {
        $this->db = \Config\Database::connect();
    }

//    public function fetch_PXI_questions($language)
//    {
//        $query_text = "SELECT questionId, description FROM Question WHERE typeId = 1;";
//        $query_text = "SELECT questionId, description FROM a21ux04.Question WHERE typeId = 1 AND LanguageID = (SELECT LanguageId FROM a21ux04.Language WHERE description = '$language');";
//        $query = $this->db->query($query_text);
//        return $query->getResult();
//    }


    //____________NOTE TO LOUIS AND ZEPING: PLEASE CLEAN THESE FUNCTIONS!_______________



    public function fetch_PXI_question($surveyId)
    {
        //$query_text = "SELECT questionId, description FROM Question WHERE typeId = 1;";
        $query_text = 'SELECT surveyQuestionsId, typeId, SurveyQuestions.questionId, description, construct FROM a21ux04.Question
                       INNER JOIN a21ux04.SurveyQuestions
                       ON SurveyQuestions.questionId = Question.questionId
                       LEFT JOIN a21ux04.ConstructTypes
                       ON ConstructTypes.questionID = Question.questionId
                       WHERE surveyId = :surveyId: AND LanguageID = (SELECT LanguageId FROM a21ux04.Language WHERE description = \'English\') AND typeId = 1';
        $query = $this->db->query($query_text, ['surveyId' => $surveyId]);

        return $query->getResult();

    }
    public function fetch_PXI_questions_enjoy_long_louis($language)
    {
        //$query_text = "SELECT questionId, description FROM Question WHERE typeId = 1;";
        $query_text = "SELECT questionId, description FROM a21ux04.Question WHERE LanguageID = (SELECT LanguageId FROM a21ux04.Language WHERE description LIKE '$language') 
                                                       and (typeId = 5);";
        $query = $this->db->query($query_text);
        return $query->getResult();
    }

    public function fetch_PXI_questions_long_louis($language, $long)
    {
        //$query_text = "SELECT questionId, description FROM Question WHERE typeId = 1;";
        $query_text = "SELECT questionId, description FROM a21ux04.Question WHERE LanguageID = (SELECT LanguageId FROM a21ux04.Language WHERE description LIKE '$language') 
                                                       AND IF(0.5 > '$long', typeID = 6, typeId = 1);";
        $query = $this->db->query($query_text);
        return $query->getResult();
    }



//____________NOTE TO LOUIS AND ZEPING: PLEASE CLEAN THESE FUNCTIONS!_______________
    public function fetch_PXI_questions_enjoy_long($language)
    {
        //$query_text = "SELECT questionId, description FROM Question WHERE typeId = 1;";
        $query_text = "SELECT questionId, description FROM a21ux04.Question INNER JOIN a21ux04.QuestionTypes ON Question.typeId = QuestionTypes.questionTypesID
WHERE type LIKE 'enjoyment-Long%' AND LanguageID = (SELECT LanguageId from a21ux04.Language WHERE description Like :language:);";
        $query = $this->db->query($query_text,['language'=>$language]);
        return $query->getResult();
    }

    //____________NOTE TO LOUIS AND ZEPING: PLEASE CLEAN THESE FUNCTIONS!_______________
    public function fetch_PXI_questions_long($language)
    {
        //$query_text = "SELECT questionId, description FROM Question WHERE typeId = 1;";
        $query_text = "SELECT questionId, description FROM a21ux04.Question INNER JOIN a21ux04.QuestionTypes ON Question.typeId = QuestionTypes.questionTypesID
WHERE type LIKE 'PXI-Long%' AND LanguageID = (SELECT LanguageId from a21ux04.Language WHERE description Like :language:);";
        $query = $this->db->query($query_text,['language'=>$language]);
        return $query->getResult();
    }
    public function fetch_PXI_questions_short($language)
    {
        //$query_text = "SELECT questionId, description FROM Question WHERE typeId = 1;";
        $query_text = "SELECT questionId, description FROM a21ux04.Question INNER JOIN a21ux04.QuestionTypes ON Question.typeId = QuestionTypes.questionTypesID
WHERE type LIKE 'PXI-short%' AND LanguageID = (SELECT LanguageId from a21ux04.Language WHERE description Like :language:);";
        $query = $this->db->query($query_text,['language'=>$language]);
        return $query->getResult();
    }

//____________NOTE TO LOUIS AND ZEPING: PLEASE CLEAN THESE FUNCTIONS!_______________
    public function fetch_PXI_questions_enjoy_short($language)
    {
        //$query_text = "SELECT questionId, description FROM Question WHERE typeId = 1;";
        $query_text = "SELECT questionId, description FROM a21ux04.Question INNER JOIN a21ux04.QuestionTypes ON Question.typeId = QuestionTypes.questionTypesID
        WHERE type LIKE 'enjoyment-short%' AND LanguageID = (SELECT LanguageId from a21ux04.Language WHERE description Like :language:);";
        $query = $this->db->query($query_text,['language'=>$language]);
        return $query->getResult();
    }


}
