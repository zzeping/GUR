<?php

namespace App\Models\PageModels\Dashboard;

use App\Models\ComponentModels\FooterModel;
use App\Models\DataBaseModels\DatabaseModel;
use App\Models\DataBaseModels\PersonModel;
use http\Exception\UnexpectedValueException;
use App\Models\ComponentModels\NavbarModel;

abstract class TemplateModel extends DatabaseModel
{

    private $pageTitle;      //html-heading: page title in the browser tab next to the favicon, implemented in default heading.
    private $navbar;
    private $footer;

    public function __construct($languageID) {
        $navbarModel = new NavbarModel('db', $languageID);
        $this->navbar = $navbarModel->getNavbarItems();
        $footerModel = new FooterModel('fp', $languageID);
        $this->footer = $footerModel->getFooterData();
        $dbData = [];
    }

    /**
     * Get the template data. To be assigned to $data['template'] in the controller.
     *
     *    e.g. : $data['template'] = getTemplateData();
     */
    public function getTemplateData() : array{
        if (!isset($this->pageTitle)) {
            throw new \CodeIgniter\Exceptions\ModelException('pageTitle of this page not defined.');
        }
        return [
            'navbar' => $this->navbar,
            'page-title' => $this->pageTitle,
            'footer' => $this->footer,
        ];
    }



    protected function setPageTitle($title){
        $this->pageTitle = $title;
    }












}