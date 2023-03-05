<?php

namespace App\Models\ComponentModels;

use App\Models\DataBaseModels\PersonModel;
use http\Exception\UnexpectedValueException;

class NavbarModel

{
    private $menu_items;

    public function __construct($template, $languageID){
        if ($template == 'fp') {
            $this->setFrontpageNavbar($languageID);
        } elseif ($template == 'db') {
            $this->setDashboardNavbar($languageID);
        }
         else {
            throw new \CodeIgniter\Exceptions\ModelException('Please provide a correct template parameter. ("fp" or "db".');
        }
    }

    private function setFrontpageNavbar($languageID) {

        $this->menu_items['languages']['name'] =
            ['en' => 'ENG', 'nl' => 'NLD'];

        if($languageID == 'en') {
            $this->menu_items['languages']['menu'] =
                ['header' => 'Choose your language'];

            $this->menu_items['create'] =
                ['name' => 'Create',
                'title' => 'Create your own survey',
                'link' => base_url().'/login',
                'class' => '' ];

            $this->menu_items['fill-in'] =
                ['name' => 'Published Surveys',
                'title' => 'Fill in published surveys',
                'link' => base_url().'/browse',
                'class' => '' ];

            $this->menu_items['about'] =
                ['name' => 'About',
                'title' => '',
                'link' => '#',
                'class' => '' ];

            $this->menu_items['about-pxi'] =
                ['name' => 'PXI Research',
                'title' => '',
                'link' => base_url().'/about_pxi',
                'class' => '' ];

            $this->menu_items['about-team4'] =
                ['name' => 'PXI Survey Creator',
                'title' => '',
                'link' => base_url().'/about_team4',
                'class' => '' ];

            $this->menu_items['contact'] =
                ['name' => 'Contact us',
                'title' => 'Let us know what you think',
                'link' => base_url().'/contact',
                'class' => '' ];

            $this->menu_items['login'] =
                ['name' => 'Login',
                'title' => 'Log in to your account',
                'link' => base_url().'/login',
                'class' => '' ];

            $this->menu_items['signup'] =
                ['name' => 'Signup',
                'title' => 'Create a new account',
                'link' => base_url().'/register',
                'class' => '' ];

        }
        else if ($languageID == 'nl') {
            $this->menu_items['languages']['menu'] =
                ['header' => 'Kies je taal'];

            $this->menu_items['create'] =    ['name' => 'Ontwerp',
                'title' => 'Maak je eigen survey',
                'link' => base_url().'/login','class' => '' ];

            $this->menu_items['fill-in'] =
                ['name' => 'Openbare Surveys',
                'title' => 'Vul een gepubliceerde survey in',
                'link' => base_url().'/browse',
                'class' => '' ];

            $this->menu_items['about'] =
                ['name' => 'Over',
                'title' => '',
                'link' => '#',
                'class' => '' ];

            $this->menu_items['about-pxi'] =
                ['name' => 'PXI Onderzoek',
                'title' => '',
                'link' => base_url().'/about_pxi',
                'class' => '' ];

            $this->menu_items['about-team4'] =
                ['name' => 'PXI Survey Creator',
                'title' => '',
                'link' => base_url().'/about_team4',
                'class' => '' ];

            $this->menu_items['contact'] =
                ['name' => 'Contacteer ons',
                'title' => 'Laat van je horen',
                'link' => base_url().'/contact',
                'class' => '' ];

            $this->menu_items['login'] =
                ['name' => 'Login',
                'title' => 'Inloggen met je account',
                'link' => base_url().'/login',
                'class' => '' ];

            $this->menu_items['signup']  =
                ['name' => 'Registreer',
                'title' => 'Registreer een nieuw account',
                'link' => base_url().'/register',
                'class' => '' ];
        }
        else throw new UnexpectedValueException('Wrong languageID');
    }

    private function setDashboardNavbar($languageID) {

        $userModel = new PersonModel([]);
        $user = $userModel->getUserInfo();
        $this->menu_items['languages']['name'] =
            ['en' => 'ENG', 'nl' => 'NLD'];

        if($languageID == 'en') {
            $this->menu_items['languages']['menu'] =
                ['header' => 'Choose your language'];
            $this->menu_items['my-surveys'] =
                ['name' => 'My Surveys',
                    'title' => 'Survey Menu',
                    'link' => base_url().'/surveys',
                    'class' => '' ];

            $this->menu_items['compare'] =
                ['name' => 'Compare',
                    'title' => 'Compare Two Surveys',
                    'link' => base_url().'/compare',
                    'class' => '' ];

            $this->menu_items['analyse'] =
                ['name' => 'Analyse',
                    'title' => 'Analyse a survey',
                    'link' => base_url().'/analyse',
                    'class' => '' ];

            $this->menu_items['account-settings'] =
                ['name' => 'Account Settings',
                    'title' => 'Go to profile',
                    'link' => base_url().'/settings',
                    'class' => '' ];

            $this->menu_items['logout'] =
                ['name' => 'Logout',
                    'title' => 'Logout of your account',
                    'link' => base_url().'/logout',
                    'class' => '' ];

            $this->menu_items['welcome'] = 'Welcome, '.$user['name'].'!';

        }
        else if ($languageID == 'nl') {
            $this->menu_items['languages']['menu'] =
                ['header' => 'Kies je taal'];

            $this->menu_items['my-surveys'] =
                ['name' => 'Mijn Surveys',
                    'title' => 'Survey Menu',
                    'link' => base_url().'/surveys',
                    'class' => '' ];

            $this->menu_items['compare'] =
                ['name' => 'Vergelijk',
                    'title' => 'Vergelijk twee surveys',
                    'link' => base_url().'/compare',
                    'class' => '' ];

            $this->menu_items['analyse'] =
                ['name' => 'Analyseer',
                    'title' => 'Analyseer een survey',
                    'link' => base_url().'/analyse',
                    'class' => '' ];

            $this->menu_items['account-settings'] =
                ['name' => 'Mijn Account',
                    'title' => 'Wijzig account instellingen',
                    'link' => base_url().'/settings',
                    'class' => '' ];

            $this->menu_items['logout'] =
                ['name' => 'Afmelden',
                    'title' => 'Log uit',
                    'link' => base_url().'/logout',
                    'class' => '' ];

            $this->menu_items['welcome'] = 'Welkom, '.$user['name'].'!';
        }

        else throw new UnexpectedValueException('Wrong languageID');

    }


    public function set_active($menutitle) {
        foreach ($this->menu_items as $item) {
            if(strcasecmp($menutitle, $item['name']) == 0) {
                $item['className'] = ' active';
            }
            else {
                $item['className'] = '';
            }
        }
    }


    public function getNavbarItems($menutitle = 'Home') {
        //$this->set_active($menutitle);
        return $this->menu_items;
    }


    public function getNavbarIcon() {
        $this->set_active('Home');
        return $this->menu_items;
    }

    public Function getData() {

        return $this->menu_items;
    }



}

