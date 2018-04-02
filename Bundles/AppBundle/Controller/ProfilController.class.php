<?php

namespace Bundles\AppBundle\Controller;

use Core\Controller\Controller;

Class ProfilController extends Controller {

    /**
     * @RouteName showProfil
     * @RouteUrl /profil
     */
    public function showAction(){
        $this->render('appBundle:profil:profil');
    }

    /**
     * @RouteName history
     * @RouteUrl /history
     */
    public function historyAction(){
        return $this->render('appBundle:profil:history');
    }


}