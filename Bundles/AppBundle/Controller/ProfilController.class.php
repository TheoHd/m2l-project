<?php

namespace Bundles\AppBundle\Controller;

use App;
use Core\Controller\Controller;
use Core\Request\Request;

Class ProfilController extends Controller {

    public function __construct()
    {
        parent::__construct();

        if(!App::getUser()){
            App::redirectToRoute('login');
        }
    }

    /**
     * @RouteName showProfil
     * @RouteUrl /profil
     */
    public function showAction(){
        $manager = App::getTable('userBundle:user');
        $user = $manager->findById(App::getUser()->getId());

        $lastFormations = App::getTable('appBundle:demand')->findBy(['user_id' => $user->getId()], ['date' => 'DESC'], 3);

        if($this->request->is('post')){

            $nom = Request::get('nom', $user->getNom());
            $prenom = Request::get('prenom');
            $birthday = Request::get('birthday', $user->getBirthday());
            $phone = Request::get('phone', $user->getPhone());

            $nom = $nom . " " . $prenom;

            $user->setNom($nom);
            $user->setBirthday($birthday);
            $user->setPhone($phone);

            $manager->save();
        }

        $this->render('appBundle:profil:profil', [
            'user' => $user,
            'lastFormations' => $lastFormations
        ]);
    }

    /**
     * @RouteName showUserProfil
     * @RouteUrl /profil/{:id}
     * @RouteParam id ([0-9]+)
     */
    public function showUserAction($params){
        $user = App::getTable('userBundle:user')->findById($params['id']);

        $this->render('appBundle:profil:profil', [
            'user' => $user
        ]);
    }

    /**
     * @RouteName history
     * @RouteUrl /history
     */
    public function historyAction(){
        $user = App::getUser();

        $demands = App::getTable('appBundle:demand')->findBy(['user_id' => $user->getId()]);

        return $this->render('appBundle:profil:history', [
            'demands' => $demands
        ]);
    }


    public static function getRole($user){
        if($user->hasRole('ROLE_ADMIN')){
            return "Administrateur";
        }else if($user->hasRole('ROLE_CHEF')){
            return 'Chef';
        }else if($user->hasRole('ROLE_SALARIE')){
            return 'Salarié';
        }
    }


}