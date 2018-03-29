<?php

namespace Bundles\AppBundle\Entity;

use Core\Collection\OneToManyCollection;
use Core\Collection\OneToOneCollection;
use \Core\Entity\Entity;

class FormationEntity extends Entity {


    /**
     * @Type identifier
     */
    protected $id;

    /**
     * @Type text
     */
    protected $contenu;

    /**
     * @Type datetime
     */
    protected $deb;

    /**
     * @Type datetime
     */
    protected $fin;

    /**
     * @Relation OneToOne
     * @Target AppBundle:PrestataireEntity
     */
    protected $prestataire;

    /**
     * @Type integer
     */
    protected $prerequis;

    /**
     * @Relation OneToOne
     * @Target AppBundle:AdressEntity
     */
    protected $adress;

    public function __construct()
    {
        $this->prestataire = new OneToOneCollection('prestataire', $this);
        $this->adress = new OneToOneCollection('adress', $this);
    }

    /*
     * Getters and Setters
     */

    public function getId() { return $this->id; }

    public function getContenu() { return $this->contenu; }
    public function setContenu($contenu) { $this->contenu = $contenu; return $this; }

    public function getDeb() { return $this->deb; }
    public function setDeb($deb) { $this->deb = $deb; return $this; }

    public function getFin() { return $this->fin; }
    public function setFin($fin) { $this->fin = $fin; return $this; }

    public function getPrestataire() { return $this->prestataire->get(); }
    public function setPrestataire($prestataire) { return $this->prestataire->set($prestataire); }

    public function getPrerequis() { return $this->prerequis; }
    public function setPrerequis($prerequis) { $this->prerequis = $prerequis; return $this; }

    public function getAdress() { return $this->adress->get(); }
    public function setAdress($adress) { return $this->adress->set($adress); }

}