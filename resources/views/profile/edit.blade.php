@extends('layouts.app')
@section('title', 'Mon profil')

@section('content')
<div class="max-w-xl mx-auto">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-slate-800">Mon profil</h1>
        <p class="text-slate-500 text-sm mt-1">Gérez vos informations personnelles</p>
    </div>

    {{-- Profile card --}}
    <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm mb-5 flex items-center gap-4">
        <div class="w-14 h-14 rounded-2xl flex items-center justify-center text-white font-bold text-xl flex-shrink-0
            {{ $user->isAdmin() ? 'bg-purple-600' : ($user->isOrganisateur() ? 'bg-emerald-600' : 'bg-indigo-600') }}">
            {{ strtoupper(substr($user->name, 0, 1)) }}
        </div>
        <div>
            <p class="font-bold text-slate-800 text-lg">{{ $user->name }}</p>
            <p class="text-slate-500 text-sm">{{ $user->email }}</p>
            <span class="inline-block mt-1.5 text-xs font-semibold px-2.5 py-1 rounded-full capitalize
                {{ $user->isAdmin() ? 'bg-purple-100 text-purple-700' : ($user->isOrganisateur() ? 'bg-emerald-100 text-emerald-700' : 'bg-sky-100 text-sky-700') }}">
                {{ $user->role }}
            </span>
        </div>
    </div>

    {{-- Edit form --}}
    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm p-8">
        <form method="POST" action="{{ route('profile.update') }}">
            @csrf @method('PUT')
            <div class="space-y-5">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Nom</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}"
                           class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition @error('name') border-red-400 bg-red-50 @enderror">
                    @error('name')<p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Email</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}"
                           class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition @error('email') border-red-400 bg-red-50 @enderror">
                    @error('email')<p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>@enderror
                </div>
                <div class="pt-4 border-t border-slate-100">
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wide mb-4">Changer le mot de passe</p>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1.5">
                                Nouveau mot de passe <span class="text-slate-400 font-normal">(optionnel)</span>
                            </label>
                            <input type="password" name="password"
                                   class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Confirmer</label>
                            <input type="password" name="password_confirmation"
                                   class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition">
                        </div>
                    </div>
                </div>
                <div class="pt-2">
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Rôle</label>
                    <p class="px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-600 capitalize">
                        {{ $user->role }}
                    </p>
                </div>
            </div>
            <div class="flex gap-3 mt-8 pt-6 border-t border-slate-100">
                <button type="submit"
                        class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-xl transition-colors">
                    Enregistrer
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
