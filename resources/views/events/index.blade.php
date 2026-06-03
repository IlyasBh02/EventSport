@extends('layouts.app')
@section('title', 'Événements Sportifs')

@section('content')

{{-- Page header --}}
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
    <div>
        <h2 class="text-3xl font-extrabold text-gray-900">Événements sportifs</h2>
        <p class="mt-1 text-gray-500 text-sm">{{ $events->total() }} événement(s) disponible(s)</p>
    </div>
    @auth
        @if(auth()->user()->isAdmin() || auth()->user()->isOrganisateur())
            <a href="{{ route('events.create') }}"
               class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 shadow-sm">
                + Créer un événement
            </a>
        @endif
    @endauth
</div>

{{-- Filters --}}
<div class="bg-white rounded-lg shadow-sm p-6 mb-8">
    <form method="GET">
        <div class="flex flex-col md:flex-row md:items-end gap-4">
            <h3 class="text-base font-medium text-gray-900 md:self-center">Filtrer</h3>
            <div class="flex flex-wrap gap-4 flex-1">
                <div class="w-full md:w-auto">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Sport</label>
                    <input type="text" name="sport" value="{{ request('sport') }}" placeholder="Ex: Football"
                           class="block w-full pl-3 pr-10 py-2 text-sm border-gray-300 border rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="w-full md:w-auto">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Lieu</label>
                    <input type="text" name="lieu" value="{{ request('lieu') }}" placeholder="Ex: Casablanca"
                           class="block w-full pl-3 pr-10 py-2 text-sm border-gray-300 border rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="w-full md:w-auto flex items-end gap-2">
                    @if(request('sport') || request('lieu'))
                        <a href="{{ route('events.index') }}"
                           class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none">
                            Réinitialiser
                        </a>
                    @endif
                    <button type="submit"
                            class="bg-blue-600 py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Rechercher
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

{{-- Events grid --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
    @forelse($events as $event)
    @php
        $filled = $event->inscriptions->where('statut','confirmee')->count();
        $remaining = $event->capacite_max - $filled;
        $isFull = $remaining <= 0;
        $isLimited = $remaining > 0 && $remaining <= 5;
    @endphp
    <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
        {{-- Card image header --}}
        <div class="relative bg-gradient-to-br from-blue-500 to-blue-700 h-36 flex items-center justify-center">
            <span class="text-white text-5xl font-extrabold opacity-20">{{ strtoupper(substr($event->sportType->name, 0, 1)) }}</span>
            <div class="absolute top-0 right-0 m-3">
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold
                    {{ $isFull ? 'bg-red-100 text-red-800' : ($isLimited ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800') }}">
                    {{ $isFull ? 'Complet' : ($isLimited ? 'Limité' : 'Disponible') }}
                </span>
            </div>
            <div class="absolute bottom-0 left-0 m-3">
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-blue-100 text-blue-800">
                    {{ $event->sportType->name }}
                </span>
            </div>
        </div>

        <div class="p-6">
            <h3 class="text-lg font-bold text-gray-900 mb-3">{{ $event->name }}</h3>

            <div class="flex items-center text-gray-500 text-sm mb-2">
                <svg class="w-4 h-4 mr-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                <span>{{ $event->lieu }}</span>
            </div>
            <div class="flex items-center text-gray-500 text-sm mb-2">
                <svg class="w-4 h-4 mr-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                <span>{{ $event->date->format('d M Y — H:i') }}</span>
            </div>
            <div class="flex items-center text-gray-500 text-sm mb-4">
                <svg class="w-4 h-4 mr-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                <span>{{ $remaining }} place(s) restante(s)</span>
            </div>

            <div class="flex items-center justify-between">
                <a href="{{ route('events.show', $event) }}"
                   class="inline-flex items-center px-3 py-1.5 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Voir les détails
                </a>
                @auth
                <form method="POST" action="{{ route('favorites.store', $event) }}">
                    @csrf
                    <button class="inline-flex items-center px-3 py-1.5 border border-gray-300 text-sm font-medium rounded-md text-gray-600 bg-white hover:bg-yellow-50 hover:border-yellow-400 hover:text-yellow-600 focus:outline-none transition-colors">
                        ⭐ Favori
                    </button>
                </form>
                @endauth
            </div>
        </div>
    </div>
    @empty
    <div class="col-span-3 text-center py-12">
        <div class="text-gray-400">
            <svg class="mx-auto h-12 w-12 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <h3 class="text-lg font-medium text-gray-900 mb-2">Aucun événement trouvé</h3>
            <p>Essayez d'autres critères de recherche.</p>
        </div>
    </div>
    @endforelse
</div>

<div class="mt-8">{{ $events->withQueryString()->links() }}</div>
@endsection
