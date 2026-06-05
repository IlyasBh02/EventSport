@extends('layouts.app')
@section('title', 'Mes favoris')

@section('content')
<div class="mb-8">
    <h1 class="text-2xl font-bold text-slate-800">Mes favoris</h1>
    <p class="text-slate-500 text-sm mt-1">Vos événements sauvegardés</p>
</div>

@forelse($favorites as $favorite)
<div class="border border-slate-200 rounded-2xl p-5 mb-4 flex flex-col sm:flex-row sm:items-center justify-between gap-4 hover:border-yellow-300 hover:shadow-sm transition-all">
    <div class="flex items-start gap-4">
        <div class="w-11 h-11 bg-yellow-100 rounded-xl flex items-center justify-center text-yellow-600 font-bold text-base flex-shrink-0">
            ⭐
        </div>
        <div>
            <p class="font-bold text-slate-800">{{ $favorite->event->name }}</p>
            <p class="text-sm text-slate-500 mt-0.5">
                {{ $favorite->event->sportType->name }} &mdash; {{ $favorite->event->lieu }}
            </p>
            <p class="text-sm text-slate-400 mt-0.5">{{ $favorite->event->date->format('d M Y à H:i') }}</p>
        </div>
    </div>
    <div class="flex items-center gap-2 flex-shrink-0">
        <a href="{{ route('events.show', $favorite->event) }}"
           class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-lg transition-colors">
            Voir
        </a>
        <form method="POST" action="{{ route('favorites.destroy', $favorite->event) }}">
            @csrf @method('DELETE')
            <button class="px-4 py-2 border border-red-200 bg-red-50 hover:bg-red-100 text-red-600 text-sm font-semibold rounded-lg transition-colors">
                Retirer
            </button>
        </form>
    </div>
</div>
@empty
<div class="border border-slate-200 rounded-2xl p-16 text-center">
    <div class="text-5xl mb-4">⭐</div>
    <h3 class="text-slate-700 font-semibold text-lg mb-1">Aucun favori</h3>
    <p class="text-slate-400 text-sm mb-6">Ajoutez des événements à vos favoris pour les retrouver facilement</p>
    <a href="{{ route('events.index') }}"
       class="inline-flex items-center gap-2 px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-xl transition-colors">
        Explorer les événements
    </a>
</div>
@endforelse
@endsection
