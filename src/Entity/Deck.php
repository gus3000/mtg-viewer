<?php

namespace App\Entity;

use App\Repository\DeckRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DeckRepository::class)
 */
class Deck
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Event::class, inversedBy="decks")
     * @ORM\JoinColumn(nullable=false)
     */
    private $event;

    /**
     * @ORM\Column(type="integer")
     */
    private $deckId;

    /**
     * @ORM\OneToMany(targetEntity=DeckCard::class, mappedBy="Deck")
     */
    private $deckCards;

    public function __construct()
    {
        $this->deckCards = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEvent(): ?Event
    {
        return $this->event;
    }

    public function setEvent(?Event $event): self
    {
        $this->event = $event;

        return $this;
    }

    public function getDeckId(): ?int
    {
        return $this->deckId;
    }

    public function setDeckId(int $deckId): self
    {
        $this->deckId = $deckId;

        return $this;
    }

    /**
     * @return Collection|DeckCard[]
     */
    public function getDeckCards(): Collection
    {
        return $this->deckCards;
    }

    public function addDeckCard(DeckCard $deckCard): self
    {
        if (!$this->deckCards->contains($deckCard)) {
            $this->deckCards[] = $deckCard;
            $deckCard->setDeck($this);
        }

        return $this;
    }

    public function removeDeckCard(DeckCard $deckCard): self
    {
        if ($this->deckCards->contains($deckCard)) {
            $this->deckCards->removeElement($deckCard);
            // set the owning side to null (unless already changed)
            if ($deckCard->getDeck() === $this) {
                $deckCard->setDeck(null);
            }
        }

        return $this;
    }
}
