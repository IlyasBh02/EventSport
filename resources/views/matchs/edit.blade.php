@extends('layouts.app')
@section('title', 'Modifier le match')

@section('content')
<div class="max-w-xl mx-auto bg-white rounded-lg shadow p-6">
    <h1 class="text-xl font-bold mb-6">Modifier le match</h1>
    <form method="POST" action="{{ route('matchs.update', [$event, $match]) }}">
        @csrf @method('PUT')
        @include('matchs._form')
        <button class="mt-4 bg-indigo-600 text-white px-6 py-2 rounded hover:bg-indigo-700">Mettre à jour</button>
    </form>
</div>
@endsection
