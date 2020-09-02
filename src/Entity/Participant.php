<?php

namespace App\Entity;

use App\Repository\ParticipantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ParticipantRepository::class)
 */
class Participant
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=User::class, inversedBy="participant", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToMany(targetEntity=Conversation::class, inversedBy="participants")
     */
    private $conversation;

    public function __construct()
    {
        $this->conversation = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection|Conversation[]
     */
    public function getConversation(): Collection
    {
        return $this->conversation;
    }

    public function addConversation(Conversation $conversation): self
    {
        if (!$this->conversation->contains($conversation)) {
            $this->conversation[] = $conversation;
        }

        return $this;
    }

    public function removeConversation(Conversation $conversation): self
    {
        if ($this->conversation->contains($conversation)) {
            $this->conversation->removeElement($conversation);
        }

        return $this;
    }
}
