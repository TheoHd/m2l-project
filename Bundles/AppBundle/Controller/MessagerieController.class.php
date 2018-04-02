<?php

namespace Bundles\AppBundle\Controller;

use Core\Controller\Controller;

Class MessagerieController extends Controller {

    /**
     * @RouteName messagerie
     * @RouteUrl /messagerie
     */
    public function showAction(){
        $this->render('appBundle:messagerie:home');
    }

}