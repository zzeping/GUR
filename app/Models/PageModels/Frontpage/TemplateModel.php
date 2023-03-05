<?php

namespace App\Models\PageModels\Frontpage;

use App\Models\ComponentModels\FooterModel;
use http\Exception\UnexpectedValueException;
use App\Models\ComponentModels\NavbarModel;

abstract class TemplateModel
{
    private $templateTitle = '';     //fp-template:  White title in green box right beneath hero-img enclosed in HTML <h1> in fptemplate
    private $templateSubTitle = '';  //fp-template:  White subtitle beneath the title enclosed in HTML <h3>
    private $heroImage = ''; //fp-template:  path to the image, empty string if no image necessary.
    private $pageTitle;      //html-heading: page title in the browser tab next to the favicon, implemented in default heading.
    private $navbar;
    private $footer;


    public function __construct($languageID) {
        $navbarModel = new NavbarModel('fp', $languageID);
        $this->navbar = $navbarModel->getNavbarItems();
        $footerModel = new FooterModel('fp', $languageID);
        $this->footer = $footerModel->getFooterData();
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
            'title' => $this->templateTitle,
            'subtitle' => $this->templateSubTitle,
            'hero-image' => $this->heroImage,
            'navbar' => $this->navbar,
            'page-title' => $this->pageTitle,
            'footer' => $this->footer
        ];
    }

    /**
     * Setters used by custom child pages of this frontpage template:
     *        -set templateTitle
     * *      -set templateSubTitle
     * *      -set templateHeroImage
     * *      -set pageTitle
     *
     */
    protected function setTemplateTitle($title) {
        $this->templateTitle = $title;
    }

    protected function setTemplateSubtitle($title) {
        $this->templateSubTitle = $title;
    }

    protected function setHeroImage($imgPath) {
        $this->heroImage = $imgPath;
    }

    protected function setPageTitle($title){
        $this->pageTitle = $title;
    }












}