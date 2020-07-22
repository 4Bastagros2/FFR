<?php

namespace App\Entity;

use App\Repository\MatchRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MatchRepository::class)
 * @ORM\Table(name="`match`")
 */
class Match
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $duration;

    /**
     * @ORM\Column(type="string", length=500, nullable=true)
     */
    private $local_team;

    /**
     * @ORM\Column(type="string", length=500, nullable=true)
     */
    private $visitor_team;

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $stats = [];

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $composition = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getDuration(): ?\DateTimeInterface
    {
        return $this->duration;
    }

    public function setDuration(?\DateTimeInterface $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function getLocalTeam(): ?string
    {
        return $this->local_team;
    }

    public function setLocalTeam(?string $local_team): self
    {
        $this->local_team = $local_team;

        return $this;
    }

    public function getVisitorTeam(): ?string
    {
        return $this->visitor_team;
    }

    public function setVisitorTeam(?string $visitor_team): self
    {
        $this->visitor_team = $visitor_team;

        return $this;
    }

    public function getStats(): ?array
    {
        return $this->stats;
    }

    public function setStats(?array $stats): self
    {
        $this->stats = $stats;

        return $this;
    }

    public function getComposition(): ?array
    {
        return $this->composition;
    }

    public function setComposition(?array $composition): self
    {
        $this->composition = $composition;

        return $this;
    }
}
