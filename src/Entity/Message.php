<?php

namespace App\Entity;

use Doctrine\ORM\Mapping\Index;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\MessageRepository;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;

/**
 * @ORM\Entity(repositoryClass=MessageRepository::class)
 * @ORM\Table(indexes={@Index(name="created_at_index", columns={"created_at"})})
 * @ORM\HasLifecycleCallbacks()
 */
class Message
{
    use Timestamp;
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Conversation::class, inversedBy="message")
     * @ORM\JoinColumn(nullable=false)
     */
    private $conversation;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="messages")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    // /**
    //  * @ORM\Column(type="text")
    //  */
    // private $content;

    // /**
    //  * @ORM\ManyToOne(targetEntity="User", inversedBy="messages")
    //  */
    // private $user;

    // /**
    //  * @ORM\ManyToOne(targetEntity="Conversation", inversedBy="messages")
    //  */
    // private $conversation;

    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getConversation(): ?Conversation
    {
        return $this->conversation;
    }

    public function setConversation(?Conversation $conversation): self
    {
        $this->conversation = $conversation;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }
}
