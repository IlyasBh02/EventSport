@extends('layouts.app')
@section('title', 'Dashboard Admin')

@section('content')
<h1 class="text-2xl font-bold mb-6">Dashboard Administrateur</h1>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-white rounded-lg shadow p-6 text-center">
        <p class="text-4xl font-bold text-indigo-600">{{ $totalEvents }}</p>
        <p class="text-gray-500 mt-1">Événements</p>
    </div>
    <div class="bg-white rounded-lg shadow p-6 text-center">
        <p class="text-4xl font-bold text-green-600">{{ $totalParticipants }}</p>
        <p class="text-gray-500 mt-1">Participants</p>
    </div>
    <div class="bg-white rounded-lg shadow p-6 text-center">
        <p class="text-4xl font-bold text-yellow-600">{{ $totalMatchs }}</p>
        <p class="text-gray-500 mt-1">Matchs programmés</p>
    </div>
</div>

<h2 class="text-xl font-semibold mb-4">Événements les plus populaires</h2>
<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 text-gray-600">
            <tr>
                <th class="px-4 py-3 text-left">Événement</th>
                <th class="px-4 py-3 text-left">Sport</th>
                <th class="px-4 py-3 text-left">Lieu</th>
                <th class="px-4 py-3 text-center">Inscriptions</th>
            </tr>
        </thead>
        <tbody class="divide-y">
            @foreach($popularEvents as $event)
            <tr>
                <td class="px-4 py-3"><a href="{{ route('events.show', $event) }}" class="text-indigo-600 hover:underline">{{ $event->name }}</a></td>
                <td class="px-4 py-3">{{ $event->sportType->name }}</td>
                <td class="px-4 py-3">{{ $event->lieu }}</td>
                <td class="px-4 py-3 text-center font-semibold">{{ $event->inscriptions_count }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
