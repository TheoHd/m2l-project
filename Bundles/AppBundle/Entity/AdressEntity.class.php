<?php

namespace Bundles\AppBundle\Entity;

use Core\Collection\OneToManyCollection;
use Core\Collection\OneToOneCollection;
use \Core\Entity\Entity;

class AdressEntity extends Entity {


    /**
     * @Type identifier
     */
    protected $id;

    /**
     * @Type string
     * @Length 255
     * @FormValidation ( rangeLength(1,10) )
     */
    protected $num;

    /**
     * @Type string
     * @Length 255
     */
    protected $rue;

    /**
     * @Type string
     * @Length 255
     * @FormPlaceholder Code postal :
     */
    protected $postalCode;

    /**
     * @Type string
     * @Length 255
     */
    protected $city;

    /*
     * Getters and Setters
     */

    public function getId() { return $this->id; }

    public function getNum() { return $this->num; }
    public function setNum($num) { $this->num = $num; return $this; }

    public function getRue() { return $this->rue; }
    public function setRue($rue) { $this->rue = $rue; return $this; }

    public function getPostalcode() { return $this->postalCode; }
    public function setPostalcode($postalCode) { $this->postalCode = $postalCode; return $this; }

    public function getCity() { return $this->city; }
    public function setCity($city) { $this->city = $city; return $this; }

    public function __toString()
    {
        return $this->getNum() . ' ' . $this->getRue() . ' ' . $this->getPostalcode() . ', ' . $this->getCity();
    }

}