<?php

namespace App\Controllers;
use App\Models\DataBaseModels\ConstructTypeModel;
use App\Models\DataBaseModels\QuestionModel;
use App\Models\DataBaseModels\SurveyModel2;
use App\Models\DataBaseModels\SurveyModel;
use App\Models\DataBaseModels\GameTitleModel;
use App\Models\DataBaseModels\TagModel;
use App\Models\DataBaseModels\GenreModel;
use App\Models\DataBaseModels\QuestionMCModel;
use App\Models\DataBaseModels\QuestionPXIModel;
use App\Models\PageModels\Dashboard\DashboardModel;


class DBTestController extends BaseController
{
    public function __construct()
    {

    }

    public function tags()
    {
        $model = new TagModel();
        $tags = $model->getAllTags();
        print_r($tags);
        //$model->addTag('Shooter');
    }

    public function genres()
    {
        $model = new GenreModel();
        $genres = $model->getAllGenres();
        print_r($genres);
        //$model->addGenre('MMORPG');
    }

    public function gametitles()
    {
        $model = new GameTitleModel();
        $gameTitles = $model->getAllGameTitles();
        print_r($gameTitles);
        $model->addGameTitle('Path of Exile');
    }

    public function DBTest()
    {
        $_SESSION['ID'] = 30;
        unset($_SESSION['loaded-db-data']); //unset session variable to reload Genres, GameTitles, Tags, Constructs, Languages QuestionTypes from the database.
        $questions = [ //2D-array! Order of questions is not important.
            //PXI QUESTIONS
            ['The actions to control the game were clear to me', //PXI Question
                'en',                                           //language
                'PXI',                                          //question type
                ['-3', '-2', '-1', '0', '1', '2', '3'],         //answer options
                0,                                              //sequenceNumber
                null],                                          //pageBreak
            ['The game was not too easy and not too hard to play', 'en', 'PXI', ['-3', '-2', '-1', '0', '1', '2', '3'], 0, null],
            ['I enjoyed the way the game was styled', 'en', 'PXI', ['-3', '-2', '-1', '0', '1', '2', '3'], 0, null],
            ['The game was challenging but not too challenging', 'en', 'PXI', ['-3', '-2', '-1', '0', '1', '2', '3'], 0, null],
            ['I could easily assess how I was performing in the game', 'en', 'PXI', ['-3', '-2', '-1', '0', '1', '2', '3'], 0, null],
            //CUSTOM QUESTIONS
            ['Are you a student?',  //custom Multiple Choice question
                'en',               //language
                'MC',               //question type
                ['yes', 'no'],      //answer options
                0,                  //sequenceNumber
                null],              //pageBreak
            ['What is your gender?', 'en', 'MC', ['male', 'female', 'rather not say'], 1, null], //custom Multiple Choice question
            ['Do you live closeby Leuven?', 'en', 'MC', ['far', 'close'], 0, null] //custom Multiple Choice question
            ];

        $dbData= $this->loadDBData(['Construct2', 'Option', 'Tags', 'Genre', 'GameTitle', 'QuestionType', 'Language2']);
        $SurveyModel = new SurveyModel($dbData);
        //$contentData['content'] = $pageModel->getContent();


        $SurveyModel->createSurvey(30, 'en', 'MySecond survey',$questions,'This second survey has a
        veery long description to teest whether description works as well. It is online until 2026 and has 3 gametitles, 3 genres and  tags.
        the image is equal to null.',
            '2005-02-08 12:30:00', '2026-02-08 12:30:00', null,
            ['Fortnite', 'Limbo', 'LittleBigPlanet'], //gametitles
            ['brand new', 'popular', 'a new world'], //genres
            ['VR', 'thrilling', 'cool']);   //tags



    }

    public function addPXIQuestionsToDb()
    {
        unset($_SESSION['loaded-db-data']);
        $PXIQuestionModel = new QuestionPXIModel();

        $questionsNL = [['Het was gemakkelijk om te weten hoe verschillende acties uit te voeren in het spel', 'nl', 'PXI', ['-3', '-2', '-1', '0', '1', '2', '3'], 'ease-of-control'],
        ['De acties om het spel te besturen waren voor mij duidelijk', 'nl', 'PXI', ['-3', '-2', '-1', '0', '1', '2', '3'], 'ease-of-control'],
        ['Ik vond het spel gemakkelijk om te besturen', 'nl', 'PXI', ['-3', '-2', '-1', '0', '1', '2', '3'], 'ease-of-control'],

        ['Ik kreeg vat op het hoofddoel van het spel', 'nl', 'PXI', ['-3', '-2', '-1', '0', '1', '2', '3'], 'clarity-of-goals'],
        ['De doelen van het spel waren duidelijk voor mij ', 'nl', 'PXI', ['-3', '-2', '-1', '0', '1', '2', '3'], 'clarity-of-goals'],
        ['Ik begreep de doelstellingen van het spel', 'nl', 'PXI', ['-3', '-2', '-1', '0', '1', '2', '3'], 'clarity-of-goals'],

        ['Het spel was niet te gemakkelijk en ook niet te moeilijk om te spelen', 'nl', 'PXI', ['-3', '-2', '-1', '0', '1', '2', '3'], 'challenge'],
        ['Het spel was uitdagend maar niet te uitdagend', 'nl', 'PXI', ['-3', '-2', '-1', '0', '1', '2', '3'], 'challenge'],
        ['De uitdagingen in het spel hadden de juiste moeilijkheidsgraad voor mij', 'nl', 'PXI', ['-3', '-2', '-1', '0', '1', '2', '3'], 'challenge'],

        ['Het spel iniformeerde mij over mijn vooruitgang in het spel', 'nl', 'PXI', ['-3', '-2', '-1', '0', '1', '2', '3'], 'progress-feedback'],
        ['Ik kon gemakkelijk inschatten hoe goed ik presteerde in het spel', 'nl', 'PXI', ['-3', '-2', '-1', '0', '1', '2', '3'], 'progress-feedback'],
        ['Het spel gaf duidelijke feedback over mijn vooruitgang naar de doelen', 'nl', 'PXI', ['-3', '-2', '-1', '0', '1', '2', '3'], 'progress-feedback'],

        ['Ik kon genieten van de manier waarop het spel was gestyled', 'nl', 'PXI', ['-3', '-2', '-1', '0', '1', '2', '3'], 'audiovisual-appeal'],
        ['Ik vond de uitstraling en gebruikservaring van het spel aangenaam', 'nl', 'PXI', ['-3', '-2', '-1', '0', '1', '2', '3'], 'audiovisual-appeal'],
        ['Ik apprecieerde de vormgeving van het spel', 'nl', 'PXI', ['-3', '-2', '-1', '0', '1', '2', '3'], 'audiovisual-appeal'],

        ['Het spel spelen was betekenisvol voor mij', 'nl', 'PXI', ['-3', '-2', '-1', '0', '1', '2', '3'], 'meaning'],
        ['Het spel voelde voor mij relevant aan', 'nl', 'PXI', ['-3', '-2', '-1', '0', '1', '2', '3'], 'meaning'],
        ['Dit spel spelen was voor mij waardevol', 'nl', 'PXI', ['-3', '-2', '-1', '0', '1', '2', '3'], 'meaning'],

        ['Ik wilde ontdekken hoe het spel evolueerde', 'nl', 'PXI', ['-3', '-2', '-1', '0', '1', '2', '3'], 'curiosity'],
        ['Ik wilde uitzoeken hoe het spel verder vorderde', 'nl', 'PXI', ['-3', '-2', '-1', '0', '1', '2', '3'], 'curiosity'],
        ['Ik voelde mij gedreven om te ontdekken hoe het spel verder ging', 'nl', 'PXI', ['-3', '-2', '-1', '0', '1', '2', '3'], 'curiosity'],

        ['Ik voelde tijdens het spelen dat ik goed was in het spel ', 'nl', 'PXI', ['-3', '-2', '-1', '0', '1', '2', '3'], 'mastery'],
        ['Ik voelde mij bekwaam in het spel', 'nl', 'PXI', ['-3', '-2', '-1', '0', '1', '2', '3'], 'mastery'],
        ['Ik had een goed gevoel van bekwaamheid tijdens het spel', 'nl', 'PXI', ['-3', '-2', '-1', '0', '1', '2', '3'], 'mastery'],

        ['Ik was mij niet meer gewaar van mijn omgeving tijdens het spel', 'nl', 'PXI', ['-3', '-2', '-1', '0', '1', '2', '3'], 'immersion'],
        ['Ik was ondergedompeld in het spel', 'nl', 'PXI', ['-3', '-2', '-1', '0', '1', '2', '3'], 'immersion'],
        ['Ik was volledig gefocusd op het spel', 'nl', 'PXI', ['-3', '-2', '-1', '0', '1', '2', '3'], 'immersion'],

        ['Ik voelde mij vrij om het spel te spelen hoe ik het wilde', 'nl', 'PXI', ['-3', '-2', '-1', '0', '1', '2', '3'], 'autonomy'],
        ['Ik voelde dat ik keuzes kreeg hoe het spel te spelen zoals ik het wilde', 'nl', 'PXI', ['-3', '-2', '-1', '0', '1', '2', '3'], 'autonomy'],
        ['Ik had een zeker gevoel van vrijheid hoe ik het spel wilde spelen', 'nl', 'PXI', ['-3', '-2', '-1', '0', '1', '2', '3'], 'autonomy'],

        ['Ik vond het leuk om dit spel te spelen', 'nl', 'PXI', ['-3', '-2', '-1', '0', '1', '2', '3'], 'enjoyment'],
        ['Het spel was vermakelijk', 'nl', 'PXI', ['-3', '-2', '-1', '0', '1', '2', '3'], 'enjoyment'],
        ['Ik heb plezier gehad tijdens het spel', 'nl', 'PXI', ['-3', '-2', '-1', '0', '1', '2', '3'], 'enjoyment']];
        $questionsEN = [['It was easy to know how to perform actions in the game', 'en', 'PXI', ['-3', '-2', '-1', '0', '1', '2', '3'], 'ease-of-control'],
            ['The actions to control the game were clear to me', 'en', 'PXI', ['-3', '-2', '-1', '0', '1', '2', '3'], 'ease-of-control'],
            ['I thought the game was easy to control', 'en', 'PXI', ['-3', '-2', '-1', '0', '1', '2', '3'], 'ease-of-control'],

            ['I grasped the overall goal of the game', 'en', 'PXI', ['-3', '-2', '-1', '0', '1', '2', '3'], 'clarity-of-goals'],
            ['The goals of the game were clear to me', 'en', 'PXI', ['-3', '-2', '-1', '0', '1', '2', '3'], 'clarity-of-goals'],
            ['I understood the objectives of the game', 'en', 'PXI', ['-3', '-2', '-1', '0', '1', '2', '3'], 'clarity-of-goals'],

            ['The game was not too easy and not too hard to play', 'en', 'PXI', ['-3', '-2', '-1', '0', '1', '2', '3'], 'challenge'],
            ['The game was challenging but not too challenging', 'en', 'PXI', ['-3', '-2', '-1', '0', '1', '2', '3'], 'challenge'],
            ['The challenges in the game were at the right level of difficulty for me', 'en', 'PXI', ['-3', '-2', '-1', '0', '1', '2', '3'], 'challenge'],

            ['The game informed me of my progress in the game', 'en', 'PXI', ['-3', '-2', '-1', '0', '1', '2', '3'], 'progress-feedback'],
            ['I could easily assess how I was performing in the game', 'en', 'PXI', ['-3', '-2', '-1', '0', '1', '2', '3'], 'progress-feedback'],
            ['The game gave clear feedback on my progress towards the goals', 'en', 'PXI', ['-3', '-2', '-1', '0', '1', '2', '3'], 'progress-feedback'],

            ['I enjoyed the way the game was styled', 'en', 'PXI', ['-3', '-2', '-1', '0', '1', '2', '3'], 'audiovisual-appeal'],
            ['I liked the look and feel of the game', 'en', 'PXI', ['-3', '-2', '-1', '0', '1', '2', '3'], 'audiovisual-appeal'],
            ['I appreciated the aesthetics of the game', 'en', 'PXI', ['-3', '-2', '-1', '0', '1', '2', '3'], 'audiovisual-appeal'],

            ['Playing the game was meaningful to me', 'en', 'PXI', ['-3', '-2', '-1', '0', '1', '2', '3'], 'meaning'],
            ['The game felt relevant to me', 'en', 'PXI', ['-3', '-2', '-1', '0', '1', '2', '3'], 'meaning'],
            ['Playing this game was valuable to me', 'en', 'PXI', ['-3', '-2', '-1', '0', '1', '2', '3'], 'meaning'],

            ['I wanted to explore how the game evolved', 'en', 'PXI', ['-3', '-2', '-1', '0', '1', '2', '3'], 'curiosity'],
            ['I wanted to find out how the game progressed', 'en', 'PXI', ['-3', '-2', '-1', '0', '1', '2', '3'], 'curiosity'],
            ['I felt eager to discover how the game continued', 'en', 'PXI', ['-3', '-2', '-1', '0', '1', '2', '3'], 'curiosity'],

            ['I felt I was good at playing this game', 'en', 'PXI', ['-3', '-2', '-1', '0', '1', '2', '3'], 'mastery'],
            ['I felt capable while playing the game', 'en', 'PXI', ['-3', '-2', '-1', '0', '1', '2', '3'], 'mastery'],
            ['I felt a sense of mastery playing this game', 'en', 'PXI', ['-3', '-2', '-1', '0', '1', '2', '3'], 'mastery'],

            ['I was no longer aware of my surroundings while I was playing', 'en', 'PXI', ['-3', '-2', '-1', '0', '1', '2', '3'], 'immersion'],
            ['I was immersed in the game', 'en', 'PXI', ['-3', '-2', '-1', '0', '1', '2', '3'], 'immersion'],
            ['I was fully focused on the game', 'en', 'PXI', ['-3', '-2', '-1', '0', '1', '2', '3'], 'immersion'],

            ['I felt free to play the game in my own way', 'en', 'PXI', ['-3', '-2', '-1', '0', '1', '2', '3'], 'autonomy'],
            ['I felt like I had choices regarding how I wanted to play this game', 'en', 'PXI', ['-3', '-2', '-1', '0', '1', '2', '3'], 'autonomy'],
            ['I felt a sense of freedom about how I wanted to play this game', 'en', 'PXI', ['-3', '-2', '-1', '0', '1', '2', '3'], 'autonomy'],

            ['I liked playing the game', 'en', 'PXI', ['-3', '-2', '-1', '0', '1', '2', '3'], 'enjoyment'],
            ['The game was entertaining', 'en', 'PXI', ['-3', '-2', '-1', '0', '1', '2', '3'], 'enjoyment'],
            ['I had a good time playing this game', 'en', 'PXI', ['-3', '-2', '-1', '0', '1', '2', '3'], 'enjoyment']];
        $PXIQuestionModel->insertQuestionsDB($questionsEN);
        $PXIQuestionModel->insertQuestionsDB($questionsNL);

    }
}