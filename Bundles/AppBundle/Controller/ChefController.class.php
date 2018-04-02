<?php

namespace Bundles\AppBundle\Controller;

use Core\Controller\Controller;

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

}