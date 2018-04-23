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
        $equipe = App::getTable('appBundle:equipe')->findOneBy( ['chef_id' => App::getUser()->getId()] );
        if($equipe == false){
            $employe = [];
        }else{
            $employe = $equipe->getEmploye()->all();
        }

        $this->render('appBundle:chef:equipe', [
            'employes' => $employe
        ]);
    }

    /**
     * @RouteName gestion_demand
     * @RouteUrl /chef/demands
     */
    public function showDemandAction(){

        $demands = App::getTable('appBundle:demand')->findAll();

        if(App::getUser()->hasRole('ROLE_ADMIN')){
            $r = $demands;
        }else{
            $r = [];
            foreach ($demands as $k => $demand){
                $userId = $demand->getUser()->getId();
                $demandEquipe = App::getDb()->query("SELECT * FROM equipe_user WHERE user_id = $userId")[0];
                if($demandEquipe and !empty($demandEquipe)){
                    $connectedUserEquipe = App::getTable('appBundle:equipe')->findOneBy(['chef_id' => App::getUser()->getId()]);
                    if($demandEquipe->equipe_id == $connectedUserEquipe->getId()){
                        $r[] = $demand;
                    }
                }
            }

        }

        $this->render('appBundle:chef:demand', [
            'demands' => $r
        ]);
    }

}