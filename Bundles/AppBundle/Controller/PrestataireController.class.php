<?php

namespace Bundles\AppBundle\Controller;

use App;
use Core\Controller\Controller;
use Core\Request\Request;
use Core\Session\Session;

Class PrestataireController extends Controller {

    /**
     * @RouteName list_prestataires
     * @RouteUrl /admin/prestataires
     */
    public function showPrestataireAction(){

        $prestataires = App::getTable('appBundle:prestataire')->findAll();

        $this->render('appBundle:admin:prestataires', [
            'prestataires' => $prestataires
        ]);
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
            'previousUrl' => "list_prestataires",
            'btnText' => "Retour à la liste des prestataires",
            'form' => $form->render(),
        ]);
    }

    /**
     * @RouteName update_prestataire
     * @RouteUrl /admin/prestataires/update/{:id}
     * @RouteParam :id ([0-9]+)
     */
    public function updatePrestataireAction($params){
        $entity = App::getTable('appBundle:prestataire')->findById($params['id']);

        $form = $this->getEntityForm('appBundle:prestataire', Request::all());
        $form->inject($entity);

        $this->render('appBundle:includes:form', [
            'pageTitle' => "Modification du prestataire #" . $entity->getId(),
            'pageDesc' => "",
            'previousUrl' => "list_prestataires",
            'btnText' => "Retour à la liste des prestataires",
            'form' => $form->render(),
        ]);
    }

    /**
     * @RouteName delete_prestataire
     * @RouteUrl /admin/prestataires/delete/{:id}
     * @RouteParam :id ([0-9]+)
     */
    public function deletePrestataireAction($params){
        App::getTable('appBundle:prestataire')->remove($params['id']);
        Session::success('Le prestataire à bien été supprimé !');
        App::redirectToRoute('list_prestataires');
    }

}