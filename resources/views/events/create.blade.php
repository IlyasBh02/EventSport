@extends('layouts.app')
@section('title', 'Créer un événement')
@section('content')

<a href="{{ route('events.index') }}" class="back-link">
    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
    Retour aux événements
</a>

<div style="max-width:680px;margin:0 auto;">
    <div class="page-header">
        <h1>Créer un événement</h1>
        <p>Remplissez les informations pour publier votre événement sportif</p>
    </div>
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('events.store') }}">
                @csrf
                @include('events._form')
                <div style="display:flex;gap:0.75rem;margin-top:2rem;padding-top:1.5rem;border-top:1px solid rgba(255,255,255,0.06);">
                    <button type="submit" class="btn btn-primary btn-lg">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                        Créer l'événement
                    </button>
                    <a href="{{ route('events.index') }}" class="btn btn-secondary btn-lg">Annuler</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
