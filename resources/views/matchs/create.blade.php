@extends('layouts.app')
@section('title', 'Planifier un match')

@section('content')
<div class="max-w-xl mx-auto bg-white rounded-lg shadow p-6">
    <h1 class="text-xl font-bold mb-6">Planifier un match — {{ $event->name }}</h1>
    <form method="POST" action="{{ route('matchs.store', $event) }}">
        @csrf
        @include('matchs._form')
        <button class="mt-4 bg-indigo-600 text-white px-6 py-2 rounded hover:bg-indigo-700">Planifier</button>
    </form>
</div>
@endsection
