@extends('layouts.app')
@section('title', 'Modifier l\'événement')

@section('content')
<div class="max-w-2xl mx-auto bg-white rounded-lg shadow p-6">
    <h1 class="text-xl font-bold mb-6">Modifier : {{ $event->name }}</h1>
    <form method="POST" action="{{ route('events.update', $event) }}">
        @csrf @method('PUT')
        @include('events._form')
        <button class="mt-4 bg-indigo-600 text-white px-6 py-2 rounded hover:bg-indigo-700">Mettre à jour</button>
    </form>
</div>
@endsection
