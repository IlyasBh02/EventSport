@extends('layouts.app')
@section('title', 'Mes favoris')

@section('content')
<h1 class="text-2xl font-bold mb-6">Mes favoris</h1>

@forelse($favorites as $favorite)
<div class="bg-white rounded shadow p-4 mb-3 flex justify-between items-center">
    <div>
        <p class="font-semibold">{{ $favorite->event->name }}</p>
        <p class="text-sm text-gray-500">{{ $favorite->event->sportType->name }} — {{ $favorite->event->lieu }}</p>
        <p class="text-sm text-gray-500">{{ $favorite->event->date->format('d/m/Y H:i') }}</p>
    </div>
    <div class="flex gap-2">
        <a href="{{ route('events.show', $favorite->event) }}" class="text-sm bg-indigo-600 text-white px-3 py-1 rounded">Voir</a>
        <form method="POST" action="{{ route('favorites.destroy', $favorite->event) }}">
            @csrf @method('DELETE')
            <button class="text-sm bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Retirer</button>
        </form>
    </div>
</div>
@empty
<p class="text-gray-500">Aucun favori pour l'instant.</p>
@endforelse
@endsection
