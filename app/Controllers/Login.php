<?php

namespace App\Controllers;

use App\Models\ComponentModels\NavbarModel;
use App\Models\DataBaseModels\PersonModel;
use App\Models\PageModels\Frontpage\LoginModel;
use App\Models\PageModels\Frontpage\RegisterModel;

class Login extends BaseController
{
    public function __construct() {
        helper(['form']);
    }
    public function login(){
        $pageModel = new LoginModel($_SESSION['language']);
        if (session()->get('isLoggedIn')) {
            return redirect()->to('dashboard');
        }
        if ($this->request->getMethod() == 'post') {
            $contentData = $this->handleLoginRequest($pageModel);
            if(session()->get('isLoggedIn')){
                return redirect()->to('dashboard');
            }
        }
        $templateData['template'] = $pageModel->getTemplateData();
        $templateView = 'fp_template';

        $contentData['loginForm'] = $pageModel->getLoginForm();
        $contentView = 'fp_login';

        $css = ['fp-template','fp-login'];
        $js = [];
        return $this->show($templateView, $templateData, $contentView, $contentData, $css, $js);
    }

    private function handleLoginRequest($pageModel)
    {
        helper(['form']);
        $contentData = [];
        $dbData = [];
        $messages = $pageModel->getHandleLogin('en');
        $rules = [
            'email' => 'required|min_length[6]|max_length[50]|valid_email',
            'password' => 'required|max_length[255]',
        ];
        $errors = [
            'password' => [
                'validateUser' => 'Email or Password don\'t match'
            ]
        ];
        if (! $this->validate($rules, $errors)) {
            $contentData['validation'] = $this->validator;

        } else {
            $model = new PersonModel($dbData);

            $user = $model->where('email', $this->request->getVar('email'))->first();

            if (! $user) {
                $contentData['validation'] = $this->validator->setError('email', $messages['user-error']);
            } elseif (! password_verify($this->request->getVar('password'), $user['password'])) {
                $contentData['validation'] = $this->validator->setError('email', $messages['pw-error']);
            } else {
                $this->setUserSession($user);

            }
        }
        return $contentData;
    }

    /**
     * Sets session variables after successful login
     * @param $user
     */
    private function setUserSession($user){
        $data = [
            'ID' => $user['ID'],
            'name' => $user['name'],
            'surname' => $user['surname'],
            'email' => $user['email'],
            'isLoggedIn' => true,
        ];
        session()->set($data);
        //session()->setFlashdata('success', 'Successful Login');
    }

    public function register(){
        $pageModel = new RegisterModel($_SESSION['language']);
        if (session()->get('isLoggedIn')) {
            return redirect()->to(base_url() . '/dashboard');
        }
        if ($this->request->getMethod() == 'post') {
            if($this->handleRegisterRequest($pageModel)== 'account_created') {
                return redirect()->to('login');}
            else{
                $contentData =$this->handleRegisterRequest($pageModel);
            }
        }
        $templateData['template'] = $pageModel->getTemplateData();
        $templateView = 'fp_template';

        $contentData['registerForm'] = $pageModel->getRegisterForm();
        $contentView = 'login_register';

        $css = ['settings_page_style.css', 'fp-template.css', 'fp-register.css'];
        $js = ['jquery.validate.js','register.js'];
        return $this->show($templateView, $templateData, $contentView, $contentData, $css, $js);
    }

    private function handleRegisterRequest($pageModel)
    {
        $dbData = [];
        $messages = $pageModel->getHandleRegister('en');
        $contentData['validation'] = $messages;
        $rules = [
            'name' => 'required|min_length[3]|max_length[20]',
            'surname' => 'required|min_length[3]|max_length[20]',
            'email' => 'required|min_length[6]|max_length[50]|valid_email|is_unique[Person.email]',
            'password' => 'required|min_length[8]|max_length[255]',
            'password_confirm' => 'matches[password]',
        ];
        $userData = [
            'name' => $this->request->getVar('name'),
            'surname' => $this->request->getVar('surname'),
            'email' => $this->request->getVar('email'),
            'password' => $this->request->getVar('password'),
        ];

        if (! $this->validate($rules)) {
            $contentData['validation'] = $this->validator;

        }else{
            $personModel = new PersonModel($dbData);
            $personModel->save($userData);
            //$session = session();
            session()->setFlashdata('success', 'Registration success');
            return 'account_created';

        }
        return $contentData;
    }

    //USED FOR HOMEPAGE LIGHTBOX
    /* public function loginbox(){
         //Navbar login pressed
         if ($this->request->isAJAX()) {
             return view('lightbox/fp_login');
         }
     }*/


}