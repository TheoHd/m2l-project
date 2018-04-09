<?php

namespace Bundles\AppBundle\Controller;

use App;
use Core\Controller\Controller;
use Core\Request\Request;

Class AdminController extends Controller {

    /**
     * @RouteName gestion_cadres
     * @RouteUrl /admin/cadres
     */
    public function showCadreAction(){
        $this->render('appBundle:admin:cadres');
    }
}