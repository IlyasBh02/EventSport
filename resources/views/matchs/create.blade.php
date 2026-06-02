@extends('layouts.app')
@section('title', 'Planifier un match')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-slate-800">Planifier un match</h1>
        <p class="text-slate-500 text-sm mt-1">{{ $event->name }}</p>
    </div>
    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm p-8">
        <form method="POST" action="{{ route('matchs.store', $event) }}">
            @csrf
            @include('matchs._form')
            <div class="flex gap-3 mt-8 pt-6 border-t border-slate-100">
                <button type="submit"
                        class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-xl transition-colors">
                    Planifier le match
                </button>
                <a href="{{ route('events.show', $event) }}"
                   class="px-5 py-2.5 border border-slate-200 hover:bg-slate-50 text-slate-600 text-sm font-medium rounded-xl transition-colors">
                    Annuler
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
