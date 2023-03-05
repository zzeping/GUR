<?php

namespace App\Models\PageModels\Dashboard;

use App\Models\DataBaseModels\QuestionPXIModel;
use CodeIgniter\Exceptions\ModelException;
use http\Exception\UnexpectedValueException;

class SurveyCreationModel extends TemplateModel
{
    //OPTIONALLY: Add here there different data structures that you want to use in your view.
    private $PXIQuestions;
    private  $dbData;


    public function __construct($languageID, $dbData)
    {
        parent::__construct($languageID);
        $this->dbData = $dbData;
        $questionPXIModel = new QuestionPXIModel($dbData);
        $this->PXIQuestions = $questionPXIModel->getPXI('en', 'DESCR', 0);
        //NECESSARY: Set custom template data. Implement this function below.
        $this->setTemplateData($languageID);
    }

    //NECESSARY: Implement this function
    private function setTemplateData($languageID) {
        if($languageID == 'en') {
            parent::setPageTitle('');

        }
        else if ($languageID == 'nl') {
            parent::setPageTitle('');
        }

    }

    //NECESSARY getter for the controller to retrieve page data.
    public function getPXIQuestions($language, $length, $enjoyment) {
        $questionModel = new QuestionPXIModel($this->dbData);
        $result = [];
        if($language == 'en') {
            $this->PXIQuestions = $questionModel->getPXI('en', 'DESCR', 0);
        }
        if($language == 'nl'){
            $this->PXIQuestions = $questionModel->getPXI('nl', 'DESCR', 0);
        }
             if (($length == 'short') && ($enjoyment == 'enjoy')) {
                 foreach ($this->PXIQuestions as $construct => $questions) {
                        if($construct == 'enjoyment') {
                            array_push($result, $questions[rand(0, count($questions)-1)]);
                        }

                     }
                 }
             if (($length == 'short') && ($enjoyment == 'no-enjoy')) {
                 foreach ($this->PXIQuestions as $construct => $questions) {

                         if($construct != 'enjoyment')
                            array_push($result, $questions[rand(0, count($questions)-1)]);

                     }
                 }
             if (($length == 'long') && ($enjoyment == 'no-enjoy')) {
                 foreach ($this->PXIQuestions as $construct => $questions) {
                     if($construct != 'enjoyment')  {
                         foreach($questions as $question) {
                             array_push($result, $question);
                         }
                     }
                 }
             }
             if (($length == 'long') && ($enjoyment == 'enjoy')) {
                 foreach ($this->PXIQuestions as $construct => $questions) {
                     if ($construct == 'enjoyment') {
                         foreach ($questions as $question) {
                             array_push($result, $question);
                         }
                     }
                 }
             }
        return $result;
    }

}


