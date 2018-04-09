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
    public function showAvisAction(){
        $this->render('appBundle:formation:avis');
    }

    /**
     * @RouteName list_formations
     * @RouteUrl /admin/formations
     */
    public function showFormationAction(){

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
     * @RouteUrl /admin/formations/add
     */
    public function addFormationAction(){
        $form = $this->getEntityForm('appBundle:formation', Request::all());

        $this->render('appBundle:includes:form', [
            'pageTitle' => "Ajout d'une nouvelle formation",
            'pageDesc' => "",
            'previousUrl' => "list_formations",
            'btnText' => "Retour à la liste des formations",
            'form' => $form->render(),
        ]);
    }

    /**
     * @RouteName update_formation
     * @RouteUrl /admin/formations/update/{:id}
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
            'btnText' => "Retour à la liste des formations",
            'form' => $form->render(),
        ]);
    }

    /**
     * @RouteName delete_formation
     * @RouteUrl /admin/formations/delete/{:id}
     * @RouteParam :id ([0-9]+)
     */
    public function deleteFormationAction($params){
        App::getTable('appBundle:formation')->remove($params['id']);
        Session::success('Le formation à bien été supprimé !');
        App::redirectToRoute('list_formations');
    }

}