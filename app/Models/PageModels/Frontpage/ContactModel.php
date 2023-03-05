<?php

namespace App\Models\PageModels\Frontpage;

use http\Exception\UnexpectedValueException;

class ContactModel extends TemplateModel
{
    //OPTIONALLY: Add here there different data structures that you want to use in your view.
    private $formData;


    public function __construct($languageID)
    {
        parent::__construct($languageID);
        //NECESSARY: Set custom template data. Implement this function below.
        $this->setTemplateData($languageID);
        //OPTIONALLY: Set custom data for this page.
        $this->setFormData($languageID);

    }

    //NECESSARY: Implement this function
    private function setTemplateData($languageID) {
        parent::setHeroImage(base_url(). '');
        if($languageID == 'en') {
            parent::setPageTitle('PXI | Contact');
            parent::setTemplateTitle("Let's Talk");
            parent::setTemplateSubtitle('Leave your message below');
        }
        else if ($languageID == 'nl') {
            parent::setPageTitle('PXI | Contact');
            parent::setTemplateTitle("Let's Talk");
            parent::setTemplateSubtitle('Laat hieronder je bericht achter');
        }

    }

    public function getFormdata() {
            return $this->formData;
    }


    private function setFormData($languageID) {
    if($languageID == 'en') {
        $this->formData['subject'] = 'Subject';
        $this->formData['message'] = 'Message';
        $this->formData['email'] = 'E-mail Address';
        $this->formData['name'] = 'Name';
        $this->formData['submit'] = 'Send';
    }
    else if ($languageID == 'nl'){
        $this->formData['subject'] = 'Onderwerp';
        $this->formData['message'] = 'Bericht';
        $this->formData['email'] = 'E-mailadres';
        $this->formData['name'] = 'Naam';
        $this->formData['submit'] = 'Verzenden';

    }
    else {
        throw new UnexpectedValueException('Wrong languageID in this model');
    }
    }
}


