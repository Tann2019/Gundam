<?php

namespace App\Livewire;

use Livewire\Component;

class CardSearch extends Component
{
    public $search = '';
    public $cardType = '';
    public $faction = '';
    public $cost = '';

    public $cards = [];
    public $isSearching = false;

    protected $queryString = [
        'search' => ['except' => ''],
        'cardType' => ['except' => ''],
        'faction' => ['except' => ''],
        'cost' => ['except' => ''],
    ];

    public function mount()
    {
        $this->cards = $this->getSampleCards();
    }

    public function updatedSearch()
    {
        $this->filterCards();
    }

    public function updatedCardType()
    {
        $this->filterCards();
    }

    public function updatedFaction()
    {
        $this->filterCards();
    }

    public function updatedCost()
    {
        $this->filterCards();
    }

    public function filterCards()
    {
        $this->isSearching = true;

        // Simulate API delay
        sleep(1);

        $this->cards = collect($this->getSampleCards())->filter(function ($card) {
            $matchesSearch = empty($this->search) ||
                stripos($card['name'], $this->search) !== false ||
                stripos($card['description'], $this->search) !== false;

            $matchesType = empty($this->cardType) || $card['type'] === $this->cardType;
            $matchesFaction = empty($this->faction) || $card['faction'] === $this->faction;
            $matchesCost = empty($this->cost) || $card['cost'] == $this->cost;

            return $matchesSearch && $matchesType && $matchesFaction && $matchesCost;
        })->values()->all();

        $this->isSearching = false;
    }

    public function clearFilters()
    {
        $this->search = '';
        $this->cardType = '';
        $this->faction = '';
        $this->cost = '';
        $this->cards = $this->getSampleCards();
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
                'description' => 'The original Gundam, piloted by Amuro Ray. A legendary mobile suit with balanced stats.',
                'rarity' => 'Rare',
                'image' => 'https://via.placeholder.com/200x280?text=RX-78-2'
            ],
            [
                'id' => 2,
                'name' => 'Char\'s Zaku II',
                'type' => 'Mobile Suit',
                'faction' => 'Zeon',
                'cost' => 2,
                'attack' => 2200,
                'defense' => 1800,
                'description' => 'The Red Comet\'s custom Zaku. Three times faster than a normal Zaku.',
                'rarity' => 'Super Rare',
                'image' => 'https://via.placeholder.com/200x280?text=Char-Zaku'
            ],
            [
                'id' => 3,
                'name' => 'Strike Freedom',
                'type' => 'Mobile Suit',
                'faction' => 'ZAFT',
                'cost' => 5,
                'attack' => 3500,
                'defense' => 3000,
                'description' => 'Kira Yamato\'s ultimate mobile suit with DRAGOON system.',
                'rarity' => 'Ultra Rare',
                'image' => 'https://via.placeholder.com/200x280?text=Strike-Freedom'
            ],
            [
                'id' => 4,
                'name' => 'Beam Rifle',
                'type' => 'Weapon',
                'faction' => 'Neutral',
                'cost' => 1,
                'attack' => 1200,
                'defense' => 0,
                'description' => 'Standard energy weapon. +1200 attack when equipped.',
                'rarity' => 'Common',
                'image' => 'https://via.placeholder.com/200x280?text=Beam-Rifle'
            ],
            [
                'id' => 5,
                'name' => 'Newtype Flash',
                'type' => 'Spell',
                'faction' => 'Neutral',
                'cost' => 2,
                'attack' => 0,
                'defense' => 0,
                'description' => 'Draw 2 cards and gain +1 energy this turn.',
                'rarity' => 'Rare',
                'image' => 'https://via.placeholder.com/200x280?text=Newtype-Flash'
            ],
            [
                'id' => 6,
                'name' => 'Barbatos Lupus Rex',
                'type' => 'Mobile Suit',
                'faction' => 'Tekkadan',
                'cost' => 4,
                'attack' => 3200,
                'defense' => 2800,
                'description' => 'Mikazuki\'s final form Barbatos with devastating melee capabilities.',
                'rarity' => 'Super Rare',
                'image' => 'https://via.placeholder.com/200x280?text=Barbatos-Rex'
            ]
        ];
    }

    public function render()
    {
        return view('livewire.card-search');
    }
}
