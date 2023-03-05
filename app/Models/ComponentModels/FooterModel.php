<?php

namespace App\Models\ComponentModels;

use http\Exception\UnexpectedValueException;

class FooterModel
{
    private $text;
    private $link;


    public function __construct($template, $languageID) {
        $this->setText($languageID);
    }

    private function setText($languageID) {
        $this->text['lang-codes'] =
            ['en' => 'ENG',
                'nl' => 'NLD'];

        if($languageID == 'en') {
            $this->text['privacy'] = 'Privacy Policy';
            $this->link['privacy'] = '#';
            $this->text['terms-of-use'] = 'Terms of Use';
            $this->link['terms-of-use'] = '#';
            $this->text['copyright'] = 'Copyright &copy; ' . date("Y") . ' UXWD Team 4.&nbsp; All Rights Reserved.&nbsp;&nbsp;';
            $this->text['lang'] =
            ['ENG' => 'English',
                'NLD' => 'Dutch'];
        }
        else if ($languageID == 'nl') {
            $this->text['privacy'] = 'Privacybeleid';
            $this->link['privacy'] = '#';
            $this->text['terms-of-use'] = 'Gebruiksvoorwaarden';
            $this->link['terms-of-use'] = '#';
            $this->text['copyright'] = 'Copyright &copy; ' . date("Y") . ' UXWD. Team 4.&nbsp; Alle Rechten Voorbehouden.&nbsp;&nbsp;';
            $this->text['lang'] =
                ['ENG' => 'Engels',
                    'NLD' => 'Nederlands'];

        }
        else throw new UnexpectedValueException('Wrong languageID. use "en" or "nl"');
    }

    public function getFooterData() {
        return ['text' => $this->text, 'links' => $this->link];
    }


}