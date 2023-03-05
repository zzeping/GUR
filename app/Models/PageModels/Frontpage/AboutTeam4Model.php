<?php

namespace App\Models\PageModels\Frontpage;

use http\Exception\UnexpectedValueException;

class AboutTeam4Model extends TemplateModel
{
    private $persons;       //language independent
    private $descriptions;  //language dependent
    private $pageDescription;

    public function __construct($languageID)
    {
        parent::__construct($languageID);
        //Set custom template data
        $this->setTemplateData($languageID);
        //Set custom data for this page:
        $this->setDescriptions($languageID);
        $this->setPersons();
        $this->setPageDescription($languageID);

    }

    private function setTemplateData($languageID) {
        parent::setHeroImage(base_url(). 'img/content/fp_about/hero-img.svg');
        if($languageID == 'en') {
            parent::setPageTitle('PXI | About');
            parent::setTemplateTitle('Who are We?');
            parent::setTemplateSubtitle('Meet the Team');
        }
        else if ($languageID == 'nl') {
            parent::setPageTitle('PXI | Over');
            parent::setTemplateTitle('Wie zijn Wij?');
            parent::setTemplateSubtitle('Ontmoet het Team');
        }

    }


    private function setPersons() {
        $this->persons['brecht'] = ['name' => 'Brecht',
            'image' => base_url(). '/img/content/fp_about/team-members/brecht.jpg' ];
        $this->persons['britt'] = ['name' => 'Britt',
            'image' => base_url(). '/img/content/fp_about/team-members/britt.jpg' ];
        $this->persons['frederik'] = ['name' => 'Frederik',
            'image' => base_url(). '/img/content/fp_about/team-members/frederik.jpg' ];
        $this->persons['louis'] = ['name' => 'Louis',
            'image' => base_url(). '/img/content/fp_about/team-members/louis.jpg' ];
        $this->persons['michiel'] = ['name' => 'Michiel',
            'image' => base_url(). '/img/content/fp_about/team-members/michiel.jpg' ];
        $this->persons['pieter'] = ['name' => 'Pieter',
            'image' => base_url(). '/img/content/fp_about/team-members/pieter.jpg'];
        $this->persons['zeping'] = ['name' => 'Zeping',
            'image' => base_url(). '/img/content/fp_about/team-members/zeping.jpg' ];
    }



    private function setDescriptions($languageID) {
    if($languageID == 'en') {
        $this->descriptions['brecht'] = 'Brecht Colemont is an engineering student at the University of Leuven. 
                                His interest in this project is to improve the overall gaming community facilities and learn more about software engineering. 
                                Along with fellow students, he likes this project because it is a possibility to learn how to work in a team and implement the scrum workflow. 
                                Also the gaming industry is an interesting place when it comes to programming.' ;
        $this->descriptions['britt'] = 'This is Britt, a programming enthusiast. 
                                She’s interested in the domain where engineering and healthcare coincides and more specifically the domain of brain computer interfaces has her attention. 
                                She likes to program and is very excited about developing games and websites that take human interaction into account.' ;
        $this->descriptions['frederik'] = 'Frederik Schreurs is a student of GroepT, he studies for industrial engineer with option electronics – ICT, he is most interested in the electronics part. 
                               But he likes designing web pages too, it’s one of his new hobbies. 
                               His other hobbies are football and mountain bike.' ;
        $this->descriptions['louis'] = 'This is Louis, he’s 21 years old and a very enthusiastic engineering student. 
                                In his free time he likes to game and do research. That’s why creating a website for game user researchers comes natural for him. 
                                He also likes the concept of a player experience inventory, 
                                he finds it very interesting to take a scientific approach to ameliorate the relationship a player has with a game.' ;
        $this->descriptions['michiel'] = 'Michiel Spiritus, a Master student electronics-ict at Groep T. 
                               His main task is the web design in this PXI. He is motivated towards game development. His main interests are sport games and shooters. 
                               He hopes that this tool will improve the game industry.' ;
        $this->descriptions['pieter'] = 'Pieter will graduate as an ICT engineer in 2022. 
                               In his thesis he conducts research in the field of machine learning and natural language processing. 
                               Creativity runs through his veins and that is why he chose to be part of the UX web development team. 
                               One of his many aspirations is to be a mathematical teacher someday, 
                               after he will have gained practical experience as an engineer in a private company.' ;
        $this->descriptions['zeping'] = 'Zeping, an international master student in GroupT. She is taking the UX-driven Web development course. 
                               It is about building a web application for GUR to create a study and analyze the data. 
                               She is very interested about the subject and willing to learn the tools of building a website.' ;
    }
    else if ($languageID == 'nl'){
        $this->descriptions['brecht'] = 'Hallo, mijn naam is Brecht.' ;
        $this->descriptions['britt'] = 'Hallo, mijn naam is Britt.' ;
        $this->descriptions['frederik'] = 'Hallo, mijn naam is Frederik.' ;
        $this->descriptions['louis'] = 'Hallo, mijn naam is Louis.' ;
        $this->descriptions['michiel'] = 'Hallo, mijn naam is Michiel.' ;
        $this->descriptions['pieter'] = 'Hallo, mijn naam is Pieter.' ;
        $this->descriptions['zeping'] = 'Hallo, mijn naam is Zeping.' ;
    }
    else {
        throw new UnexpectedValueException('Wrong languageID in aboutteam4model');
    }
    }

    private function setPageDescription($languageID) {
        if ($languageID == 'en') {
            $this->pageDescription = 'UXWD team 4 consists of 7 enthusiastic engineering students of the university of Leuven. 
                                      Developing a website was the main goal for the Research & Development course. 
                                      It should support gamers in filling out surveys while supporting Game User Researchers in making and analyzing the surveys.';

        }
        else if ($languageID == 'nl') {
            $this->pageDescription = 'UXWD team 4 bestaat uit zeven enthousiaste ingenieurstudenten van de KULeuven. 
                                      Maak kennis met het team achter deze website.';

        }
    }

    public function getDescriptions() {
        return $this->descriptions;
    }

    public function getPersons() {
        return $this->persons;
    }

    public function getPageDescription()
    {
        return $this->pageDescription;
    }

}


