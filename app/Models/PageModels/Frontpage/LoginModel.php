<?php

namespace App\Models\PageModels\Frontpage;

use App\Models\DataBaseModels\PersonModel;
use http\Exception\UnexpectedValueException;

class LoginModel extends TemplateModel
{

    private $loginForm;
    private $handleLogin;


    public function __construct($language)
    {
        parent::__construct($language);
        //NECESSARY: Set custom template data. Implement this function below.
        $this->setTemplateData($language);
        //OPTIONALLY: Set custom data for this page.
        $this->setLoginForm($language);
        $this->setHandleLogin($language);
    }

    //NECESSARY: Implement this function
    private function setTemplateData($language) {
        parent::setHeroImage(base_url(). '');

        if($language == 'en') {
            parent::setPageTitle('PXI | Login');
            parent::setTemplateTitle('Login');
            parent::setTemplateSubtitle('Enter your login credentials');
        }
        else if ($language == 'nl') {
            parent::setPageTitle('PXI | Login');
            parent::setTemplateTitle('Login');
            parent::setTemplateSubtitle('Vul je inloggegevens in');
        }

    }
    //NECESSARY getter for the controller to retrieve page data.
    public function getLoginForm() {
            return $this->loginForm;
    }

    private function setLoginForm($language) {
        if($language == 'en') {
            $this->loginForm['email'] = 'E-mail Address';
            $this->loginForm['pw'] = 'Password';
            $this->loginForm['login-btn'] = 'Login';
            $this->loginForm['register'] = "Don't have an account yet?";
        }
        else if ($language == 'nl'){
            $this->loginForm['email'] = 'E-mailadres';
            $this->loginForm['pw'] = 'Wachtwoord';
            $this->loginForm['login-btn'] = 'Login';
            $this->loginForm['register'] = "Nog niet geregistreerd?";
        }
        else {
            throw new UnexpectedValueException('Wrong language string in this model');
        }
    }

    public function getHandleLogin() {
        return $this->handleLogin;
    }

    private function setHandleLogin($language) {
        if($language == 'en') {
            $this->handleLogin['user-error'] = 'There is no account registered with this email address';
            $this->handleLogin['pw-error'] = 'Invalid password';
        }
        else if ($language == 'nl') {
            $this->handleLogin['user-error'] = 'Er bestaat geen account voor dit e-mailadres';
            $this->handleLogin['pw-error'] = 'Ongeldig wachtwoord';
        }

    }




}


