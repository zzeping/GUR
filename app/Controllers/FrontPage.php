<?php

namespace App\Controllers;


use App\Models\PageModels\Frontpage\HomeModel;
use App\Models\PageModels\Frontpage\AboutTeam4Model;
use App\Models\PageModels\Frontpage\AboutPXIModel;
use App\Models\PageModels\Frontpage\ContactModel;
use App\Models\PageModels\Frontpage\BrowseModel;


use CodeIgniter\Exceptions\PageNotFoundException;
use http\Exception\UnexpectedValueException;


class FrontPage extends BaseController

{
 /*****************************************************************************************************************
 ----FrontPage constructor----------------------------------------------------------------------------------
 *****************************************************************************************************************/
    public function __construct() {
        helper(['form']);

    }

/*****************************************************************************************************************
----FrontPage methods----------------------------------------------------------------------------------
*****************************************************************************************************************/

    public function home()
    {
        $pageModel = new HomeModel($_SESSION['language']);

        $templateData['template'] = $pageModel->getTemplateData();
        $templateView = 'fp_template';

        $contentData['features'] = $pageModel->getFeatures();
        $contentView = 'fp_home';

        $js = [''];
        $css = ['fp-template.css', 'fp-home.css'];
        return $this->show($templateView, $templateData, $contentView, $contentData, $css, $js);
    }

    public function about_team4()
    {
        $pageModel = new AboutTeam4Model($_SESSION['language']);

        $templateData['template'] = $pageModel->getTemplateData();
        $templateView = 'fp_template';

        $contentData['persons'] = $pageModel->getPersons();
        $contentData['descriptions'] = $pageModel->getDescriptions();
        $contentData['pageDescription'] = $pageModel->getPageDescription();
        $contentView = 'fp_about_team4';

        $css = ['fp-template.css', 'fp-about.css'];
        $js = [''];
        return $this->show($templateView, $templateData, $contentView, $contentData, $css, $js);
    }

    public function about_pxi()
    {
        $pageModel = new AboutPXIModel($_SESSION['language']);

        $templateData['template'] = $pageModel->getTemplateData();
        $templateView = 'fp_template';

        $contentData['pageDescription'] = $pageModel->getPageDescription();
        $contentData['pxiLink'] = $pageModel->getPXILink();
        $contentView = 'fp_about_PXI';

        $css = ['fp-template.css', 'fp-about-pxi.css'];
        $js = [];
        return $this->show($templateView, $templateData, $contentView, $contentData, $css, $js);
    }

    public function contact()
    {
        $pageModel = new ContactModel($_SESSION['language']);

        $templateData['template'] = $pageModel->getTemplateData();
        $templateView = 'fp_template';

        $contentView = 'fp_contact';
        $contentData['formdata'] = $pageModel->getFormData();

        $css = ['fp-template.css','fp-contact.css'];
        $js = [];
        return $this->show($templateView, $templateData, $contentView, $contentData, $css, $js);
    }

    public function public_surveys(){

        $dbData = $this->loadDBData(['Genre', 'QuestionType', 'Option', 'Construct2', 'GameTitle', 'Tags', 'Language2']); //Necessary when using PersonModel, SurveyModel or QuestionPXIModel in Models > DatabaseModels
        $pageModel = new BrowseModel($_SESSION['language'], $dbData);

        $templateData['template'] = $pageModel->getTemplateData();
        $templateView = 'fp_template';

        $contentView = 'fp_browse_public_surveys';
        $contentData['surveys'] = $pageModel->getPublishedSurveys();
        //print_r($contentData['surveys']);

        $css = ['fp-template', 'fp-browse-public-surveys.css'];
        $js = ['localSearch.js'];
        return $this->show($templateView, $templateData, $contentView, $contentData, $css, $js);


    }



}
