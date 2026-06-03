@extends('layouts.app')
@section('title', 'Inscription — EventSport')

@section('content')
@push('styles')
<style>
    .form-section {
        background-image: url('https://images.unsplash.com/photo-1517649763962-0c623066013b?ixlib=rb-4.0.3&auto=format&fit=crop&w=1470&q=80');
        background-size: cover;
        background-position: center;
        position: relative;
    }
    .form-overlay {
        background: rgba(0,0,0,0.55);
    }
    .form-container {
        background-color: rgba(255,255,255,0.97);
    }
</style>
@endpush

<div class="form-section -mx-6 -mt-8 min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="form-overlay absolute inset-0"></div>

    <div class="form-container relative z-10 max-w-md w-full space-y-8 p-10 rounded-xl shadow-xl">

        {{-- Brand --}}
        <div>
            <div class="flex justify-center items-center gap-2">
                <span class="text-blue-600 font-bold text-3xl">EVENT</span>
                <span class="text-gray-800 font-bold text-3xl">SPORT</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-9 w-9 ml-1 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                </svg>
            </div>
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">Créer votre compte</h2>
            <p class="mt-2 text-center text-sm text-gray-600">Rejoignez la communauté sportive EventSport</p>
        </div>

        <form class="mt-8 space-y-6" action="{{ route('register') }}" method="POST">
            @csrf

            @if($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/></svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-red-700">Veuillez corriger les erreurs suivantes :</p>
                        <ul class="mt-2 list-disc list-inside text-sm text-red-700">
                            @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                        </ul>
                    </div>
                </div>
            </div>
            @endif

            <div class="rounded-md shadow-sm -space-y-px">
                <div>
                    <label for="name" class="sr-only">Nom complet</label>
                    <input id="name" name="name" type="text" autocomplete="name" required value="{{ old('name') }}"
                           class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm"
                           placeholder="Nom complet">
                </div>
                <div>
                    <label for="email" class="sr-only">Adresse email</label>
                    <input id="email" name="email" type="email" autocomplete="email" required value="{{ old('email') }}"
                           class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm"
                           placeholder="Adresse email">
                </div>
                <div>
                    <label for="password" class="sr-only">Mot de passe</label>
                    <input id="password" name="password" type="password" autocomplete="new-password" required
                           class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm"
                           placeholder="Mot de passe">
                </div>
                <div>
                    <label for="password_confirmation" class="sr-only">Confirmer le mot de passe</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required
                           class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm"
                           placeholder="Confirmer le mot de passe">
                </div>
            </div>

            {{-- Role selection — same card style as SURF WITH US --}}
            <div class="mt-4">
                <p class="text-sm font-medium text-gray-700 mb-2">Je souhaite m'inscrire en tant que :</p>
                <div class="grid grid-cols-2 gap-4">
                    <label class="relative bg-white rounded-lg border border-gray-300 p-4 flex cursor-pointer hover:border-blue-500 focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                        <input type="radio" name="role" value="participant" class="sr-only" {{ old('role', 'participant') === 'participant' ? 'checked' : '' }}>
                        <div class="flex items-center justify-center w-full">
                            <div class="text-sm flex flex-col items-center">
                                <svg class="text-blue-500 w-8 h-8 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                <p class="font-medium text-gray-900">Participant</p>
                                <p class="text-gray-500 text-xs text-center mt-1">Rejoindre des événements</p>
                            </div>
                        </div>
                        <div class="absolute -inset-px rounded-lg border-2 pointer-events-none role-border" aria-hidden="true"></div>
                    </label>

                    <label class="relative bg-white rounded-lg border border-gray-300 p-4 flex cursor-pointer hover:border-blue-500 focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                        <input type="radio" name="role" value="organisateur" class="sr-only" {{ old('role') === 'organisateur' ? 'checked' : '' }}>
                        <div class="flex items-center justify-center w-full">
                            <div class="text-sm flex flex-col items-center">
                                <svg class="text-blue-500 w-8 h-8 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                                <p class="font-medium text-gray-900">Organisateur</p>
                                <p class="text-gray-500 text-xs text-center mt-1">Créer des événements</p>
                            </div>
                        </div>
                        <div class="absolute -inset-px rounded-lg border-2 pointer-events-none role-border" aria-hidden="true"></div>
                    </label>
                </div>
                @error('role')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <button type="submit"
                        class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                        <svg class="h-5 w-5 text-blue-400 group-hover:text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                    </span>
                    Créer mon compte
                </button>
            </div>

            <div class="text-sm text-center mt-4">
                <p class="text-gray-600">
                    Déjà un compte ?
                    <a href="{{ route('login') }}" class="font-medium text-blue-600 hover:text-blue-500">Se connecter</a>
                </p>
            </div>

            <div class="mt-6 border-t border-gray-200 pt-4">
                <div class="text-xs text-gray-500">
                    <p><strong>Note :</strong> Les comptes admin sont créés directement en base de données.</p>
                </div>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const roleInputs = document.querySelectorAll('input[name="role"]');
        roleInputs.forEach(input => {
            input.addEventListener('change', function () {
                document.querySelectorAll('input[name="role"]').forEach(r => {
                    r.closest('label').querySelector('.role-border').classList.remove('border-blue-500');
                });
                if (this.checked) {
                    this.closest('label').querySelector('.role-border').classList.add('border-blue-500');
                }
            });
        });
        const checked = document.querySelector('input[name="role"]:checked');
        if (checked) checked.closest('label').querySelector('.role-border').classList.add('border-blue-500');
    });
</script>
@endpush
@endsection
