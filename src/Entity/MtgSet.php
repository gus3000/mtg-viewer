<?php

namespace App\Entity;

use App\Repository\MtgSetRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MtgSetRepository::class)
 */
class MtgSet
{


    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="guid", unique=true)
     */
    private $scryfallId;

    /**
     * @ORM\Column(type="string", length=6, unique=true)
     */
    private $code;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $mtgo_code;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $tcgplayer_id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity=SetType::class, inversedBy="mtgSets")
     * @ORM\JoinColumn(nullable=false)
     */
    private $setType;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $releasedAt;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $blockCode;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $block;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $parentSetCode;

    /**
     * @ORM\Column(type="integer")
     */
    private $cardCount;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $printedSize;

    /**
     * @ORM\Column(type="boolean")
     */
    private $digital;

    /**
     * @ORM\Column(type="boolean")
     */
    private $foilOnly;

    /**
     * @ORM\Column(type="boolean")
     */
    private $nonfoilOnly;

    /**
     * @ORM\Column(type="string", length=1023)
     */
    private $scryfallUri;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $uri;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $iconSvgUri;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $searchUri;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getScryfallId(): ?string
    {
        return $this->scryfallId;
    }

    public function setScryfallId(string $scryfallId): self
    {
        $this->scryfallId = $scryfallId;

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getMtgoCode(): ?string
    {
        return $this->mtgo_code;
    }

    public function setMtgoCode(?string $mtgo_code): self
    {
        $this->mtgo_code = $mtgo_code;

        return $this;
    }

    public function getTcgplayerId(): ?int
    {
        return $this->tcgplayer_id;
    }

    public function setTcgplayerId(?int $tcgplayer_id): self
    {
        $this->tcgplayer_id = $tcgplayer_id;

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

    public function getSetType(): ?SetType
    {
        return $this->setType;
    }

    public function setSetType(?SetType $setType): self
    {
        $this->setType = $setType;

        return $this;
    }

    public function getReleasedAt(): ?\DateTimeInterface
    {
        return $this->releasedAt;
    }

    public function setReleasedAt(?\DateTimeInterface $releasedAt): self
    {
        $this->releasedAt = $releasedAt;

        return $this;
    }

    public function getBlockCode(): ?string
    {
        return $this->blockCode;
    }

    public function setBlockCode(?string $blockCode): self
    {
        $this->blockCode = $blockCode;

        return $this;
    }

    public function getBlock(): ?string
    {
        return $this->block;
    }

    public function setBlock(?string $block): self
    {
        $this->block = $block;

        return $this;
    }

    public function getParentSetCode(): ?string
    {
        return $this->parentSetCode;
    }

    public function setParentSetCode(?string $parentSetCode): self
    {
        $this->parentSetCode = $parentSetCode;

        return $this;
    }

    public function getCardCount(): ?int
    {
        return $this->cardCount;
    }

    public function setCardCount(int $cardCount): self
    {
        $this->cardCount = $cardCount;

        return $this;
    }

    public function getPrintedSize(): ?int
    {
        return $this->printedSize;
    }

    public function setPrintedSize(?int $printedSize): self
    {
        $this->printedSize = $printedSize;

        return $this;
    }

    public function getDigital(): ?bool
    {
        return $this->digital;
    }

    public function setDigital(bool $digital): self
    {
        $this->digital = $digital;

        return $this;
    }

    public function getFoilOnly(): ?bool
    {
        return $this->foilOnly;
    }

    public function setFoilOnly(bool $foilOnly): self
    {
        $this->foilOnly = $foilOnly;

        return $this;
    }

    public function getNonfoilOnly(): ?bool
    {
        return $this->nonfoilOnly;
    }

    public function setNonfoilOnly(bool $nonfoilOnly): self
    {
        $this->nonfoilOnly = $nonfoilOnly;

        return $this;
    }

    public function getScryfallUri(): ?string
    {
        return $this->scryfallUri;
    }

    public function setScryfallUri(string $scryfallUri): self
    {
        $this->scryfallUri = $scryfallUri;

        return $this;
    }

    public function getUri(): ?string
    {
        return $this->uri;
    }

    public function setUri(string $uri): self
    {
        $this->uri = $uri;

        return $this;
    }

    public function getIconSvgUri(): ?string
    {
        return $this->iconSvgUri;
    }

    public function setIconSvgUri(string $iconSvgUri): self
    {
        $this->iconSvgUri = $iconSvgUri;

        return $this;
    }

    public function getSearchUri(): ?string
    {
        return $this->searchUri;
    }

    public function setSearchUri(string $searchUri): self
    {
        $this->searchUri = $searchUri;

        return $this;
    }
}
