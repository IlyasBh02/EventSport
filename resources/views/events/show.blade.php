@extends('layouts.app')
@section('title', $event->name)

@section('content')
@php
    $filled = $event->inscriptions->where('statut','confirmee')->count();
    $remaining = $event->capacite_max - $filled;
    $isFull = $remaining <= 0;
@endphp

<a href="{{ route('events.index') }}" class="inline-flex items-center text-sm text-gray-500 hover:text-blue-600 mb-6 transition-colors">
    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
    Retour aux événements
</a>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

    {{-- Main --}}
    <div class="lg:col-span-2 space-y-6">

        {{-- Event card --}}
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="bg-gradient-to-br from-blue-500 to-blue-700 px-6 py-8 relative">
                <div class="flex items-start justify-between flex-wrap gap-4">
                    <div>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-white text-blue-700 mb-3">
                            {{ $event->sportType->name }}
                        </span>
                        <h1 class="text-2xl font-extrabold text-white">{{ $event->name }}</h1>
                    </div>
                    <div class="flex gap-2">
                        @if(auth()->user()?->isAdmin() || auth()->id() === $event->user_id)
                            <a href="{{ route('events.edit', $event) }}"
                               class="inline-flex items-center px-3 py-1.5 border border-white text-sm font-medium rounded-md text-white hover:bg-white hover:text-blue-700 transition-colors">
                                ✏️ Modifier
                            </a>
                        @endif
                        @if(auth()->user()?->isAdmin())
                            <form method="POST" action="{{ route('events.destroy', $event) }}" onsubmit="return confirm('Supprimer cet événement ?')">
                                @csrf @method('DELETE')
                                <button class="inline-flex items-center px-3 py-1.5 border border-red-300 text-sm font-medium rounded-md text-white bg-red-500 hover:bg-red-600 transition-colors">
                                    🗑️ Supprimer
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>

            <div class="p-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm text-gray-600 mb-4">
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-blue-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                        <span>{{ $event->lieu }}</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-blue-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <span>{{ $event->date->format('d M Y à H:i') }}</span>
                    </div>
                    <div class="flex items-center gap-2 sm:col-span-2">
                        <svg class="w-4 h-4 text-blue-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        <span>{{ $filled }} / {{ $event->capacite_max }} participants
                            <span class="ml-2 inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold {{ $isFull ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }}">
                                {{ $isFull ? 'Complet' : $remaining . ' places restantes' }}
                            </span>
                        </span>
                    </div>
                </div>
                @if($event->description)
                    <p class="text-gray-600 text-sm leading-relaxed border-t border-gray-100 pt-4">{{ $event->description }}</p>
                @endif
            </div>
        </div>

        {{-- Matches --}}
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                <h2 class="text-lg font-bold text-gray-900">Matchs programmés</h2>
                @if(auth()->user()?->isAdmin() || auth()->user()?->isOrganisateur())
                    <a href="{{ route('matchs.create', $event) }}"
                       class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                        + Ajouter un match
                    </a>
                @endif
            </div>
            <div class="divide-y divide-gray-100">
                @forelse($event->matchs as $match)
                <div class="px-6 py-4 flex items-center justify-between gap-4 hover:bg-gray-50 transition-colors">
                    <div class="flex items-center gap-4 flex-1 min-w-0">
                        <span class="font-semibold text-gray-800 text-sm truncate flex-1 text-right">{{ $match->equipe_a }}</span>
                        @if($match->scores->isNotEmpty())
                            <span class="bg-blue-600 text-white font-bold text-sm px-3 py-1 rounded-md flex-shrink-0">
                                {{ $match->scores->first()->score_a }} — {{ $match->scores->first()->score_b }}
                            </span>
                        @else
                            <span class="bg-gray-100 text-gray-500 font-bold text-xs px-3 py-1 rounded-md flex-shrink-0">VS</span>
                        @endif
                        <span class="font-semibold text-gray-800 text-sm truncate flex-1">{{ $match->equipe_b }}</span>
                    </div>
                    <div class="flex items-center gap-2 flex-shrink-0">
                        <span class="text-xs text-gray-400 hidden sm:block">{{ $match->date_match->format('d M • H:i') }}</span>
                        @if(auth()->user()?->isAdmin() || auth()->user()?->isOrganisateur())
                            <a href="{{ route('matchs.edit', [$event, $match]) }}"
                               class="inline-flex items-center px-2.5 py-1 border border-yellow-300 text-xs font-medium rounded-md text-yellow-700 bg-yellow-50 hover:bg-yellow-100 transition-colors">
                                Modifier
                            </a>
                            <a href="{{ route('matchs.score', [$event, $match]) }}"
                               class="inline-flex items-center px-2.5 py-1 border border-blue-300 text-xs font-medium rounded-md text-blue-700 bg-blue-50 hover:bg-blue-100 transition-colors">
                                Score
                            </a>
                        @endif
                    </div>
                </div>
                @empty
                <div class="px-6 py-10 text-center text-gray-400 text-sm">
                    Aucun match planifié pour cet événement.
                </div>
                @endforelse
            </div>
        </div>
    </div>

    {{-- Sidebar --}}
    @auth
    <div class="space-y-5">
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h3 class="font-bold text-gray-900 mb-4">Participer à l'événement</h3>
            @if($isFull)
                <div class="bg-red-50 border-l-4 border-red-500 p-4 text-sm text-red-700">
                    <p class="font-semibold">Événement complet</p>
                    <p class="mt-1 text-xs">Plus de places disponibles.</p>
                </div>
            @else
                <form method="POST" action="{{ route('inscriptions.store', $event) }}">
                    @csrf
                    <button class="w-full flex justify-center py-2.5 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        ✅ S'inscrire
                    </button>
                </form>
            @endif
        </div>

        <div class="bg-white rounded-lg shadow-lg p-6">
            <h3 class="font-bold text-gray-900 mb-4">Favoris</h3>
            <form method="POST" action="{{ route('favorites.store', $event) }}">
                @csrf
                <button class="w-full flex justify-center py-2 px-4 border-2 border-yellow-400 rounded-md text-sm font-medium text-yellow-700 bg-yellow-50 hover:bg-yellow-100 transition-colors mb-2">
                    ⭐ Ajouter aux favoris
                </button>
            </form>
            <form method="POST" action="{{ route('favorites.destroy', $event) }}">
                @csrf @method('DELETE')
                <button class="w-full flex justify-center py-2 px-4 border border-gray-300 rounded-md text-sm font-medium text-gray-600 bg-white hover:bg-gray-50 transition-colors">
                    Retirer des favoris
                </button>
            </form>
        </div>
    </div>
    @endauth
</div>
@endsection
