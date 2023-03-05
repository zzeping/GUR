<?php

namespace App\Controllers;




use App\Models\PageModels\Frontpage\FillInModel;
use App\Models\QuestionModel;
use App\Models\SurveyModel;

class SurveyFillinController extends BaseController
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

    public function add_answers_to_db($surveyId){
        helper(['form']);
        $pageModel = new FillInModel($_SESSION['language']);
        $contentData['questions'] = $pageModel->getQuestions($surveyId);

        $contentData['survey'] = $surveyId;
        $answerData = [];
        $answerOpenData =[];
        if($this->request->getMethod() == 'post') {
            foreach( $contentData['questions'] as $q){
                if($q->type == "PXI" || "MC" ){
                    array_push($answerData, (object)[ 'answer_value' => $this->request->getVar('answer-value-'.$q->questionId), 'questionId' => $q->questionId]);
                }
                elseif($q->type == "Open" ){
                   array_push($answerOpenData, (object)['answer_text' => $this->request->getVar('open-answer-'.$q->questionId), 'questionId' => $q->questionId]);
                }

            }
            //var_dump($answerData);
            foreach( $answerData as $answer){
                $pageModel->insertAnswersMC($answer->questionId, $surveyId,(string)$answer->answer_value);
            }
            /*foreach($answerOpenData as $openAnswer){
                $surveyModel->insertAnswerOpen($openAnswer->answer_text,$surveyId, $openAnswer->questionId );
            }*/
        }
        $dbData = $this->loadDBData(['Genre', 'QuestionType', 'Option', 'Construct2', 'GameTitle', 'Tags']); //Necessary when using PersonModel, SurveyModel or QuestionPXIModel in Models > DatabaseModels
        $templateData['template'] = $pageModel->getTemplateData();
        $templateView = 'fp_template';

        $contentView = 'fp_completed_survey';


        $css = ['fp-template.css', 'fp-fillin.css'];
        $js = [''];
        return $this->show($templateView, $templateData, $contentView, $contentData, $css, $js);
    }

    public function home()
    {
        helper(['form']);
        $surveyID = $this->request->getVar('sID');
        $pageModel = new FillInModel($_SESSION['language']);
        $surveyTitle = $pageModel->getTitle($surveyID);

        //Load contentData:
        $contentData['questions'] = $pageModel->getQuestions($surveyID);
        $contentData['questionsandoptions'] = $pageModel->getQuestionsAndOptions($surveyID);

        $number_of_pages = 0;
        $number_of_questions = 0;
        foreach($contentData['questions'] as $q){
            $number_of_questions++;
            if($q->Pagebreak == null){
                    $q->page = $number_of_pages;
            }
            else{
                $q->page = $number_of_pages;
                $number_of_pages++;
            }
        }
        $contentData['number_of_pages'] = $number_of_pages;
        $contentData['number_of_questions'] = $number_of_questions;
        $contentData['surveyID'] = $surveyID;
        $dbData = $this->loadDBData(['Genre', 'QuestionType', 'Option', 'Construct2', 'GameTitle', 'Tags']); //Necessary when using PersonModel, SurveyModel or QuestionPXIModel in Models > DatabaseModels
        $templateData['template'] = $pageModel->getTemplateData();
        $templateView = 'fp_template';

        $contentView = 'fp_fillin_survey';

        $css = ['fp-template.css', 'fp-fillin.css'];
        $js = ['fillin.js'];
        return $this->show($templateView, $templateData, $contentView, $contentData, $css, $js);


    }


}