<?php

namespace Bundles\AppBundle\Entity;

use Core\Collection\OneToManyCollection;
use Core\Collection\OneToOneCollection;
use \Core\Entity\Entity;

class PrestataireEntity extends Entity {


    /**
     * @Type identifier
     */
    protected $id;

    /**
     * @Type string
     * @Length 255
     */
    protected $entrepriseName;

    /**
     * @Type string
     * @Length 255
     */
    protected $contactName;

    /**
     * @Type string
     * @Length 255
     * @FormType email
     */
    protected $contactEmail;

    /**
     * @Type string
     * @Length 255
     * @FormType phone
     */
    protected $contactPhone;

    /**
     * @Relation OneToOne
     * @Target AppBundle:AdressEntity
     * @FormRelationType create
     */
    protected $adress;

    public function __construct()
    {
        $this->adress = new OneToOneCollection('adress', $this);
    }

    /*
     * Getters and Setters
     */

    public function getEntrepriseName() { return $this->entrepriseName;}
    public function setEntrepriseName($entrepriseName) { $this->entrepriseName = $entrepriseName;}

    public function getContactName() { return $this->contactName;}
    public function setContactName($contactName) { $this->contactName = $contactName;}

    public function getContactEmail() { return $this->contactEmail;}
    public function setContactEmail($contactEmail) { $this->contactEmail = $contactEmail;}

    public function getContactPhone() { return $this->contactPhone;}
    public function setContactPhone($contactPhone) { $this->contactPhone = $contactPhone;}

    public function getAdress() { return $this->adress->get(); }
    public function setAdress($adress) { return $this->adress->set($adress); }

    public function __toString()
    {
        return $this->getEntrepriseName() . ' - ' . $this->getAdress();
    }

}