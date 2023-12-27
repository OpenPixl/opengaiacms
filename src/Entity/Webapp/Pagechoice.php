<?php

namespace App\Entity\Webapp;

use App\Repository\Webapp\PagechoiceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PagechoiceRepository::class)]
class Pagechoice
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(nullable: true)]
    private ?bool $isActiv = null;

    #[ORM\OneToMany(mappedBy: 'pageChoice', targetEntity: BlockType::class)]
    private Collection $blockTypes;


    public function __construct()
    {
        $this->blockTypes = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function isIsActiv(): ?bool
    {
        return $this->isActiv;
    }

    public function setIsActiv(?bool $isActiv): static
    {
        $this->isActiv = $isActiv;

        return $this;
    }

    /**
     * @return Collection<int, BlockType>
     */
    public function getBlockTypes(): Collection
    {
        return $this->blockTypes;
    }

    public function addBlockType(BlockType $blockType): static
    {
        if (!$this->blockTypes->contains($blockType)) {
            $this->blockTypes->add($blockType);
            $blockType->setPageChoice($this);
        }

        return $this;
    }

    public function removeBlockType(BlockType $blockType): static
    {
        if ($this->blockTypes->removeElement($blockType)) {
            // set the owning side to null (unless already changed)
            if ($blockType->getPageChoice() === $this) {
                $blockType->setPageChoice(null);
            }
        }

        return $this;
    }
}
