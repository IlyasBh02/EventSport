@extends('layouts.app')
@section('title', 'Saisir le score')

@section('content')
<div class="max-w-md mx-auto bg-white rounded-lg shadow p-6">
    <h1 class="text-xl font-bold mb-2">Score : {{ $match->equipe_a }} vs {{ $match->equipe_b }}</h1>
    <p class="text-sm text-gray-500 mb-6">{{ $event->name }}</p>
    <form method="POST" action="{{ route('matchs.saveScore', [$event, $match]) }}">
        @csrf
        <div class="flex gap-4 items-center">
            <div class="flex-1">
                <label class="block text-sm font-medium text-gray-700">{{ $match->equipe_a }}</label>
                <input type="number" name="score_a" value="{{ old('score_a', $match->scores->first()?->score_a ?? 0) }}" min="0" class="mt-1 w-full border rounded px-3 py-2">
            </div>
            <span class="text-2xl font-bold text-gray-400 mt-5">-</span>
            <div class="flex-1">
                <label class="block text-sm font-medium text-gray-700">{{ $match->equipe_b }}</label>
                <input type="number" name="score_b" value="{{ old('score_b', $match->scores->first()?->score_b ?? 0) }}" min="0" class="mt-1 w-full border rounded px-3 py-2">
            </div>
        </div>
        <button class="mt-6 w-full bg-indigo-600 text-white py-2 rounded hover:bg-indigo-700">Enregistrer</button>
    </form>
</div>
@endsection
