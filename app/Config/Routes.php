<?php

namespace Config;

// Create a new instance of our RouteCollection class.
use App\Controllers\FrontPage;

$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('FrontPage');
$routes->setDefaultMethod('home');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/setLanguage/(:any)','BaseController::setLanguage/$1');

/*
 * -----------------------------------------------------------------------------------------------------
 * FrontPage routes
 * -----------------------------------------------------------------------------------------------------
 */
$routes->get('/',               'FrontPage::home');
$routes->get('/home',           'FrontPage::home');
$routes->get('/frontpage',      'FrontPage::home');
$routes->get('/about',          'FrontPage::about_team4');
$routes->get('/about_team4',    'FrontPage::about_team4');
$routes->get('/about_pxi',      'FrontPage::about_pxi');
$routes->get('/contact',        'FrontPage::contact');
$routes->get('/browse',         'FrontPage::public_surveys');


/*
 * -----------------------------------------------------------------------------------------------------
 * Login routes
 * -----------------------------------------------------------------------------------------------------
 */
$routes->match(['get', 'post'],'/login',            'Login::login', ['filter' => 'noauth']);
$routes->match(['get', 'post'],'/loginbox',         'Login::loginbox', ['filter' => 'noauth']);
$routes->match(['get', 'post'],'/register',         'Login::register', ['filter' => 'noauth']);
$routes->match(['get', 'post'],'/forgot_password',  'Login::forgot_password', ['filter' => 'noauth']);
$routes->get(                  '/setLanguage/(:any)','Login::setLanguage/$1');

/*
 * -----------------------------------------------------------------------------------------------------
 * Survey Fillin routes
 * -----------------------------------------------------------------------------------------------------
 */

/*
 * -----------------------------------------------------------------------------------------------------
 * DashBoardController routes
 * -----------------------------------------------------------------------------------------------------
 */
$routes->match(['get', 'post'],'/dashboard',        'DashBoardController::dashboard', ['filter' => 'auth']);
$routes->match(['get', 'post'],'/mysurveys',        'DashBoardController::dashboard', ['filter' => 'auth']);
$routes->match(['get', 'post'],'/surveys',          'DashBoardController::dashboard', ['filter' => 'auth']);
$routes->match(['get', 'post'],'/logout',           'DashBoardController::logout',    ['filter' => 'auth']);
$routes->match(['get', 'post'],'/settings',         'DashBoardController::settings',  ['filter' => 'auth']);
$routes->match(['get', 'post'],'/compare',          'DashBoardController::compare',   ['filter' => 'auth']);
$routes->match(['get', 'post'],'/analyse',          'DashBoardController::analyse',   ['filter' => 'auth']);
$routes->match(['get', 'post'],'/profile',          'DashBoardController::settings',  ['filter' => 'auth']);
$routes->match(['get', 'post'],'/getImage/(:any)',  'DashBoardController::getImage/$1', ['filter' => 'auth']);
$routes->match(['get', 'post'],'/results/(:any)',   'DashBoardController::getResults/$1', ['filter' => 'auth']);
$routes->get(                  '/setLanguage/(:any)','DashBoardController::setLanguage/$1');

/*
 * -----------------------------------------------------------------------------------------------------
 * Create survey Routes
 * -----------------------------------------------------------------------------------------------------
 */
//$routes->match(['get', 'post'],'/create_survey', 'CreateSurvey::create_survey', ['filter' => 'auth']);
$routes->get('/create_survey', 'SurveyCreationController::home');

//$routes->match(['get', 'post'],'/create_survey/preview', 'CreateSurvey::preview', ['filter' => 'auth']);
//$routes->match(['get', 'post'],'/public_surveys', 'PublicPlayerSurvey::public_surveys');
$routes->match(['post','get'], 'create_survey/addQuestionnaire', 'SurveyCreationController::addQuestionnaire');
$routes->match(['post','get'], 'create_survey/addPersonId', 'SurveyCreationController::addPersonId');
$routes->match(['post','get'], 'create_survey/addQuestions', 'SurveyCreationController::addQuestions');
$routes->match(['post','get'], 'create_survey/addNewQuestions', 'SurveyCreationController::addNewQuestions');
$routes->match(['post','get'], 'create_survey/insertOptions', 'SurveyCreationController::insertOptions');
$routes->match(['get','post'], 'create_survey/get_surveyId', 'SurveyCreationController::get_surveyId');
$routes->match(['get','post'], 'create_survey/get_addedId', 'SurveyCreationController::get_addedId');


//$routes->get('/fillin_survey/getSurveyQuestions(:any)', 'SurveyFillinController::getSurveyQuestions');
//$routes->get('/fillin_survey/getPXIOptions(:any)', 'SurveyFillinController::getPXIOptions');
$routes->get('/fillin_survey', 'SurveyFillinController::home');
$routes->get('/create_survey', 'SurveyCreationController::home');
$routes->match(['post'], '/handleFill/(:any)', 'SurveyFillinController::add_answers_to_db/$1');


/*
 * -----------------------------------------------------------------------------------------------------
 * Database Test routes
 * -----------------------------------------------------------------------------------------------------
 */
$routes->get('/tags', 'DBTestController::tags');
$routes->get('/genres', 'DBTestController::genres');
$routes->get('/gametitles', 'DBTestController::gametitles');
$routes->get('/DBTest', 'DBTestController::DBTest');
$routes->get('/AddPXI', 'DBTestController::addPXIQuestionsToDb');


/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
