<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EventSport - @yield('title', 'Plateforme Sportive')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen">
    <nav class="bg-white shadow mb-6">
        <div class="max-w-7xl mx-auto px-4 py-3 flex items-center justify-between">
            <a href="{{ route('events.index') }}" class="text-xl font-bold text-indigo-600">⚽ EventSport</a>
            <div class="flex items-center gap-4 text-sm">
                @auth
                    <a href="{{ route('events.index') }}" class="text-gray-600 hover:text-indigo-600">Événements</a>
                    <a href="{{ route('inscriptions.index') }}" class="text-gray-600 hover:text-indigo-600">Mes inscriptions</a>
                    <a href="{{ route('favorites.index') }}" class="text-gray-600 hover:text-indigo-600">Favoris</a>
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="text-gray-600 hover:text-indigo-600">Dashboard</a>
                    @endif
                    @if(auth()->user()->isAdmin() || auth()->user()->isOrganisateur())
                        <a href="{{ route('events.create') }}" class="text-gray-600 hover:text-indigo-600">+ Événement</a>
                    @endif
                    <a href="{{ route('profile.edit') }}" class="text-gray-600 hover:text-indigo-600">{{ auth()->user()->name }}</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="text-red-500 hover:underline">Déconnexion</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-gray-600 hover:text-indigo-600">Connexion</a>
                    <a href="{{ route('register') }}" class="bg-indigo-600 text-white px-3 py-1 rounded hover:bg-indigo-700">Inscription</a>
                @endauth
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4">
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-4">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mb-4">{{ session('error') }}</div>
        @endif
        @yield('content')
    </main>
</body>
</html>
