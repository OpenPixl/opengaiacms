<?php

namespace App\Entity\Webapp;

use App\Repository\Webapp\PageRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PageRepository::class)]
class Page
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $name = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $slug = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $subtitle = null;

    #[ORM\Column(length: 50)]
    private ?string $state = null;

    #[ORM\Column]
    private ?bool $isPublish = null;

    #[ORM\Column]
    private ?bool $isShowTitle = null;

    #[ORM\Column]
    private ?bool $IsShowDate = null;

    #[ORM\Column]
    private ?bool $IsShowDescription = null;

    #[ORM\ManyToOne(targetEntity: self::class)]
    private ?self $parent = null;

    #[ORM\Column(length: 25, nullable: true)]
    private ?string $cssId = null;

    #[ORM\Column(length: 25, nullable: true)]
    private ?string $cssName = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $cssStyle = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(?string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }

    public function getSubtitle(): ?string
    {
        return $this->subtitle;
    }

    public function setSubtitle(?string $subtitle): static
    {
        $this->subtitle = $subtitle;

        return $this;
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function setState(string $state): static
    {
        $this->state = $state;

        return $this;
    }

    public function isIsPublish(): ?bool
    {
        return $this->isPublish;
    }

    public function setIsPublish(bool $isPublish): static
    {
        $this->isPublish = $isPublish;

        return $this;
    }

    public function isIsShowTitle(): ?bool
    {
        return $this->isShowTitle;
    }

    public function setIsShowTitle(bool $isShowTitle): static
    {
        $this->isShowTitle = $isShowTitle;

        return $this;
    }

    public function isIsShowDate(): ?bool
    {
        return $this->IsShowDate;
    }

    public function setIsShowDate(bool $IsShowDate): static
    {
        $this->IsShowDate = $IsShowDate;

        return $this;
    }

    public function isIsShowDescription(): ?bool
    {
        return $this->IsShowDescription;
    }

    public function setIsShowDescription(bool $IsShowDescription): static
    {
        $this->IsShowDescription = $IsShowDescription;

        return $this;
    }

    public function getParent(): ?self
    {
        return $this->parent;
    }

    public function setParent(?self $parent): static
    {
        $this->parent = $parent;

        return $this;
    }

    public function getCssId(): ?string
    {
        return $this->cssId;
    }

    public function setCssId(?string $cssId): static
    {
        $this->cssId = $cssId;

        return $this;
    }

    public function getCssName(): ?string
    {
        return $this->cssName;
    }

    public function setCssName(?string $cssName): static
    {
        $this->cssName = $cssName;

        return $this;
    }

    public function getCssStyle(): ?string
    {
        return $this->cssStyle;
    }

    public function setCssStyle(?string $cssStyle): static
    {
        $this->cssStyle = $cssStyle;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
