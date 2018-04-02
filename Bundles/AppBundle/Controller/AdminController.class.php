<?php

namespace Bundles\AppBundle\Controller;

use Core\Controller\Controller;

Class AdminController extends Controller {

    /**
     * @RouteName gestion_equipe
     * @RouteUrl /admin/equipe/{:equipe}
     * @RouteParam equipe ([0-9]+)
     */
    public function showChefEquipeAction(){
        $this->render('appBundle:chef:equipe');
    }

    /**
     * @RouteName gestion_equipes
     * @RouteUrl /admin/equipes
     */
    public function showEquipesAction(){
        $this->render('appBundle:admin:equipes');
    }

    /**
     * @RouteName gestion_membres
     * @RouteUrl /admin/membres
     */
    public function showMembreAction(){
        $this->render('appBundle:admin:membres');
    }

    /**
     * @RouteName gestion_cadres
     * @RouteUrl /admin/cadres
     */
    public function showCadreAction(){
        $this->render('appBundle:admin:cadres');
    }

    /**
     * @RouteName gestion_prestataires
     * @RouteUrl /admin/prestataires
     */
    public function showPrestataireAction(){
        $this->render('appBundle:admin:prestataires');
    }

    /**
     * @RouteName gestion_formations
     * @RouteUrl /admin/formations
     */
    public function showFormationAction(){
        $this->render('appBundle:admin:formations');
    }

}