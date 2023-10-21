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

    #[ORM\Column]
    private ?bool $IsOffLine = null;

    #[ORM\Column]
    private ?bool $IsInstalled = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $host = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $dbhost = null;

    #[ORM\Column]
    private ?int $step = 0;

    public function getId(): ?int
    {
        return $this->id;
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

   public function getHost(): ?string
    {
        return $this->host;
    }

    public function setHost(?string $host): static
    {
        $this->host = $host;

        return $this;
    }

    public function getDbhost(): ?string
    {
        return $this->dbhost;
    }

    public function setDbhost(?string $dbhost): static
    {
        $this->dbhost = $dbhost;

        return $this;
    }

    public function getStep(): ?int
    {
        return $this->step;
    }

    public function setStep(int $step): static
    {
        $this->step = $step;

        return $this;
    }
}
