<?php

namespace App\Entity;

use App\Repository\ImageUrisRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ImageUrisRepository::class)
 */
class ImageUris
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $small;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $normal;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $large;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $png;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $artCrop;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $borderCrop;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSmall(): ?string
    {
        return $this->small;
    }

    public function setSmall(string $small): self
    {
        $this->small = $small;

        return $this;
    }

    public function getNormal(): ?string
    {
        return $this->normal;
    }

    public function setNormal(string $normal): self
    {
        $this->normal = $normal;

        return $this;
    }

    public function getLarge(): ?string
    {
        return $this->large;
    }

    public function setLarge(string $large): self
    {
        $this->large = $large;

        return $this;
    }

    public function getPng(): ?string
    {
        return $this->png;
    }

    public function setPng(string $png): self
    {
        $this->png = $png;

        return $this;
    }

    public function getArtCrop(): ?string
    {
        return $this->artCrop;
    }

    public function setArtCrop(string $artCrop): self
    {
        $this->artCrop = $artCrop;

        return $this;
    }

    public function getBorderCrop(): ?string
    {
        return $this->borderCrop;
    }

    public function setBorderCrop(string $borderCrop): self
    {
        $this->borderCrop = $borderCrop;

        return $this;
    }
}
