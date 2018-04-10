<?php

namespace Bundles\AppBundle\Controller;

use App;
use Bundles\AppBundle\Form\FormEntity;
use Bundles\UserBundle\Entity\UserEntity;
use Core\Controller\Controller;
use Core\Form\Form;
use Core\Form\FormEntityTraitement;
use Core\Request\Request;
use Core\Session\Session;

Class FormationController extends Controller {

    /**
     * @RouteName avis_formations
     * @RouteUrl /formation/{:id}/avis
     * @RouteParam id ([0-9]+)
     */
    public function showAvisAction($params){
        $formation = App::getTable('appBundle:formation')->findById($params['id']);
        $avis = App::getTable('appBundle:avis')->findBy(['formation_id' => $formation->getId()], ['date' => 'DESC']);

        $myAvis = App::getTable('appBundle:avis')->findOneBy(['formation_id' => $formation->getId(), 'user_id' => App::getUser()->getId()]);

        $authorizeNewAvis = $myAvis === false;

        $this->render('appBundle:formation:avis', [
            'formation' => $formation,
            'avis' => $avis,
            'authorizeNewAvis' => $authorizeNewAvis
        ]);
    }

    /**
     * @RouteName show_formation
     * @RouteUrl /formation/{:id}
     * @RouteParam :id ([0-9]+)
     */
    public function showAction($params){
        $formation = App::getTable('appBundle:formation')->findById($params['id']);

        $this->render('appBundle:formation:show', [
            'formation' => $formation
        ]);
    }

    /**
     * @RouteName list_formations
     * @RouteUrl /formations
     */
    public function listFormationAction(){

        $formations = App::getTable('appBundle:formation')->findAll();

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

        $this->render('appBundle:admin:formations', [
            'canceled' => $canceled,
            'soon' => $soon,
            'ended' => $ended,
            'reported' => $reported,
        ]);
    }

    /**
     * @RouteName add_formation
     * @RouteUrl /formations/add
     */
    public function addFormationAction(){
        $form = $this->getEntityForm('appBundle:formation', Request::all());

        $this->render('appBundle:includes:form', [
            'pageTitle' => "Ajout d'une nouvelle formation",
            'pageDesc' => "",
            'previousUrl' => "list_formations",
            'previousParams' => [],
            'btnText' => "Retour à la liste des formations",
            'form' => $form->render(),
        ]);
    }

    /**
     * @RouteName update_formation
     * @RouteUrl /formations/update/{:id}
     * @RouteParam :id ([0-9]+)
     */
    public function updateFormationAction($params){
        $entity = App::getTable('appBundle:formation')->findById($params['id']);

        $form = $this->getEntityForm('appBundle:formation', Request::all());
        $form->inject($entity);

        $this->render('appBundle:includes:form', [
            'pageTitle' => "Modification d'une formation #" . $entity->getId(),
            'pageDesc' => "",
            'previousUrl' => "list_formations",
            'previousParams' => [],
            'btnText' => "Retour à la liste des formations",
            'form' => $form->render(),
        ]);
    }

    /**
     * @RouteName delete_formation
     * @RouteUrl /formations/delete/{:id}
     * @RouteParam :id ([0-9]+)
     */
    public function deleteFormationAction($params){
        App::getTable('appBundle:formation')->remove($params['id']);
        Session::success('Le formation à bien été supprimé !');
        App::redirectToRoute('list_formations');
    }

}