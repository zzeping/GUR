<?php

namespace App\Controllers;




use App\Models\QuestionModel;

class SurveyCreationController extends BaseController
{

    private $data = [];
    private $components = [];
    private $questions;

 /*****************************************************************************************************************
 ----DashboardController constructor---------------------------------------------------------------------------------
 *****************************************************************************************************************/

    public function __construct() {
        $this->db = \Config\Database::connect();
        $this->question_model = new QuestionModel();
    }


/*****************************************************************************************************************
----DashboardController methods----------------------------------------------------------------------------------
 *****************************************************************************************************************/



    public function home()
    {
        helper(['form']);

        $components = $this->load_components(['db_navbar', 'footer']);
        $data['title'] = 'PXI Create Survey';

//        $data["questions_en"] = $this->question_model->fetch_PXI_questions('English');
//        $data["questions_nl"] = $this->question_model->fetch_PXI_questions('Dutch');
        $contentData["questions_en_enjoy_long"] = $this->question_model->fetch_PXI_questions_enjoy_long('English');
        $contentData["questions_nl_enjoy_long"] = $this->question_model->fetch_PXI_questions_enjoy_long('Dutch');
        $contentData["questions_en_enjoy_short"] = $this->question_model->fetch_PXI_questions_enjoy_short('English');
        $contentData["questions_nl_enjoy_short"] = $this->question_model->fetch_PXI_questions_enjoy_short('Dutch');
        $contentData["questions_nl_long"] = $this->question_model->fetch_PXI_questions_long('Dutch');
        $contentData["questions_en_long"] = $this->question_model->fetch_PXI_questions_long('English');
        $contentData["questions_nl_short"] = $this->question_model->fetch_PXI_questions_short('Dutch');
        $contentData["questions_en_short"] = $this->question_model->fetch_PXI_questions_short('English');
        $contentData["person_id"] = session()->get('ID');

        $css = ['db-template.css','db-create-survey.css'];
       // array_push($this->data['scripts_to_load'], 'create_survey.js');

        $content = 'db_create_survey';

        $js = ['create_survey.js', 'jquery-3.6.0.min.js'];

        return $this->show('db_template', $components, $data, $css, $js, $content, $contentData);

    }

    public function addQuestionnaire()
    {
        if ($this->request->isAJAX()) {

            $surveyName = $this->request->getVar('surveyName');
            $description = $this->request->getVar('description');
            $longShortBoolean = $this->request->getVar('longShortBoolean');
            $enjoymentBoolean = $this->request->getVar('enjoymentBoolean');
            $language = $this->request->getVar('language');
            $start = $this->request->getVar('start');
            $end = $this->request->getVar('end');
            $endingMessage = $this->request->getVar('endingMessage');
            $query_text = "INSERT INTO `a21ux04`.`Survey` (`description`, `languageId`, `longShortBoolean`, `surveyName`, `enjoymentBoolean`,`open`,`close`,`endingMessage`)
VALUES (:description: , (SELECT languageId FROM a21ux04.Language WHERE description LIKE :language:) , :longShortBoolean:, :surveyName:, :enjoymentBoolean:, :start:,:end:,:endingMessage:);
";
             return $this->db->query($query_text,['description'=>$description,'language'=>$language,'longShortBoolean'=>$longShortBoolean,'surveyName'=>$surveyName,'enjoymentBoolean'=>$enjoymentBoolean,'start'=>$start,'end'=>$end,'endingMessage'=>$endingMessage]);
        }
    }
    public function addPersonId()
    {
        if ($this->request->isAJAX()) {
            $surveyId = $this->request->getVar('surveyId');
            $person_id = $this->request->getVar('person_id');
            $query_text = "INSERT INTO a21ux04.SurveyRole(surveyId, PersonId) VALUES(:surveyId:, :person_id:);";
            return $this->db->query($query_text,['surveyId'=>$surveyId,'person_id'=>$person_id]);
        }
    }

    public function addQuestions()
    {
        if ($this->request->isAJAX()) {
            $questionId = $this->request->getVar('questionId');
            $surveyId = $this->request->getVar('surveyId');
            $SequenceNumber = $this->request->getVar('SequenceNumber');
            $Pagebreak = $this->request->getVar('Pagebreak');
            $query_text = "INSERT INTO a21ux04.SurveyQuestions(surveyId, questionId,SequenceNumber,Pagebreak) VALUES(:surveyId:, :questionId:,:SequenceNumber:,:Pagebreak:);";
            return $this->db->query($query_text,['surveyId'=>$surveyId,'questionId'=>$questionId,'SequenceNumber'=>$SequenceNumber,'Pagebreak'=>$Pagebreak]);
        }
    }
    

    public function get_surveyId()
    {
        if($this->request->isAJAX()) {
            $query_text = "Select max(surveyId) as surveyId from a21ux04.Survey;";
            $query = $this->db->query($query_text);
            $array = $query->getResult()[0];
            $array = json_encode($array);
            $array = json_decode($array);
            return $array->surveyId;
        }
    }

    public function addNewQuestions()
    {
        if ($this->request->isAJAX()) {
            $question = $this->request->getVar('question');
            $type = $this->request->getVar('type');
            $language = $this->request->getVar('language');
            $query_text = "INSERT INTO a21ux04.Question(description,typeId,LanguageID) VALUES(:question:,
                                                                   (SELECT questionTypesID FROM a21ux04.QuestionTypes WHERE type LIKE :type:),
                                                                   (SELECT languageId FROM a21ux04.Language WHERE description LIKE :language:));";
            return $this->db->query($query_text,['question'=>$question,'type'=>$type,'language'=>$language]);
        }
    }

    public function get_addedId()
    {
        if($this->request->isAJAX()) {
            $query_text = "Select max(questionId) as questionId from a21ux04.Question";
            $query = $this->db->query($query_text);
            $array = $query->getResult()[0];
            $array = json_encode($array);
            $array = json_decode($array);
            return $array->questionId;
        }
    }
    
    public function insertOptions()
    {
        if ($this->request->isAJAX()) {
            $questionId = $this->request->getVar('questionId');
            $totalOptions = $this->request->getVar('totalOptions');
            $optionNr = $this->request->getVar('optionNr');
            $description = $this->request->getVar('description');
            $query_text = "INSERT INTO a21ux04.MCOptions(questionId,totalOptions,optionNr,description) 
                                VALUES(:questionId:,:totalOptions:,:optionNr:,:description:);";
            return $this->db->query($query_text,['questionId'=>$questionId,'totalOptions'=>$totalOptions,'optionNr'=>$optionNr,'description'=>$description]);
        }
    }



}