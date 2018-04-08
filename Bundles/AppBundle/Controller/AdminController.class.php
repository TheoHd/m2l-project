<?php

namespace Bundles\AppBundle\Controller;

use Core\Controller\Controller;
use Core\Request\Request;

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
     * @RouteName gestion_cadres
     * @RouteUrl /admin/cadres
     */
    public function showCadreAction(){
        $this->render('appBundle:admin:cadres');
    }

    /**
     * @RouteName gestion_equipes
     * @RouteUrl /admin/equipes
     */
    public function showEquipesAction(){
        $this->render('appBundle:admin:equipes');
    }

    /**
     * @RouteName add_equipe
     * @RouteUrl /admin/equipes/add
     */
    public function addEquipeAction(){
        $form = $this->getEntityForm('appBundle:equipe', Request::all());

        $this->render('appBundle:includes:form', [
            'pageTitle' => "Ajout d'une nouvelle equipe",
            'pageDesc' => "",
            'previousUrl' => "gestion_equipes",
            'btnText' => "Retour à la liste des equipes",
            'form' => $form->render(),
        ]);
    }

    /**
     * @RouteName gestion_membres
     * @RouteUrl /admin/membres
     */
    public function showMembreAction(){
        $this->render('appBundle:admin:membres');
    }

    /**
     * @RouteName gestion_prestataires
     * @RouteUrl /admin/prestataires
     */
    public function showPrestataireAction(){
        $this->render('appBundle:admin:prestataires');
    }

    /**
     * @RouteName add_prestataire
     * @RouteUrl /admin/prestataires/add
     */
    public function addPrestataireAction(){
        $form = $this->getEntityForm('appBundle:prestataire', Request::all());

        $this->render('appBundle:includes:form', [
            'pageTitle' => "Ajout d'un nouveau prestataire",
            'pageDesc' => "",
            'previousUrl' => "gestion_prestataires",
            'btnText' => "Retour à la liste des prestataires",
            'form' => $form->render(),
        ]);
    }

    /**
     * @RouteName gestion_formations
     * @RouteUrl /admin/formations
     */
    public function showFormationAction(){
        $this->render('appBundle:admin:formations');
    }

    /**
     * @RouteName add_formation
     * @RouteUrl /admin/formations/add
     */
    public function addFormationAction(){
        $form = $this->getEntityForm('appBundle:formation', Request::all());

        $this->render('appBundle:includes:form', [
            'pageTitle' => "Ajout d'une nouvelle formation",
            'pageDesc' => "",
            'previousUrl' => "gestion_formations",
            'btnText' => "Retour à la liste des formations",
            'form' => $form->render(),
        ]);
    }

}