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

    private $score;
    private $reds;
    private $yellows;
    private $essais;
    private $transformations;
    private $penalites;
    private $drops;


    public function __construct()
    {
        $this->teams = new ArrayCollection();
        $compo = json_decode("[0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]");
        $this->setComposition($compo);
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

    /**
     * Get the value of score
     */ 
    public function getScore()
    {
        return $this->score;
    }

    /**
     * Set the value of score
     *
     * @return  self
     */ 
    public function setScore($score)
    {
        $this->score = $score;
        $tmpStats = $this->getStats();
        $tmpStats['score'] = $score;
        $this->setStats($tmpStats);
        return $this;
    }

    /**
     * Get the value of reds
     */ 
    public function getReds()
    {
        return $this->reds;
    }

    /**
     * Set the value of reds
     *
     * @return  self
     */ 
    public function setReds($reds)
    {
        $this->reds = $reds;
        $tmpStats = $this->getStats();
        $tmpStats['reds'] = $reds;
        $this->setStats($tmpStats);

        return $this;
    }

    /**
     * Get the value of yellows
     */ 
    public function getYellows()
    {
        return $this->yellows;
    }

    /**
     * Set the value of yellows
     *
     * @return  self
     */ 
    public function setYellows($yellows)
    {
        $this->yellows = $yellows;
        $tmpStats = $this->getStats();
        $tmpStats['yellows'] = $yellows;
        $this->setStats($tmpStats);

        return $this;
    }

    /**
     * Get the value of essais
     */ 
    public function getEssais()
    {
        return $this->essais;
    }

    /**
     * Set the value of essais
     *
     * @return  self
     */ 
    public function setEssais($essais)
    {
        $this->essais = $essais;
        $tmpStats = $this->getStats();
        $tmpStats['essais'] = $essais;
        $this->setStats($tmpStats);

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
        $tmpStats = $this->getStats();
        $tmpStats['transformations'] = $transformations;
        $this->setStats($tmpStats);

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
        $tmpStats = $this->getStats();
        $tmpStats['penalites'] = $penalites;
        $this->setStats($tmpStats);

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
        $tmpStats = $this->getStats();
        $tmpStats['drops'] = $drops;
        $this->setStats($tmpStats);

        return $this;
    }
}
