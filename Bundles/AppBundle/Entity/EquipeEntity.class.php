<?php

namespace Bundles\AppBundle\Entity;

use Core\Collection\OneToManyCollection;
use Core\Collection\OneToOneCollection;
use \Core\Entity\Entity;

class EquipeEntity extends Entity {


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
     * @Relation OneToOne
     * @Target UserBundle:UserEntity
     */
    protected $chef;

    /**
     * @Relation OneToMany
     * @Target UserBundle:UserEntity
     */
    protected $employe;

    public function __construct()
    {
        $this->employe = new OneToManyCollection('employe', $this);
        $this->chef = new OneToOneCollection('chef', $this);
    }

    /*
     * Getters and Setters
     */

    public function getId() { return $this->id; }

    public function addEmploye($employe) { return $this->employe->add($employe); }
    public function removeEmploye($employe) { return $this->employe->remove($employe); }
    public function getEmploye() { return $this->employe->instance(); }

    public function getNom() { return $this->nom; }
    public function setNom($nom) { $this->nom = $nom; return $this; }

    public function getChef() { return $this->chef->get(); }
    public function setChef($chef) { return $this->chef->set($chef); }

}