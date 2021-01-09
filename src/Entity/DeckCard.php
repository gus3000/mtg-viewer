<?php

namespace App\Entity;

use App\Repository\DeckCardRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DeckCardRepository::class)
 */
class DeckCard
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Card::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $card;

    /**
     * @ORM\ManyToOne(targetEntity=Deck::class, inversedBy="deckCards")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Deck;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCard(): ?Card
    {
        return $this->card;
    }

    public function setCard(?Card $card): self
    {
        $this->card = $card;

        return $this;
    }

    public function getDeck(): ?Deck
    {
        return $this->Deck;
    }

    public function setDeck(?Deck $Deck): self
    {
        $this->Deck = $Deck;

        return $this;
    }
}
