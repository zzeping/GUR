<?php

namespace App\Models\PageModels\Frontpage;



class HomeModel extends TemplateModel
{
    private $features = null;


    public function __construct($languageID)
    {
        parent::__construct($languageID);

            $this->setTemplateData($languageID);
            $this->setFeatures($languageID);

    }

    public function setFeatures($languageID){
        $this->features['research']['image'] = base_url() . '/img/content/fp_home/research.svg';
        $this->features['research']['buttonlink'] = base_url() . '/login"';

        if($languageID == 'en') {

            $this->features['research']['buttontext'] = 'Create Survey';
            $this->features['research']['buzzword'] = 'Research';
            $this->features['research']['highlighted'] = ' player experience with PXI surveys';
            $this->features['research']['text'] = 'Create surveys and bring them to the world. 
                                                   You can either choose to share with a private public or publish on 
                                                   our website.';

            $this->features['analyse']['buttontext'] = 'Try it out';
            $this->features['analyse']['buzzword'] = 'Analyse';
            $this->features['analyse']['highlighted'] = ' your results';
            $this->features['analyse']['text'] = 'Pinpoint flaws or discover unexploited enhancements in your game through our PX analyser.';

            $this->features['share']['buttontext'] = 'Register now';
            $this->features['share']['buzzword'] = 'Share';
            $this->features['share']['highlighted'] = ' your findings with the world';
            $this->features['share']['text'] = 'Create beautiful reports of your analyses in a single click and share them with the world.';

            $this->features['const']['title'] = 'PXI Surveys';
            $this->features['const']['subtitle'] = 'For Players';
            $this->features['const']['buttontext'] = 'Browse surveys';
            $this->features['const']['buzzword'] = 'Constribute';
            $this->features['const']['highlighted'] = ' and share your experience';
            $this->features['const']['text'] = 'Your game experience as a player is valued. Take your time to share the strengths and weaknesses of your favourite game in a published survey of your choice.';
        }
        else if($languageID == 'nl') {
            $this->features['research']['buttontext'] = 'Ontwerp Survey';
            $this->features['research']['buzzword'] = 'Onderzoek';
            $this->features['research']['highlighted'] = ' spel ervaringen met PXI surveys';
            $this->features['research']['text'] = 'Maak surveys en breng ze naar de buitenwereld. 
                                                   Je kan surveys privé houden of ervoor kiezen om ze te publiceren op deze website.';

            $this->features['analyse']['buttontext'] = 'Probeer het';
            $this->features['analyse']['buzzword'] = 'Analyseer';
            $this->features['analyse']['highlighted'] = ' je resultaten';
            $this->features['analyse']['text'] = 'Lokaliseer fouten of ontdek onbenutte verbeteringen in je spel via onze PX-analyser.';

            $this->features['share']['buttontext'] = 'Registreer nu';
            $this->features['share']['buzzword'] = 'Deel';
            $this->features['share']['highlighted'] = ' je bevindingen met de wereld';
            $this->features['share']['text'] = 'Maak in één klik prachtige rapporten van uw analyses en deel ze aan de buitenwereld.';

            $this->features['const']['title'] = 'PXI Surveys';
            $this->features['const']['subtitle'] = 'Voor Spelers';
            $this->features['const']['buttontext'] = 'Zoek een survey';
            $this->features['const']['buzzword'] = 'Doe mee';
            $this->features['const']['highlighted'] = ' en deel je ervaring';
            $this->features['const']['text'] = 'Je game ervaring als speler wordt gewaardeerd. Neem de tijd om de sterke en zwakke punten van je favoriete game te delen in een gepubliceerde survey naar keuze.';
        }
    }

    private function setTemplateData($languageID)
    {
        $this->setHeroImage(base_url().'"/img/content/fp_home/main_img.svg"');
        if ($languageID == 'en') {
           parent::setPageTitle('PXI | Home');
           parent::setTemplateTitle('PXI Survey Creator');
           parent::setTemplateSubtitle('For Games User Researchers');
        }
        else if($languageID == 'nl') {
           parent::setPageTitle('PXI | Startpagina');
           parent::setTemplateTitle('PXI Survey Creator');
           parent::setTemplateSubtitle('Voor Games User Researchers');
        }
        else
            throw new \UnexpectedValueException('wrong languageID: '.$languageID);
    }

   public function getFeatures() {
     return $this->features;
    }
}