<?php

namespace App\Entity\Admin;

use App\Repository\Admin\UnderConstructionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UnderConstructionRepository::class)]
#[ORM\HasLifecycleCallbacks]
class UnderConstruction
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 150)]
    private ?string $title1 = null;

    #[ORM\Column(length: 150)]
    private ?string $title2 = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $content = null;

    #[ORM\Column(length: 15)]
    private ?string $contactPhone = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $contactMail = null;

    #[ORM\Column(length: 80, nullable: true)]
    private ?string $contactFb = null;

    #[ORM\Column(length: 80, nullable: true)]
    private ?string $contactInst = null;

    #[ORM\Column(length: 80, nullable: true)]
    private ?string $contactMasto = null;

    #[ORM\Column(length: 80, nullable: true)]
    private ?string $contactXtweet = null;

    #[ORM\Column(type: 'datetime')]
    private $createdAt;

    #[ORM\Column(type: 'datetime')]
    private $updatedAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle1(): ?string
    {
        return $this->title1;
    }

    public function setTitle1(string $title1): static
    {
        $this->title1 = $title1;

        return $this;
    }

    public function getTitle2(): ?string
    {
        return $this->title2;
    }

    public function setTitle2(string $title2): static
    {
        $this->title2 = $title2;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): static
    {
        $this->content = $content;

        return $this;
    }

    public function getContactPhone(): ?string
    {
        return $this->contactPhone;
    }

    public function setContactPhone(string $contactPhone): static
    {
        $this->contactPhone = $contactPhone;

        return $this;
    }

    public function getContactMail(): ?string
    {
        return $this->contactMail;
    }

    public function setContactMail(?string $contactMail): static
    {
        $this->contactMail = $contactMail;

        return $this;
    }

    public function getContactFb(): ?string
    {
        return $this->contactFb;
    }

    public function setContactFb(?string $contactFb): static
    {
        $this->contactFb = $contactFb;

        return $this;
    }

    public function getContactInst(): ?string
    {
        return $this->contactInst;
    }

    public function setContactInst(?string $contactInst): static
    {
        $this->contactInst = $contactInst;

        return $this;
    }

    public function getContactMasto(): ?string
    {
        return $this->contactMasto;
    }

    public function setContactMasto(?string $contactMasto): static
    {
        $this->contactMasto = $contactMasto;

        return $this;
    }

    public function getContactXtweet(): ?string
    {
        return $this->contactXtweet;
    }

    public function setContactXtweet(?string $contactXtweet): static
    {
        $this->contactXtweet = $contactXtweet;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    #[ORM\PrePersist]
    public function setCreatedAt(): self
    {
        $this->createdAt = new \DateTime('now');

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    #[ORM\PrePersist]
    #[ORM\PreUpdate]
    public function setUpdatedAt(): self
    {
        $this->updatedAt = new \DateTime('now');

        return $this;
    }
}
