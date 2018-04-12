<?php

namespace Bundles\AppBundle\Controller;

use App;
use Core\Controller\Controller;
use Core\Request\Request;

Class AdminController extends Controller {

    /**
     * @RouteName list_cadres
     * @RouteUrl /admin/cadres
     */
    public function showMembreAction(){

        $cadres = App::getTable('userBundle:user')->findBy(['roles' => '{"ROLE_CHEF":"ROLE_CHEF"}']);

        $this->render('appBundle:admin:cadres', [
            'cadres' => $cadres
        ]);
    }
}