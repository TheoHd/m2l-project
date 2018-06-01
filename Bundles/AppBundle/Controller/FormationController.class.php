<?php

namespace Bundles\AppBundle\Controller;

use App;
use Bundles\AppBundle\Entity\FormationEntity;
use Bundles\AppBundle\Form\FormEntity;
use Bundles\UserBundle\Entity\UserEntity;
use Core\Controller\Controller;
use Core\Form\Form;
use Core\Form\FormEntityTraitement;
use Core\Request\Request;
use Core\Session\Session;
use PDO;

class FormationController extends Controller {

    public function __construct()
    {
        parent::__construct();

        if(!App::getUser()){
            App::redirectToRoute('login');
        }
    }

    /**
     * @RouteName show_formation
     * @RouteUrl /formation/{:id}
     * @RouteParam :id ([0-9]+)
     */
    public function showAction($params){
        $formation = App::getTable('appBundle:formation')->findById($params['id']);
        $user = App::getUser();

        $nbDemand = count( App::getTable('appBundle:demand')->findBy(['formation_id' => $formation->getId()]) );
        $demand = App::getTable('appBundle:demand')->findBy(['formation_id' => $formation->getId(), 'user_id' => $user->getId()]);
        $avisFormation = App::getTable('appBundle:avis')->findBy(['formation_id' => $formation->getId()]);
        $lastAvis = reset($avisFormation);

        $alreadyHasDemand = count($demand) > 0;

        $note = false;
        if(!empty($avisFormation)){
            $noteFormation = 0;
            foreach ($avisFormation as $avis){
                $noteFormation += $avis->getNote();
            }
            $note = (int) round($noteFormation / count($avisFormation));
        }

        $this->render('appBundle:formation:show', [
            'formation' => $formation,
            'alreadyHasDemand' => $alreadyHasDemand,
            'nbAvis' => count($avisFormation),
            'note' => $note,
            'nbDemand' => $nbDemand,
            'lastAvis' => $lastAvis,
            'demands' => $demand,
        ]);
    }

    /**
     * @RouteName manage_formations
     * @RouteUrl /formations/manage
     */
    public function manageFormationAction(){

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

        $this->render('appBundle:formation:manage', [
            'canceled' => $canceled,
            'soon' => $soon,
            'ended' => $ended,
            'reported' => $reported,
        ]);
    }

    /**
     * @RouteName search_formations
     * @RouteUrl /home/search
     */
    public function searchqHomeFormationAction(){

        $search = Request::get('search');

        $formations = App::getDb()->query("SELECT * FROM formation WHERE nom LIKE '%".$search."%'", false, PDO::FETCH_CLASS, FormationEntity::class);

        $this->render('appBundle:formation:ajax-template', [
            'formations' => $formations
        ]);
    }

    /**
     * @RouteName search_formations_salarie
     * @RouteUrl /formations/search
     */
    public function searchFormationAction(){

        $search = Request::get('search');

        $formations = App::getDb()->query("SELECT * FROM formation WHERE nom LIKE '%".$search."%'", false, PDO::FETCH_CLASS, FormationEntity::class);

        $this->render('appBundle:formation:ajax-template-search', [
            'formations' => $formations
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
            'previousUrl' => "manage_formations",
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
            'previousUrl' => "manage_formations",
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
        App::redirectToRoute('manage_formations');
    }



    /**
     * @RouteName list_formations
     * @RouteUrl /formations
     */
    public function listFormationAction(){

        $manager = App::getTable('userBundle:user');
        $user = $manager->findById(App::getUser()->getId());
        $formations = App::getTable('appBundle:formation')->findAll();

        $myFormation = App::getTable('appBundle:demand')->findBy(['user_id' => $user->getId()]);

        $nbFormation = count($myFormation);
        $totalDays = 0;
        if($nbFormation > 0){
            foreach ($myFormation as $f){
                $totalDays += $f->getFormation()->getDuree();
            }
        }

        foreach ($formations as $f){
            $avisFormation = App::getTable('appBundle:avis')->findBy(['formation_id' => $f->getId()]);

            if(!empty($avisFormation)){
                $noteFormation = 0;
                foreach ($avisFormation as $avis){
                    $noteFormation += $avis->getNote();
                }

                $round = (int) round($noteFormation / count($avisFormation));
                if($round == 1) { $noteTitle = 'Facile';
                } elseif($round == 2) { $noteTitle = 'Moyen';
                } elseif($round == 3) { $noteTitle = 'Intermédiaire';
                } elseif($round == 4) { $noteTitle = 'Difficile';
                } elseif($round == 5) { $noteTitle = 'Trés difficile';
                } else{ $noteTitle = 'Aucun avis'; }

                $f->noteTitle = $noteTitle;
                $f->notePercent = ($noteFormation / count($avisFormation)) * 100 / 5;
            }else{
                $f->notePercent = "0";
                $f->noteTitle = "Aucun avis";
            }
        }


        $this->render('appBundle:formation:list', [
            'user' => $user,
            'formations' => $formations,
            'nbFormation' => $nbFormation,
            'totalDays' => $totalDays,
        ]);
    }

}