@extends('layouts.app')
@section('title', 'Mon profil')

@section('content')
<div class="max-w-xl mx-auto bg-white rounded-lg shadow p-6">
    <h1 class="text-xl font-bold mb-6">Mon profil</h1>
    <form method="POST" action="{{ route('profile.update') }}">
        @csrf @method('PUT')
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Nom</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" class="mt-1 w-full border rounded px-3 py-2 @error('name') border-red-500 @enderror">
                @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" class="mt-1 w-full border rounded px-3 py-2 @error('email') border-red-500 @enderror">
                @error('email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Nouveau mot de passe <span class="text-gray-400">(optionnel)</span></label>
                <input type="password" name="password" class="mt-1 w-full border rounded px-3 py-2">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Confirmer le mot de passe</label>
                <input type="password" name="password_confirmation" class="mt-1 w-full border rounded px-3 py-2">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Rôle</label>
                <p class="mt-1 px-3 py-2 bg-gray-50 border rounded text-gray-600 capitalize">{{ $user->role }}</p>
            </div>
        </div>
        <button class="mt-6 bg-indigo-600 text-white px-6 py-2 rounded hover:bg-indigo-700">Enregistrer</button>
    </form>
</div>
@endsection
