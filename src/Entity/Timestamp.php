<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\PrePersist;


trait Timestamp
{
    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @return mixed
     */

     public function getCreatedAT()
     {
         return $this->createdAT;
     }

     /**
      * @ORM\PrePersist()
      */
     public function prePersist()
     {
         $this->createdAt = new \DateTime();
     }
}