<?php

namespace App\Models\PageModels\Frontpage;

use App\Models\DataBaseModels\SurveyModel;
use http\Exception\UnexpectedValueException;

class BrowseModel extends TemplateModel
{

    private $surveyModel;

    public function __construct($languageID, $dbData)
    {
        parent::__construct($languageID);
        //NECESSARY: Set custom template data. Implement this function below.
        $this->setTemplateData($languageID);
        $this->surveyModel = new SurveyModel($dbData);


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

    //relevant information of published surveys. Important to include surveyIDs
    public function getPublishedSurveys() : array {
        $surveyIDs = $this->surveyModel->getPublishedSurveyIDs();
        $surveysInfo = $this->surveyModel->getSurveys($surveyIDs);
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
            $survey['creation-date'] = $surveysInfo[$surveyId[0]]['creation-date'];
            //$survey['image'] = $surveysInfo[$surveyId[0]]['image'];
            $survey['genres'] = $genres[$surveyId[0]];
            $survey['gameTitles'] = $gameTitles[$surveyId[0]];
            $survey['numberRespondents'] = $respondents[$surveyId[0]];
            $survey['enjoyment'] = $longEnjoy[$surveyId[0]][1];
            $survey['long'] = $longEnjoy[$surveyId[0]][0];
            array_push($surveys, $survey);
        }
        return $surveys;
    }


}


