<?php

namespace Bundles\AppBundle\Form;

use Core\Form\Form;
use Core\Form\Validation;
use Core\Request\Request;

class FormationForm extends Form {

    public function newForm(){

        $this->setAction('#')->setMethod('POST')->setFormName('newFormation');

        $this->text('nom', 'Nom de la formation :');
        $this->textarea('contenu', 'Descriptif de la formation :');
        $this->date('deb', 'Début :');
        $this->number('duree', 'Durée (en Jours) :');
        $this->number('prerequis', 'Crédits :');


        $this->OneToOne('prestataire', 'Prestataire :', 'appBundle:prestataire');
        //$this->OneToMany('members', 'Salariés :', 'userBundle:user', ['roles' => '{ ROLE_USER }']);

        //$this->addEntityFormMultiple('prestataire', 'appBundle:prestataire');
//        $this->addEntityForm('user', 'userBundle:user');
        //$this->addForm('appBundle:adressForm', 'new');

        $this->submit('Ajouter');

        $this->setValidation( $this->addFormValidation() );

        return $this;
    }

    public function addFormValidation(){

        $validation = new Validation( $this );

        $validation->isText('nom');
        $validation->isTextarea('contenu');
        $validation->isDate('deb');
        $validation->isNumber('duree');
        $validation->isNumber('prerequis');

        $validation->isRequired('prestataire');

        return $validation;
    }

}