@extends('layouts.app')
@section('title', 'Événements Sportifs')

@section('content')
{{-- Page header --}}
<div style="display:flex;flex-wrap:wrap;align-items:center;justify-content:space-between;gap:1rem;margin-bottom:2rem;">
    <div>
        <h1 style="font-size:1.75rem;font-weight:800;color:#f1f5f9;letter-spacing:-0.02em;">Événements sportifs</h1>
        <p style="color:#64748b;font-size:0.875rem;margin-top:0.3rem;">{{ $events->total() }} événement(s) disponible(s)</p>
    </div>
    @auth
        @if(auth()->user()->isAdmin() || auth()->user()->isOrganisateur())
        <a href="{{ route('events.create') }}" class="btn btn-primary">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
            Créer un événement
        </a>
        @endif
    @endauth
</div>

{{-- Filters --}}
<div class="card" style="margin-bottom:2rem;">
    <div class="card-body">
        <form method="GET">
            <div style="display:flex;flex-wrap:wrap;align-items:flex-end;gap:1rem;">
                <div style="flex:1;min-width:180px;">
                    <label class="form-label">
                        <svg style="width:13px;height:13px;display:inline;margin-right:4px;color:#818cf8;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 6h18M3 14h18M3 18h18"/></svg>
                        Type de sport
                    </label>
                    <input type="text" name="sport" value="{{ request('sport') }}" placeholder="Ex: Football"
                           class="form-input">
                </div>
                <div style="flex:1;min-width:180px;">
                    <label class="form-label">
                        <svg style="width:13px;height:13px;display:inline;margin-right:4px;color:#818cf8;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                        Lieu
                    </label>
                    <input type="text" name="lieu" value="{{ request('lieu') }}" placeholder="Ex: Casablanca"
                           class="form-input">
                </div>
                <div style="display:flex;gap:0.5rem;flex-shrink:0;">
                    @if(request('sport') || request('lieu'))
                    <a href="{{ route('events.index') }}" class="btn btn-secondary">Réinitialiser</a>
                    @endif
                    <button type="submit" class="btn btn-primary">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        Rechercher
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- Events grid --}}
<div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(300px,1fr));gap:1.5rem;">
    @forelse($events as $event)
    @php
        $filled    = $event->inscriptions->where('statut','confirmee')->count();
        $remaining = $event->capacite_max - $filled;
        $isFull    = $remaining <= 0;
        $isLimited = $remaining > 0 && $remaining <= 5;
        $pct       = $event->capacite_max > 0 ? min(100, round($filled / $event->capacite_max * 100)) : 0;
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
    <div class="event-card">
        <div class="event-banner" style="background:{{ $banner }};">
            <span class="event-banner-letter">{{ strtoupper(substr($sportName,0,1)) }}</span>
            <span class="event-banner-badge {{ $isFull ? 'badge-full' : ($isLimited ? 'badge-limited' : 'badge-available') }}">
                {{ $isFull ? 'Complet' : ($isLimited ? 'Limité' : 'Disponible') }}
            </span>
            <span class="event-sport-badge">{{ $sportName }}</span>
        </div>
        <div class="event-body">
            <h3 class="event-title">{{ $event->name }}</h3>
            <div class="event-meta">
                <div class="event-meta-item">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                    {{ $event->lieu }}
                </div>
                <div class="event-meta-item">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    {{ $event->date->format('d M Y — H:i') }}
                </div>
                <div class="event-meta-item">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    {{ $remaining > 0 ? $remaining . ' place(s) restante(s)' : 'Complet' }}
                </div>
            </div>
            <div class="capacity-bar-wrap">
                <div class="capacity-bar-bg">
                    <div class="capacity-bar-fill {{ $isFull ? 'full' : ($isLimited ? 'limited' : '') }}" style="width:{{ $pct }}%;"></div>
                </div>
                <div class="capacity-label">
                    <span>{{ $filled }} inscrits</span>
                    <span>{{ $event->capacite_max }} max</span>
                </div>
            </div>
        </div>
        <div class="event-actions">
            <a href="{{ route('events.show', $event) }}" class="btn btn-primary btn-sm">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                Voir les détails
            </a>
            @auth
            <form method="POST" action="{{ route('favorites.store', $event) }}" style="margin:0;">
                @csrf
                <button class="btn btn-warning btn-sm">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                    Favori
                </button>
            </form>
            @endauth
        </div>
    </div>
    @empty
    <div class="empty-state" style="grid-column:1/-1;">
        <div class="empty-icon">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
        </div>
        <h3>Aucun événement trouvé</h3>
        <p>Essayez d'autres critères de recherche.</p>
        <a href="{{ route('events.index') }}" class="btn btn-primary">Voir tous les événements</a>
    </div>
    @endforelse
</div>

<div style="margin-top:2rem;">{{ $events->withQueryString()->links() }}</div>
@endsection
