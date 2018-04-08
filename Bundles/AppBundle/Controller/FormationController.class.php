<?php

namespace Bundles\AppBundle\Controller;

use App;
use Bundles\AppBundle\Form\FormEntity;
use Bundles\UserBundle\Entity\UserEntity;
use Core\Controller\Controller;
use Core\Form\Form;
use Core\Form\FormEntityTraitement;
use Core\Request\Request;

Class FormationController extends Controller {

    /**
     * @RouteName formations_list
     * @RouteUrl /formations
     */
    public function listAction(){
        $this->render('appBundle:formation:list');
    }

    /**
     * @RouteName formation_show
     * @RouteUrl /formation/{:id}
     * @RouteParam id ([0-9]+)
     */
    public function showAction(){
        $this->render('appBundle:formation:show');
    }


    /**
     * @RouteName formation_show_avis
     * @RouteUrl /formation/{:id}/avis
     * @RouteParam id ([0-9]+)
     */
    public function showAvisAction(){
        $this->render('appBundle:formation:avis');
    }

    /**
     * @RouteName formation_add
     * @RouteUrl /formation/add
     */
    public function addAction(){
        $form = $this->getEntityForm("userbundle:user", Request::all());

        $this->render('userbundle:form', [
            'form' => $form->render()
        ]);
    }
}