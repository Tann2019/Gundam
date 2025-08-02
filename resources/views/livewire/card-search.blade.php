<div class="max-w-7xl mx-auto p-6">
    <!-- Search Header -->
    <div class="bg-gradient-to-r from-blue-900 to-purple-900 rounded-xl p-8 mb-8 text-white">
        <h1 class="text-4xl font-bold mb-4">Gundam Card Search</h1>
        <p class="text-xl text-blue-200">Find the perfect cards for your deck</p>
    </div>

    <!-- Search and Filters -->
    <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
        <!-- Search Bar -->
        <div class="mb-6">
            <label for="search" class="block text-sm font-medium text-gray-700 mb-2">Search Cards</label>
            <div class="relative">
                <input type="text" id="search" wire:model.live.debounce.500ms="search"
                    placeholder="Search by name or description..."
                    class="w-full px-4 py-3 pl-12 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Filter Options -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
            <!-- Card Type Filter -->
            <div>
                <label for="cardType" class="block text-sm font-medium text-gray-700 mb-2">Card Type</label>
                <select wire:model.live="cardType" id="cardType"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                    <option value="">All Types</option>
                    <option value="Mobile Suit">Mobile Suit</option>
                    <option value="Weapon">Weapon</option>
                    <option value="Spell">Spell</option>
                    <option value="Support">Support</option>
                </select>
            </div>

            <!-- Faction Filter -->
            <div>
                <label for="faction" class="block text-sm font-medium text-gray-700 mb-2">Faction</label>
                <select wire:model.live="faction" id="faction"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                    <option value="">All Factions</option>
                    <option value="Earth Federation">Earth Federation</option>
                    <option value="Zeon">Zeon</option>
                    <option value="ZAFT">ZAFT</option>
                    <option value="Tekkadan">Tekkadan</option>
                    <option value="Neutral">Neutral</option>
                </select>
            </div>

            <!-- Cost Filter -->
            <div>
                <label for="cost" class="block text-sm font-medium text-gray-700 mb-2">Energy Cost</label>
                <select wire:model.live="cost" id="cost"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                    <option value="">Any Cost</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5+</option>
                </select>
            </div>

            <!-- Clear Filters -->
            <div class="flex items-end">
                <button wire:click="clearFilters"
                    class="w-full px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors">
                    Clear Filters
                </button>
            </div>
        </div>

        <!-- Results Count -->
        <div class="text-sm text-gray-600">
            Found {{ count($cards) }} card{{ count($cards) !== 1 ? 's' : '' }}
        </div>
    </div>

    <!-- Loading State -->
    <div wire:loading.delay wire:target="search,cardType,faction,cost" class="text-center py-8">
        <div class="inline-flex items-center">
            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                </circle>
                <path class="opacity-75" fill="currentColor"
                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                </path>
            </svg>
            Searching cards...
        </div>
    </div>

    <!-- Cards Grid -->
    <div wire:loading.remove wire:target="search,cardType,faction,cost"
        class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @forelse($cards as $card)
            <div
                class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300 transform hover:scale-105">
                <!-- Card Image -->
                <div class="aspect-[3/4] bg-gradient-to-br from-gray-100 to-gray-200 relative overflow-hidden">
                    <img src="{{ $card['image'] }}" alt="{{ $card['name'] }}" class="w-full h-full object-cover">

                    <!-- Rarity Badge -->
                    <div class="absolute top-2 right-2">
                        <span
                            class="px-2 py-1 text-xs font-bold rounded-full
                            @if ($card['rarity'] === 'Common') bg-gray-500 text-white
                            @elseif($card['rarity'] === 'Rare') bg-blue-500 text-white
                            @elseif($card['rarity'] === 'Super Rare') bg-purple-500 text-white
                            @elseif($card['rarity'] === 'Ultra Rare') bg-yellow-500 text-black @endif">
                            {{ $card['rarity'] }}
                        </span>
                    </div>

                    <!-- Cost Badge -->
                    <div class="absolute top-2 left-2">
                        <div
                            class="w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold text-sm">
                            {{ $card['cost'] }}
                        </div>
                    </div>
                </div>

                <!-- Card Info -->
                <div class="p-4">
                    <h3 class="font-bold text-lg text-gray-900 mb-1">{{ $card['name'] }}</h3>

                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm font-medium text-blue-600">{{ $card['type'] }}</span>
                        <span class="text-sm text-gray-600">{{ $card['faction'] }}</span>
                    </div>

                    @if ($card['attack'] > 0 || $card['defense'] > 0)
                        <div class="flex items-center justify-between mb-3">
                            @if ($card['attack'] > 0)
                                <div class="flex items-center">
                                    <span class="text-red-600 font-bold text-sm mr-1">ATK:</span>
                                    <span class="text-sm">{{ number_format($card['attack']) }}</span>
                                </div>
                            @endif
                            @if ($card['defense'] > 0)
                                <div class="flex items-center">
                                    <span class="text-blue-600 font-bold text-sm mr-1">DEF:</span>
                                    <span class="text-sm">{{ number_format($card['defense']) }}</span>
                                </div>
                            @endif
                        </div>
                    @endif

                    <p class="text-sm text-gray-600 mb-4 line-clamp-3">{{ $card['description'] }}</p>

                    <!-- Action Buttons -->
                    <div class="flex gap-2">
                        <button
                            class="flex-1 px-3 py-2 bg-blue-600 text-white text-sm rounded-lg hover:bg-blue-700 transition-colors">
                            Add to Deck
                        </button>
                        <button
                            class="px-3 py-2 bg-gray-200 text-gray-700 text-sm rounded-lg hover:bg-gray-300 transition-colors">
                            View Details
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
                <h3 class="text-lg font-medium text-gray-900 mb-2">No cards found</h3>
                <p class="text-gray-600">Try adjusting your search criteria or clearing the filters.</p>
            </div>
        @endforelse
    </div>
</div>
