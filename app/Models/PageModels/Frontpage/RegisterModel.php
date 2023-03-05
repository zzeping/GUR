<?php

namespace App\Models\PageModels\Frontpage;

use App\Models\DataBaseModels\PersonModel;
use http\Exception\UnexpectedValueException;

class RegisterModel extends TemplateModel
{

    private $registerForm;
    private $handleRegister;

    public function __construct($language)
    {
        parent::__construct($language);
        //NECESSARY: Set custom template data. Implement this function below.
        $this->setTemplateData($language);
        //OPTIONALLY: Set custom data for this page.
        $this->setRegisterForm($language);
        $this->setHandleRegister($language);
        helper(['form']);
    }

    //NECESSARY: Implement this function
    private function setTemplateData($languageID) {
        parent::setHeroImage(base_url(). '');
        if($languageID == 'en') {
            parent::setPageTitle('PXI | Register');
            parent::setTemplateTitle('Join the Club');
            parent::setTemplateSubtitle('Register your account');
        }
        else if ($languageID == 'nl') {
            parent::setPageTitle('PXI | Registreer');
            parent::setTemplateTitle('Join the Club');
            parent::setTemplateSubtitle('Registreer je account');
        }

    }

    //NECESSARY getter for the controller to retrieve page data.
    public function getRegisterForm() {
            return $this->registerForm;
    }
    private function setRegisterForm($languageID) {
    if($languageID == 'en') {
        $this->registerForm['fields-required'] = 'All fields are required.';
        $this->registerForm['first-name'] = 'First Name';
        $this->registerForm['surname'] = 'Last Name';
        $this->registerForm['email'] = 'Email Address';
        $this->registerForm['email-example'] = 'jackjohnson@example.com';
        $this->registerForm['pw'] = 'Password';
        $this->registerForm['pw-confirm'] = 'Confirm Password';
        $this->registerForm['register-btn'] = 'Register';
        $this->registerForm['login'] = "I already have an account";
    }
    else if ($languageID == 'nl'){
        $this->registerForm['fields-required'] = 'Alle velden zijn vereist.';
        $this->registerForm['first-name'] = 'Voornaam';
        $this->registerForm['surname'] = 'Achternaam';
        $this->registerForm['email'] = 'E-mail';
        $this->registerForm['email-example'] = 'janjanssens@voorbeeld.com';
        $this->registerForm['pw'] = 'Wachtwoord';
        $this->registerForm['pw-confirm'] = 'Bevestig Wachtwoord';
        $this->registerForm['register-btn'] = 'Registreer';
        $this->registerForm['login'] = "Ik heb al een account";
    }
    else {
        throw new UnexpectedValueException('Wrong language string in this model');
    }
    }
    public function getHandleRegister($language) {
        return $this->handleRegister['register-success'] = 'Register Succes';
    }
    private function setHandleRegister($language) {
        if($language == 'en') {
            $this->handleRegister['register-success'] = 'Your account was successfully registered';

        }
        else if ($language == 'nl') {
            $this->handleRegister['register-success'] = 'Je account werd met succes geregistreerd';
        }

    }


}



