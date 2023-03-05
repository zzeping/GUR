<?php

namespace App\Models\PageModels\Frontpage;

use http\Exception\UnexpectedValueException;

class AboutPXIModel extends TemplateModel
{
    private $pageDescription;
    private $PXILink;


    public function __construct($languageID)
    {
        parent::__construct($languageID);

        $this->setTemplateData($languageID);
        $this->setPageDescription($languageID);
        $this->setPXILink($languageID);


    }

    private function setTemplateData($languageID) {
        parent::setHeroImage(base_url(). '');
        if($languageID == 'en') {
            parent::setPageTitle('PXI | About PXI');
            parent::setTemplateTitle('What is PXI?');
            parent::setTemplateSubtitle('The scientific framework behind our surveys');
        }
        else if ($languageID == 'nl') {
            parent::setPageTitle('PXI | Over PXI');
            parent::setTemplateTitle('Wat is PXI?');
            parent::setTemplateSubtitle('De wetenschappelijke basis voor onze surveys');
        }

    }


    private function setPageDescription($languageID) {
    if($languageID == 'en') {

        $this->pageDescription = ' Player experience inventory bench is an easy-to-use web application to help you gain insight
                into game players experience. This tool helps researchers and developers understand the player’s
                experience. It facilitates the connection between the creator and the player. Although widely used
                in the gaming industry, it can also be applied to non-digital games.';


    }
    else if ($languageID == 'nl'){
        $this->pageDescription = 'Player experience inventory is een eenvoudige te gebruiken web applicatie die hulp biedt bij onderzoek naar
                                    spelers ervaringen. Meer specifiek helpt deze tool door spelerservaring op te delen in verschillende zogenaamde "constructs".
                                    Het overbrugt de afstand tussen spelontwikkelaar en speler. Ondanks dat het veel gebruikt wordt in de game industrie, kan het ook toegepast worden op
                                    niet-digitale spellen zoals bijvoorbeeld gezelschapspellen.';

    }
    else {
        throw new UnexpectedValueException('Wrong languageID in this model');
    }
    }

    private function setPXILink($languageID) {
        $this->PXILink['link'] = "https://www.playerexperienceinventory.org/";
        if($languageID == 'en') {
            $this->PXILink['description'] = "Visit the PXI website";
        }
        else if ($languageID == 'nl'){
            $this->PXILink['description'] = "Bezoek de website van PXI";
        }
    }

    public function getPXILink() {
        return $this->PXILink;
    }

    public function getPageDescription() {
        return $this->pageDescription;
    }
}


