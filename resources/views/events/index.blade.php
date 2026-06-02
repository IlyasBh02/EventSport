@extends('layouts.app')
@section('title', 'Événements Sportifs')

@section('content')

{{-- Page header --}}
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
    <div>
        <h1 class="text-2xl font-bold text-slate-800">Événements sportifs</h1>
        <p class="text-slate-500 text-sm mt-1">{{ $events->total() }} événement(s) disponible(s)</p>
    </div>
    @auth
        @if(auth()->user()->isAdmin() || auth()->user()->isOrganisateur())
            <a href="{{ route('events.create') }}"
               class="inline-flex items-center gap-2 px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-xl transition-colors shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Créer un événement
            </a>
        @endif
    @endauth
</div>

{{-- Search bar --}}
<form method="GET" class="bg-white border border-slate-200 rounded-2xl p-4 mb-8 flex flex-wrap gap-3 items-end shadow-sm">
    <div class="flex-1 min-w-40">
        <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wide mb-1.5">Sport</label>
        <input type="text" name="sport" value="{{ request('sport') }}" placeholder="Ex: Football..."
               class="w-full border border-slate-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition">
    </div>
    <div class="flex-1 min-w-40">
        <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wide mb-1.5">Lieu</label>
        <input type="text" name="lieu" value="{{ request('lieu') }}" placeholder="Ex: Casablanca..."
               class="w-full border border-slate-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition">
    </div>
    <div class="flex gap-2">
        <button type="submit"
                class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-lg transition-colors">
            Rechercher
        </button>
        @if(request('sport') || request('lieu'))
            <a href="{{ route('events.index') }}"
               class="px-4 py-2.5 border border-slate-200 text-slate-600 hover:bg-slate-50 text-sm font-medium rounded-lg transition-colors">
                Réinitialiser
            </a>
        @endif
    </div>
</form>

{{-- Events grid --}}
@forelse($events as $event)
@php
    $filled = $event->inscriptions->where('statut','confirmee')->count();
    $pct    = $event->capacite_max > 0 ? min(100, round($filled / $event->capacite_max * 100)) : 0;
    $isFull = $filled >= $event->capacite_max;
@endphp
<div class="bg-white border border-slate-200 rounded-2xl p-5 mb-4 hover:shadow-md hover:border-indigo-200 transition-all duration-200">
    <div class="flex flex-col sm:flex-row sm:items-start justify-between gap-4">
        <div class="flex-1">
            <div class="flex items-center gap-2 flex-wrap mb-2">
                <h2 class="text-base font-bold text-slate-800">{{ $event->name }}</h2>
                <span class="text-xs bg-indigo-100 text-indigo-700 font-semibold px-2.5 py-0.5 rounded-full">
                    {{ $event->sportType->name }}
                </span>
                @if($isFull)
                    <span class="text-xs bg-red-100 text-red-600 font-semibold px-2.5 py-0.5 rounded-full">Complet</span>
                @endif
            </div>
            <div class="flex flex-wrap gap-x-5 gap-y-1 text-sm text-slate-500 mb-3">
                <span class="flex items-center gap-1.5">
                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    {{ $event->lieu }}
                </span>
                <span class="flex items-center gap-1.5">
                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    {{ $event->date->format('d M Y • H:i') }}
                </span>
            </div>
            {{-- Capacity bar --}}
            <div class="flex items-center gap-3">
                <div class="flex-1 max-w-48 h-1.5 bg-slate-100 rounded-full overflow-hidden">
                    <div class="h-full rounded-full transition-all {{ $isFull ? 'bg-red-400' : 'bg-indigo-500' }}"
                         style="width: {{ $pct }}%"></div>
                </div>
                <span class="text-xs text-slate-500 font-medium">{{ $filled }}/{{ $event->capacite_max }} participants</span>
            </div>
        </div>
        <div class="flex items-center gap-2 flex-shrink-0">
            <a href="{{ route('events.show', $event) }}"
               class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-lg transition-colors">
                Voir
            </a>
            @auth
            <form method="POST" action="{{ route('favorites.store', $event) }}">
                @csrf
                <button class="px-3 py-2 border border-slate-200 hover:border-yellow-400 hover:bg-yellow-50 text-slate-500 hover:text-yellow-600 text-sm rounded-lg transition-colors" title="Ajouter aux favoris">
                    ⭐
                </button>
            </form>
            @endauth
        </div>
    </div>
</div>
@empty
<div class="bg-white border border-slate-200 rounded-2xl p-16 text-center">
    <div class="text-5xl mb-4">🏟️</div>
    <h3 class="text-slate-700 font-semibold text-lg mb-1">Aucun événement trouvé</h3>
    <p class="text-slate-400 text-sm">Essayez d'autres critères de recherche</p>
</div>
@endforelse

<div class="mt-6">{{ $events->withQueryString()->links() }}</div>
@endsection
