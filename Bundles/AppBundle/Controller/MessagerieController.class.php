<?php

namespace Bundles\AppBundle\Controller;

use App;
use Core\Controller\Controller;

Class MessagerieController extends Controller {

    public function __construct()
    {
        parent::__construct();

        if(!App::getUser()){
            App::redirectToRoute('login');
        }
    }

    /**
     * @RouteName messagerie
     * @RouteUrl /messagerie
     */
    public function showAction(){
        $this->render('appBundle:messagerie:home');
    }

}