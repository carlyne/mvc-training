<?php 

// mode strict
// declare(strict_types=1);

namespace App\Model;

class Animal {
    /**
     * @var int
     */
    private $_id;
    /**
     * @var string
     */
    private  $_species;
    /**
     * @var string
     */
    private  $_country;

    public function __construct(int $id, string $species, string $country) {
        $this->_id = $id;
        $this->_species = $species;
        $this->_country = $country;
    }

    public function getId() : int {
        return $this->_id;
    }

    public function getSpecies() : string {
        return $this->_species;
    }

    public function getCountry() : string {
        return $this->_country;
    }

    public function setId(int $id) : self {
        $this->_id = $id;
        return $this;
    }

    public function setSpecies($species) : self {
        $this->_species = $species;
        return $this;
    }

    public function setCountry($country) : self {
        $this->_country = $country;
        return $this;
    }
}

?>