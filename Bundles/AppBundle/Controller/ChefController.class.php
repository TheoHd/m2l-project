<?php

namespace Bundles\AppBundle\Controller;

use Core\Controller\Controller;
use Core\Request\Request;

Class ChefController extends Controller {

    /**
     * @RouteName gestion_equipe
     * @RouteUrl /chef/equipes
     */
    public function showEquipeAction(){
        $this->render('appBundle:chef:equipe');
    }

    /**
     * @RouteName gestion_demand
     * @RouteUrl /chef/demands
     */
    public function showDemandAction(){
        $this->render('appBundle:chef:demand');
    }

    /**
     * @RouteName add_membre
     * @RouteUrl /chef/membres/add
     */
    public function addMembreAction(){
        $form = $this->getEntityForm('userBundle:user', Request::all());

        $this->render('appBundle:includes:form', [
            'pageTitle' => "Ajout d'un nouveau membre",
            'pageDesc' => "",
            'previousUrl' => "gestion_membres",
            'btnText' => "Retour à la liste des membres",
            'form' => $form->render(),
        ]);
    }

}