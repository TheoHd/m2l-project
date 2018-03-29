<?php

namespace Bundles\AppBundle\Entity;

use Core\Collection\OneToManyCollection;
use Core\Collection\OneToOneCollection;
use \Core\Entity\Entity;

class DemandEntity extends Entity {


    /**
     * @Type identifier
     */
    protected $id;

    /**
     * @Relation OneToOne
     * @Target AppBundle:FormationEntity
     */
    protected $formation;

    /**
     * @Relation OneToOne
     * @Target UserBundle:UserEntity
     */
    protected $user;

    /**
     * @Type integer
     * @Default 1
     */
    protected $etat;

    public function __construct()
    {
        $this->formation = new OneToOneCollection('formation', $this);
        $this->user = new OneToOneCollection('user', $this);
    }

    /*
     * Getters and Setters
     */

    public function getId() { return $this->id; }

    public function getFormation() { return $this->formation->get(); }
    public function setFormation($formation) { return $this->formation->set($formation); }

    public function getUser() { return $this->user->get(); }
    public function setUser($user) { return $this->user->set($user); }

    public function getEtat() { return $this->etat; }
    public function setEtat($etat) { $this->etat = $etat; return $this; }

}