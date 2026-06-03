<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EventSport — @yield('title', 'Plateforme Sportive')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { font-family: 'Inter', sans-serif; }

        /* ── NAVBAR ── */
        .navbar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(226, 232, 240, 0.8);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .nav-link {
            position: relative;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.45rem 0.85rem;
            border-radius: 8px;
            font-size: 0.875rem;
            font-weight: 500;
            color: #475569;
            text-decoration: none;
            transition: all 0.18s ease;
            white-space: nowrap;
        }
        .nav-link:hover { color: #2563eb; background: #eff6ff; }
        .nav-link.active { color: #2563eb; background: #eff6ff; font-weight: 600; }
        .nav-link.active::after {
            content: '';
            position: absolute;
            bottom: -1px;
            left: 50%;
            transform: translateX(-50%);
            width: 20px;
            height: 2px;
            background: #2563eb;
            border-radius: 2px;
        }

        .btn-primary-nav {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.5rem 1.1rem;
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
            color: #fff;
            font-size: 0.875rem;
            font-weight: 600;
            border-radius: 10px;
            text-decoration: none;
            transition: all 0.2s ease;
            box-shadow: 0 2px 8px rgba(37, 99, 235, 0.3);
            white-space: nowrap;
        }
        .btn-primary-nav:hover {
            background: linear-gradient(135deg, #1d4ed8 0%, #1e40af 100%);
            box-shadow: 0 4px 16px rgba(37, 99, 235, 0.4);
            transform: translateY(-1px);
        }

        .user-avatar {
            width: 34px;
            height: 34px;
            border-radius: 10px;
            background: linear-gradient(135deg, #2563eb, #7c3aed);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 0.8rem;
            font-weight: 700;
            flex-shrink: 0;
        }

        .role-pill {
            font-size: 0.68rem;
            font-weight: 700;
            padding: 0.18rem 0.6rem;
            border-radius: 999px;
            letter-spacing: 0.04em;
            text-transform: uppercase;
        }

        .logout-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            padding: 0.45rem 0.85rem;
            border-radius: 8px;
            font-size: 0.85rem;
            font-weight: 500;
            color: #94a3b8;
            background: transparent;
            border: none;
            cursor: pointer;
            transition: all 0.18s ease;
        }
        .logout-btn:hover { color: #ef4444; background: #fef2f2; }

        /* ── MOBILE MENU ── */
        .mobile-menu {
            display: none;
            flex-direction: column;
            gap: 0.25rem;
            padding: 1rem 1.25rem 1.25rem;
            border-top: 1px solid #f1f5f9;
            background: #fff;
        }
        .mobile-menu.open { display: flex; }
        .mobile-nav-link {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            padding: 0.7rem 0.85rem;
            border-radius: 10px;
            font-size: 0.9rem;
            font-weight: 500;
            color: #475569;
            text-decoration: none;
            transition: all 0.15s ease;
        }
        .mobile-nav-link:hover, .mobile-nav-link.active { color: #2563eb; background: #eff6ff; }

        /* ── HAMBURGER ── */
        .hamburger { cursor: pointer; padding: 6px; border-radius: 8px; transition: background 0.15s; border: none; background: transparent; }
        .hamburger:hover { background: #f1f5f9; }
        .hamburger span { display: block; width: 22px; height: 2px; background: #475569; border-radius: 2px; transition: all 0.25s ease; margin: 4px 0; }
        .hamburger.open span:nth-child(1) { transform: translateY(6px) rotate(45deg); }
        .hamburger.open span:nth-child(2) { opacity: 0; transform: scaleX(0); }
        .hamburger.open span:nth-child(3) { transform: translateY(-6px) rotate(-45deg); }

        /* ── FLASH ── */
        .flash-success {
            display: flex; align-items: flex-start; gap: 0.75rem;
            background: #f0fdf4; border: 1px solid #bbf7d0; border-left: 4px solid #22c55e;
            color: #166534; padding: 0.875rem 1rem; border-radius: 10px;
            font-size: 0.875rem; font-weight: 500; margin-bottom: 1.5rem;
        }
        .flash-error {
            display: flex; align-items: flex-start; gap: 0.75rem;
            background: #fef2f2; border: 1px solid #fecaca; border-left: 4px solid #ef4444;
            color: #991b1b; padding: 0.875rem 1rem; border-radius: 10px;
            font-size: 0.875rem; font-weight: 500; margin-bottom: 1.5rem;
        }
    </style>
    @stack('styles')
</head>
<body style="background:#f8fafc;min-height:100vh;">

    {{-- ══ NAVBAR ══ --}}
    <nav class="navbar">
        <div style="max-width:1280px;margin:0 auto;padding:0 1.5rem;">
            <div style="display:flex;align-items:center;justify-content:space-between;height:64px;">

                {{-- Brand --}}
                <a href="{{ route('events.index') }}" style="display:flex;align-items:center;gap:0.6rem;text-decoration:none;flex-shrink:0;">
                    <div style="width:36px;height:36px;background:linear-gradient(135deg,#2563eb,#7c3aed);border-radius:10px;display:flex;align-items:center;justify-content:center;box-shadow:0 2px 8px rgba(37,99,235,0.3);">
                        <svg style="width:20px;height:20px;color:#fff;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                        </svg>
                    </div>
                    <div style="line-height:1.1;">
                        <span style="font-size:1.1rem;font-weight:800;color:#1e293b;letter-spacing:-0.02em;">Event<span style="color:#2563eb;">Sport</span></span>
                        <div style="font-size:0.6rem;color:#94a3b8;font-weight:500;letter-spacing:0.08em;text-transform:uppercase;">Gestion Sportive</div>
                    </div>
                </a>

                {{-- Desktop nav --}}
                <div style="display:none;" class="desktop-nav" id="desktopNav">
                    @auth
                    <div style="display:flex;align-items:center;gap:0.25rem;">
                        <a href="{{ route('events.index') }}" class="nav-link {{ request()->routeIs('events.index') ? 'active' : '' }}">
                            <svg style="width:15px;height:15px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            Événements
                        </a>
                        <a href="{{ route('inscriptions.index') }}" class="nav-link {{ request()->routeIs('inscriptions.index') ? 'active' : '' }}">
                            <svg style="width:15px;height:15px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                            Inscriptions
                        </a>
                        <a href="{{ route('favorites.index') }}" class="nav-link {{ request()->routeIs('favorites.index') ? 'active' : '' }}">
                            <svg style="width:15px;height:15px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                            Favoris
                        </a>
                        @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <svg style="width:15px;height:15px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                            Dashboard
                        </a>
                        @endif
                    </div>
                    @endauth
                </div>

                {{-- Right section --}}
                <div style="display:flex;align-items:center;gap:0.75rem;">
                    @auth
                        {{-- Create button --}}
                        @if(auth()->user()->isAdmin() || auth()->user()->isOrganisateur())
                        <a href="{{ route('events.create') }}" class="btn-primary-nav" style="display:none;" id="createBtn">
                            <svg style="width:15px;height:15px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                            Créer
                        </a>
                        @endif

                        {{-- User profile --}}
                        <a href="{{ route('profile.edit') }}" style="display:flex;align-items:center;gap:0.5rem;text-decoration:none;padding:0.35rem 0.6rem 0.35rem 0.35rem;border-radius:10px;border:1px solid #e2e8f0;background:#fff;transition:all 0.18s;" onmouseover="this.style.borderColor='#bfdbfe';this.style.background='#eff6ff';" onmouseout="this.style.borderColor='#e2e8f0';this.style.background='#fff';">
                            <div class="user-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
                            <div style="display:none;flex-direction:column;" id="userInfo">
                                <span style="font-size:0.82rem;font-weight:600;color:#1e293b;line-height:1.2;">{{ auth()->user()->name }}</span>
                                <span class="role-pill {{ auth()->user()->isAdmin() ? 'bg-purple-100 text-purple-700' : (auth()->user()->isOrganisateur() ? 'bg-green-100 text-green-700' : 'bg-blue-100 text-blue-700') }}" style="margin-top:1px;display:inline-block;">
                                    {{ ucfirst(auth()->user()->role) }}
                                </span>
                            </div>
                        </a>

                        {{-- Logout --}}
                        <form method="POST" action="{{ route('logout') }}" style="margin:0;">
                            @csrf
                            <button type="submit" class="logout-btn" title="Déconnexion">
                                <svg style="width:17px;height:17px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                <span style="display:none;" id="logoutText">Déconnexion</span>
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="nav-link" style="display:none;" id="loginLink">Connexion</a>
                        <a href="{{ route('register') }}" class="btn-primary-nav">S'inscrire</a>
                    @endauth

                    {{-- Hamburger --}}
                    <button class="hamburger" id="hamburger" aria-label="Menu" onclick="toggleMenu()">
                        <span></span><span></span><span></span>
                    </button>
                </div>
            </div>
        </div>

        {{-- Mobile menu --}}
        <div class="mobile-menu" id="mobileMenu">
            @auth
            <a href="{{ route('events.index') }}" class="mobile-nav-link {{ request()->routeIs('events.index') ? 'active' : '' }}">
                <svg style="width:18px;height:18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                Événements
            </a>
            <a href="{{ route('inscriptions.index') }}" class="mobile-nav-link {{ request()->routeIs('inscriptions.index') ? 'active' : '' }}">
                <svg style="width:18px;height:18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                Mes inscriptions
            </a>
            <a href="{{ route('favorites.index') }}" class="mobile-nav-link {{ request()->routeIs('favorites.index') ? 'active' : '' }}">
                <svg style="width:18px;height:18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                Favoris
            </a>
            @if(auth()->user()->isAdmin())
            <a href="{{ route('admin.dashboard') }}" class="mobile-nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <svg style="width:18px;height:18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                Dashboard Admin
            </a>
            @endif
            @if(auth()->user()->isAdmin() || auth()->user()->isOrganisateur())
            <a href="{{ route('events.create') }}" class="btn-primary-nav" style="margin-top:0.5rem;justify-content:center;">
                <svg style="width:15px;height:15px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                Créer un événement
            </a>
            @endif
            <div style="height:1px;background:#f1f5f9;margin:0.5rem 0;"></div>
            <div style="display:flex;align-items:center;justify-content:space-between;padding:0.25rem 0.5rem;">
                <a href="{{ route('profile.edit') }}" style="display:flex;align-items:center;gap:0.5rem;text-decoration:none;">
                    <div class="user-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
                    <div>
                        <p style="font-size:0.875rem;font-weight:600;color:#1e293b;">{{ auth()->user()->name }}</p>
                        <p style="font-size:0.72rem;color:#94a3b8;">{{ auth()->user()->email }}</p>
                    </div>
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="logout-btn">
                        <svg style="width:17px;height:17px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        Déconnexion
                    </button>
                </form>
            </div>
            @else
            <a href="{{ route('login') }}" class="mobile-nav-link">Connexion</a>
            <a href="{{ route('register') }}" class="btn-primary-nav" style="justify-content:center;">S'inscrire</a>
            @endauth
        </div>
    </nav>

    {{-- ══ PAGE CONTENT ══ --}}
    <main style="max-width:1280px;margin:0 auto;padding:2rem 1.5rem;">

        @if(session('success'))
        <div class="flash-success">
            <svg style="width:18px;height:18px;flex-shrink:0;margin-top:1px;" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
            {{ session('success') }}
        </div>
        @endif
        @if(session('error'))
        <div class="flash-error">
            <svg style="width:18px;height:18px;flex-shrink:0;margin-top:1px;" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/></svg>
            {{ session('error') }}
        </div>
        @endif

        @yield('content')
    </main>

    @stack('scripts')

    <script>
        // ── Responsive navbar show/hide elements ──
        function applyResponsive() {
            const w = window.innerWidth;
            const desktopNav  = document.getElementById('desktopNav');
            const createBtn   = document.getElementById('createBtn');
            const userInfo    = document.getElementById('userInfo');
            const logoutText  = document.getElementById('logoutText');
            const loginLink   = document.getElementById('loginLink');
            const hamburger   = document.getElementById('hamburger');

            if (w >= 768) {
                // md+
                if (desktopNav)  { desktopNav.style.display  = 'flex'; }
                if (createBtn)   { createBtn.style.display   = 'inline-flex'; }
                if (userInfo)    { userInfo.style.display     = 'flex'; }
                if (logoutText)  { logoutText.style.display   = 'inline'; }
                if (loginLink)   { loginLink.style.display    = 'inline-flex'; }
                if (hamburger)   { hamburger.style.display    = 'none'; }
                // close mobile menu
                const mm = document.getElementById('mobileMenu');
                if (mm) mm.classList.remove('open');
            } else {
                // mobile
                if (desktopNav)  { desktopNav.style.display  = 'none'; }
                if (createBtn)   { createBtn.style.display   = 'none'; }
                if (userInfo)    { userInfo.style.display     = 'none'; }
                if (logoutText)  { logoutText.style.display   = 'none'; }
                if (loginLink)   { loginLink.style.display    = 'none'; }
                if (hamburger)   { hamburger.style.display    = 'block'; }
            }
        }

        function toggleMenu() {
            const menu = document.getElementById('mobileMenu');
            const btn  = document.getElementById('hamburger');
            menu.classList.toggle('open');
            btn.classList.toggle('open');
        }

        applyResponsive();
        window.addEventListener('resize', applyResponsive);
    </script>
</body>
</html>
