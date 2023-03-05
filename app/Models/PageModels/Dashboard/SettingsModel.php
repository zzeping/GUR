<?php

namespace App\Models\PageModels\Dashboard;



use http\Exception\UnexpectedValueException;

class SettingsModel extends TemplateModel
{
    //OPTIONALLY: Add here there different data structures that you want to use in your view.
    private $settingsForm;

    public function __construct($languageID)
    {
        parent::__construct($languageID);
        //NECESSARY: Set custom template data. Implement this function below.
        $this->setTemplateData($languageID);
        //OPTIONALLY: Set custom data for this page.
        $this->setSettingsForm($languageID);


    }

    //NECESSARY: Implement this function
    private function setTemplateData($languageID) {
        if($languageID == 'en') {
            parent::setPageTitle('');

        }
        else if ($languageID == 'nl') {
            parent::setPageTitle('');


        }

    }

    //NECESSARY getter for the controller to retrieve page data.
    public function getSettingsForm() {
        return $this->settingsForm;
    }

    private function setSettingsForm($language) {
        if($language == 'en') {
            $this->settingsForm['first-name'] = 'First Name';
            $this->settingsForm['surname'] = 'Last Name';
            $this->settingsForm['email'] = 'E-mail Address';
            $this->settingsForm['pw'] = 'New Password';
            $this->settingsForm['confirm-pw'] = 'Confirm Password';
            $this->settingsForm['confirm-btn'] = 'Save Changes';

        }
        else if ($language == 'nl'){
            $this->settingsForm['first-name'] = 'Voornaam';
            $this->settingsForm['surname'] = 'Naam';
            $this->settingsForm['email'] = 'E-mailadres';
            $this->settingsForm['pw'] = 'Nieuw Wachtwoord';
            $this->settingsForm['confirm-pw'] = 'Bevestig Wachtwoord';
            $this->settingsForm['confirm-btn'] = 'Bewaar';
        }
        else {
            throw new UnexpectedValueException('Wrong language string in this model');
        }
    }
}


