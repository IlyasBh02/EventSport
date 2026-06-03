@extends('layouts.app')
@section('title', 'Mes inscriptions')

@section('content')
<div class="page-header">
    <h1>Mes inscriptions</h1>
    <p>Gérez vos participations aux événements sportifs</p>
</div>

@forelse($inscriptions as $inscription)
@php
    $sportName = $inscription->event->sportType->name;
    $bannerColors = [
        'Football'=>'#047857','Basketball'=>'#c2410c','Tennis'=>'#b45309',
        'Volleyball'=>'#1d4ed8','Natation'=>'#0369a1','Cyclisme'=>'#7c3aed','Athlétisme'=>'#be123c',
    ];
    $color = $bannerColors[$sportName] ?? '#6366f1';
@endphp
<div style="background:var(--bg-card);border:1px solid var(--border);border-radius:16px;padding:1.25rem 1.5rem;margin-bottom:1rem;display:flex;flex-wrap:wrap;align-items:center;justify-content:space-between;gap:1rem;transition:border-color 0.2s,box-shadow 0.2s;"
     onmouseover="this.style.borderColor='rgba(99,102,241,0.3)';this.style.boxShadow='0 8px 30px rgba(0,0,0,0.3)'"
     onmouseout="this.style.borderColor='rgba(255,255,255,0.07)';this.style.boxShadow='none'">
    <div style="display:flex;align-items:center;gap:1rem;">
        <div style="width:46px;height:46px;border-radius:14px;background:{{ $color }}22;border:1px solid {{ $color }}44;display:flex;align-items:center;justify-content:center;font-size:1.25rem;font-weight:800;color:{{ $color }};flex-shrink:0;">
            {{ strtoupper(substr($inscription->event->name, 0, 1)) }}
        </div>
        <div>
            <p style="font-weight:700;color:#f1f5f9;margin-bottom:0.2rem;">{{ $inscription->event->name }}</p>
            <p style="font-size:0.8rem;color:#64748b;display:flex;align-items:center;gap:0.4rem;">
                <span style="color:{{ $color }};font-weight:600;">{{ $sportName }}</span>
                <span>·</span>
                <svg style="width:12px;height:12px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                {{ $inscription->event->lieu }}
            </p>
            <p style="font-size:0.78rem;color:#475569;margin-top:0.2rem;display:flex;align-items:center;gap:0.4rem;">
                <svg style="width:12px;height:12px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                {{ $inscription->event->date->format('d M Y à H:i') }}
            </p>
            <span class="badge {{ $inscription->statut === 'confirmee' ? 'badge-confirmed' : 'badge-cancelled' }}" style="margin-top:0.5rem;">
                @if($inscription->statut === 'confirmee')
                <svg style="width:10px;height:10px;" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                Confirmée
                @else
                <svg style="width:10px;height:10px;" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/></svg>
                Annulée
                @endif
            </span>
        </div>
    </div>
    <div style="display:flex;align-items:center;gap:0.5rem;">
        <a href="{{ route('events.show', $inscription->event) }}" class="btn btn-primary btn-sm">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
            Voir
        </a>
        @if($inscription->statut === 'confirmee')
        <form method="POST" action="{{ route('inscriptions.destroy', $inscription) }}" style="margin:0;">
            @csrf @method('DELETE')
            <button class="btn btn-danger btn-sm">Annuler</button>
        </form>
        @endif
    </div>
</div>
@empty
<div class="empty-state">
    <div class="empty-icon">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
    </div>
    <h3>Aucune inscription</h3>
    <p>Vous n'êtes inscrit à aucun événement pour l'instant</p>
    <a href="{{ route('events.index') }}" class="btn btn-primary">Découvrir les événements</a>
</div>
@endforelse
@endsection
