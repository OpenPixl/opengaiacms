<?php

namespace App\Entity\Admin;

use App\Repository\Admin\ConfigRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ConfigRepository::class)]
class Config
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $nameSite = null;

    #[ORM\Column]
    private ?bool $IsOffLine = null;

    #[ORM\Column]
    private ?bool $IsInstalled = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameSite(): ?string
    {
        return $this->nameSite;
    }

    public function setNameSite(string $nameSite): static
    {
        $this->nameSite = $nameSite;

        return $this;
    }

    public function isIsOffLine(): ?bool
    {
        return $this->IsOffLine;
    }

    public function setIsOffLine(bool $IsOffLine): static
    {
        $this->IsOffLine = $IsOffLine;

        return $this;
    }

    public function isIsInstalled(): ?bool
    {
        return $this->IsInstalled;
    }

    public function setIsInstalled(bool $IsInstalled): static
    {
        $this->IsInstalled = $IsInstalled;

        return $this;
    }
}
