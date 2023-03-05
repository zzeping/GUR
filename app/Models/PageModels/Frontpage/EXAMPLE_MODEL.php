<?php

namespace App\Models\PageModels\Frontpage;

use http\Exception\UnexpectedValueException;

class EXAMPLE_MODEL extends TemplateModel
{
    //OPTIONALLY: Add here there different data structures that you want to use in your view.
    private $datastructure1;
    private $datastructure2;
    private $datastructure3;

    public function __construct($languageID)
    {
        parent::__construct($languageID);
        //NECESSARY: Set custom template data. Implement this function below.
        $this->setTemplateData($languageID);
        //OPTIONALLY: Set custom data for this page.
        $this->setDatastructure1($languageID);
        $this->setDatastructure2($languageID);
        $this->setDatastructure3($languageID);


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

    //NECESSARY getter for the controller to retrieve page data.
    public function getDatastructure1($name) {
            return $this->datastructure1;
    }


    private function setDatastructure1($languageID) {
    if($languageID == 'en') {

        $this->datastructure1 = 'English text for datastructure 1';

    }
    else if ($languageID == 'nl'){
        $this->datastructure1 = 'Nederlandse tekst voor datastructuur 1';
    }
    else {
        throw new UnexpectedValueException('Wrong languageID in this modell');
    }
    }
}


