<div class="max-w-7xl mx-auto p-6">
    <!-- Header -->
    <div class="bg-gradient-to-r from-purple-900 to-blue-900 rounded-xl p-8 mb-8 text-white">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-4xl font-bold mb-2">Deck Builder</h1>
                <p class="text-xl text-blue-200">Create your ultimate Gundam deck</p>
            </div>
            <div class="text-right">
                <div class="text-sm text-blue-200 mb-1">Total Cards</div>
                <div class="text-3xl font-bold">{{ $this->getTotalCards() }}/40</div>
            </div>
        </div>
    </div>

    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('message') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Card Pool (Left Side) -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-2xl font-bold mb-4">Available Cards</h2>

                <!-- Search -->
                <div class="mb-6">
                    <input type="text" wire:model.live.debounce.300ms="searchTerm" placeholder="Search cards..."
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <!-- Cards Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 max-h-96 overflow-y-auto">
                    @foreach ($filteredCards as $card)
                        <div class="bg-gray-50 rounded-lg p-4 hover:bg-gray-100 transition-colors">
                            <div class="flex items-center justify-between mb-2">
                                <h3 class="font-bold text-lg">{{ $card['name'] }}</h3>
                                <div class="flex items-center space-x-2">
                                    <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">
                                        Cost: {{ $card['cost'] }}
                                    </span>
                                    <button wire:click="addToDeck({{ $card['id'] }})"
                                        class="px-3 py-1 bg-blue-600 text-white text-sm rounded hover:bg-blue-700 transition-colors">
                                        Add
                                    </button>
                                </div>
                            </div>

                            <div class="flex items-center justify-between text-sm text-gray-600 mb-2">
                                <span>{{ $card['type'] }}</span>
                                <span>{{ $card['faction'] }}</span>
                            </div>

                            @if ($card['attack'] > 0 || $card['defense'] > 0)
                                <div class="flex items-center space-x-4 text-sm">
                                    @if ($card['attack'] > 0)
                                        <span class="text-red-600">ATK: {{ number_format($card['attack']) }}</span>
                                    @endif
                                    @if ($card['defense'] > 0)
                                        <span class="text-blue-600">DEF: {{ number_format($card['defense']) }}</span>
                                    @endif
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Current Deck (Right Side) -->
        <div>
            <div class="bg-white rounded-xl shadow-lg p-6">
                <!-- Deck Header -->
                <div class="mb-6">
                    <input type="text" wire:model="deckName"
                        class="text-2xl font-bold w-full border-none focus:ring-0 p-0 bg-transparent"
                        placeholder="Deck Name">

                    <!-- Deck Stats -->
                    <div class="grid grid-cols-2 gap-4 mt-4 p-4 bg-gray-50 rounded-lg">
                        <div class="text-center">
                            <div class="text-2xl font-bold text-blue-600">{{ $this->getTotalCards() }}</div>
                            <div class="text-sm text-gray-600">Total Cards</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold text-green-600">{{ $this->getAverageCost() }}</div>
                            <div class="text-sm text-gray-600">Avg Cost</div>
                        </div>
                    </div>
                </div>

                <!-- Deck List -->
                <div class="space-y-2 mb-6 max-h-64 overflow-y-auto">
                    @forelse($deck as $card)
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                            <div class="flex-1">
                                <div class="font-medium">{{ $card['name'] }}</div>
                                <div class="text-sm text-gray-600">Cost: {{ $card['cost'] }}</div>
                            </div>

                            <div class="flex items-center space-x-2">
                                <button wire:click="decreaseQuantity({{ $card['id'] }})"
                                    class="w-6 h-6 bg-red-100 text-red-600 rounded-full flex items-center justify-center text-sm hover:bg-red-200">
                                    -
                                </button>

                                <span class="w-8 text-center font-bold">{{ $card['quantity'] }}</span>

                                <button wire:click="addToDeck({{ $card['id'] }})"
                                    class="w-6 h-6 bg-green-100 text-green-600 rounded-full flex items-center justify-center text-sm hover:bg-green-200"
                                    @if ($card['quantity'] >= 3) disabled @endif>
                                    +
                                </button>

                                <button wire:click="removeFromDeck({{ $card['id'] }})"
                                    class="w-6 h-6 bg-red-500 text-white rounded-full flex items-center justify-center text-sm hover:bg-red-600">
                                    ×
                                </button>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-8 text-gray-500">
                            <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                            <p>Your deck is empty</p>
                            <p class="text-sm">Add cards from the left panel</p>
                        </div>
                    @endforelse
                </div>

                <!-- Action Buttons -->
                <div class="space-y-3">
                    <button wire:click="saveDeck"
                        class="w-full px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors font-medium">
                        Save Deck
                    </button>

                    <button onclick="if(confirm('Clear all cards from deck?')) @this.call('$set', 'deck', [])"
                        class="w-full px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors font-medium">
                        Clear Deck
                    </button>
                </div>

                <!-- Deck Validation -->
                @if ($this->getTotalCards() < 30)
                    <div class="mt-4 p-3 bg-yellow-100 border border-yellow-400 text-yellow-700 rounded-lg text-sm">
                        ⚠️ Minimum 30 cards required ({{ 30 - $this->getTotalCards() }} more needed)
                    </div>
                @elseif($this->getTotalCards() > 40)
                    <div class="mt-4 p-3 bg-red-100 border border-red-400 text-red-700 rounded-lg text-sm">
                        ❌ Maximum 40 cards allowed ({{ $this->getTotalCards() - 40 }} over limit)
                    </div>
                @else
                    <div class="mt-4 p-3 bg-green-100 border border-green-400 text-green-700 rounded-lg text-sm">
                        ✅ Deck is valid ({{ $this->getTotalCards() }}/40 cards)
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
