<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EventSport — @yield('title', 'Plateforme Sportive')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
        .nav-link { @apply text-slate-600 hover:text-indigo-600 text-sm font-medium transition-colors duration-150; }
        .nav-link.active { @apply text-indigo-600; }
    </style>
</head>
<body class="bg-slate-50 min-h-screen">

    {{-- NAVBAR --}}
    <nav class="bg-white border-b border-slate-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex items-center justify-between h-16">

                {{-- Brand --}}
                <a href="{{ route('events.index') }}" class="flex items-center gap-2.5">
                    <span class="text-2xl">⚽</span>
                    <span class="text-lg font-bold text-slate-800">Event<span class="text-indigo-600">Sport</span></span>
                </a>

                {{-- Nav links --}}
                <div class="hidden md:flex items-center gap-1">
                    @auth
                        <a href="{{ route('events.index') }}"
                           class="px-3 py-2 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('events.index') ? 'bg-indigo-50 text-indigo-600' : 'text-slate-600 hover:bg-slate-100' }}">
                            🏆 Événements
                        </a>
                        <a href="{{ route('inscriptions.index') }}"
                           class="px-3 py-2 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('inscriptions.index') ? 'bg-indigo-50 text-indigo-600' : 'text-slate-600 hover:bg-slate-100' }}">
                            📋 Mes inscriptions
                        </a>
                        <a href="{{ route('favorites.index') }}"
                           class="px-3 py-2 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('favorites.index') ? 'bg-indigo-50 text-indigo-600' : 'text-slate-600 hover:bg-slate-100' }}">
                            ⭐ Favoris
                        </a>
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}"
                               class="px-3 py-2 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-50 text-indigo-600' : 'text-slate-600 hover:bg-slate-100' }}">
                                📊 Dashboard
                            </a>
                        @endif
                        @if(auth()->user()->isAdmin() || auth()->user()->isOrganisateur())
                            <a href="{{ route('events.create') }}"
                               class="ml-1 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-lg transition-colors">
                                + Créer un événement
                            </a>
                        @endif
                    @endauth
                </div>

                {{-- User menu --}}
                <div class="flex items-center gap-3">
                    @auth
                        <a href="{{ route('profile.edit') }}"
                           class="flex items-center gap-2 px-3 py-1.5 rounded-lg hover:bg-slate-100 transition-colors">
                            <div class="w-7 h-7 rounded-full bg-indigo-600 flex items-center justify-center text-white text-xs font-bold">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                            <span class="text-sm font-medium text-slate-700 hidden sm:block">{{ auth()->user()->name }}</span>
                            <span class="text-xs px-2 py-0.5 rounded-full font-semibold hidden sm:block
                                {{ auth()->user()->isAdmin() ? 'bg-purple-100 text-purple-700' : (auth()->user()->isOrganisateur() ? 'bg-emerald-100 text-emerald-700' : 'bg-sky-100 text-sky-700') }}">
                                {{ ucfirst(auth()->user()->role) }}
                            </span>
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="px-3 py-1.5 text-sm font-medium text-slate-500 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                                Déconnexion
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="px-4 py-2 text-sm font-medium text-slate-600 hover:text-indigo-600 transition-colors">
                            Connexion
                        </a>
                        <a href="{{ route('register') }}" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-lg transition-colors">
                            S'inscrire
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    {{-- PAGE CONTENT --}}
    <main class="max-w-7xl mx-auto px-6 py-8">

        {{-- Flash messages --}}
        @if(session('success'))
            <div class="flex items-center gap-3 bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-xl mb-6 text-sm font-medium">
                <svg class="w-5 h-5 text-emerald-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="flex items-center gap-3 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-xl mb-6 text-sm font-medium">
                <svg class="w-5 h-5 text-red-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/></svg>
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </main>

</body>
</html>
