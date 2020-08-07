<?php

namespace App\Entity;

class PlayerStats
{
    // essais transformations penalites drops rouge jaune temps_joué

    private $match_id;

    private $essais;
    private $transformations;
    private $penalites;
    private $drops;
    private $rouge;
    private $jaune;
    private $temps;





    /**
     * Get the value of essais
     */ 
    public function getEssais($match_id)
    {
        return $this->essais;
    }

    /**
     * Set the value of essais
     *
     * @return  self
     */ 
    public function setEssais($match_id, $essais)
    {
        $this->essais = $essais;

        return $this;
    }

    /**
     * Get the value of transformations
     */ 
    public function getTransformations()
    {
        return $this->transformations;
    }

    /**
     * Set the value of transformations
     *
     * @return  self
     */ 
    public function setTransformations($transformations)
    {
        $this->transformations = $transformations;

        return $this;
    }

    /**
     * Get the value of penalites
     */ 
    public function getPenalites()
    {
        return $this->penalites;
    }

    /**
     * Set the value of penalites
     *
     * @return  self
     */ 
    public function setPenalites($penalites)
    {
        $this->penalites = $penalites;

        return $this;
    }

    /**
     * Get the value of drops
     */ 
    public function getDrops()
    {
        return $this->drops;
    }

    /**
     * Set the value of drops
     *
     * @return  self
     */ 
    public function setDrops($drops)
    {
        $this->drops = $drops;

        return $this;
    }

    /**
     * Get the value of rouge
     */ 
    public function getRouge()
    {
        return $this->rouge;
    }

    /**
     * Set the value of rouge
     *
     * @return  self
     */ 
    public function setRouge($rouge)
    {
        $this->rouge = $rouge;

        return $this;
    }

    /**
     * Get the value of jaune
     */ 
    public function getJaune()
    {
        return $this->jaune;
    }

    /**
     * Set the value of jaune
     *
     * @return  self
     */ 
    public function setJaune($jaune)
    {
        $this->jaune = $jaune;

        return $this;
    }

    /**
     * Get the value of temps
     */ 
    public function getTemps()
    {
        return $this->temps;
    }

    /**
     * Set the value of temps
     *
     * @return  self
     */ 
    public function setTemps($temps)
    {
        $this->temps = $temps;

        return $this;
    }
}