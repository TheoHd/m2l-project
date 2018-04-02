<?php

namespace Bundles\UserBundle\Controller;

use Core\Controller\Controller;
use Core\Security\Security;

Class UtilsController extends Controller {

    public function changeRole($params){
        $id = $params['id'];
        $role = $params['role'];
    }

    /**
     * @RouteName zsxedcrfv
     * @RouteUrl /ajax
     */
    public function getRoles(){
        $roles = Security::getRoles();
        $roles = array_keys($roles);
        var_dump($roles);
    }

}