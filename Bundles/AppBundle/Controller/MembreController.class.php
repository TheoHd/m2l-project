<?php

namespace Bundles\AppBundle\Controller;

use App;
use Core\Config\Config;
use Core\Controller\Controller;
use Core\Request\Request;
use Core\Session\Session;

Class MembreController extends Controller {

    public function __construct()
    {
        parent::__construct();

        if(!App::getUser()){
            App::redirectToRoute('login');
        }
    }

    /**
     * @RouteName list_membres
     * @RouteUrl /admin/membres
     */
    public function showMembreAction(){

        $membres = App::getTable('userBundle:user')->findBy(['roles' => '{"ROLE_SALARIE":"ROLE_SALARIE"}']);

        $this->render('appBundle:admin:membres', [
            'membres' => $membres
        ]);
    }

    /**
     * @RouteName add_membre
     * @RouteUrl /admin/membres/add
     */
    public function addMembreAction(){
        $form = $this->getEntityForm('userBundle:user', Request::all());

        $form->setData('credits', Config::get('app:site_maxCredits'));
        $form->setData('nbJour', Config::get('app:site_maxJours'));

        $this->render('appBundle:includes:form', [
            'pageTitle' => "Ajout d'un nouveau membre",
            'pageDesc' => "",
            'previousUrl' => "list_membres",
            'previousParams' => [],
            'btnText' => "Retour à la liste des membres",
            'form' => $form->render(),
        ]);
    }

    /**
     * @RouteName update_membre
     * @RouteUrl /admin/membres/update/{:id}
     * @RouteParam :id ([0-9]+)
     */
    public function updateMembreAction($params){
        $entity = App::getTable('userBundle:user')->findById($params['id']);

        $form = $this->getEntityForm('appBundle:membre', Request::all());
        $form->inject($entity);

        $this->render('appBundle:includes:form', [
            'pageTitle' => "Modification du membre #" . $entity->getId(),
            'pageDesc' => "",
            'previousUrl' => "list_membres",
            'previousParams' => [],
            'btnText' => "Retour à la liste des membres",
            'form' => $form->render(),
        ]);
    }

    /**
     * @RouteName delete_membre
     * @RouteUrl /admin/membres/delete/{:id}
     * @RouteParam :id ([0-9]+)
     */
    public function deleteMembreAction($params){
        App::getTable('userBundle:user')->remove($params['id']);
        Session::success('Le membre à bien été supprimé !');
        App::redirectToRoute('list_membres');
    }

    /**
     * @RouteName promote_user
     * @RouteUrl /user/promote/{:id}
     * @RouteParam id ([0-9]+)
     */
    public function promoteUserAction($params){
        $manager = App::getTable('userBundle:user');
        $user = $manager->findById($params['id']);

        App::getDb()->query('DELETE FROM equipe_user WHERE user_id = ' . $user->getId(), true);

        $user->setRoles('ROLE_CHEF');
        $manager->save();

        App::redirectToPreviousRoute();
    }

    /**
     * @RouteName demote_user
     * @RouteUrl /user/demote/{:id}
     * @RouteParam id ([0-9]+)
     */
    public function demoteUserAction($params){
        $manager = App::getTable('userBundle:user');
        $user = $manager->findById($params['id']);
        $user->setRoles('ROLE_SALARIE');
        $manager->save();

        App::redirectToPreviousRoute();
    }

}