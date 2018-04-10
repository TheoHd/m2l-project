<?php

namespace Bundles\AppBundle\Entity;

use Core\Collection\OneToManyCollection;
use Core\Collection\OneToOneCollection;
use \Core\Entity\Entity;

class AvisEntity extends Entity {


    /**
     * @Type identifier
     */
    protected $id;

    /**
     * @Relation OneToOne
     * @Target UserBundle:UserEntity
     */
    protected $user;

    /**
     * @Relation OneToOne
     * @Target AppBundle:FormationEntity
     */
    protected $formation;

    /**
     * @Type text
     */
    protected $content;

    /**
     * @Type datetime
     */
    protected $date;

    /**
     * @Type integer
     */
    protected $note;

    public function __construct()
    {
        $this->user = new OneToOneCollection('user', $this);
        $this->formation = new OneToOneCollection('formation', $this);
    }

    /*
     * Getters and Setters
     */

    public function getId() { return $this->id; }

    public function getUser() { return $this->user->get(); }
    public function setUser($user) { return $this->user->set($user); }

    public function getFormation() { return $this->formation->get(); }
    public function setFormation($formation) { return $this->formation->set($formation); }

    public function getContent() { return $this->content; }
    public function setContent($content) { $this->content = $content; return $this; }

    public function getDate() { return $this->date; }
    public function setDate($date) { $this->date = $date; return $this; }

    public function getNote() { return $this->note; }
    public function setNote($note) { $this->note = $note; return $this; }

}