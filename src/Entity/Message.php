<?php

namespace App\Entity;

use App\Repository\MessageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MessageRepository::class)
 */
class Message
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="messages")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=Project::class, inversedBy="messages")
     * @ORM\JoinColumn(nullable=false)
     */
    private $project;

    /**
     * @ORM\ManyToOne(targetEntity=Task::class, inversedBy="messages")
     */
    private $task;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\ManyToOne(targetEntity=Message::class, inversedBy="messages_reply")
     */
    private $message_reply;

    /**
     * @ORM\OneToMany(targetEntity=Message::class, mappedBy="message_reply")
     */
    private $messages_reply;

    public function __construct()
    {
        $this->messages_reply = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getProject(): ?Project
    {
        return $this->project;
    }

    public function setProject(?Project $project): self
    {
        $this->project = $project;

        return $this;
    }

    public function getTask(): ?Task
    {
        return $this->task;
    }

    public function setTask(?Task $task): self
    {
        $this->task = $task;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getMessageReply(): ?self
    {
        return $this->message_reply;
    }

    public function setMessageReply(?self $message_reply): self
    {
        $this->message_reply = $message_reply;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getMessagesReply(): Collection
    {
        return $this->messages_reply;
    }

    public function addMessagesReply(self $messagesReply): self
    {
        if (!$this->messages_reply->contains($messagesReply)) {
            $this->messages_reply[] = $messagesReply;
            $messagesReply->setMessageReply($this);
        }

        return $this;
    }

    public function removeMessagesReply(self $messagesReply): self
    {
        if ($this->messages_reply->contains($messagesReply)) {
            $this->messages_reply->removeElement($messagesReply);
            // set the owning side to null (unless already changed)
            if ($messagesReply->getMessageReply() === $this) {
                $messagesReply->setMessageReply(null);
            }
        }

        return $this;
    }
}
