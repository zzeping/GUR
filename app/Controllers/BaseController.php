<?php

namespace App\Controllers;

use App\Models\ComponentModels\FooterModel;
use App\Models\ComponentModels\NavbarModel;
use CodeIgniter\Controller;
use CodeIgniter\Exceptions\ModelException;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use http\Exception\UnexpectedValueException;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading ComponentModels
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class FrontPage extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = [];


    /**
     * database connection to load data once
     *
     * @var array
     */
    protected $db;




    /**
     * Constructor.
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.

        $this->session = \Config\Services::session();
        //default site language is english:
        if  (!$this->session->has('language')) {
            $this->session->set(['language' => 'en']);
        }
        $this->db = \Config\Database::connect();
        //$this->db = \Config\Database::connect('manual);


    }

    protected function show($templateView, $templateData, $contentView, $contentData,  $stylesheets = null, $scripts = null): string
    {
        //Checking whether the template view exists:
        if (!is_file(APPPATH . 'Views/template/' . $templateView . '.php')) {
            // Whoops, we don't have a page for that!
            throw new \CodeIgniter\Exceptions\PageNotFoundException('"Views/template/' . $templateView . '" can not be found in the local file directory.');
        }
        //Checking whether the content view exists:
        if (!is_file(APPPATH . 'Views/content/' . $contentView . '.php')) {
            // Whoops, we don't have a page for that!
            throw new \CodeIgniter\Exceptions\PageNotFoundException('"Views/content/' . $contentView . '" can not be found in the local file directory.');
        }

        //parse the contentView in the variable $content:
        $templateData['content'] = view('/content/'.$contentView, $contentData);
        $templateData['sheets_to_load'] = $stylesheets;
        $templateData['scripts_to_load'] = $scripts;

        return (view('/default/html_heading', $templateData) . view('/template/' . $templateView, $templateData) . view('/default/html_eof', $templateData));

    }



    /**
     * Loads all data from the database stored in the provided table.
     *
     */
    protected function loadDBData($tables) {
        $dbData = [];
            foreach ($tables as $table) {
                if ($table == 'Construct2') {
                    $dbData['Construct2'] = $this->getAllConstructs();
                }
                if ($table == 'QuestionType') {
                    $dbData['QuestionType'] = $this->getAllQuestionTypes();
                }
                if ($table == 'Option') {
                    $dbData['Option'] = $this->getAllOptions();
                }
                if ($table == 'Genre') {
                    $dbData['Genre'] = $this->getAllGenres();
                }
                if ($table == 'GameTitle') {
                    $dbData['GameTitle'] = $this->getAllGameTitles(1);;
                }
                if ($table == 'Tags') {
                    $dbData['Tags'] = $this->getAllTags();
                }
                if ($table == 'Language2') {
                    $dbData['Language2'] = $this->getAllLanguages();
                }
            }
        $_SESSION['dbdata'] = $dbData;
        return $_SESSION['dbdata'];
    }

    /*
    *--------------------  GAMETITLES ----------------------------------*/
    /**
     * @Returns array-key with (key, value) pairs containing the stored database game titles.
     *   'key'    = GameTitle.idGameTit
     *   'value'  = GameTitle.Name
     */
    protected function getAllGameTitles(): array
    {

        //print_r('  Loading gametitles from DB, called by: '.$caller['function'].'---');
        $query_text = 'SELECT * 
                   FROM a21ux04.GameTitle';
        $this->db->transStart();
        $query = $this->db->query($query_text);
        $this->db->transComplete();
        $result = [];
        foreach ($query->getResult() as $row) {
            $result[$row->idGameTit] = strtolower($row->Name);
        }
        return $result;
    }
    /*
      *--------------------  GENRES ----------------------------------*/
    /**
     * @Returns array-key with (key, value) pairs containing the stored database genres
     *  'key'    = Genre.genreID
     *  'value'  = Genre.description
     */
    protected function getAllGenres(): array {

        //print_r('  Loading from DB, called by: '.$caller['function'].'---');
        $query_text = 'SELECT * 
                   FROM a21ux04.Genre';
        $query = $this->db->query($query_text);
        $result = [];
        foreach ($query->getResult() as $row) {
                $result[$row->genreId] = strtolower($row->description);
            }
        return $result;
    }

    protected function getAllLanguages(): array
    {
        $query_text = 'SELECT * 
                   FROM a21ux04.Language2';
        $query = $this->db->query($query_text);
        $result = [];
        foreach ($query->getResult() as $row) {
                $result[$row->idLanguage] = strtolower($row->description);
            }

        return $result;
    }

    /**
     * @Returns array-key with (key, value) pairs containing the stored database genres
     *  'key'    = Option.idOption
     *  'value'  = Option.description
     */
    protected function getAllOptions(): array {

        //print_r('  Loading from DB, called by: '.$caller['function'].'---');
        $query_text = 'SELECT * 
                       FROM a21ux04.Option';
        $query = $this->db->query($query_text);
        $result = [];
        foreach ($query->getResult() as $row) {
                $result[$row->idOption] = strtolower($row->description);
            }
        return $result;
    }

    /**
     * @Returns array-key with (key, value) pairs containing the stored database construct types
     *  'key'    = QuestionTypes.questionTypesID
     *  'value'  = QuestionTypes.type
     */
    protected function getAllQuestionTypes() : array {

        //print_r('  Loading from DB, called by: '.$caller['function'].'---');
        $query_text = 'SELECT * 
                       FROM a21ux04.QuestionType';
        $query = $this->db->query($query_text);
        $result=[];
        foreach ($query->getResult() as $row){
                $result[$row->idType] = strtolower($row->description);
            }
        return $result;
    }

    /**
     * @Returns array-key with (key, value) pairs containing the stored database tags
     *  'key'    = Tags.idtags
     *  'value'  = Tags.tagname
     */
    protected function getAllTags(): array {

        //print_r('  Loading from DB, called by: '.$caller['function'].'---');
        $query_text = 'SELECT * 
                   FROM a21ux04.Tags';
        $query = $this->db->query($query_text);
        $result = [];
        foreach ($query->getResult() as $row) {
            $result[$row->idTags] = strtolower($row->tagname);
        }
        return $result;
    }

    /**
     * @Returns array of strings containing the stored database ConstructTypes
     *   'value'  = ConstructTypes.construct
     */
    public function getAllConstructs(): array
    {

        //print_r('  Loading from DB, called by: '.$caller['function'].'---');
        $query_text = 'SELECT * 
                   FROM a21ux04.Construct2';
        $query = $this->db->query($query_text);
        $result = [];
        foreach ($query->getResult() as $row) {
                $result[$row->idConstruct] = strtolower($row->description);
            }
        return $result;
    }

    public function setLanguage($languageID) {
        //print_r($_SESSION['language']);
        $_SESSION['language'] = $languageID;
        $agent = $this->request->getUserAgent();
        //print_r($languageID);

        $this->response->redirect($agent->getReferrer());
    }

}
