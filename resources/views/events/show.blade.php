@extends('layouts.app')
@section('title', $event->name)

@section('content')
@php
    $filled    = $event->inscriptions->where('statut','confirmee')->count();
    $remaining = $event->capacite_max - $filled;
    $isFull    = $remaining <= 0;
    $pct       = $event->capacite_max > 0 ? min(100, round($filled/$event->capacite_max*100)) : 0;
    $sportName = $event->sportType->name;
    $bannerColors = [
        'Football'   => 'linear-gradient(135deg,#047857,#065f46)',
        'Basketball' => 'linear-gradient(135deg,#c2410c,#9a3412)',
        'Tennis'     => 'linear-gradient(135deg,#b45309,#92400e)',
        'Volleyball' => 'linear-gradient(135deg,#1d4ed8,#1e40af)',
        'Natation'   => 'linear-gradient(135deg,#0369a1,#075985)',
        'Cyclisme'   => 'linear-gradient(135deg,#7c3aed,#5b21b6)',
        'Athlétisme' => 'linear-gradient(135deg,#be123c,#9f1239)',
    ];
    $banner = $bannerColors[$sportName] ?? 'linear-gradient(135deg,#6366f1,#8b5cf6)';
@endphp

<a href="{{ route('events.index') }}" class="back-link">
    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
    Retour aux événements
</a>

{{-- Hero banner --}}
<div style="background:{{ $banner }};border-radius:20px;padding:2.5rem;margin-bottom:1.5rem;position:relative;overflow:hidden;">
    <div style="position:absolute;inset:0;display:flex;align-items:center;justify-content:center;font-size:8rem;font-weight:900;color:rgba(255,255,255,0.07);letter-spacing:-0.04em;pointer-events:none;">
        {{ strtoupper(substr($sportName,0,1)) }}
    </div>
    <div style="position:relative;z-index:1;display:flex;flex-wrap:wrap;align-items:flex-start;justify-content:space-between;gap:1rem;">
        <div>
            <span style="display:inline-block;font-size:0.72rem;font-weight:700;padding:0.2rem 0.7rem;border-radius:99px;background:rgba(255,255,255,0.2);color:#fff;letter-spacing:0.06em;text-transform:uppercase;margin-bottom:0.75rem;backdrop-filter:blur(8px);">
                {{ $sportName }}
            </span>
            <h1 style="font-size:2rem;font-weight:900;color:#fff;letter-spacing:-0.03em;line-height:1.1;">{{ $event->name }}</h1>
        </div>
        <div style="display:flex;gap:0.5rem;flex-wrap:wrap;">
            @if(auth()->user()?->isAdmin() || auth()->id() === $event->user_id)
            <a href="{{ route('events.edit', $event) }}" class="btn btn-secondary btn-sm" style="background:rgba(255,255,255,0.15);border-color:rgba(255,255,255,0.2);color:#fff;">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                Modifier
            </a>
            @endif
            @if(auth()->user()?->isAdmin())
            <form method="POST" action="{{ route('events.destroy', $event) }}" onsubmit="return confirm('Supprimer cet événement ?')" style="margin:0;">
                @csrf @method('DELETE')
                <button class="btn btn-danger btn-sm">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                    Supprimer
                </button>
            </form>
            @endif
        </div>
    </div>
    {{-- Meta chips --}}
    <div style="display:flex;flex-wrap:wrap;gap:0.75rem;margin-top:1.5rem;position:relative;z-index:1;">
        <span style="display:inline-flex;align-items:center;gap:0.4rem;padding:0.35rem 0.85rem;background:rgba(0,0,0,0.3);border-radius:8px;font-size:0.82rem;color:#fff;backdrop-filter:blur(8px);">
            <svg style="width:14px;height:14px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
            {{ $event->lieu }}
        </span>
        <span style="display:inline-flex;align-items:center;gap:0.4rem;padding:0.35rem 0.85rem;background:rgba(0,0,0,0.3);border-radius:8px;font-size:0.82rem;color:#fff;backdrop-filter:blur(8px);">
            <svg style="width:14px;height:14px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            {{ $event->date->format('d M Y à H:i') }}
        </span>
        <span style="display:inline-flex;align-items:center;gap:0.4rem;padding:0.35rem 0.85rem;background:rgba(0,0,0,0.3);border-radius:8px;font-size:0.82rem;color:{{ $isFull ? '#fca5a5' : '#6ee7b7' }};backdrop-filter:blur(8px);">
            <svg style="width:14px;height:14px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            {{ $filled }}/{{ $event->capacite_max }} participants
        </span>
    </div>
</div>

<div style="display:grid;grid-template-columns:1fr;gap:1.5rem;">
    @auth
    @php
        $userInscription = $event->inscriptions->where('user_id', auth()->id())->where('statut','confirmee')->first();
        $isFavorited     = auth()->user()->favorites()->where('event_id', $event->id)->exists();
    @endphp

    {{-- Action sidebar (top on mobile) --}}
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;">
        {{-- Registration --}}
        <div class="card" style="padding:1.5rem;">
            <p style="font-size:0.8rem;font-weight:700;text-transform:uppercase;letter-spacing:0.08em;color:#64748b;margin-bottom:1rem;">Participation</p>
            @if($userInscription)
                <p style="font-size:0.82rem;color:#6ee7b7;margin-bottom:0.75rem;display:flex;align-items:center;gap:0.4rem;">
                    <svg style="width:16px;height:16px;flex-shrink:0;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    Vous êtes inscrit(e)
                </p>
                <form method="POST" action="{{ route('inscriptions.destroy', $userInscription) }}" style="margin:0;">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger btn-block btn-sm">Annuler mon inscription</button>
                </form>
            @elseif($isFull)
                <div style="background:rgba(239,68,68,0.08);border:1px solid rgba(239,68,68,0.2);border-radius:10px;padding:0.85rem;font-size:0.82rem;color:#fca5a5;">
                    <strong>Événement complet</strong><br>Plus de places disponibles.
                </div>
            @else
                <div class="capacity-bar-wrap" style="margin-bottom:1rem;">
                    <div class="capacity-bar-bg"><div class="capacity-bar-fill" style="width:{{ $pct }}%;"></div></div>
                    <div class="capacity-label"><span>{{ $filled }} inscrits</span><span>{{ $event->capacite_max }} max</span></div>
                </div>
                <form method="POST" action="{{ route('inscriptions.store', $event) }}" style="margin:0;">
                    @csrf
                    <button class="btn btn-success btn-block">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        S'inscrire
                    </button>
                </form>
            @endif
        </div>

        {{-- Favorites --}}
        <div class="card" style="padding:1.5rem;">
            <p style="font-size:0.8rem;font-weight:700;text-transform:uppercase;letter-spacing:0.08em;color:#64748b;margin-bottom:1rem;">Favoris</p>
            @if($isFavorited)
                <p style="font-size:0.82rem;color:#fcd34d;margin-bottom:0.75rem;display:flex;align-items:center;gap:0.4rem;">
                    <svg style="width:16px;height:16px;flex-shrink:0;" fill="currentColor" viewBox="0 0 24 24"><path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                    Sauvegardé
                </p>
                <form method="POST" action="{{ route('favorites.destroy', $event) }}" style="margin:0;">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger btn-block btn-sm">Retirer des favoris</button>
                </form>
            @else
                <form method="POST" action="{{ route('favorites.store', $event) }}" style="margin:0;">
                    @csrf
                    <button class="btn btn-warning btn-block">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                        Ajouter aux favoris
                    </button>
                </form>
            @endif
        </div>
    </div>
    @endauth

    {{-- Description --}}
    @if($event->description)
    <div class="card">
        <div class="card-header"><h2>Description</h2></div>
        <div class="card-body">
            <p style="font-size:0.9rem;color:#94a3b8;line-height:1.7;">{{ $event->description }}</p>
        </div>
    </div>
    @endif

    {{-- Matches --}}
    <div class="card">
        <div class="card-header">
            <div>
                <h2>Matchs programmés</h2>
                <p>{{ $event->matchs->count() }} match(s)</p>
            </div>
            @if(auth()->user()?->isAdmin() || auth()->user()?->isOrganisateur())
            <a href="{{ route('matchs.create', $event) }}" class="btn btn-primary btn-sm">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                Ajouter
            </a>
            @endif
        </div>
        @forelse($event->matchs as $match)
        <div style="display:flex;align-items:center;justify-content:space-between;gap:1rem;padding:1rem 1.5rem;border-bottom:1px solid rgba(255,255,255,0.05);">
            <div style="display:flex;align-items:center;gap:1rem;flex:1;min-width:0;">
                <span style="font-weight:700;color:#f1f5f9;font-size:0.9rem;flex:1;text-align:right;truncate;">{{ $match->equipe_a }}</span>
                @if($match->scores->isNotEmpty())
                <span style="background:linear-gradient(135deg,#6366f1,#8b5cf6);color:#fff;font-weight:800;font-size:0.9rem;padding:0.35rem 0.85rem;border-radius:8px;flex-shrink:0;letter-spacing:0.04em;">
                    {{ $match->scores->first()->score_a }} — {{ $match->scores->first()->score_b }}
                </span>
                @else
                <span style="background:rgba(255,255,255,0.06);color:#64748b;font-weight:700;font-size:0.78rem;padding:0.35rem 0.75rem;border-radius:8px;flex-shrink:0;letter-spacing:0.06em;">VS</span>
                @endif
                <span style="font-weight:700;color:#f1f5f9;font-size:0.9rem;flex:1;text-align:left;truncate;">{{ $match->equipe_b }}</span>
            </div>
            <div style="display:flex;align-items:center;gap:0.5rem;flex-shrink:0;">
                <span style="font-size:0.72rem;color:#475569;">{{ $match->date_match->format('d M • H:i') }}</span>
                @if(auth()->user()?->isAdmin() || auth()->user()?->isOrganisateur())
                <a href="{{ route('matchs.edit', [$event, $match]) }}" class="btn btn-warning btn-sm">Modifier</a>
                <a href="{{ route('matchs.score', [$event, $match]) }}" class="btn btn-secondary btn-sm">Score</a>
                @endif
            </div>
        </div>
        @empty
        <div style="text-align:center;padding:3rem;color:#475569;font-size:0.875rem;">
            Aucun match planifié pour cet événement.
        </div>
        @endforelse
    </div>
</div>

@push('styles')
<style>
    @media(min-width:1024px) {
        .show-grid { display: grid !important; grid-template-columns: 1fr 340px; }
    }
</style>
@endpush
@endsection
