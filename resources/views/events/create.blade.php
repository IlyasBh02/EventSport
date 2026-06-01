@extends('layouts.app')
@section('title', 'Créer un événement')

@section('content')
<div class="max-w-2xl mx-auto bg-white rounded-lg shadow p-6">
    <h1 class="text-xl font-bold mb-6">Créer un événement</h1>
    <form method="POST" action="{{ route('events.store') }}">
        @csrf
        @include('events._form')
        <button class="mt-4 bg-indigo-600 text-white px-6 py-2 rounded hover:bg-indigo-700">Créer</button>
    </form>
</div>
@endsection
