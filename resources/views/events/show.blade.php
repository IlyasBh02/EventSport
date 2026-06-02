@extends('layouts.app')
@section('title', $event->name)

@section('content')
@php
    $filled = $event->inscriptions->where('statut','confirmee')->count();
    $pct    = $event->capacite_max > 0 ? min(100, round($filled / $event->capacite_max * 100)) : 0;
    $isFull = $filled >= $event->capacite_max;
@endphp

{{-- Back link --}}
<a href="{{ route('events.index') }}" class="inline-flex items-center gap-1.5 text-sm text-slate-500 hover:text-indigo-600 mb-6 transition-colors">
    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
    Retour aux événements
</a>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    {{-- Main column --}}
    <div class="lg:col-span-2 space-y-6">

        {{-- Event header card --}}
        <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm">
            <div class="flex items-start justify-between gap-4 flex-wrap">
                <div>
                    <div class="flex items-center gap-2 flex-wrap mb-3">
                        <span class="text-xs bg-indigo-100 text-indigo-700 font-semibold px-3 py-1 rounded-full">
                            {{ $event->sportType->name }}
                        </span>
                        @if($isFull)
                            <span class="text-xs bg-red-100 text-red-600 font-semibold px-3 py-1 rounded-full">Complet</span>
                        @else
                            <span class="text-xs bg-emerald-100 text-emerald-700 font-semibold px-3 py-1 rounded-full">Places disponibles</span>
                        @endif
                    </div>
                    <h1 class="text-2xl font-bold text-slate-800 mb-4">{{ $event->name }}</h1>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-sm text-slate-600">
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-slate-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                            <span>{{ $event->lieu }}</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-slate-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            <span>{{ $event->date->format('d M Y à H:i') }}</span>
                        </div>
                        <div class="flex items-center gap-2 sm:col-span-2">
                            <svg class="w-4 h-4 text-slate-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            <span>{{ $filled }} / {{ $event->capacite_max }} participants</span>
                            <div class="flex-1 max-w-32 h-1.5 bg-slate-100 rounded-full overflow-hidden ml-1">
                                <div class="h-full rounded-full {{ $isFull ? 'bg-red-400' : 'bg-indigo-500' }}" style="width:{{ $pct }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex gap-2 flex-shrink-0">
                    @if(auth()->user()?->isAdmin() || auth()->id() === $event->user_id)
                        <a href="{{ route('events.edit', $event) }}"
                           class="px-4 py-2 border border-amber-300 bg-amber-50 hover:bg-amber-100 text-amber-700 text-sm font-semibold rounded-lg transition-colors">
                            ✏️ Modifier
                        </a>
                    @endif
                    @if(auth()->user()?->isAdmin())
                        <form method="POST" action="{{ route('events.destroy', $event) }}" onsubmit="return confirm('Supprimer cet événement ?')">
                            @csrf @method('DELETE')
                            <button class="px-4 py-2 border border-red-300 bg-red-50 hover:bg-red-100 text-red-600 text-sm font-semibold rounded-lg transition-colors">
                                🗑️ Supprimer
                            </button>
                        </form>
                    @endif
                </div>
            </div>

            @if($event->description)
                <div class="mt-5 pt-5 border-t border-slate-100">
                    <p class="text-sm text-slate-600 leading-relaxed">{{ $event->description }}</p>
                </div>
            @endif
        </div>

        {{-- Matches --}}
        <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
            <div class="flex items-center justify-between px-6 py-4 border-b border-slate-100">
                <h2 class="text-base font-bold text-slate-800">🥊 Matchs programmés</h2>
                @if(auth()->user()?->isAdmin() || auth()->user()?->isOrganisateur())
                    <a href="{{ route('matchs.create', $event) }}"
                       class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-semibold rounded-lg transition-colors">
                        + Ajouter un match
                    </a>
                @endif
            </div>
            <div class="divide-y divide-slate-100">
                @forelse($event->matchs as $match)
                <div class="px-6 py-4 flex items-center justify-between gap-4 hover:bg-slate-50 transition-colors">
                    <div class="flex items-center gap-4 flex-1 min-w-0">
                        <div class="text-center flex-1">
                            <p class="font-semibold text-slate-800 text-sm truncate">{{ $match->equipe_a }}</p>
                        </div>
                        @if($match->scores->isNotEmpty())
                            <div class="bg-indigo-600 text-white font-bold text-sm px-4 py-1.5 rounded-lg flex-shrink-0">
                                {{ $match->scores->first()->score_a }} — {{ $match->scores->first()->score_b }}
                            </div>
                        @else
                            <div class="bg-slate-100 text-slate-500 font-bold text-xs px-4 py-1.5 rounded-lg flex-shrink-0">VS</div>
                        @endif
                        <div class="text-center flex-1">
                            <p class="font-semibold text-slate-800 text-sm truncate">{{ $match->equipe_b }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 flex-shrink-0">
                        <span class="text-xs text-slate-400 hidden sm:block">{{ $match->date_match->format('d M • H:i') }}</span>
                        @if(auth()->user()?->isAdmin() || auth()->user()?->isOrganisateur())
                            <a href="{{ route('matchs.edit', [$event, $match]) }}"
                               class="px-3 py-1.5 bg-amber-50 border border-amber-200 text-amber-700 text-xs font-semibold rounded-lg hover:bg-amber-100 transition-colors">
                                Modifier
                            </a>
                            <a href="{{ route('matchs.score', [$event, $match]) }}"
                               class="px-3 py-1.5 bg-blue-50 border border-blue-200 text-blue-700 text-xs font-semibold rounded-lg hover:bg-blue-100 transition-colors">
                                Score
                            </a>
                        @endif
                    </div>
                </div>
                @empty
                <div class="px-6 py-10 text-center text-slate-400 text-sm">
                    Aucun match planifié pour cet événement.
                </div>
                @endforelse
            </div>
        </div>
    </div>

    {{-- Sidebar --}}
    @auth
    <div class="space-y-4">
        {{-- Register --}}
        <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm">
            <h3 class="font-bold text-slate-800 mb-4 text-sm">🎟️ Participer à l'événement</h3>
            @if($isFull)
                <div class="bg-red-50 border border-red-200 rounded-xl p-4 text-center">
                    <p class="text-red-600 font-semibold text-sm">Événement complet</p>
                    <p class="text-red-400 text-xs mt-1">Plus de places disponibles</p>
                </div>
            @else
                <form method="POST" action="{{ route('inscriptions.store', $event) }}">
                    @csrf
                    <button class="w-full py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold rounded-xl transition-colors">
                        ✅ S'inscrire
                    </button>
                </form>
            @endif
        </div>

        {{-- Favorites --}}
        <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm">
            <h3 class="font-bold text-slate-800 mb-4 text-sm">⭐ Favoris</h3>
            <form method="POST" action="{{ route('favorites.store', $event) }}">
                @csrf
                <button class="w-full py-2.5 border-2 border-yellow-300 hover:bg-yellow-50 text-yellow-700 text-sm font-semibold rounded-xl transition-colors mb-2">
                    Ajouter aux favoris
                </button>
            </form>
            <form method="POST" action="{{ route('favorites.destroy', $event) }}">
                @csrf @method('DELETE')
                <button class="w-full py-2 border border-slate-200 hover:bg-slate-50 text-slate-500 text-sm font-medium rounded-xl transition-colors">
                    Retirer des favoris
                </button>
            </form>
        </div>
    </div>
    @endauth
</div>
@endsection
