@extends('layouts.app')
@section('title', 'Mes inscriptions')

@section('content')
<div class="mb-8">
    <h1 class="text-2xl font-bold text-slate-800">Mes inscriptions</h1>
    <p class="text-slate-500 text-sm mt-1">Gérez vos participations aux événements</p>
</div>

@forelse($inscriptions as $inscription)
<div class="bg-white border border-slate-200 rounded-2xl p-5 mb-4 flex flex-col sm:flex-row sm:items-center justify-between gap-4 hover:border-indigo-200 hover:shadow-sm transition-all">
    <div class="flex items-start gap-4">
        <div class="w-11 h-11 bg-indigo-100 rounded-xl flex items-center justify-center text-indigo-600 font-bold text-base flex-shrink-0">
            {{ strtoupper(substr($inscription->event->name, 0, 1)) }}
        </div>
        <div>
            <p class="font-bold text-slate-800">{{ $inscription->event->name }}</p>
            <p class="text-sm text-slate-500 mt-0.5">
                {{ $inscription->event->sportType->name }} &mdash; {{ $inscription->event->lieu }}
            </p>
            <p class="text-sm text-slate-400 mt-0.5">{{ $inscription->event->date->format('d M Y à H:i') }}</p>
            <span class="inline-block mt-2 text-xs font-semibold px-2.5 py-1 rounded-full
                {{ $inscription->statut === 'confirmee' ? 'bg-emerald-100 text-emerald-700' : 'bg-red-100 text-red-600' }}">
                {{ $inscription->statut === 'confirmee' ? '✅ Confirmée' : '❌ Annulée' }}
            </span>
        </div>
    </div>
    <div class="flex items-center gap-2 flex-shrink-0">
        <a href="{{ route('events.show', $inscription->event) }}"
           class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-lg transition-colors">
            Voir
        </a>
        @if($inscription->statut === 'confirmee')
        <form method="POST" action="{{ route('inscriptions.destroy', $inscription) }}">
            @csrf @method('DELETE')
            <button class="px-4 py-2 border border-red-200 bg-red-50 hover:bg-red-100 text-red-600 text-sm font-semibold rounded-lg transition-colors">
                Annuler
            </button>
        </form>
        @endif
    </div>
</div>
@empty
<div class="bg-white border border-slate-200 rounded-2xl p-16 text-center">
    <div class="text-5xl mb-4">📋</div>
    <h3 class="text-slate-700 font-semibold text-lg mb-1">Aucune inscription</h3>
    <p class="text-slate-400 text-sm mb-6">Vous n'êtes inscrit à aucun événement pour l'instant</p>
    <a href="{{ route('events.index') }}"
       class="inline-flex items-center gap-2 px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-xl transition-colors">
        Découvrir les événements
    </a>
</div>
@endforelse
@endsection
