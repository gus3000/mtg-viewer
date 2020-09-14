<?php

namespace App\Entity;

use App\Repository\CardRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Annotation\SerializedName;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CardRepository::class)
 */
class Card
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="guid", unique=true)
     * @SerializedName("id")
     */
    private $scryfallId;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lang;

    /**
     * @ORM\Column(type="guid")
     */
    private $oracleId;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $printsSearchUri;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $rulingsUri;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $scryfallUri;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $uri;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $cmc;

    /**
     * @ORM\ManyToMany(targetEntity=Color::class)
     */
    private $colorIdentity;

    /**
     * @ORM\Column(type="simple_array", nullable=true)
     */
    private $keywords = [];

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $layout;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $loyalty;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $manaCost;

    /**
     * @ORM\Column(type="string", length=1023, nullable=true)
     */
    private $oracleText;

    /**
     * @ORM\Column(type="boolean")
     */
    private $reserved;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $artist;

    /**
     * @ORM\Column(type="boolean")
     */
    private $booster;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $border_color;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $collector_number;

    /**
     * @ORM\Column(type="boolean")
     */
    private $highresImage;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $rarity;

    /**
     * @ORM\Column(type="date")
     */
    private $releasedAt;

    /**
     * @ORM\Column(type="boolean")
     */
    private $reprint;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $scryfallSet;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $arena_id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $mtgo_id;

    /**
     * @ORM\Column(type="simple_array", nullable=true)
     */
    private $multiverse_ids = [];

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $tcgplayer_id;

    /**
     * @ORM\OneToMany(targetEntity=RelatedCard::class, mappedBy="card", orphanRemoval=true, cascade={"persist"})
     */
    private $allParts;

    public function __construct()
    {
        $this->colorIdentity = new ArrayCollection();
        $this->allParts = new ArrayCollection();
    }

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

    public function getLang(): ?string
    {
        return $this->lang;
    }

    public function setLang(string $lang): self
    {
        $this->lang = $lang;

        return $this;
    }

    public function getOracleId(): ?string
    {
        return $this->oracleId;
    }

    public function setOracleId(string $oracleId): self
    {
        $this->oracleId = $oracleId;

        return $this;
    }

    public function getPrintsSearchUri(): ?string
    {
        return $this->printsSearchUri;
    }

    public function setPrintsSearchUri(string $printsSearchUri): self
    {
        $this->printsSearchUri = $printsSearchUri;

        return $this;
    }

    public function getRulingsUri(): ?string
    {
        return $this->rulingsUri;
    }

    public function setRulingsUri(string $rulingsUri): self
    {
        $this->rulingsUri = $rulingsUri;

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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCmc(): ?int
    {
        return $this->cmc;
    }

    public function setCmc(?int $cmc): self
    {
        $this->cmc = $cmc;

        return $this;
    }

    /**
     * @return Collection|Color[]
     */
    public function getColorIdentity(): Collection
    {
        return $this->colorIdentity;
    }

    public function addColorIdentity(Color $colorIdentity): self
    {
        if (!$this->colorIdentity->contains($colorIdentity)) {
            $this->colorIdentity[] = $colorIdentity;
        }

        return $this;
    }

    public function removeColorIdentity(Color $colorIdentity): self
    {
        if ($this->colorIdentity->contains($colorIdentity)) {
            $this->colorIdentity->removeElement($colorIdentity);
        }

        return $this;
    }

    public function getKeywords(): ?array
    {
        return $this->keywords;
    }

    public function setKeywords(array $keywords): self
    {
        $this->keywords = $keywords;

        return $this;
    }

    public function getLayout(): ?string
    {
        return $this->layout;
    }

    public function setLayout(string $layout): self
    {
        $this->layout = $layout;

        return $this;
    }

    public function getLoyalty(): ?int
    {
        return $this->loyalty;
    }

    public function setLoyalty(?int $loyalty): self
    {
        $this->loyalty = $loyalty;

        return $this;
    }

    public function getManaCost(): ?string
    {
        return $this->manaCost;
    }

    public function setManaCost(?string $manaCost): self
    {
        $this->manaCost = $manaCost;

        return $this;
    }

    public function getOracleText(): ?string
    {
        return $this->oracleText;
    }

    public function setOracleText(?string $oracleText): self
    {
        $this->oracleText = $oracleText;

        return $this;
    }

    public function getReserved(): ?bool
    {
        return $this->reserved;
    }

    public function setReserved(bool $reserved): self
    {
        $this->reserved = $reserved;

        return $this;
    }

    public function getArtist(): ?string
    {
        return $this->artist;
    }

    public function setArtist(?string $artist): self
    {
        $this->artist = $artist;

        return $this;
    }

    public function getBooster(): ?bool
    {
        return $this->booster;
    }

    public function setBooster(bool $booster): self
    {
        $this->booster = $booster;

        return $this;
    }

    public function getBorderColor(): ?string
    {
        return $this->border_color;
    }

    public function setBorderColor(string $border_color): self
    {
        $this->border_color = $border_color;

        return $this;
    }

    public function getCollectorNumber(): ?string
    {
        return $this->collector_number;
    }

    public function setCollectorNumber(string $collector_number): self
    {
        $this->collector_number = $collector_number;

        return $this;
    }

    public function getHighresImage(): ?bool
    {
        return $this->highresImage;
    }

    public function setHighresImage(bool $highresImage): self
    {
        $this->highresImage = $highresImage;

        return $this;
    }

    public function getRarity(): ?string
    {
        return $this->rarity;
    }

    public function setRarity(string $rarity): self
    {
        $this->rarity = $rarity;

        return $this;
    }

    public function getReleasedAt(): ?\DateTimeInterface
    {
        return $this->releasedAt;
    }

    public function setReleasedAt(\DateTimeInterface $releasedAt): self
    {
        $this->releasedAt = $releasedAt;

        return $this;
    }

    public function getReprint(): ?bool
    {
        return $this->reprint;
    }

    public function setReprint(bool $reprint): self
    {
        $this->reprint = $reprint;

        return $this;
    }

    public function getScryfallSet(): ?string
    {
        return $this->scryfallSet;
    }

    public function setScryfallSet(string $scryfallSet): self
    {
        $this->scryfallSet = $scryfallSet;

        return $this;
    }

    public function getArenaId(): ?int
    {
        return $this->arena_id;
    }

    public function setArenaId(?int $arena_id): self
    {
        $this->arena_id = $arena_id;

        return $this;
    }

    public function getMtgoId(): ?int
    {
        return $this->mtgo_id;
    }

    public function setMtgoId(?int $mtgo_id): self
    {
        $this->mtgo_id = $mtgo_id;

        return $this;
    }

    public function getMultiverseIds(): ?array
    {
        return $this->multiverse_ids;
    }

    public function setMultiverseIds(?array $multiverse_ids): self
    {
        $this->multiverse_ids = $multiverse_ids;

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

    /**
     * @return Collection|RelatedCard[]
     */
    public function getAllParts(): Collection
    {
        return $this->allParts;
    }

    public function addAllPart(RelatedCard $allPart): self
    {
        if (!$this->allParts->contains($allPart)) {
            $this->allParts[] = $allPart;
            $allPart->setCard($this);
        }

        return $this;
    }

    public function removeAllPart(RelatedCard $allPart): self
    {
        if ($this->allParts->contains($allPart)) {
            $this->allParts->removeElement($allPart);
            // set the owning side to null (unless already changed)
            if ($allPart->getCard() === $this) {
                $allPart->setCard(null);
            }
        }

        return $this;
    }
}
