<?php

namespace App\Entity;

use App\Repository\MatchRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    /**
     * @ORM\ManyToOne(targetEntity=MatchType::class, inversedBy="matches")
     * @ORM\JoinColumn(nullable=false)
     */
    private $match_type;

    /**
     * @ORM\ManyToMany(targetEntity=Team::class, mappedBy="play_matches")
     */
    private $teams;

    public function __construct()
    {
        $this->teams = new ArrayCollection();
    }

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

    public function getMatchType(): ?MatchType
    {
        return $this->match_type;
    }

    public function setMatchType(?MatchType $match_type): self
    {
        $this->match_type = $match_type;

        return $this;
    }

    /**
     * @return Collection|Team[]
     */
    public function getTeams(): Collection
    {
        return $this->teams;
    }

    public function addTeam(Team $team): self
    {
        if (!$this->teams->contains($team)) {
            $this->teams[] = $team;
            $team->addPlayMatch($this);
        }

        return $this;
    }

    public function removeTeam(Team $team): self
    {
        if ($this->teams->contains($team)) {
            $this->teams->removeElement($team);
            $team->removePlayMatch($this);
        }

        return $this;
    }
}
