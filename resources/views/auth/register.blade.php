@extends('layouts.app')
@section('title', 'Inscription — EventSport')

@push('styles')
<style>
    .auth-page {
        min-height: calc(100vh - 64px);
        display: flex; align-items: center; justify-content: center;
        padding: 2rem 1rem;
        position: relative; overflow: hidden;
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
        width: 100%; max-width: 480px;
        background: rgba(17,24,39,0.85);
        backdrop-filter: blur(24px);
        border: 1px solid rgba(255,255,255,0.09);
        border-radius: 24px; padding: 2.5rem;
        box-shadow: 0 40px 100px rgba(0,0,0,0.6), 0 0 0 1px rgba(255,255,255,0.04);
    }
    .auth-logo { display: flex; flex-direction: column; align-items: center; margin-bottom: 2rem; }
    .auth-logo-icon {
        width: 58px; height: 58px;
        background: linear-gradient(135deg,#6366f1,#8b5cf6);
        border-radius: 18px; margin-bottom: 1rem;
        display: flex; align-items: center; justify-content: center;
        box-shadow: 0 0 30px rgba(99,102,241,0.5);
    }
    .auth-logo-icon svg { width: 28px; height: 28px; color: #fff; }
    .auth-logo-name { font-size: 1.6rem; font-weight: 900; letter-spacing: -0.03em; color: #f1f5f9; }
    .auth-logo-name span { color: #818cf8; }
    .auth-logo-sub { font-size: 0.72rem; color: #475569; text-transform: uppercase; letter-spacing: 0.1em; margin-top: 0.25rem; }
    .auth-title { margin-bottom: 1.75rem; }
    .auth-title h2 { font-size: 1.4rem; font-weight: 700; color: #f1f5f9; margin-bottom: 0.3rem; }
    .auth-title p { font-size: 0.85rem; color: #64748b; }
    .reg-form { display: flex; flex-direction: column; gap: 1rem; }
    .reg-input-wrap { position: relative; }
    .reg-input {
        width: 100%; background: rgba(255,255,255,0.04);
        border: 1px solid rgba(255,255,255,0.09); border-radius: 12px;
        padding: 0.85rem 1rem 0.85rem 2.85rem;
        color: #f1f5f9; font-size: 0.9rem; font-family: 'Inter', sans-serif;
        transition: all 0.22s; outline: none;
    }
    .reg-input::placeholder { color: #475569; }
    .reg-input:focus { border-color: rgba(99,102,241,0.6); background: rgba(99,102,241,0.06); box-shadow: 0 0 0 3px rgba(99,102,241,0.15); }
    .reg-input-icon {
        position: absolute; left: 14px; top: 50%;
        transform: translateY(-50%); color: #475569;
        pointer-events: none; transition: color 0.2s;
    }
    .reg-input-wrap:focus-within .reg-input-icon { color: #818cf8; }
    .reg-input-icon svg { width: 17px; height: 17px; }
    .role-cards { display: grid; grid-template-columns: 1fr 1fr; gap: 0.75rem; }
    .role-card {
        position: relative; cursor: pointer;
    }
    .role-card input { display: none; }
    .role-card-inner {
        background: rgba(255,255,255,0.03);
        border: 1px solid rgba(255,255,255,0.08);
        border-radius: 14px; padding: 1.25rem 1rem;
        display: flex; flex-direction: column; align-items: center; gap: 0.6rem;
        transition: all 0.2s; cursor: pointer;
    }
    .role-card:hover .role-card-inner { border-color: rgba(99,102,241,0.4); background: rgba(99,102,241,0.06); }
    .role-card input:checked + .role-card-inner {
        border-color: #6366f1;
        background: rgba(99,102,241,0.12);
        box-shadow: 0 0 0 2px rgba(99,102,241,0.2);
    }
    .role-card-icon { width: 40px; height: 40px; border-radius: 12px; display: flex; align-items: center; justify-content: center; }
    .role-card-icon.blue { background: rgba(99,102,241,0.15); }
    .role-card-icon.green { background: rgba(16,185,129,0.15); }
    .role-card-icon svg { width: 22px; height: 22px; }
    .role-card-title { font-size: 0.875rem; font-weight: 700; color: #f1f5f9; }
    .role-card-desc { font-size: 0.72rem; color: #64748b; text-align: center; }
    .btn-auth {
        width: 100%; padding: 0.9rem;
        background: linear-gradient(135deg,#6366f1,#4f46e5);
        color: #fff; font-weight: 700; font-size: 0.95rem;
        font-family: 'Inter', sans-serif; border: none; border-radius: 12px;
        cursor: pointer; transition: all 0.22s;
        box-shadow: 0 0 25px rgba(99,102,241,0.4);
        display: flex; align-items: center; justify-content: center; gap: 0.5rem;
    }
    .btn-auth:hover { transform: translateY(-1px); box-shadow: 0 0 40px rgba(99,102,241,0.6); }
    .btn-auth svg { width: 18px; height: 18px; }
    .auth-error {
        background: rgba(239,68,68,0.08); border: 1px solid rgba(239,68,68,0.2);
        border-radius: 10px; padding: 0.85rem 1rem;
        display: flex; gap: 0.65rem; align-items: flex-start;
    }
    .auth-error svg { width: 17px; height: 17px; color: #f87171; flex-shrink: 0; margin-top: 1px; }
    .auth-error li { font-size: 0.82rem; color: #fca5a5; }
    .auth-link-text { text-align: center; font-size: 0.875rem; color: #64748b; margin-top: 0.25rem; }
    .auth-link-text a { color: #818cf8; font-weight: 600; text-decoration: none; }
    .auth-link-text a:hover { color: #a5b4fc; }
    .auth-note { font-size: 0.75rem; color: #475569; margin-top: 1rem; padding-top: 1rem; border-top: 1px solid rgba(255,255,255,0.06); }
</style>
@endpush

@section('content')
<div class="auth-page">
    <div class="auth-bg"></div>
    <div class="auth-bg-grid"></div>

    <div class="auth-card">
        <div class="auth-logo">
            <div class="auth-logo-icon">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                </svg>
            </div>
            <div class="auth-logo-name">Event<span>Sport</span></div>
            <div class="auth-logo-sub">Rejoignez la communauté sportive</div>
        </div>

        <div class="auth-title">
            <h2>Créer votre compte ✨</h2>
            <p>Rejoignez des milliers de sportifs sur EventSport</p>
        </div>

        @if($errors->any())
        <div class="auth-error" style="margin-bottom:1rem;">
            <svg fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/></svg>
            <ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
        @endif

        <form action="{{ route('register') }}" method="POST" class="reg-form">
            @csrf
            <div class="reg-input-wrap">
                <input id="name" name="name" type="text" autocomplete="name" required
                       value="{{ old('name') }}" placeholder="Nom complet"
                       class="reg-input">
                <div class="reg-input-icon">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                </div>
            </div>
            <div class="reg-input-wrap">
                <input id="email" name="email" type="email" autocomplete="email" required
                       value="{{ old('email') }}" placeholder="Adresse email"
                       class="reg-input">
                <div class="reg-input-icon">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/></svg>
                </div>
            </div>
            <div class="reg-input-wrap">
                <input id="password" name="password" type="password" autocomplete="new-password" required
                       placeholder="Mot de passe" class="reg-input">
                <div class="reg-input-icon">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                </div>
            </div>
            <div class="reg-input-wrap">
                <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required
                       placeholder="Confirmer le mot de passe" class="reg-input">
                <div class="reg-input-icon">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                </div>
            </div>

            {{-- Role selection --}}
            <div>
                <p style="font-size:0.8rem;font-weight:600;color:#64748b;margin-bottom:0.6rem;text-transform:uppercase;letter-spacing:0.06em;">Je m'inscris en tant que</p>
                <div class="role-cards">
                    <label class="role-card">
                        <input type="radio" name="role" value="participant" {{ old('role','participant') === 'participant' ? 'checked' : '' }}>
                        <div class="role-card-inner">
                            <div class="role-card-icon blue">
                                <svg fill="none" stroke="#818cf8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            </div>
                            <span class="role-card-title">Participant</span>
                            <span class="role-card-desc">Rejoindre des événements</span>
                        </div>
                    </label>
                    <label class="role-card">
                        <input type="radio" name="role" value="organisateur" {{ old('role') === 'organisateur' ? 'checked' : '' }}>
                        <div class="role-card-inner">
                            <div class="role-card-icon green">
                                <svg fill="none" stroke="#6ee7b7" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                            </div>
                            <span class="role-card-title">Organisateur</span>
                            <span class="role-card-desc">Créer des événements</span>
                        </div>
                    </label>
                </div>
                @error('role')<p style="font-size:0.75rem;color:#fca5a5;margin-top:0.3rem;">{{ $message }}</p>@enderror
            </div>

            <button type="submit" class="btn-auth">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                Créer mon compte
            </button>
            <p class="auth-link-text">Déjà un compte ? <a href="{{ route('login') }}">Se connecter</a></p>
            <p class="auth-note"><strong style="color:#94a3b8;">Note :</strong> Les comptes admin sont créés directement en base de données.</p>
        </form>
    </div>
</div>
@endsection
