<?php

namespace Bundles\AppBundle\Form;

use Core\Form\Form;
use Core\Form\Validation;

class AdressForm extends Form {

    public function newForm(){

        $this->setFormName('newAdress');

        $this->text('num', 'Numéro de la rue :');
        $this->text('nom', 'Nom de la rue :');
        $this->number('postalCode', 'Code postal :');
        $this->text('city', 'Ville :');

        $this->setValidation( $this->addFormValidation() );

        return $this;
    }

    public function addFormValidation(){

        $validation = new Validation( $this );
//        $validation->regexCompare('num', '/^[0-9]+$/');
        $validation->isText('num');
        $validation->isText('nom');
        $validation->isNumber('postalCode');
        $validation->isText('city');

        return $validation;
    }

}