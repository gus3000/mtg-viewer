<?php

namespace App\Entity;

use App\Repository\SetTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SetTypeRepository::class)
 */
class SetType
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30, unique=true)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity=MtgSet::class, mappedBy="setType")
     */
    private $mtgSets;

    public function __construct()
    {
        $this->mtgSets = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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

    /**
     * @return Collection|MtgSet[]
     */
    public function getMtgSets(): Collection
    {
        return $this->mtgSets;
    }

    public function addMtgSet(MtgSet $mtgSet): self
    {
        if (!$this->mtgSets->contains($mtgSet)) {
            $this->mtgSets[] = $mtgSet;
            $mtgSet->setSetType($this);
        }

        return $this;
    }

    public function removeMtgSet(MtgSet $mtgSet): self
    {
        if ($this->mtgSets->contains($mtgSet)) {
            $this->mtgSets->removeElement($mtgSet);
            // set the owning side to null (unless already changed)
            if ($mtgSet->getSetType() === $this) {
                $mtgSet->setSetType(null);
            }
        }

        return $this;
    }
}
