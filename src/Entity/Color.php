<?php

namespace App\Entity;

use App\Repository\ColorRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ColorRepository::class)
 */
class Color
{
    public const NAMES = [
        "W" => "White",
        "U" => "Blue",
        "B" => "Black",
        "G" => "Green",
        "R" => "Red"
    ];
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=1, unique=true)
     */
    private $abbr;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $name;

    /**
     * Color constructor.
     * @param int|null $id
     * @param string|null $abbr
     * @param string|null $name
     */
    public function __construct(int $id = null, string $abbr = null, string $name = null)
    {
        $this->id = $id;
        $this->abbr = $abbr;
        $this->name = $name;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAbbr(): ?string
    {
        return $this->abbr;
    }

    public function setAbbr(string $abbr): self
    {
        $this->abbr = $abbr;

        return $this;
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

    public function __toString()
    {
        return "[id : {$this->getId()}, abbr : {$this->getAbbr()}, name : {$this->getName()}";
    }

}
