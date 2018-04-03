<?php

namespace Core\Security;

use App;
use Core\Singleton\Singleton;
use Core\Utils\Utils;

class Security extends Singleton {

    protected $roles;

    public function __construct()
    {
        $file = ROOT . "/Config/Security.xml";
        $content = (array) Utils::XMLToArray($file);
        unset($content['comment']);

        $rolesList = $this->formatRoleArray($content['role']);
        $rolesList = $this->convertRoleArray($rolesList);

        $this->roles = $rolesList;
    }

    protected function formatRoleArray($roles){
        $return = [];
        foreach ($roles as $role){
            list($roleName, $roleTab) = explode(' > ', $role);
            $roleName = trim($roleName);
            $roleTab = trim($roleTab);
            $roleTab = str_replace(['[', ']'], ['', ''], $roleTab);

            $heritRole = explode(',', $roleTab);
            foreach ($heritRole as $k => $v){
                unset($heritRole[$k]);
                $value = trim($v);
                $heritRole[ $value ] = $value;
            }

            $return[ $roleName ] = $heritRole;
        }
        return $return;
    }

    protected function convertRoleArray($rolesList){
        $result = [];
        foreach ($rolesList as $roleName => $roles){
            $result[$roleName] = $this->getChildArray($roles, $rolesList) + [$roleName => $roleName] ;
            asort( $result[$roleName] );
        }
        return $result;
    }

    protected function getChildArray($roles, $rolesList){
        $res = [];
        foreach ($roles as $key => $value){
            if( key_exists($key, $rolesList) ){
                $a = $this->getChildArray($rolesList[$key], $rolesList);
                $res = array_merge($res, $a);
            }
            $res[$key] = $key;
        }
        return $res;
    }

    public static function getChildRoles($roleName){
        $inst = self::getInstance();
        return $inst->roles[$roleName];
    }

    public static function getRoles(){
        $inst = self::getInstance();
        return $inst->roles;
    }

    public static function convertRolesToArray($roles){
        if(empty($roles)){ $roles = json_encode([]); }
        $res = [];
        if( !empty((array) $roles) ){
            $values = json_decode($roles);
            foreach ($values as $v){
                $v = trim($v);
                $res[$v] = $v;
            }
        }
        return $res;
    }

    public static function redirectIfNotGranted($role, $routename, $params = [], $absolutPath = true){
        if( ! self::isGrantedFor($role) ){
            App::redirectToRoute($routename, $params, $absolutPath);
        }
    }

    public static function isGrantedFor($role){
        return App::getUser()->hasRole($role);
    }

    public static function getUser(){
        return App::getAuthentification()->getUser();
    }

    public static function removeRole($userRoles, $roles) {
        if( is_array($roles) ){
            $res = self::convertRolesToArray($userRoles);
            foreach ($roles as $role){
                unset($res[$role]);
            }
        }else{
            $res = self::convertRolesToArray($userRoles);
            unset($res[$roles]);
        }
        return json_encode($res);
    }

    public static function hasRole($userRoles, $role) {
        $rolesList = self::convertRolesToArray($userRoles);
        foreach ($rolesList as $value){
            $childRoles = self::getChildRoles( trim($value) );
            if($childRoles){
                foreach ($childRoles as $childRole){
                    $childRole = trim($childRole);
                    $rolesList[ $childRole ] = $childRole;
                }
            }
        }
        return (isset($rolesList[ $role ]) AND !empty($rolesList[ $role ]));
    }

    public static function addRole($userRoles, $roles) {
        if( is_array($roles) ){
            $res = self::convertRolesToArray($userRoles);
            foreach ($roles as $role){
                $res[$role] = $role;
            }
        }else{
            $res = self::convertRolesToArray($userRoles);
            $res[$roles] = $roles;
        }
        return json_encode($res);
    }

    public static function setRoles($roles) {
        $res = [];
        if(!empty($roles)){
            if( is_array($roles) ){
                foreach ($roles as $role){
                    $res[$role] = $role;
                }
            }else{
                $res[$roles] = $roles;
            }
        }

        return json_encode($res);
    }


}