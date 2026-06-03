@extends('layouts.app')
@section('title', 'Connexion — EventSport')
@section('fullpage', '!max-w-none !px-0 !py-0')

@push('styles')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');

    .login-page {
        font-family: 'Inter', sans-serif;
        min-height: calc(100vh - 64px);
        background-image: url('https://images.unsplash.com/photo-1540747913346-19e32dc3e97e?ixlib=rb-4.0.3&auto=format&fit=crop&w=1905&q=80');
        background-size: cover;
        background-position: center;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem 1rem;
    }

    .login-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(0,0,0,0.82) 0%, rgba(15,23,42,0.88) 50%, rgba(30,58,138,0.75) 100%);
    }

    .login-card {
        position: relative;
        z-index: 10;
        width: 100%;
        max-width: 460px;
        background: rgba(255, 255, 255, 0.06);
        backdrop-filter: blur(24px);
        -webkit-backdrop-filter: blur(24px);
        border: 1px solid rgba(255, 255, 255, 0.12);
        border-radius: 24px;
        padding: 2.75rem;
        box-shadow: 0 32px 80px rgba(0,0,0,0.5), 0 0 0 1px rgba(255,255,255,0.05);
    }

    .input-group {
        position: relative;
    }

    .input-icon {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: rgba(148, 163, 184, 0.7);
        pointer-events: none;
        transition: color 0.2s;
    }

    .input-field {
        width: 100%;
        background: rgba(255,255,255,0.07);
        border: 1px solid rgba(255,255,255,0.12);
        border-radius: 12px;
        padding: 0.875rem 1rem 0.875rem 2.75rem;
        color: #fff;
        font-size: 0.9rem;
        font-family: 'Inter', sans-serif;
        transition: all 0.25s ease;
        outline: none;
    }

    .input-field::placeholder {
        color: rgba(148, 163, 184, 0.6);
    }

    .input-field:focus {
        background: rgba(255,255,255,0.11);
        border-color: rgba(99, 102, 241, 0.7);
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.18);
    }

    .input-field:focus + .input-icon,
    .input-group:focus-within .input-icon {
        color: rgba(129, 140, 248, 0.9);
    }

    .btn-login {
        width: 100%;
        padding: 0.9rem 1.5rem;
        background: linear-gradient(135deg, #4f46e5 0%, #3b82f6 100%);
        color: #fff;
        font-weight: 700;
        font-size: 0.95rem;
        font-family: 'Inter', sans-serif;
        border: none;
        border-radius: 12px;
        cursor: pointer;
        transition: all 0.25s ease;
        letter-spacing: 0.025em;
        box-shadow: 0 4px 20px rgba(79, 70, 229, 0.4);
        position: relative;
        overflow: hidden;
    }

    .btn-login::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, #6366f1 0%, #60a5fa 100%);
        opacity: 0;
        transition: opacity 0.25s ease;
    }

    .btn-login:hover::before { opacity: 1; }
    .btn-login:hover { transform: translateY(-1px); box-shadow: 0 8px 30px rgba(79, 70, 229, 0.5); }
    .btn-login:active { transform: translateY(0); }

    .btn-login span { position: relative; z-index: 1; display: flex; align-items: center; justify-content: center; gap: 0.5rem; }

    .divider {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin: 1.5rem 0;
    }

    .divider::before, .divider::after {
        content: '';
        flex: 1;
        height: 1px;
        background: rgba(255,255,255,0.1);
    }

    .divider span {
        color: rgba(148, 163, 184, 0.6);
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.1em;
    }

    .info-card {
        background: rgba(99, 102, 241, 0.1);
        border: 1px solid rgba(99, 102, 241, 0.25);
        border-radius: 12px;
        padding: 1rem 1.25rem;
    }

    .role-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        font-size: 0.72rem;
        font-weight: 600;
        padding: 0.25rem 0.65rem;
        border-radius: 999px;
        letter-spacing: 0.04em;
    }

    .custom-checkbox {
        width: 16px;
        height: 16px;
        border-radius: 5px;
        border: 1.5px solid rgba(255,255,255,0.2);
        background: rgba(255,255,255,0.07);
        cursor: pointer;
        accent-color: #6366f1;
    }

    .stat-pill {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 2px;
        padding: 0.6rem 1rem;
        background: rgba(255,255,255,0.05);
        border: 1px solid rgba(255,255,255,0.08);
        border-radius: 10px;
    }
</style>
@endpush

@section('content')
<div class="login-page">
    <div class="login-overlay"></div>

    {{-- Floating stats bar --}}
    <div style="position:absolute;top:2rem;left:50%;transform:translateX(-50%);z-index:20;display:flex;gap:1rem;" class="hidden lg:flex">
        <div class="stat-pill">
            <span style="color:#818cf8;font-size:1.1rem;font-weight:800;">500+</span>
            <span style="color:rgba(148,163,184,0.7);font-size:0.65rem;text-transform:uppercase;letter-spacing:0.08em;">Événements</span>
        </div>
        <div class="stat-pill">
            <span style="color:#34d399;font-size:1.1rem;font-weight:800;">12k+</span>
            <span style="color:rgba(148,163,184,0.7);font-size:0.65rem;text-transform:uppercase;letter-spacing:0.08em;">Participants</span>
        </div>
        <div class="stat-pill">
            <span style="color:#fb923c;font-size:1.1rem;font-weight:800;">8</span>
            <span style="color:rgba(148,163,184,0.7);font-size:0.65rem;text-transform:uppercase;letter-spacing:0.08em;">Sports</span>
        </div>
    </div>

    <div class="login-card">

        {{-- Logo --}}
        <div style="text-align:center;margin-bottom:2rem;">
            <div style="display:inline-flex;align-items:center;justify-content:center;width:56px;height:56px;background:linear-gradient(135deg,#4f46e5,#3b82f6);border-radius:16px;margin-bottom:1rem;box-shadow:0 8px 24px rgba(79,70,229,0.4);">
                <svg style="width:28px;height:28px;color:#fff;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                </svg>
            </div>
            <div style="display:flex;align-items:center;justify-content:center;gap:0.4rem;margin-bottom:0.5rem;">
                <span style="color:#fff;font-size:1.5rem;font-weight:800;letter-spacing:-0.02em;">Event</span>
                <span style="color:#818cf8;font-size:1.5rem;font-weight:800;letter-spacing:-0.02em;">Sport</span>
            </div>
            <p style="color:rgba(148,163,184,0.7);font-size:0.82rem;letter-spacing:0.06em;text-transform:uppercase;">Plateforme de gestion sportive</p>
        </div>

        {{-- Title --}}
        <div style="margin-bottom:1.75rem;">
            <h2 style="color:#f1f5f9;font-size:1.5rem;font-weight:700;margin-bottom:0.35rem;">Bon retour 👋</h2>
            <p style="color:rgba(148,163,184,0.65);font-size:0.875rem;">Connectez-vous pour accéder à votre espace</p>
        </div>

        {{-- Error alert --}}
        @if($errors->any())
        <div style="background:rgba(239,68,68,0.1);border:1px solid rgba(239,68,68,0.3);border-radius:10px;padding:0.875rem 1rem;margin-bottom:1.25rem;display:flex;gap:0.75rem;align-items:flex-start;">
            <svg style="width:18px;height:18px;color:#f87171;flex-shrink:0;margin-top:1px;" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
            </svg>
            <div>
                @foreach($errors->all() as $error)
                    <p style="color:#fca5a5;font-size:0.825rem;">{{ $error }}</p>
                @endforeach
            </div>
        </div>
        @endif

        {{-- Form --}}
        <form action="{{ route('login') }}" method="POST" style="display:flex;flex-direction:column;gap:1rem;">
            @csrf

            {{-- Email --}}
            <div class="input-group">
                <input id="email" name="email" type="email" autocomplete="email" required
                       value="{{ old('email') }}"
                       placeholder="Adresse email"
                       class="input-field">
                <div class="input-icon" style="display:flex;">
                    <svg style="width:17px;height:17px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                    </svg>
                </div>
            </div>

            {{-- Password --}}
            <div class="input-group">
                <input id="password" name="password" type="password" autocomplete="current-password" required
                       placeholder="Mot de passe"
                       class="input-field">
                <div class="input-icon" style="display:flex;">
                    <svg style="width:17px;height:17px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                </div>
            </div>

            {{-- Remember + forgot --}}
            <div style="display:flex;align-items:center;justify-content:space-between;">
                <label style="display:flex;align-items:center;gap:0.5rem;cursor:pointer;">
                    <input id="remember_me" name="remember" type="checkbox" class="custom-checkbox">
                    <span style="color:rgba(148,163,184,0.8);font-size:0.825rem;">Se souvenir de moi</span>
                </label>
                @if(Route::has('password.request'))
                <a href="{{ route('password.request') }}"
                   style="color:#818cf8;font-size:0.825rem;font-weight:500;text-decoration:none;transition:color 0.2s;"
                   onmouseover="this.style.color='#a5b4fc'" onmouseout="this.style.color='#818cf8'">
                    Mot de passe oublié ?
                </a>
                @endif
            </div>

            {{-- Submit --}}
            <button type="submit" class="btn-login" style="margin-top:0.25rem;">
                <span>
                    <svg style="width:18px;height:18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                    </svg>
                    Se connecter
                </span>
            </button>

            {{-- Register link --}}
            <div class="divider"><span>ou</span></div>
            <p style="text-align:center;color:rgba(148,163,184,0.7);font-size:0.875rem;">
                Pas encore de compte ?
                <a href="{{ route('register') }}"
                   style="color:#818cf8;font-weight:600;text-decoration:none;transition:color 0.2s;"
                   onmouseover="this.style.color='#a5b4fc'" onmouseout="this.style.color='#818cf8'">
                    Créer un compte
                </a>
            </p>
        </form>

        {{-- Info card --}}
        <div class="info-card" style="margin-top:1.75rem;">
            <div style="display:flex;align-items:center;gap:0.5rem;margin-bottom:0.75rem;">
                <svg style="width:15px;height:15px;color:#818cf8;flex-shrink:0;" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                </svg>
                <span style="color:rgba(148,163,184,0.8);font-size:0.75rem;font-weight:600;text-transform:uppercase;letter-spacing:0.06em;">Accès par rôle</span>
            </div>
            <div style="display:flex;flex-direction:column;gap:0.6rem;">
                <div style="display:flex;align-items:center;gap:0.75rem;">
                    <span class="role-badge" style="background:rgba(99,102,241,0.2);color:#a5b4fc;">
                        <svg style="width:11px;height:11px;" fill="currentColor" viewBox="0 0 20 20"><path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/><path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"/></svg>
                        Organisateur
                    </span>
                    <span style="color:rgba(148,163,184,0.65);font-size:0.78rem;">Créez et gérez vos événements</span>
                </div>
                <div style="display:flex;align-items:center;gap:0.75rem;">
                    <span class="role-badge" style="background:rgba(52,211,153,0.15);color:#6ee7b7;">
                        <svg style="width:11px;height:11px;" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/></svg>
                        Participant
                    </span>
                    <span style="color:rgba(148,163,184,0.65);font-size:0.78rem;">Inscrivez-vous aux événements</span>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
