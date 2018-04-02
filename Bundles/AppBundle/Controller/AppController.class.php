<?php

namespace Bundles\AppBundle\Controller;

use Core\Controller\Controller;

Class AppController extends Controller {

    public function indexAction(){
        return $this->render('appBundle:pages:home');
    }

    /**
     * @RouteName contact
     * @RouteUrl /contact
     */
    public function contactAction(){
        return $this->render('appBundle:pages:contact');
    }
}