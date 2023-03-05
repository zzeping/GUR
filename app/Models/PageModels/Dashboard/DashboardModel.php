<?php

namespace App\Models\PageModels\Dashboard;


use App\Models\DataBaseModels\PersonModel;
use App\Models\DataBaseModels\SurveyModel;
use UnexpectedValueException;


class DashboardModel extends TemplateModel
{
    //OPTIONALLY: Add here there different data structures that you want to use in your view.
    private $datastructure1;
    private $userSurveys;
    private $surveyModel;
    private $userModel;
    private $language;
    private $content;


    public function __construct($language, $dbData)
    {

        parent::__construct($language);
        $personID = $_SESSION['ID'];
        $this->userModel = new PersonModel($dbData);
        $this->surveyModel = new SurveyModel($dbData);
        //NECESSARY: Set custom template data. Implement this function below.
        $this->setTemplateData($language);
        //OPTIONALLY: Set custom data for this page.
        $this->setContent($language);
        $this->userSurveys = $this->loadUserSurveys();

        /*
        if(isset($_POST['short']))
        {
            print "test";
            $this->userSurveys = $this->loadUserSurveys(True, False, False);
        }

        if(isset($_POST['az']))
        {
            print "test";
            $this->userSurveys = $this->loadUserSurveys(False, True, False);
        }

        if(isset($_POST['az']))
        {
            print "test";
            $this->userSurveys = $this->loadUserSurveys(False, False, True);
        }
        */

        $this->language = $language;
    }

    //NECESSARY: Implement this function
    public function setContent($language){


        if($language == 'en') {

           $this->content['newsurvey'] = 'New Survey';
            $this->content['newsurvey_text'] = 'Create a new Survey';
            $this->content['prev'] = 'Previous';
            $this->content['next'] = 'Next';
            $this->content['search'] = 'Search Surveys';
            $this->content['show_results'] = 'Show results';
            $this->content['resp'] = 'respondents';
            $this->content['show_offline'] = 'Show offline surveys';
            $this->content['show_online'] = 'Show online surveys';
            $this->content['sort_AZ'] = 'Sort by name(A-Z)';
            $this->content['sort_ZA'] = 'Sort by name(Z-A)';
            $this->content['sort_opening_date'] = 'Sort by opening date';
            $this->content['sort_closing_date'] = 'Sort by closing date';
            $this->content['sort_popularity'] = 'Sort by popularity';

        }
        else if($language == 'nl') {
            $this->content['newsurvey'] = 'Nieuwe Survey';
            $this->content['newsurvey_text'] = 'Maak een nieuwe survey aan';
            $this->content['prev'] = 'Vorige';
            $this->content['next'] = 'Volgende';
            $this->content['search'] = 'Zoek Surveys';
            $this->content['show_results'] = 'Toon resultaten';
            $this->content['resp'] = 'antwoorden';

            $this->content['show_offline'] = 'Toon offline surveys';
            $this->content['show_online'] = 'Toon online surveys';
            $this->content['sort_AZ'] = 'Sorteer op naam(A-Z)';
            $this->content['sort_ZA'] = 'Sorteer op naam(Z-A)';
            $this->content['sort_opening_date'] = 'Sorteer op openingsdatum';
            $this->content['sort_closing_date'] = 'Sorteer op openingsdatum';
            $this->content['sort_popularity'] = 'Sorteer op populariteit';
        }
    }

    private function setTemplateData($language)
    {
        //parent::setHeroImage(base_url() . '');
        if ($language == 'en') {
            parent::setPageTitle('Dashboard');
            //parent::setTemplateTitle('');
            //parent::setTemplateSubtitle('');
        } else if ($language == 'nl') {
            parent::setPageTitle('Overzicht');
            //parent::setTemplateTitle('');
            //parent::setTemplateSubtitle('');
        }

    }

    /**
     * @returns Array of key values: (KEY = $surveyId, VALUE = $row)
     *      $row['title']               =   [String] title of this survey
     *      $row['description']         =   [String] description of this survey
     *      $row['open']                =   [String] opening date of survey (format: 'y-m-d h:m:s')
     *      $row['close']               =   [String] closing date of survey (format: 'y-m-d h:m:s')
     *      $row['genres']              =   [Array-Strings] genres of this survey
     *      $row['tags']                =   [Array-Strings] tags of this survey
     *      $row['gameTitles']          =   [Array-Strings] gametitles of this survey
     *      $row['numberRespondents']   =   [Int]   number of survey respondents
     *      $row['status']              =   [Bool]  0 = offline, 1 = online
     *      $row['enjoyment']           =   [Bool]  0 = no enjoyment, 1 = enjoyment
     *      $row['long']                =   [Bool]  0 = short, 1 = long
     */
    public function loadUserSurveys()
    {
        $surveyIDs = $this->userModel->getSurveyIDs();

        if($surveyIDs == null ) return [];
        $surveysInfo = $this->surveyModel->getSurveys($surveyIDs);
        $tags = $this->surveyModel->getSurveyTags($surveyIDs);
        $gameTitles = $this->surveyModel->getSurveyGameTitles($surveyIDs);
        $genres = $this->surveyModel->getSurveyGenres($surveyIDs);
        $respondents = $this->surveyModel->getNumberOfRespondents($surveyIDs);
        $longEnjoy = $this->surveyModel->getLongEnjoyment($surveyIDs);
        $surveys = [];
        $survey = [];
        foreach($surveyIDs as $surveyId) {
            $survey['surveyId'] = $surveyId;
            $survey['title'] = $surveysInfo[$surveyId[0]]['title'];
            $survey['language'] = $surveysInfo[$surveyId[0]]['language'];
            $survey['description'] = $surveysInfo[$surveyId[0]]['description'];
            $survey['open'] = $surveysInfo[$surveyId[0]]['open'];
            $survey['close'] = $surveysInfo[$surveyId[0]]['close'];
            $survey['creation-date'] = $surveysInfo[$surveyId[0]]['creation-date'];
            $survey['status'] = $surveysInfo[$surveyId[0]]['status'];
            $survey['image'] = $surveysInfo[$surveyId[0]]['image'];
            $survey['genres'] = $genres[$surveyId[0]];
            $survey['tags'] = $tags[$surveyId[0]];
            $survey['gameTitles'] = $gameTitles[$surveyId[0]];
            $survey['numberRespondents'] = $respondents[$surveyId[0]];
            $survey['enjoyment'] = $longEnjoy[$surveyId[0]][1];
            $survey['long'] = $longEnjoy[$surveyId[0]][0];
            array_push($surveys, $survey);
        }
        return $surveys;

    }

    /**
     * @return array
     */
    public function getContent() {
    return $this->content;

}
    public function getUserSurveys(): array
    {
        return $this->userSurveys;
    }

    /**
    * @return mixed
    */
    public function getLanguage()
    {
        return $this->language;
    }




}

