<?php

namespace Bundles\AppBundle\Form;

use Core\Form\Form;
use Core\Form\Validation;
use Core\Request\Request;

class AvisForm extends Form {

    public function newForm(){

        $this->setAction('#')->setMethod('POST')->setFormName('newAvis');

        $this->textarea('contenu', 'Votre commentaire', true, null, ['class' => 'form-control', 'rows' => 10]);
        $this->number('note', 'Note sur 5 :');

        $this->submit('Publier mon commentaire');

        $this->setValidation( $this->addFormValidation() );

        return $this;
    }

    public function addFormValidation(){

        $validation = new Validation( $this );

        $validation->isText('contenu');
        $validation->isInteger('note');
        $validation->addValidation('note', [
           'maxNumber' => 5,
           'minNumber' => 0
        ]);

        return $validation;
    }

}