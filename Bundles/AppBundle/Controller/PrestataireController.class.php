<?php

namespace Bundles\AppBundle\Controller;

use App;
use Core\Controller\Controller;
use Core\Request\Request;
use Core\Session\Session;

Class PrestataireController extends Controller {

    public function __construct()
    {
        parent::__construct();

        if(!App::getUser()){
            App::redirectToRoute('login');
        }
    }

    /**
     * @RouteName list_prestataires
     * @RouteUrl /prestataires
     */
    public function listPrestataireAction(){

        $prestataires = App::getTable('appBundle:prestataire')->findAll();

        $this->render('appBundle:prestataire:prestataires', [
            'prestataires' => $prestataires
        ]);
    }

    /**
     * @RouteName add_prestataire
     * @RouteUrl /prestataires/add
     */
    public function addPrestataireAction(){
        $form = $this->getEntityForm('appBundle:prestataire', Request::all());

        $this->render('appBundle:includes:form', [
            'pageTitle' => "Ajout d'un nouveau prestataire",
            'pageDesc' => "",
            'previousUrl' => "list_prestataires",
            'previousParams' => [],
            'btnText' => "Retour à la liste des prestataires",
            'form' => $form->render(),
        ]);
    }

    /**
     * @RouteName update_prestataire
     * @RouteUrl /prestataires/update/{:id}
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
            'previousParams' => [],
            'btnText' => "Retour à la liste des prestataires",
            'form' => $form->render(),
        ]);
    }

    /**
     * @RouteName delete_prestataire
     * @RouteUrl /prestataires/delete/{:id}
     * @RouteParam :id ([0-9]+)
     */
    public function deletePrestataireAction($params){
        App::getTable('appBundle:prestataire')->remove($params['id']);
        Session::success('Le prestataire à bien été supprimé !');
        App::redirectToRoute('list_prestataires');
    }

    /**
     * @RouteName show_prestataire
     * @RouteUrl /prestataire/{:id}
     * @RouteParam :id ([0-9]+)
     */
    public function showPrestataireAction($params){
        $prestataire = App::getTable('appBundle:prestataire')->findById($params['id']);

        $formations = App::getTable('appBundle:formation')->findBy(['prestataire_id' => $prestataire->getId()]);

        $soon = []; $ended = []; $canceled = []; $reported = [];

        foreach ($formations as $f){
            if($f->getStatut() == 0){
                $canceled[] = $f;
            }elseif($f->getStatut() == 1){
                $soon[] = $f;
            }elseif($f->getStatut() == 2){
                $ended[] = $f;
            }elseif($f->getStatut() == -1){
                $reported[] = $f;
            }
        }

        $this->render('appBundle:prestataire:show', [
            'prestataire' => $prestataire,
            'canceled' => $canceled,
            'soon' => $soon,
            'ended' => $ended,
            'reported' => $reported,
        ]);
    }

}