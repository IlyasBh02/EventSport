@extends('layouts.app')
@section('title', 'Dashboard Admin')

@section('content')
<div class="mb-8">
    <h1 class="text-2xl font-bold text-slate-800">Dashboard Administrateur</h1>
    <p class="text-slate-500 text-sm mt-1">Vue d'ensemble de la plateforme</p>
</div>
{{-- Action Actions --}}
<div class="flex flex-wrap gap-3 mb-8">
    <a href="{{ route('users.index') }}" class="inline-flex items-center gap-2 px-5 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-sm rounded-xl transition-all shadow-sm shadow-indigo-150">
        👥 Gérer les Utilisateurs
    </a>
    <a href="{{ route('sport-types.index') }}" class="inline-flex items-center gap-2 px-5 py-3 bg-slate-800 hover:bg-slate-900 text-white font-semibold text-sm rounded-xl transition-all shadow-sm shadow-slate-150">
        🏆 Gérer les Sports
    </a>
</div>

{{-- Stat cards --}}
<div class="grid grid-cols-1 sm:grid-cols-3 gap-5 mb-8">
    <div class="border border-slate-200 rounded-2xl p-6 shadow-sm flex items-center gap-4">
        <div class="w-12 h-12 bg-indigo-100 rounded-xl flex items-center justify-content text-2xl flex-shrink-0">🏆</div>
        <div>
            <p class="text-3xl font-bold text-slate-800">{{ $totalEvents }}</p>
            <p class="text-slate-500 text-sm font-medium mt-0.5">Événements</p>
        </div>
    </div>
    <div class="border border-slate-200 rounded-2xl p-6 shadow-sm flex items-center gap-4">
        <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center text-2xl flex-shrink-0">👥</div>
        <div>
            <p class="text-3xl font-bold text-slate-800">{{ $totalParticipants }}</p>
            <p class="text-slate-500 text-sm font-medium mt-0.5">Participants</p>
        </div>
    </div>
    <div class="border border-slate-200 rounded-2xl p-6 shadow-sm flex items-center gap-4">
        <div class="w-12 h-12 bg-amber-100 rounded-xl flex items-center justify-center text-2xl flex-shrink-0">🥊</div>
        <div>
            <p class="text-3xl font-bold text-slate-800">{{ $totalMatchs }}</p>
            <p class="text-slate-500 text-sm font-medium mt-0.5">Matchs programmés</p>
        </div>
    </div>
</div>

{{-- Popular events table --}}
<div class="border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
    <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
        <div>
            <h2 class="text-base font-bold text-slate-800">Événements les plus populaires</h2>
            <p class="text-slate-400 text-xs mt-0.5">Classés par nombre d'inscriptions confirmées</p>
        </div>
        <a href="{{ route('events.index') }}" class="text-sm text-indigo-600 hover:underline font-medium">
            Voir tous →
        </a>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="bg-slate-50 text-xs font-semibold text-slate-500 uppercase tracking-wider">
                    <th class="px-6 py-3 text-left">Événement</th>
                    <th class="px-6 py-3 text-left">Sport</th>
                    <th class="px-6 py-3 text-left">Lieu</th>
                    <th class="px-6 py-3 text-center">Inscriptions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @foreach($popularEvents as $event)
                <tr class="hover:bg-slate-50 transition-colors">
                    <td class="px-6 py-4">
                        <a href="{{ route('events.show', $event) }}"
                           class="font-semibold text-indigo-600 hover:text-indigo-800 hover:underline">
                            {{ $event->name }}
                        </a>
                    </td>
                    <td class="px-6 py-4">
                        <span class="text-xs bg-indigo-100 text-indigo-700 font-semibold px-2.5 py-1 rounded-full">
                            {{ $event->sportType->name }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-slate-600">{{ $event->lieu }}</td>
                    <td class="px-6 py-4 text-center">
                        <span class="font-bold text-slate-800">{{ $event->inscriptions_count }}</span>
                        <span class="text-slate-400">/{{ $event->capacite_max }}</span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
