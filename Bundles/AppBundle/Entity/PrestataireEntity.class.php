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
    protected $nom;

    /**
     * @Type string
     * @Length 255
     */
    protected $fonction;

    /**
     * @Relation OneToOne
     * @Target AppBundle:AdressEntity
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

    public function getNom() { return $this->nom; }
    public function setNom($nom) { $this->nom = $nom; return $this; }

    public function getFonction() { return $this->fonction; }
    public function setFonction($fonction) { $this->fonction = $fonction; return $this; }

    public function getAdress() { return $this->adress->get(); }
    public function setAdress($adress) { return $this->adress->set($adress); }

}