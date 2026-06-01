@extends('layouts.app')
@section('title', 'Événements')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-bold">Événements sportifs</h1>
</div>

<form method="GET" class="flex gap-3 mb-6">
    <input type="text" name="sport" value="{{ request('sport') }}" placeholder="Sport..." class="border rounded px-3 py-2 w-48">
    <input type="text" name="lieu" value="{{ request('lieu') }}" placeholder="Lieu..." class="border rounded px-3 py-2 w-48">
    <button class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">Rechercher</button>
    <a href="{{ route('events.index') }}" class="px-4 py-2 border rounded text-gray-600 hover:bg-gray-50">Réinitialiser</a>
</form>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse($events as $event)
    <div class="bg-white rounded-lg shadow p-5">
        <div class="flex justify-between items-start mb-2">
            <h2 class="text-lg font-semibold">{{ $event->name }}</h2>
            <span class="text-xs bg-indigo-100 text-indigo-700 px-2 py-1 rounded">{{ $event->sportType->name }}</span>
        </div>
        <p class="text-sm text-gray-500">📍 {{ $event->lieu }}</p>
        <p class="text-sm text-gray-500">📅 {{ $event->date->format('d/m/Y H:i') }}</p>
        <p class="text-sm text-gray-500">👥 {{ $event->inscriptions->where('statut','confirmee')->count() }} / {{ $event->capacite_max }}</p>
        <div class="mt-4 flex gap-2">
            <a href="{{ route('events.show', $event) }}" class="text-sm bg-indigo-600 text-white px-3 py-1 rounded hover:bg-indigo-700">Voir</a>
            @auth
            <form method="POST" action="{{ route('favorites.store', $event) }}">
                @csrf
                <button class="text-sm border px-3 py-1 rounded hover:bg-gray-50">⭐ Favori</button>
            </form>
            @endauth
        </div>
    </div>
    @empty
    <p class="text-gray-500 col-span-3">Aucun événement trouvé.</p>
    @endforelse
</div>

<div class="mt-6">{{ $events->withQueryString()->links() }}</div>
@endsection
