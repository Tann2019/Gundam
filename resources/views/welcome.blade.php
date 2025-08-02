<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <link rel="icon" href="/favicon.ico" sizes="any">
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-br from-slate-900 via-blue-900 to-indigo-900 min-h-screen text-slate-100 overflow-x-hidden">
    <!-- Background Pattern -->
    <div class="absolute inset-0 bg-gradient-to-r from-blue-600/10 to-purple-600/10"></div>
    <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,<svg width="60" height="60"
        viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg">
        <g fill="none" fill-rule="evenodd">
            <g fill="%23ffffff" fill-opacity="0.05">
                <circle cx="30" cy="30" r="2" />
            </g>
        </g></svg>');">
    </div>

    <!-- Navigation -->
    <nav class="relative z-10 flex items-center justify-between p-6 lg:px-12">
        <div class="flex items-center space-x-3">
            <div
                class="w-10 h-10 bg-gradient-to-br from-red-500 to-red-700 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-slate-100" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2L2 7V17L12 22L22 17V7L12 2Z" />
                </svg>
            </div>
            <h1 class="text-2xl font-bold bg-gradient-to-r from-red-400 to-red-600 bg-clip-text text-transparent">
                GundamDeck
            </h1>
        </div>

        @if (Route::has('login'))
            <div class="flex items-center space-x-4">
                @auth
                    <a href="{{ url('/dashboard') }}"
                        class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-slate-100 rounded-lg font-medium transition-all duration-200 transform hover:scale-105">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="px-4 py-2 text-blue-300 hover:text-slate-100 transition-colors">
                        Log in
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="px-6 py-2 bg-red-600 hover:bg-red-700 text-slate-100 rounded-lg font-medium transition-all duration-200 transform hover:scale-105">
                            Register
                        </a>
                    @endif
                @endauth
            </div>
        @endif
    </nav>

    <!-- Hero Section -->
    <div class="relative z-10 px-6 lg:px-12 py-12 lg:py-24">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <div class="inline-block p-2 bg-red-600/20 rounded-lg mb-6">
                    <div
                        class="w-16 h-16 bg-gradient-to-br from-red-500 to-red-700 rounded-lg flex items-center justify-center mx-auto">
                        <svg class="w-8 h-8 text-slate-100" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2L2 7V17L12 22L22 17V7L12 2Z" />
                        </svg>
                    </div>
                </div>

                <h1
                    class="text-5xl lg:text-7xl font-bold mb-6 bg-gradient-to-r from-white via-blue-100 to-red-200 bg-clip-text text-transparent leading-tight">
                    Build Your Ultimate<br>
                    <span class="text-red-400">Gundam Deck</span>
                </h1>

                <p class="text-xl lg:text-2xl text-blue-200 mb-8 max-w-3xl mx-auto leading-relaxed">
                    Search through thousands of Gundam cards, create powerful decks, and dominate the battlefield with
                    strategic combinations.
                </p>

                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    @auth
                        <a href="{{ url('/dashboard') }}"
                            class="px-8 py-4 bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-slate-100 rounded-xl font-semibold text-lg transition-all duration-200 transform hover:scale-105 shadow-xl">
                            Go to Dashboard
                        </a>
                        <a href="{{ route('cards.search') }}"
                            class="px-8 py-4 bg-white/10 hover:bg-white/20 text-slate-100 rounded-xl font-semibold text-lg transition-all duration-200 backdrop-blur-sm border border-white/20">
                            Browse Cards
                        </a>
                    @else
                        <a href="{{ route('register') }}"
                            class="px-8 py-4 bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-slate-100 rounded-xl font-semibold text-lg transition-all duration-200 transform hover:scale-105 shadow-xl">
                            Start Building Now
                        </a>
                        <a href="{{ route('cards.search') }}"
                            class="px-8 py-4 bg-white/10 hover:bg-white/20 text-slate-100 rounded-xl font-semibold text-lg transition-all duration-200 backdrop-blur-sm border border-white/20">
                            Browse Cards
                        </a>
                    @endauth
                </div>
            </div>

            <!-- Features Grid -->
            <div class="grid md:grid-cols-3 gap-8 mt-20">
                <!-- Card Search Feature -->
                <div
                    class="bg-white/5 backdrop-blur-sm rounded-2xl p-8 border border-white/10 hover:bg-white/10 transition-all duration-300 transform hover:scale-105">
                    <div class="w-12 h-12 bg-blue-600 rounded-lg flex items-center justify-center mb-6">
                        <svg class="w-6 h-6 text-slate-100" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold mb-4 text-slate-100">Advanced Search</h3>
                    <p class="text-blue-200 leading-relaxed">
                        Find the perfect cards with our powerful search engine. Filter by type, cost, faction, and
                        abilities to discover hidden synergies.
                    </p>
                </div>

                <!-- Deck Builder Feature -->
                <div
                    class="bg-white/5 backdrop-blur-sm rounded-2xl p-8 border border-white/10 hover:bg-white/10 transition-all duration-300 transform hover:scale-105">
                    <div class="w-12 h-12 bg-red-600 rounded-lg flex items-center justify-center mb-6">
                        <svg class="w-6 h-6 text-slate-100" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold mb-4 text-slate-100">Deck Builder</h3>
                    <p class="text-blue-200 leading-relaxed mb-4">
                        Create and optimize your decks with our intuitive builder. Track mana curves, test combinations,
                        and save multiple deck variations.
                    </p>
                    <a href="{{ route('deck.builder') }}"
                        class="inline-block px-4 py-2 bg-red-600 hover:bg-red-700 text-slate-100 rounded-lg font-medium transition-colors">
                        Try Deck Builder
                    </a>
                </div>

                <!-- Community Feature -->
                <div
                    class="bg-white/5 backdrop-blur-sm rounded-2xl p-8 border border-white/10 hover:bg-white/10 transition-all duration-300 transform hover:scale-105">
                    <div class="w-12 h-12 bg-purple-600 rounded-lg flex items-center justify-center mb-6">
                        <svg class="w-6 h-6 text-slate-100" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold mb-4 text-slate-100">Community</h3>
                    <p class="text-blue-200 leading-relaxed">
                        Share your decks, discover trending builds, and learn from top players in the Gundam community.
                    </p>
                </div>
            </div>

            <!-- Stats Section -->
            <div class="mt-20 grid grid-cols-2 md:grid-cols-4 gap-8">
                <div class="text-center">
                    <div class="text-4xl font-bold text-red-400 mb-2">1000+</div>
                    <div class="text-blue-200">Cards Available</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold text-blue-400 mb-2">500+</div>
                    <div class="text-blue-200">Active Players</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold text-purple-400 mb-2">50+</div>
                    <div class="text-blue-200">Deck Archetypes</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold text-green-400 mb-2">24/7</div>
                    <div class="text-blue-200">Always Online</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="relative z-10 mt-20 py-8 border-t border-white/10">
        <div class="max-w-7xl mx-auto px-6 lg:px-12 text-center">
            <p class="text-blue-300">© 2025 GundamDeck. Ready to build the ultimate deck?</p>
        </div>
    </footer>
</body>

</html>
