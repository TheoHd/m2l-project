<?php

namespace Bundles\UserBundle\Entity;

use Core\Collection\ArrayCollection;
use Core\Collection\OneToManyCollection;
use Core\Collection\OneToOneCollection;
use \Core\Entity\Entity;
use Core\Security\Security;

/**
 * @FormSubmitLabel Créer
 */
class UserEntity extends Entity {

    /**
     * @Type identifier
     */
    protected $id;

    /**
     * @Type string
     * @Length 255
     */
    protected $nom;

    /**
     * @Type string
     * @Length 255
     */
    protected $email;

    /**
     * @Type string
     * @Length 255
     */
    protected $password;

    /**
     * @Type array
     * @Default {"ROLE_EMPLOYE"}
     * @FormLabel Roles :
     */
    protected $roles;

    /**
     * @Type datetime
     * @Nullable true
     */
    protected $validationDate;

    /**
     * @Type string
     * @Length 255
     * @Nullable true
     * @FormPlaceholder Numéro de téléphone...
     */
    protected $phone;

    /**
     * @Type integer
     * @Nullable true
     */
    protected $nbJour;

    /**
     * @Type integer
     * @Nullable true
     */
    protected $credits;

    /**
     * @Relation OneToOne
     * @Target AppBundle:AdressEntity
     * @Nullable true
     * @FormRelationMethod create
     */
    protected $adress;

    public function __construct()
    {
        $this->adress = new OneToOneCollection('adress', $this);
    }



    /*
     * Getters and Setters
     */

    public function getId() { return $this->id; }
    public function setId($id) { $this->id = $id; return $this; }

    public function getNom() { return $this->nom; }
    public function setNom($nom) { $this->nom = $nom; return $this; }

    public function getEmail() { return $this->email; }
    public function setEmail($email) { $this->email = $email; return $this; }

    public function getPassword() { return $this->password; }
    public function setPassword($password) { $this->password = $password; return $this; }
    public function setPlainPassword($password) { $this->password = sha1($password); return $this; }

    public function getValidationDate() { return $this->validationDate; }
    public function setValidationDate($validationDate) { $this->validationDate = $validationDate; return $this; }

    public function getPhone() { return $this->phone; }
    public function setPhone($phone) { $this->phone = $phone; return $this; }

    public function getNbJour() { return $this->nbJour; }
    public function setNbJour($nbJour) { $this->nbJour = $nbJour; return $this; }

    public function getCredits() { return $this->credits; }
    public function setCredits($credits) { $this->credits = $credits; return $this; }

    public function getAdress() { return $this->adress->get(); }
    public function setAdress($adress) { return $this->adress->set($adress); }


    public function getRoles() {
        return $this->roles;
    }

    public function addRole($roles) {
        if( is_array($roles) ){
            $res = Security::convertRolesToArray($this->roles);
            foreach ($roles as $role){
                $res[$role] = $role;
            }
        }else{
            $res = Security::convertRolesToArray($this->roles);
            $res[$roles] = $roles;
        }

        $this->roles = '{ ' . implode(', ', $res) . ' }';
        return $this;
    }

    public function removeRole($roles) {
        if( is_array($roles) ){
            $res = Security::convertRolesToArray($this->roles);
            foreach ($roles as $role){
                unset($res[$role]);
            }
        }else{
            $res = Security::convertRolesToArray($this->roles);
            unset($res[$roles]);
        }
        $this->roles = '{ ' . implode(', ', $res) . ' }';
        return $this;
    }

    public function hasRole($role) {
        $rolesList = Security::convertRolesToArray($this->roles);
        foreach ($rolesList as $value){
            $childRoles = Security::getInstance()->getChildRoles( trim($value) );
            if($childRoles){
                foreach ($childRoles as $childRole){
                    $childRole = trim($childRole);
                    $rolesList[ $childRole ] = $childRole;
                }
            }
        }
        return (isset($rolesList[ $role ]) AND !empty($rolesList[ $role ]));
    }

    public function __toString()
    {
        return $this->getNom() . ' <' . $this->getEmail() . '>';
    }
}