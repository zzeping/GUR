<?php

namespace App\Models\ComponentModels;

class CardModel


{
    private $session_elements = [];
    public function __construct($type)
    {
        if ($type = 'person') {
            $names = array('Brecht', 'Britt', 'Frederik', 'Louis', 'Michiel', 'Pieter', 'Zeping');
            $brecht = "/img/content/fp_about/team-members/brecht.jpg";
            $britt = "/img/content/fp_about/team-members/britt.jpg";
            $frederik = "/img/content/fp_about/team-members/frederik.jpg";
            $louis = "/img/content/fp_about/team-members/louis.jpg";
            $michiel = "/img/content/fp_about/team-members/michiel.jpg";
            $pieter = "/img/content/fp_about/team-members/pieter.jpg";
            $zeping = "/img/content/fp_about/team-members/zeping.jpg";
            $brechtText = 'Brecht Colemont is an engineering student at the University of Leuven. His interest in this project is to improve the overall gaming community facilities and learn more about software engineering. Along with fellow students, he likes this project because it is a possibility to learn how to work in a team and implement the scrum workflow. Also the gaming industry is an interesting place when it comes to programming.';
            $brittText = 'This is Britt, a programming enthusiast. She’s interested in the domain where engineering and healthcare coincides and more specifically the domain of brain computer interfaces has her attention. She likes to program and is very excited about developing games and websites that take human interaction into account.';
            $frederikText = 'Frederik Schreurs is a student of GroepT, he studies for industrial engineer with option electronics – ICT, he is most interested in the electronics part. But he likes designing web pages too, it’s one of his new hobbies. His other hobbies are football and mountain bike.';
            $louisText = 'This is Louis, he’s 21 years old and a very enthusiastic engineering student. In his free time he likes to game and do research. That’s why creating a website for game user researchers comes natural for him. He also likes the concept of a player experience inventory, he finds it very interesting to take a scientific approach to ameliorate the relationship a player has with a game.';
            $michielText = 'Michiel Spiritus, a Master student electronics-ict at Groep T. His main task is the web design in this PXI. He is motivated towards game development. His main interests are sport games and shooters. He hopes that this tool will improve the game industry.';
            $pieterText = 'Pieter will graduate as an ICT engineer in 2022. In his thesis he conducts research in the field of machine learning and natural language processing. Creativity runs through his veins and that is why he chose to be part of the UX web development team. One of his many aspirations is to be a mathematical teacher someday, after he will have gained practical experience as an engineer in a private company.';
            $zepingText = 'Zeping, an international master student in GroupT. She is taking the UX-driven Web development course. It is about building a web application for GUR to create a study and analyze the data. She is very interested about the subject and willing to learn the tools of building a website.';
            $images = array($brecht, $britt, $frederik, $louis, $michiel, $pieter, $zeping);
            $texts = array($brechtText, $brittText, $frederikText, $louisText, $michielText, $pieterText, $zepingText);
            $persons = array();
            for ($index = 0; $index < count($names); $index++) {
                $person = array('image' => $images[$index], 'name' => $names[$index], 'text' => $texts[$index]);
                array_push($persons, $person);
            }
            $this->session_elements = array('persons' => $persons);

        }
    }

    /**
     * @return array|array[]
     */
    public function getSessionElements(): array
    {
        return $this->session_elements;
    }

}

