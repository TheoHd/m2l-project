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
     * @Type string
     * @Length 255
     */
    protected $nom;

    /**
     * @Type text
     */
    protected $contenu;

    /**
     * @Type datetime
     */
    protected $deb;

    /**
     * @Type integer
     */
    protected $duree;

    /**
     * @Relation OneToOne
     * @Target AppBundle:PrestataireEntity
     */
    protected $prestataire;

    /**
     * @Type integer
     * @FormLabel credits
     */
    protected $prerequis;

    /**
     * @Relation OneToOne
     * @Target AppBundle:AdressEntity
     * @FormRelationType create
     */
    protected $adress;

    /**
     * @Type string
     * @Length 255
     * @Default 1
     */
    protected $statut;

    public function __construct()
    {
        $this->prestataire = new OneToOneCollection('prestataire', $this);
        $this->adress = new OneToOneCollection('adress', $this);
    }

    /*
     * Getters and Setters
     */

    public function getNom() { return $this->nom; }
    public function setNom($nom) { $this->nom = $nom; return $this; }

    public function getContenu() { return $this->contenu; }
    public function setContenu($contenu) { $this->contenu = $contenu; return $this; }

    public function getDeb() { return $this->deb; }
    public function setDeb($deb) { $this->deb = $deb; return $this; }

    public function getDuree() { return $this->duree; }
    public function setDuree($duree) { $this->duree = $duree; return $this; }

    public function getPrestataire() { return $this->prestataire->get(); }
    public function setPrestataire($prestataire) { return $this->prestataire->set($prestataire); }

    public function getPrerequis() { return $this->prerequis; }
    public function setPrerequis($prerequis) { $this->prerequis = $prerequis; return $this; }

    public function getAdress() { return $this->adress->get(); }
    public function setAdress($adress) { return $this->adress->set($adress); }

    public function getStatut(){ return $this->statut; }
    public function setStatut($statut){ $this->statut = $statut;}

    public function __toString()
    {
        return $this->getNom();
    }
}