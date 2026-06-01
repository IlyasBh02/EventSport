@extends('layouts.app')
@section('title', $event->name)

@section('content')
<div class="bg-white rounded-lg shadow p-6 mb-6">
    <div class="flex justify-between items-start">
        <div>
            <h1 class="text-2xl font-bold mb-1">{{ $event->name }}</h1>
            <span class="text-sm bg-indigo-100 text-indigo-700 px-2 py-1 rounded">{{ $event->sportType->name }}</span>
        </div>
        <div class="flex gap-2">
            @if(auth()->user()?->isAdmin() || auth()->id() === $event->user_id)
                <a href="{{ route('events.edit', $event) }}" class="text-sm bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">Modifier</a>
            @endif
            @if(auth()->user()?->isAdmin())
                <form method="POST" action="{{ route('events.destroy', $event) }}" onsubmit="return confirm('Supprimer ?')">
                    @csrf @method('DELETE')
                    <button class="text-sm bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">Supprimer</button>
                </form>
            @endif
        </div>
    </div>

    <div class="mt-4 grid grid-cols-2 gap-4 text-sm text-gray-600">
        <p>📍 <strong>Lieu :</strong> {{ $event->lieu }}</p>
        <p>📅 <strong>Date :</strong> {{ $event->date->format('d/m/Y H:i') }}</p>
        <p>👥 <strong>Capacité :</strong> {{ $event->inscriptions->where('statut','confirmee')->count() }} / {{ $event->capacite_max }}</p>
    </div>
    @if($event->description)
        <p class="mt-4 text-gray-700">{{ $event->description }}</p>
    @endif

    @auth
    <div class="mt-4 flex gap-3">
        <form method="POST" action="{{ route('inscriptions.store', $event) }}">
            @csrf
            <button class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">S'inscrire</button>
        </form>
        <form method="POST" action="{{ route('favorites.store', $event) }}">
            @csrf
            <button class="border px-4 py-2 rounded hover:bg-gray-50">⭐ Ajouter aux favoris</button>
        </form>
        @if(auth()->user()->isAdmin() || auth()->user()->isOrganisateur())
            <a href="{{ route('matchs.create', $event) }}" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">+ Match</a>
        @endif
    </div>
    @endauth
</div>

<h2 class="text-xl font-semibold mb-4">Matchs</h2>
@forelse($event->matchs as $match)
<div class="bg-white rounded shadow p-4 mb-3">
    <div class="flex justify-between items-center">
        <div>
            <p class="font-medium">{{ $match->equipe_a }} vs {{ $match->equipe_b }}</p>
            <p class="text-sm text-gray-500">{{ $match->date_match->format('d/m/Y H:i') }}</p>
            @if($match->scores->isNotEmpty())
                <p class="text-sm font-semibold text-indigo-600">Score : {{ $match->scores->first()->score_a }} - {{ $match->scores->first()->score_b }}</p>
            @endif
        </div>
        @if(auth()->user()?->isAdmin() || auth()->user()?->isOrganisateur())
        <div class="flex gap-2">
            <a href="{{ route('matchs.edit', [$event, $match]) }}" class="text-sm bg-yellow-500 text-white px-3 py-1 rounded">Modifier</a>
            <a href="{{ route('matchs.score', [$event, $match]) }}" class="text-sm bg-blue-600 text-white px-3 py-1 rounded">Score</a>
        </div>
        @endif
    </div>
</div>
@empty
<p class="text-gray-500">Aucun match planifié.</p>
@endforelse
@endsection
