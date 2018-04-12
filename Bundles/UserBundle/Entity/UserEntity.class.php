<?php

namespace Bundles\UserBundle\Entity;

use App;
use Core\Collection\ArrayCollection;
use Core\Collection\OneToManyCollection;
use Core\Collection\OneToOneCollection;
use Core\Config\Config;
use Core\Email\Email;
use \Core\Entity\Entity;
use Core\Security\Security;

/**
 * @FormBtnLabel Valider
 */
class UserEntity extends Entity {

    /**
     * @Type identifier
     */
    protected $id;

    /**
     * @Type string
     * @Length 255
     * @FormValidation [ isRequired(), rangeLength(2,20) ]
     */
    protected $nom;

    /**
     * @Type string
     * @Length 255
     * @FormType email
     */
    protected $email;

    /**
     * @Type string
     * @Length 255
     * @FormType password
     */
    protected $password;

    /**
     * @Type array
     * @Nullable true
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
     * @FormPlaceholder Numéro de téléphone...
     * @FormValidation (isPhone())
     */
    protected $phone;

    /**
     * @Type integer
     */
    protected $nbJour;

    /**
     * @Type integer
     */
    protected $credits;

    /**
     * @Relation OneToOne
     * @Target AppBundle:AdressEntity
     * @Nullable true
     * @FormRelationType select
     */
    protected $adress;
    /**
     * @Type date
     * @Nullable true
     */
    protected $birthday;

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
    public function setAdress($adress) { $this->adress->set($adress); return $this; }

    public function getBirthday() { return $this->birthday; }
    public function setBirthday($birthday) { $this->birthday = $birthday; }

//    public function addAdress($adress) { return $this->adress->add($adress); }
//    public function removeAdress($adress) { return $this->adress->remove($adress); }
//    public function getAdress() { return $this->adress->instance(); }


    public function getRoles() { return $this->roles; }
    public function addRole($roles) { $this->roles = Security::addRole($this->roles, $roles); }
    public function setRoles($roles) { $this->roles = Security::setRoles($roles); }
    public function removeRole($roles) { $this->roles = Security::removeRole($this->roles, $roles); }
    public function hasRole($role) { return Security::hasRole($this->roles, $role); }

    public function __toString()
    {
        return $this->getNom() . ' <' . $this->getEmail() . '>';
    }

    public function __beforePersist(){
        $this->__plainPassword = $this->password;
        $this->password = sha1($this->password);
        $this->addRole('ROLE_EMPLOYE');
    }

    public function __afterPersist(){
        $email = new Email();
        $email->addAddress($this->getEmail());

        $email->setContent( App::getController()->render('userBundle:emails:register', [
            'nom' => $this->getNom(),
            'email' => $this->getEmail(),
            'password' => $this->__plainPassword
        ], true) );

        $email->setSubject( App::translate('userBundle:email_subject_welcome', [ Config::get('app:email_SiteName') ]));
        $email->send();
    }
}