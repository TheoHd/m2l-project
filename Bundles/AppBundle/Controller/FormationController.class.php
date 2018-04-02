<?php

namespace Bundles\AppBundle\Controller;

use Bundles\AppBundle\Form\FormEntity;
use Core\Controller\Controller;
use Core\Form\Form;
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
//        $form = $this->getForm('appBundle:formationForm', 'new', $_POST);

        $entity = \App::getTable('userBundle:user')->findById(4);
        $form = new \Core\Form\FormEntity('userBundle:user');

        if( $this->request->is('post') ){
            var_dump(Request::all());
            if($form->isValid()){
                var_dump("ok");
            }else{
                $form->error( $form->getErrors() );
            }
        }

        $this->render('userBundle:form', [
            'form' => $form->render()
        ]);
    }
}