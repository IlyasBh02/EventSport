@extends('layouts.app')
@section('title', 'Mes inscriptions')

@section('content')
<h1 class="text-2xl font-bold mb-6">Mes inscriptions</h1>

@forelse($inscriptions as $inscription)
<div class="bg-white rounded shadow p-4 mb-3 flex justify-between items-center">
    <div>
        <p class="font-semibold">{{ $inscription->event->name }}</p>
        <p class="text-sm text-gray-500">{{ $inscription->event->sportType->name }} — {{ $inscription->event->lieu }}</p>
        <p class="text-sm text-gray-500">{{ $inscription->event->date->format('d/m/Y H:i') }}</p>
        <span class="text-xs px-2 py-1 rounded {{ $inscription->statut === 'confirmee' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
            {{ ucfirst($inscription->statut) }}
        </span>
    </div>
    @if($inscription->statut === 'confirmee')
    <form method="POST" action="{{ route('inscriptions.destroy', $inscription) }}">
        @csrf @method('DELETE')
        <button class="text-sm bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Annuler</button>
    </form>
    @endif
</div>
@empty
<p class="text-gray-500">Vous n'êtes inscrit à aucun événement.</p>
@endforelse
@endsection
