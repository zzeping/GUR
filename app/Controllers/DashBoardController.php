<?php

namespace App\Controllers;

use App\Models\DataBaseModels\PersonModel;
use App\Models\PageModels\Dashboard\DashboardModel;
use App\Models\PageModels\Dashboard\ResultsModel;
use App\Models\PageModels\Dashboard\CompareModel;
use App\Models\DataBaseModels\SurveyModel;
use App\Models\PageModels\Dashboard\SettingsModel;


class DashBoardController extends BaseController
{

 /*****************************************************************************************************************
 ----DashBoardController constructor---------------------------------------------------------------------------------
 *****************************************************************************************************************/

    public function __construct() {
    }

/*****************************************************************************************************************
----DashBoardController methods----------------------------------------------------------------------------------
 *****************************************************************************************************************/

    public function dashboard()
    {
        $dbData= $this->loadDBData(['Construct2', 'Option', 'Tags', 'Genre', 'GameTitle', 'QuestionType', 'Language2']);
        $pageModel = new DashboardModel($_SESSION['language'], $dbData);
        //$surveyModel = new App\Models\SurveyModel();


        //$userSurveys = $surveyModel->get_numberOfSurveys_one(session()->get('ID'));

        //$this->handleFilter($surveyModel);
        //$userSurveys = $this->handleOthers($surveyModel, $userSurveys);

        $templateData['template'] = $pageModel->getTemplateData();
        $contentData['content'] = $pageModel->getContent();

        $templateView = 'db_template';

        $contentView = 'db_home';
        $contentData['surveys'] = $pageModel->getUserSurveys();

        $css = ['db-template.css', 'db-surveys.css'];
        $js = ['jquery-3.6.0.min.js', 'qrcode.min.js', 'clipboard.min.js', 'db_surveys.js'];
        return $this->show($templateView, $templateData, $contentView, $contentData, $css, $js);
    }

    private function handleFilter($surveyModel) {
        if(isset($_POST['long']))
        {
            if(empty($_POST['surveyss'])){ $surveyModel->where();}

            if(!empty($_POST['surveyss']))
            {
                $surveyModel->add_and();
            }
            $surveyModel->get_longShortOne();
            $surveys2 =  $surveyModel->get_query();
        }

        if(isset($_POST['short']))
        {
            if(empty($_POST['surveyss'])){ $surveyModel->where();}
            if(!empty($_POST['surveyss']))
            {
                $surveyModel->add_and();
            }
            $surveyModel->get_longShortZero();
            $surveys2 = $surveyModel->get_query();
        }
        if(isset($_POST['closedDesc']))
        {
            /*
            if((empty($_POST['surveyss']) && (!isset($_POST['short'])) && (!isset($_POST['long'])))){$surveyModel->where();}

            if(!empty($_POST['surveyss']) or isset($_POST['short']) or isset($_POST['long']))
            {
                $surveyModel->add_and();
            }
            $surveyModel->get_ClosedSurveysDesc();
            $surveys2 = $surveyModel->get_query();
            */
        }
        if(isset($_POST['closedAsc']))
        {
            if((empty($_POST['surveyss']) && (!isset($_POST['short'])) && (!isset($_POST['long'])))){$surveyModel->where();}

            if(!empty($_POST['surveyss']) or isset($_POST['short']) or isset($_POST['long']))
            {
                $surveyModel->add_and();
            }
            $surveyModel->get_ClosedSurveysAsc();
            $surveys2 = $surveyModel->get_query();
        }
        if(isset($_POST['asc']))
        {
            $surveyModel->get_SurveyOpeningDatesAsc();
            $surveys2 = $surveyModel->get_query();
        }
        if(isset($_POST['desc']))
        {
            $surveyModel->get_SurveyOpeningDatesDesc();
            $surveys2 = $surveyModel->get_query();
        }
        if(isset($_POST['az']))
        {
            $surveyModel->get_SurveyAlphabeticAsc();
            $surveys2 = $surveyModel->get_query();
        }
        if(isset($_POST['za']))
        {
            $surveyModel->get_SurveyAlphabeticDesc();
            $surveys2 = $surveyModel->get_query();
        }
    }

    private function handleOthers($surveyModel, $numberOfSurveys)
    {
        if(isset($_POST['btn2']))
        {
            $surveyModel->set_PDF();
        }
        if(!empty($_POST['surveyss']))
        {
            $surveyModel->where();
            $surveyModel->get_numberOfSurveys();
            $numberOfSurveys = $surveyModel->get_query();
        }
        if(isset($_POST['limit']))
        {
            $surveyModel->get_limitedAmountOfSurveys();
            $numberOfSurveys = $surveyModel->get_query();
        }
        if(!empty($_POST['lang']))
        {
            if((empty($_POST['surveyss']) && (!isset($_POST['short'])) && (!isset($_POST['long'])) && (!isset($_POST['closed'])))){$surveyModel->where();}
            if(!empty($_POST['surveyss']) or isset($_POST['short']) or isset($_POST['long']) or isset($_POST['closed']))
            {
                $surveyModel->add_and();
            }
            $surveyModel->get_surveyOnLanguage();
            $numberOfSurveys = $surveyModel->get_query();
        }
        if((!empty($_POST['surveyss']) || (isset($_POST['short'])) || (isset($_POST['long'])) || (isset($_POST['closed'])) || (isset($_POST['lang'])))) {
            if ((empty($_POST['surveyss']) && (!isset($_POST['short'])) && (!isset($_POST['long'])) && (!isset($_POST['closed'])))) {
                $surveyModel->where();
            }
            if (!empty($_POST['surveyss']) or isset($_POST['short']) or isset($_POST['long']) or isset($_POST['closed'])) {
                $surveyModel->add_and();
            }
            $surveyModel->get_personId(session()->get('ID'));
            $numberOfSurveys = $surveyModel->get_query();
        }
        if (isset($_POST['delete'])) {
            $surveyModel->deleteSurvey(62);
            //header("Refresh:0");
            redirect()->to(base_url() . '/dashboard');
        }

        return $numberOfSurveys;
    }


    /**
     * returns the blob with id from table "Test"
     */
    public function getImage($surveyId) {
        $dbData = [];
        $surveyDBModel = new SurveyModel($dbData);
        $row =  $surveyDBModel->getImage($surveyId);
        $this->response->setContentType('image/jpeg')->setBody($row->image)->send();
    }

    public function logout(){
        session()->destroy();
        return redirect()->to(base_url() . '/home');
    }

    public function settings(){
        helper(['form']);
        $dbData = [];
        $personModel = new personModel($dbData);
        $dbData = $this->loadDBData(['Construct2', 'Option', 'Tags', 'Genre', 'GameTitle', 'QuestionType', 'Language2']);
        $pageModel = new SettingsModel($_SESSION['language'], $dbData);
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'name' => 'required|min_length[3]|max_length[20]',
                'surname' => 'required|min_length[3]|max_length[20]',
            ];

            if($this->request->getPost('password') != ''){
                $rules['password'] = 'required|min_length[8]|max_length[255]';
                $rules['password_confirm'] = 'matches[password]';
            }

            if (! $this->validate($rules)) {
                $contentData['validation'] = $this->validator;
            }else{

                $newData = [
                    'ID' => session()->get('ID'),
                    'name' => $this->request->getPost('name'),
                    'surname' => $this->request->getPost('surname'),
                ];
                if($this->request->getPost('password') != ''){
                    $newData['password'] = $this->request->getPost('password');
                }
                $personModel->update(session()->get('ID'), $newData);

                session()->setFlashdata('success', 'Successfuly Updated');
                return redirect()->to(base_url() . '/settings');

            }
        }

        $templateData['template'] = $pageModel->getTemplateData();
        $templateView = 'db_template';
        $contentView = 'db_settings';

        $contentData['user'] = $personModel->where('ID', session()->get('ID'))->first();
        $contentData['settingsForm'] = $pageModel->getSettingsForm();

        $css = ['db-template.css', 'fp-login.css'];
        $js = [];
        $data = [];

        $content = 'db_settings';



        return $this->show($templateView, $templateData, $contentView, $contentData, $css, $js);
    }
    public function getResults($surveyId){

        $dbData = [];
        $personModel = new personModel($dbData);
        $surveys = $personModel->getSurveyIDs();

        //check if user has access to survey

        $survey_found = false;
        foreach($surveys as $survey){
            if($survey[0] == $surveyId){
                $survey_found = true;
            }
        }
        if(!$survey_found){
            return redirect('dashboard');
        }



        //Load in the page model and the data
        $contentData = [];
        $pageModel = new ResultsModel($_SESSION['language']);
        $contentData['title'] = $pageModel->getTitle($surveyId);
        $contentData['questions'] = $pageModel->getQuestions($surveyId);
        $contentData['questionAnswers'] = $pageModel->getQuestionAnswers($surveyId);
        $templateData['template'] = $pageModel->getTemplateData();
        $templateView = 'db_template';
        $contentView = 'survey_result';

        //css and js
        $css = ['db-template.css','db-results.css'];
        $js = ['result_chart.js'];

        return $this->show($templateView, $templateData, $contentView, $contentData, $css, $js);
    }

    public function compare(){

        //$model = new SurveyModel();
        $dbData= $this->loadDBData(['Construct2', 'Option', 'Tags', 'Genre', 'GameTitle', 'QuestionType', 'Language2']);
        $model= new DashboardModel($_SESSION['language'], $dbData);
       // $pageModel = new CompareModel('en');

        //$questions = $model->getPXIfromSurvey(0);
        $surveyTrue = false;
        $surveyTrue2 = false;

        //$all = $model->get_all_compare(session()->get('ID'));
        $all = $model->getUserSurveys();

        //$answers = $pageModel->getQuestionAnswer(0);
        //$answers2 = $pageModel->getQuestionAnswer(0);
        $pageModel = new CompareModel($_SESSION['language']);
        $survey = $pageModel->getSurveyOnId(0);
        $survey2 = $pageModel->getSurveyOnId(0);
        $contentData['questions'] = $pageModel->getQuestions(0);
        $contentData['answers'] = $pageModel->getQuestionAnswers(0);
        $contentData['answers2'] = $pageModel->getQuestionAnswers(0);

        //$answers = $model->getPXIAnswersfromSurvey(0);
        //$answers2 = $model->getPXIAnswersfromSurvey(0);

        if(!empty($_POST['compare1']))
        {
            $surveyTrue = true;
            $name = $_POST['compare1'];

            $surveyId = $pageModel->getSurveyId($name);
            $contentData['questions']  = $pageModel->getQuestions($surveyId[0]->s);

            $survey = $pageModel->getSurveyOnId($surveyId[0]->s);
            $contentData['answers'] = $pageModel->getQuestionAnswers($surveyId[0]->s);



            $contentData['survey']= $survey;


        }
        if(!empty($_POST['compare2']))
        {

            $surveyTrue2 = true;
            $name = $_POST['compare2'];

            $surveyId = $pageModel->getSurveyId($name);

            $survey2 = $pageModel->getSurveyOnId($surveyId[0]->s);
            $contentData['answers2'] = $pageModel->getQuestionAnswers($surveyId[0]->s);


            $contentData['survey2']= $survey2;

        }
        //var_dump($survey);
        $templateData['template'] = $pageModel->getTemplateData();
        $templateView = 'db_template';

        $contentData['surveyTrue']= $surveyTrue;
        $contentData['surveyTrue2']= $surveyTrue2;
        $contentData['all']= $all;
        $contentData['survey']= $survey;
        $contentData['survey2']= $survey2;
     //   $contentData['questions'] = $questions;
      //  $contentData['answers']= $answers;
        //$contentData['answers2']= $answers2;

        $contentView = 'db_compare';
       // $contentData = [];

        $css = ['db-template.css','db-results.css'];
        $js = [];

        return $this->show($templateView, $templateData, $contentView, $contentData, $css, $js);

    }


}