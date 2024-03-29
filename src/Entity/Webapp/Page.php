<?php

namespace App\Entity\Webapp;

use App\Repository\Webapp\PageRepository;
use Cocur\Slugify\Slugify;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PageRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Page
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $name = null;

    #[ORM\Column(length: 100)]
    private ?string $slug = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $subtitle = null;

    #[ORM\Column(length: 50)]
    private ?string $state = null;

    #[ORM\Column]
    private ?bool $isMenu = false;

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

    #[ORM\Column(type: 'datetime')]
    private $createdAt;

    #[ORM\Column(type: 'datetime')]
    private $updatedAt;

    #[ORM\Column(length: 255)]
    private ?string $seoTitle = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $seoDescription = null;

    #[ORM\Column(type: Types::ARRAY, nullable: true)]
    private ?array $seoKeywords = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Content $content = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\ManyToOne]
    private ?Content $contentPage = null;

    #[ORM\PrePersist]
    #[ORM\PreUpdate]
    public function initializeSlug() {
        $slugify = new Slugify();
        $this->slug = $slugify->slugify($this->name);
    }

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

    public function isIsMenu(): ?bool
    {
        return $this->isMenu;
    }

    public function setIsMenu(bool $isMenu): static
    {
        $this->isMenu = $isMenu;

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

    public function getSeoTitle(): ?string
    {
        return $this->seoTitle;
    }

    public function setSeoTitle(string $seoTitle): static
    {
        $this->seoTitle = $seoTitle;

        return $this;
    }

    public function getSeoDescription(): ?string
    {
        return $this->seoDescription;
    }

    public function setSeoDescription(?string $seoDescription): static
    {
        $this->seoDescription = $seoDescription;

        return $this;
    }

    public function getSeoKeywords(): ?array
    {
        return $this->seoKeywords;
    }

    public function setSeoKeywords(?array $seoKeywords): static
    {
        $this->seoKeywords = $seoKeywords;

        return $this;
    }

    public function getContent(): ?Content
    {
        return $this->content;
    }

    public function setContent(Content $content): static
    {
        $this->content = $content;

        return $this;
    }
<<<<<<< Updated upstream

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }
<<<<<<<
=======
>>>>>>> Stashed changes
=======

    public function getContentPage(): ?Content
    {
        return $this->contentPage;
    }

    public function setContentPage(?Content $contentPage): static
    {
        $this->contentPage = $contentPage;

        return $this;
    }
>>>>>>>
}
