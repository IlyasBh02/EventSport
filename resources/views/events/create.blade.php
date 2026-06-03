@extends('layouts.app')
@section('title', 'Créer un événement')
@section('content')
<div class="max-w-2xl mx-auto">
    <h2 class="text-3xl font-extrabold text-gray-900 mb-2">Créer un événement</h2>
    <p class="text-gray-500 text-sm mb-6">Remplissez les informations ci-dessous</p>
    <div class="bg-white rounded-lg shadow-lg p-8">
        <form method="POST" action="{{ route('events.store') }}">
            @csrf
            @include('events._form')
            <div class="flex gap-3 mt-8 pt-6 border-t border-gray-100">
                <button type="submit" class="inline-flex justify-center py-2.5 px-6 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Créer l'événement
                </button>
                <a href="{{ route('events.index') }}" class="inline-flex justify-center py-2.5 px-5 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                    Annuler
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
