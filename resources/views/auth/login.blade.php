@extends('layouts.app')
@section('title', 'Connexion — EventSport')

@push('styles')
<style>
    .auth-page {
        min-height: calc(100vh - 64px);
        display: flex; align-items: center; justify-content: center;
        padding: 2rem 1rem;
        position: relative;
        overflow: hidden;
    }
    .auth-bg {
        position: absolute; inset: 0;
        background: radial-gradient(ellipse 80% 60% at 50% -10%, rgba(99,102,241,0.18) 0%, transparent 60%),
                    radial-gradient(ellipse 50% 40% at 80% 80%, rgba(139,92,246,0.12) 0%, transparent 60%);
    }
    .auth-bg-grid {
        position: absolute; inset: 0;
        background-image: linear-gradient(rgba(255,255,255,0.03) 1px, transparent 1px),
                          linear-gradient(90deg, rgba(255,255,255,0.03) 1px, transparent 1px);
        background-size: 50px 50px;
        mask-image: radial-gradient(ellipse 80% 80% at 50% 50%, black 40%, transparent 100%);
    }
    .auth-card {
        position: relative; z-index: 10;
        width: 100%; max-width: 440px;
        background: rgba(17,24,39,0.85);
        backdrop-filter: blur(24px);
        border: 1px solid rgba(255,255,255,0.09);
        border-radius: 24px;
        padding: 2.5rem;
        box-shadow: 0 40px 100px rgba(0,0,0,0.6), 0 0 0 1px rgba(255,255,255,0.04);
    }
    .auth-logo {
        display: flex; flex-direction: column; align-items: center;
        margin-bottom: 2rem;
    }
    .auth-logo-icon {
        width: 58px; height: 58px;
        background: linear-gradient(135deg,#6366f1,#8b5cf6);
        border-radius: 18px; margin-bottom: 1rem;
        display: flex; align-items: center; justify-content: center;
        box-shadow: 0 0 30px rgba(99,102,241,0.5);
    }
    .auth-logo-icon svg { width: 28px; height: 28px; color: #fff; }
    .auth-logo-name {
        font-size: 1.6rem; font-weight: 900; letter-spacing: -0.03em;
        color: #f1f5f9;
    }
    .auth-logo-name span { color: #818cf8; }
    .auth-logo-sub {
        font-size: 0.72rem; color: #475569; text-transform: uppercase;
        letter-spacing: 0.1em; margin-top: 0.25rem;
    }
    .auth-title { margin-bottom: 1.75rem; }
    .auth-title h2 {
        font-size: 1.4rem; font-weight: 700; color: #f1f5f9;
        margin-bottom: 0.3rem;
    }
    .auth-title p { font-size: 0.85rem; color: #64748b; }
    .auth-form { display: flex; flex-direction: column; gap: 1rem; }
    .auth-input-wrap { position: relative; }
    .auth-input {
        width: 100%;
        background: rgba(255,255,255,0.04);
        border: 1px solid rgba(255,255,255,0.09);
        border-radius: 12px;
        padding: 0.85rem 1rem 0.85rem 2.85rem;
        color: #f1f5f9; font-size: 0.9rem;
        font-family: 'Inter', sans-serif;
        transition: all 0.22s; outline: none;
    }
    .auth-input::placeholder { color: #475569; }
    .auth-input:focus {
        border-color: rgba(99,102,241,0.6);
        background: rgba(99,102,241,0.06);
        box-shadow: 0 0 0 3px rgba(99,102,241,0.15);
    }
    .auth-input-icon {
        position: absolute; left: 14px; top: 50%;
        transform: translateY(-50%);
        color: #475569; pointer-events: none;
        transition: color 0.2s;
    }
    .auth-input-wrap:focus-within .auth-input-icon { color: #818cf8; }
    .auth-input-icon svg { width: 17px; height: 17px; }
    .auth-row {
        display: flex; align-items: center; justify-content: space-between;
    }
    .auth-checkbox-label {
        display: flex; align-items: center; gap: 0.5rem; cursor: pointer;
    }
    .auth-checkbox {
        width: 15px; height: 15px; border-radius: 4px;
        border: 1px solid rgba(255,255,255,0.15);
        background: rgba(255,255,255,0.05);
        accent-color: #6366f1; cursor: pointer;
    }
    .auth-checkbox-text { font-size: 0.82rem; color: #64748b; }
    .auth-forgot {
        font-size: 0.82rem; color: #818cf8; text-decoration: none;
        font-weight: 500; transition: color 0.2s;
    }
    .auth-forgot:hover { color: #a5b4fc; }
    .btn-auth {
        width: 100%; padding: 0.9rem;
        background: linear-gradient(135deg,#6366f1,#4f46e5);
        color: #fff; font-weight: 700; font-size: 0.95rem;
        font-family: 'Inter', sans-serif; border: none;
        border-radius: 12px; cursor: pointer;
        transition: all 0.22s;
        box-shadow: 0 0 25px rgba(99,102,241,0.4);
        display: flex; align-items: center; justify-content: center; gap: 0.5rem;
        margin-top: 0.25rem;
    }
    .btn-auth:hover { transform: translateY(-1px); box-shadow: 0 0 40px rgba(99,102,241,0.6); }
    .btn-auth:active { transform: translateY(0); }
    .btn-auth svg { width: 18px; height: 18px; }
    .auth-divider {
        display: flex; align-items: center; gap: 1rem; margin: 1.25rem 0;
    }
    .auth-divider::before, .auth-divider::after {
        content: ''; flex: 1; height: 1px; background: rgba(255,255,255,0.07);
    }
    .auth-divider span { font-size: 0.72rem; color: #475569; text-transform: uppercase; letter-spacing: 0.1em; }
    .auth-link-text {
        text-align: center; font-size: 0.875rem; color: #64748b;
    }
    .auth-link-text a { color: #818cf8; font-weight: 600; text-decoration: none; }
    .auth-link-text a:hover { color: #a5b4fc; }
    .auth-error {
        background: rgba(239,68,68,0.08); border: 1px solid rgba(239,68,68,0.2);
        border-radius: 10px; padding: 0.85rem 1rem;
        display: flex; gap: 0.65rem; align-items: flex-start;
    }
    .auth-error svg { width: 17px; height: 17px; color: #f87171; flex-shrink: 0; margin-top: 1px; }
    .auth-error p { font-size: 0.82rem; color: #fca5a5; }
    .info-box {
        background: rgba(99,102,241,0.08); border: 1px solid rgba(99,102,241,0.18);
        border-radius: 12px; padding: 1rem 1.15rem; margin-top: 1.5rem;
    }
    .info-box-title {
        display: flex; align-items: center; gap: 0.5rem;
        font-size: 0.72rem; font-weight: 700; text-transform: uppercase;
        letter-spacing: 0.08em; color: #94a3b8; margin-bottom: 0.75rem;
    }
    .info-box-title svg { width: 14px; height: 14px; color: #818cf8; }
    .role-info-item {
        display: flex; align-items: center; gap: 0.7rem; margin-bottom: 0.5rem;
    }
    .role-info-item:last-child { margin-bottom: 0; }
    .role-chip {
        display: inline-flex; align-items: center; gap: 0.3rem;
        font-size: 0.68rem; font-weight: 700; padding: 0.18rem 0.6rem;
        border-radius: 99px; letter-spacing: 0.04em; flex-shrink: 0;
    }
    .role-chip svg { width: 10px; height: 10px; }
    .role-info-desc { font-size: 0.78rem; color: #64748b; }

    /* floating stats */
    .auth-stats {
        position: absolute; top: 2rem; left: 50%;
        transform: translateX(-50%);
        display: none; gap: 0.75rem; z-index: 20;
    }
    @media(min-width:1024px) { .auth-stats { display: flex; } }
    .stat-chip {
        display: flex; flex-direction: column; align-items: center; gap: 2px;
        padding: 0.55rem 1rem;
        background: rgba(255,255,255,0.04);
        border: 1px solid rgba(255,255,255,0.07);
        border-radius: 10px;
    }
    .stat-chip-val { font-size: 1rem; font-weight: 800; }
    .stat-chip-lbl { font-size: 0.6rem; text-transform: uppercase; letter-spacing: 0.08em; color: #475569; }
</style>
@endpush

@section('content')
<div class="auth-page">
    <div class="auth-bg"></div>
    <div class="auth-bg-grid"></div>

    {{-- Floating stats --}}
    <div class="auth-stats">
        <div class="stat-chip">
            <span class="stat-chip-val" style="color:#818cf8;">500+</span>
            <span class="stat-chip-lbl">Événements</span>
        </div>
        <div class="stat-chip">
            <span class="stat-chip-val" style="color:#6ee7b7;">12k+</span>
            <span class="stat-chip-lbl">Participants</span>
        </div>
        <div class="stat-chip">
            <span class="stat-chip-val" style="color:#fcd34d;">8</span>
            <span class="stat-chip-lbl">Sports</span>
        </div>
    </div>

    <div class="auth-card">
        {{-- Logo --}}
        <div class="auth-logo">
            <div class="auth-logo-icon">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                </svg>
            </div>
            <div class="auth-logo-name">Event<span>Sport</span></div>
            <div class="auth-logo-sub">Plateforme de Gestion Sportive</div>
        </div>

        {{-- Title --}}
        <div class="auth-title">
            <h2>Bon retour 👋</h2>
            <p>Connectez-vous pour accéder à votre espace</p>
        </div>

        {{-- Errors --}}
        @if($errors->any())
        <div class="auth-error" style="margin-bottom:1rem;">
            <svg fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/></svg>
            <div>@foreach($errors->all() as $error)<p>{{ $error }}</p>@endforeach</div>
        </div>
        @endif

        {{-- Form --}}
        <form action="{{ route('login') }}" method="POST" class="auth-form">
            @csrf
            <div class="auth-input-wrap">
                <input id="email" name="email" type="email" autocomplete="email" required
                       value="{{ old('email') }}" placeholder="Adresse email"
                       class="auth-input {{ $errors->has('email') ? 'error' : '' }}">
                <div class="auth-input-icon">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/></svg>
                </div>
            </div>
            <div class="auth-input-wrap">
                <input id="password" name="password" type="password" autocomplete="current-password" required
                       placeholder="Mot de passe"
                       class="auth-input {{ $errors->has('password') ? 'error' : '' }}">
                <div class="auth-input-icon">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                </div>
            </div>
            <div class="auth-row">
                <label class="auth-checkbox-label">
                    <input id="remember_me" name="remember" type="checkbox" class="auth-checkbox">
                    <span class="auth-checkbox-text">Se souvenir de moi</span>
                </label>
                @if(Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="auth-forgot">Mot de passe oublié ?</a>
                @endif
            </div>
            <button type="submit" class="btn-auth">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/></svg>
                Se connecter
            </button>
            <div class="auth-divider"><span>ou</span></div>
            <p class="auth-link-text">Pas encore de compte ? <a href="{{ route('register') }}">Créer un compte</a></p>
        </form>

        {{-- Role info --}}
        <div class="info-box">
            <div class="info-box-title">
                <svg fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/></svg>
                Accès par rôle
            </div>
            <div class="role-info-item">
                <span class="role-chip" style="background:rgba(139,92,246,0.15);color:#c4b5fd;border:1px solid rgba(139,92,246,0.25);">
                    <svg fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/></svg>
                    Organisateur
                </span>
                <span class="role-info-desc">Créez et gérez vos événements</span>
            </div>
            <div class="role-info-item">
                <span class="role-chip" style="background:rgba(99,102,241,0.15);color:#818cf8;border:1px solid rgba(99,102,241,0.25);">
                    <svg fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/></svg>
                    Participant
                </span>
                <span class="role-info-desc">Inscrivez-vous aux événements</span>
            </div>
        </div>
    </div>
</div>
@endsection
