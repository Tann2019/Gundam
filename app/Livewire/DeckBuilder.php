<?php

namespace App\Livewire;

use Livewire\Component;

class DeckBuilder extends Component
{
    public $deckName = 'My Gundam Deck';
    public $deck = [];
    public $availableCards = [];
    public $searchTerm = '';
    public $selectedCard = null;

    public function mount()
    {
        $this->availableCards = $this->getSampleCards();
        // Add some default cards to deck
        $this->deck = [
            ['id' => 1, 'name' => 'RX-78-2 Gundam', 'cost' => 3, 'quantity' => 1],
            ['id' => 4, 'name' => 'Beam Rifle', 'cost' => 1, 'quantity' => 2],
        ];
    }

    public function addToDeck($cardId)
    {
        $card = collect($this->availableCards)->firstWhere('id', $cardId);
        if (!$card) return;

        $existingCard = collect($this->deck)->firstWhere('id', $cardId);

        if ($existingCard) {
            // Increase quantity if card already in deck
            $this->deck = collect($this->deck)->map(function ($deckCard) use ($cardId) {
                if ($deckCard['id'] === $cardId && $deckCard['quantity'] < 3) {
                    $deckCard['quantity']++;
                }
                return $deckCard;
            })->toArray();
        } else {
            // Add new card to deck
            $this->deck[] = [
                'id' => $card['id'],
                'name' => $card['name'],
                'cost' => $card['cost'],
                'quantity' => 1
            ];
        }
    }

    public function removeFromDeck($cardId)
    {
        $this->deck = collect($this->deck)->filter(function ($card) use ($cardId) {
            return $card['id'] !== $cardId;
        })->values()->toArray();
    }

    public function decreaseQuantity($cardId)
    {
        $this->deck = collect($this->deck)->map(function ($card) use ($cardId) {
            if ($card['id'] === $cardId) {
                $card['quantity']--;
                if ($card['quantity'] <= 0) {
                    return null;
                }
            }
            return $card;
        })->filter()->values()->toArray();
    }

    public function getTotalCards()
    {
        return collect($this->deck)->sum('quantity');
    }

    public function getAverageCost()
    {
        $totalCost = collect($this->deck)->sum(function ($card) {
            return $card['cost'] * $card['quantity'];
        });
        $totalCards = $this->getTotalCards();
        return $totalCards > 0 ? round($totalCost / $totalCards, 1) : 0;
    }

    public function saveDeck()
    {
        // In a real app, this would save to database
        session()->flash('message', 'Deck "' . $this->deckName . '" saved successfully!');
    }

    private function getSampleCards()
    {
        return [
            [
                'id' => 1,
                'name' => 'RX-78-2 Gundam',
                'type' => 'Mobile Suit',
                'faction' => 'Earth Federation',
                'cost' => 3,
                'attack' => 2800,
                'defense' => 2500,
                'rarity' => 'Rare',
            ],
            [
                'id' => 2,
                'name' => 'Char\'s Zaku II',
                'type' => 'Mobile Suit',
                'faction' => 'Zeon',
                'cost' => 2,
                'attack' => 2200,
                'defense' => 1800,
                'rarity' => 'Super Rare',
            ],
            [
                'id' => 3,
                'name' => 'Strike Freedom',
                'type' => 'Mobile Suit',
                'faction' => 'ZAFT',
                'cost' => 5,
                'attack' => 3500,
                'defense' => 3000,
                'rarity' => 'Ultra Rare',
            ],
            [
                'id' => 4,
                'name' => 'Beam Rifle',
                'type' => 'Weapon',
                'faction' => 'Neutral',
                'cost' => 1,
                'attack' => 1200,
                'defense' => 0,
                'rarity' => 'Common',
            ],
            [
                'id' => 5,
                'name' => 'Newtype Flash',
                'type' => 'Spell',
                'faction' => 'Neutral',
                'cost' => 2,
                'attack' => 0,
                'defense' => 0,
                'rarity' => 'Rare',
            ],
            [
                'id' => 6,
                'name' => 'Barbatos Lupus Rex',
                'type' => 'Mobile Suit',
                'faction' => 'Tekkadan',
                'cost' => 4,
                'attack' => 3200,
                'defense' => 2800,
                'rarity' => 'Super Rare',
            ],
        ];
    }

    public function render()
    {
        $filteredCards = collect($this->availableCards);

        if ($this->searchTerm) {
            $filteredCards = $filteredCards->filter(function ($card) {
                return stripos($card['name'], $this->searchTerm) !== false;
            });
        }

        return view('livewire.deck-builder', [
            'filteredCards' => $filteredCards,
        ]);
    }
}
