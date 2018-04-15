<?php

namespace Bundles\AppBundle\Form;

use App;
use Core\Form\Form;
use Core\Form\Validation;
use Core\Query\Query;
use Core\Request\Request;
use Core\Router\Router;

class EquipeForm extends Form {

    public function newForm(){

        $users = App::getTable('userBundle:user')->findAll();
        $chef = [];
        $salarie = [];

        foreach ($users as $user){
            if( !$hasEquipe = App::getDb()->has(['user_id' => $user->getId()], 'equipe_user') ){
                if($user->hasRole('ROLE_CHEF') and !$user->hasRole('ROLE_ADMIN')){
                    $chef[$user->getId()] = $user;
                }elseif($user->hasRole('ROLE_SALARIE')){
                    $salarie[$user->getId()] = $user;
                }
            }
        }

        $this->setAction('#')->setMethod('POST')->setFormName('appbundle_equipe');

        $this->text('nom', 'Nom de l\'équipe :');
        $this->select('chef', 'Chef :',$chef, true, false, ['class' => 'form-control']);
        $this->select('employe', 'Salarié : ', $salarie, true, true, ['class' => 'form-control']);

        $this->submit('Valider');

        $this->setValidation( $this->addFormValidation() );

        return $this;
    }

    public function addFormValidation(){

        $validation = new Validation( $this );

        $validation->addValidation('nom', ['isRequired' => true]);
        $validation->addValidation('chef', ['isRequired' => true]);
        $validation->addValidation('employe', ['isRequired' => true]);

        return $validation;
    }

    public function updateForm(){

        $users = App::getTable('userBundle:user')->findAll();
        $chef = [];
        $salarie = [];
        $inEquipe = [];

        $equipeId =  $this->getParams('equipe')->getId();

        foreach ($users as $user){
            if($user->hasRole('ROLE_CHEF') and !$user->hasRole('ROLE_ADMIN')){
                $chef[] = $user;

            }else {
                if (App::getDb()->has(['user_id' => $user->getId(), 'equipe_id' => $equipeId], 'equipe_user')) { // dans l'équipe
                    if ($user->hasRole('ROLE_SALARIE')) {
                        $inEquipe[] = $user;
                    }
                } else {
                    if ($user->hasRole('ROLE_SALARIE')) {
                        $salarie[] = $user;
                    }
                }
            }
        }

        $this->setAction('#')->setMethod('POST')->setFormName('appbundle_equipe');

        $this->text('nom', 'Nom de l\'équipe :');
        $this->OneToOne('chef', 'Chef :', $chef, true, false, ['class' => 'form-control']);
        $this->OneToMany('employeToAdd', 'Salarié : <small><i>Sélectionner pour ajouter</i></small>', $salarie, [], [], false);
        $this->OneToMany('employeToRemove', 'Salarié dans l\'équipe : <small><i>Sélectionner pour retirer</i></small>', $inEquipe, [], [], false);

        $this->submit('Valider');

        $this->setValidation( $this->updateFormValidation() );

        return $this;
    }

    public function updateFormValidation(){

        $validation = new Validation( $this );

        $validation->addValidation('nom', ['isRequired' => true]);
        $validation->addValidation('chef', ['isRequired' => true]);

        return $validation;
    }

}