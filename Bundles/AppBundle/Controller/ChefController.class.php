<?php

namespace Bundles\AppBundle\Controller;

use App;
use Core\Controller\Controller;
use Core\Request\Request;

Class ChefController extends Controller {

    public function __construct()
    {
        parent::__construct();

        if(!App::getUser()){
            App::redirectToRoute('login');
        }
    }

    /**
     * @RouteName gestion_equipe
     * @RouteUrl /chef/equipes
     */
    public function showEquipeAction(){
        $equipe = App::getTable('appBundle:equipe')->findById( App::getUser()->getId() );

        $this->render('appBundle:chef:equipe', [
            'employes' => $equipe->getEmploye()->all()
        ]);
    }

    /**
     * @RouteName gestion_demand
     * @RouteUrl /chef/demands
     */
    public function showDemandAction(){

        $demand = App::getTable('appBundle:demand')->findAll();

        $this->render('appBundle:chef:demand', [
            'demands' => $demand
        ]);
    }

}