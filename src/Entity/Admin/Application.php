<?php

namespace App\Entity\Admin;

use App\Repository\Admin\ApplicationRepository;
use Cocur\Slugify\Slugify;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ApplicationRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Application
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $nameSite = null;

    #[ORM\Column(length: 255)]
    private ?string $nameSiteSlug = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $slogan = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $logoFilename = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $logoFilesize = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $logoFileext = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $faviconFilename = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $faviconFilesize = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $faviconFileext = null;

    /**
     * Permet d'initialiser le slug !
     * Utilisation de slugify pour transformer une chaine de caractères en slug
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    #[ORM\PrePersist]
    #[ORM\PreUpdate]
    public function initializeSlug() {
        $slugify = new Slugify();
        $this->nameSiteSlug = $slugify->slugify($this->nameSite);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameSite(): ?string
    {
        return $this->nameSite;
    }

    public function setNameSite(?string $nameSite): static
    {
        $this->nameSite = $nameSite;

        return $this;
    }

    public function getNameSiteSlug(): ?string
    {
        return $this->nameSiteSlug;
    }

    public function setNameSiteSlug(string $nameSiteSlug): static
    {
        $this->nameSiteSlug = $nameSiteSlug;

        return $this;
    }

    public function getSlogan(): ?string
    {
        return $this->slogan;
    }

    public function setSlogan(string $slogan): static
    {
        $this->slogan = $slogan;

        return $this;
    }

    public function getLogoFilename(): ?string
    {
        return $this->logoFilename;
    }

    public function setLogoFilename(?string $logoFilename): static
    {
        $this->logoFilename = $logoFilename;

        return $this;
    }

    public function getLogoFilesize(): ?string
    {
        return $this->logoFilesize;
    }

    public function setLogoFilesize(?string $logoFilesize): static
    {
        $this->logoFilesize = $logoFilesize;

        return $this;
    }

    public function getLogoFileext(): ?string
    {
        return $this->logoFileext;
    }

    public function setLogoFileext(?string $logoFileext): static
    {
        $this->logoFileext = $logoFileext;

        return $this;
    }

    public function getFaviconFilename(): ?string
    {
        return $this->faviconFilename;
    }

    public function setFaviconFilename(?string $faviconFilename): static
    {
        $this->faviconFilename = $faviconFilename;

        return $this;
    }

    public function getFaviconFilesize(): ?string
    {
        return $this->faviconFilesize;
    }

    public function setFaviconFilesize(?string $faviconFilesize): static
    {
        $this->faviconFilesize = $faviconFilesize;

        return $this;
    }

    public function getFaviconFileext(): ?string
    {
        return $this->faviconFileext;
    }

    public function setFaviconFileext(string $faviconFileext): static
    {
        $this->faviconFileext = $faviconFileext;

        return $this;
    }
}
