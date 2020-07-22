<?php

namespace App\Entity;

use App\Repository\PlayerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PlayerRepository::class)
 */
class Player
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lest_name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $first_name;

    /**
     * @ORM\Column(type="string", length=500, nullable=true)
     */
    private $picture;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $birth_date;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $club_entry_date;

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $stats = [];

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $license_number;

    /**
     * @ORM\ManyToMany(targetEntity=Team::class, inversedBy="players")
     */
    private $play_in;

    /**
     * @ORM\ManyToMany(targetEntity=Post::class, inversedBy="players")
     */
    private $is_post;

    public function __construct()
    {
        $this->play_in = new ArrayCollection();
        $this->is_post = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLestName(): ?string
    {
        return $this->lest_name;
    }

    public function setLestName(string $lest_name): self
    {
        $this->lest_name = $lest_name;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function setFirstName(string $first_name): self
    {
        $this->first_name = $first_name;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function getBirthDate(): ?\DateTimeInterface
    {
        return $this->birth_date;
    }

    public function setBirthDate(?\DateTimeInterface $birth_date): self
    {
        $this->birth_date = $birth_date;

        return $this;
    }

    public function getClubEntryDate(): ?\DateTimeInterface
    {
        return $this->club_entry_date;
    }

    public function setClubEntryDate(?\DateTimeInterface $club_entry_date): self
    {
        $this->club_entry_date = $club_entry_date;

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

    public function getLicenseNumber(): ?int
    {
        return $this->license_number;
    }

    public function setLicenseNumber(?int $license_number): self
    {
        $this->license_number = $license_number;

        return $this;
    }

    /**
     * @return Collection|Team[]
     */
    public function getPlayIn(): Collection
    {
        return $this->play_in;
    }

    public function addPlayIn(Team $playIn): self
    {
        if (!$this->play_in->contains($playIn)) {
            $this->play_in[] = $playIn;
        }

        return $this;
    }

    public function removePlayIn(Team $playIn): self
    {
        if ($this->play_in->contains($playIn)) {
            $this->play_in->removeElement($playIn);
        }

        return $this;
    }

    /**
     * @return Collection|Post[]
     */
    public function getIsPost(): Collection
    {
        return $this->is_post;
    }

    public function addIsPost(Post $isPost): self
    {
        if (!$this->is_post->contains($isPost)) {
            $this->is_post[] = $isPost;
        }

        return $this;
    }

    public function removeIsPost(Post $isPost): self
    {
        if ($this->is_post->contains($isPost)) {
            $this->is_post->removeElement($isPost);
        }

        return $this;
    }
}
