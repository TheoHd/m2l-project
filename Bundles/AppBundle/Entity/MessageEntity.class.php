<?php

namespace Bundles\AppBundle\Entity;

use Core\Collection\OneToManyCollection;
use Core\Collection\OneToOneCollection;
use \Core\Entity\Entity;

class MessageEntity extends Entity {


    /**
     * @Type identifier
     */
    protected $id;

    /**
     * @Relation OneToOne
     * @Target UserBundle:UserEntity
     */
    protected $receiver;

    /**
     * @Relation OneToOne
     * @Target UserBundle:UserEntity
     */
    protected $send;

    /**
     * @Type text
     */
    protected $message;

    /**
     * @Type datetime
     */
    protected $date;

    public function __construct()
    {
        $this->receiver = new OneToOneCollection('receiver', $this);
        $this->send = new OneToOneCollection('send', $this);
    }

    /*
     * Getters and Setters
     */

    public function getId() { return $this->id; }

    public function getReceiver() { return $this->receiver->get(); }
    public function setReceiver($receiver) { return $this->receiver->set($receiver); }

    public function getSend() { return $this->send->get(); }
    public function setSend($send) { return $this->send->set($send); }

    public function getMessage() { return $this->message; }
    public function setMessage($message) { $this->message = $message; return $this; }

    public function getDate() { return $this->date; }
    public function setDate($date) { $this->date = $date; return $this; }

}