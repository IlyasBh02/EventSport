@extends('layouts.app')
@section('title', 'Saisir le score')

@section('content')
<div class="max-w-md mx-auto">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-slate-800">Saisir le score</h1>
        <p class="text-slate-500 text-sm mt-1">{{ $event->name }}</p>
    </div>
    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm p-8">

        {{-- Teams display --}}
        <div class="flex items-center justify-between gap-4 mb-8 pb-6 border-b border-slate-100">
            <div class="text-center flex-1">
                <div class="w-12 h-12 bg-indigo-100 rounded-xl flex items-center justify-center text-indigo-700 font-bold text-lg mx-auto mb-2">
                    {{ strtoupper(substr($match->equipe_a, 0, 1)) }}
                </div>
                <p class="font-semibold text-slate-800 text-sm">{{ $match->equipe_a }}</p>
            </div>
            <span class="text-slate-300 font-bold text-xl">VS</span>
            <div class="text-center flex-1">
                <div class="w-12 h-12 bg-rose-100 rounded-xl flex items-center justify-center text-rose-700 font-bold text-lg mx-auto mb-2">
                    {{ strtoupper(substr($match->equipe_b, 0, 1)) }}
                </div>
                <p class="font-semibold text-slate-800 text-sm">{{ $match->equipe_b }}</p>
            </div>
        </div>

        <form method="POST" action="{{ route('matchs.saveScore', [$event, $match]) }}">
            @csrf
            <div class="flex items-center gap-4">
                <div class="flex-1">
                    <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wide text-center mb-2">
                        {{ $match->equipe_a }}
                    </label>
                    <input type="number" name="score_a"
                           value="{{ old('score_a', $match->scores->first()?->score_a ?? 0) }}"
                           min="0"
                           class="w-full border-2 border-indigo-200 bg-indigo-50 rounded-xl px-4 py-4 text-3xl font-bold text-indigo-700 text-center focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition">
                </div>
                <span class="text-slate-300 font-bold text-3xl mt-6">—</span>
                <div class="flex-1">
                    <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wide text-center mb-2">
                        {{ $match->equipe_b }}
                    </label>
                    <input type="number" name="score_b"
                           value="{{ old('score_b', $match->scores->first()?->score_b ?? 0) }}"
                           min="0"
                           class="w-full border-2 border-rose-200 bg-rose-50 rounded-xl px-4 py-4 text-3xl font-bold text-rose-700 text-center focus:outline-none focus:ring-2 focus:ring-rose-400 focus:border-transparent transition">
                </div>
            </div>
            <div class="flex gap-3 mt-8 pt-6 border-t border-slate-100">
                <button type="submit"
                        class="flex-1 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-xl transition-colors">
                    Enregistrer le score
                </button>
                <a href="{{ route('events.show', $event) }}"
                   class="px-5 py-2.5 border border-slate-200 hover:bg-slate-50 text-slate-600 text-sm font-medium rounded-xl transition-colors">
                    Retour
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
