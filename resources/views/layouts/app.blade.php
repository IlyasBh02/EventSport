<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EventSport — @yield('title', 'Plateforme Sportive')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            --bg-base:    #0b1120;
            --bg-card:    #111827;
            --bg-card2:   #1a2236;
            --border:     rgba(255,255,255,0.07);
            --border-hover: rgba(99,102,241,0.4);
            --blue:       #6366f1;
            --blue-glow:  rgba(99,102,241,0.25);
            --blue-light: #818cf8;
            --emerald:    #10b981;
            --amber:      #f59e0b;
            --red:        #ef4444;
            --text-1:     #f1f5f9;
            --text-2:     #94a3b8;
            --text-3:     #475569;
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; }
        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg-base);
            color: var(--text-1);
            min-height: 100vh;
            padding-bottom: 80px; /* space for mobile nav */
        }

        /* ── SCROLLBAR ── */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: var(--bg-base); }
        ::-webkit-scrollbar-thumb { background: #2d3748; border-radius: 99px; }

        /* ── NAVBAR ── */
        .navbar {
            background: rgba(11,17,32,0.85);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--border);
            position: sticky;
            top: 0;
            z-index: 200;
        }
        .nav-inner {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 64px;
        }

        /* brand */
        .brand {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            text-decoration: none;
            flex-shrink: 0;
        }
        .brand-icon {
            width: 38px; height: 38px;
            background: linear-gradient(135deg,#6366f1,#8b5cf6);
            border-radius: 11px;
            display: flex; align-items: center; justify-content: center;
            box-shadow: 0 0 20px rgba(99,102,241,0.4);
        }
        .brand-icon svg { width: 20px; height: 20px; color: #fff; }
        .brand-text { line-height: 1.1; }
        .brand-name {
            font-size: 1.15rem; font-weight: 800;
            color: var(--text-1); letter-spacing: -0.02em;
        }
        .brand-name span { color: var(--blue-light); }
        .brand-sub {
            font-size: 0.58rem; color: var(--text-3);
            font-weight: 500; letter-spacing: 0.1em;
            text-transform: uppercase;
        }

        /* desktop nav links */
        .nav-links {
            display: none;
            align-items: center;
            gap: 0.15rem;
        }
        .nav-link {
            display: inline-flex; align-items: center; gap: 0.4rem;
            padding: 0.45rem 0.9rem;
            border-radius: 8px;
            font-size: 0.875rem; font-weight: 500;
            color: var(--text-2);
            text-decoration: none;
            transition: all 0.18s ease;
            white-space: nowrap;
        }
        .nav-link:hover { color: var(--blue-light); background: rgba(99,102,241,0.1); }
        .nav-link.active {
            color: var(--blue-light);
            background: rgba(99,102,241,0.15);
            font-weight: 600;
        }
        .nav-link svg { width: 15px; height: 15px; flex-shrink: 0; }

        /* right section */
        .nav-right { display: flex; align-items: center; gap: 0.75rem; }

        .btn-create {
            display: none;
            align-items: center; gap: 0.4rem;
            padding: 0.5rem 1.1rem;
            background: linear-gradient(135deg,#6366f1,#4f46e5);
            color: #fff; font-size: 0.875rem; font-weight: 600;
            border-radius: 10px; text-decoration: none;
            transition: all 0.2s; white-space: nowrap;
            box-shadow: 0 0 20px rgba(99,102,241,0.35);
        }
        .btn-create:hover {
            transform: translateY(-1px);
            box-shadow: 0 0 30px rgba(99,102,241,0.5);
        }
        .btn-create svg { width: 15px; height: 15px; }

        .user-pill {
            display: flex; align-items: center; gap: 0.5rem;
            padding: 0.3rem 0.75rem 0.3rem 0.3rem;
            background: rgba(255,255,255,0.05);
            border: 1px solid var(--border);
            border-radius: 10px; text-decoration: none;
            transition: all 0.18s;
        }
        .user-pill:hover { border-color: var(--border-hover); background: rgba(99,102,241,0.08); }
        .user-avatar {
            width: 30px; height: 30px; border-radius: 8px;
            background: linear-gradient(135deg,#6366f1,#8b5cf6);
            display: flex; align-items: center; justify-content: center;
            color: #fff; font-size: 0.78rem; font-weight: 700;
        }
        .user-info { display: none; flex-direction: column; }
        .user-name { font-size: 0.8rem; font-weight: 600; color: var(--text-1); line-height: 1.2; }
        .role-pill {
            font-size: 0.62rem; font-weight: 700;
            padding: 0.12rem 0.5rem; border-radius: 99px;
            letter-spacing: 0.04em; text-transform: uppercase;
        }

        .logout-btn {
            display: inline-flex; align-items: center; gap: 0.35rem;
            padding: 0.45rem 0.8rem; border-radius: 8px;
            font-size: 0.82rem; font-weight: 500;
            color: var(--text-3); background: transparent;
            border: none; cursor: pointer; transition: all 0.18s;
        }
        .logout-btn:hover { color: var(--red); background: rgba(239,68,68,0.1); }
        .logout-btn svg { width: 16px; height: 16px; }
        .logout-text { display: none; }

        /* hamburger */
        .hamburger {
            cursor: pointer; padding: 7px; border-radius: 8px;
            border: none; background: rgba(255,255,255,0.05);
            transition: background 0.15s;
        }
        .hamburger:hover { background: rgba(255,255,255,0.1); }
        .hamburger span {
            display: block; width: 20px; height: 1.5px;
            background: var(--text-2); border-radius: 2px;
            transition: all 0.25s ease; margin: 4px 0;
        }
        .hamburger.open span:nth-child(1) { transform: translateY(5.5px) rotate(45deg); }
        .hamburger.open span:nth-child(2) { opacity: 0; transform: scaleX(0); }
        .hamburger.open span:nth-child(3) { transform: translateY(-5.5px) rotate(-45deg); }

        /* mobile dropdown */
        .mobile-menu {
            display: none;
            flex-direction: column;
            gap: 0.2rem;
            padding: 1rem 1.25rem 1.25rem;
            border-top: 1px solid var(--border);
            background: rgba(11,17,32,0.98);
        }
        .mobile-menu.open { display: flex; }
        .mobile-nav-link {
            display: flex; align-items: center; gap: 0.65rem;
            padding: 0.7rem 0.85rem; border-radius: 10px;
            font-size: 0.9rem; font-weight: 500;
            color: var(--text-2); text-decoration: none;
            transition: all 0.15s;
        }
        .mobile-nav-link svg { width: 18px; height: 18px; flex-shrink: 0; }
        .mobile-nav-link:hover, .mobile-nav-link.active {
            color: var(--blue-light); background: rgba(99,102,241,0.1);
        }
        .mobile-divider { height: 1px; background: var(--border); margin: 0.4rem 0; }

        /* ── FLASH ── */
        .flash-success {
            display: flex; align-items: flex-start; gap: 0.75rem;
            background: rgba(16,185,129,0.1); border: 1px solid rgba(16,185,129,0.25);
            border-left: 3px solid var(--emerald);
            color: #6ee7b7; padding: 0.875rem 1rem; border-radius: 12px;
            font-size: 0.875rem; font-weight: 500; margin-bottom: 1.5rem;
        }
        .flash-error {
            display: flex; align-items: flex-start; gap: 0.75rem;
            background: rgba(239,68,68,0.1); border: 1px solid rgba(239,68,68,0.2);
            border-left: 3px solid var(--red);
            color: #fca5a5; padding: 0.875rem 1rem; border-radius: 12px;
            font-size: 0.875rem; font-weight: 500; margin-bottom: 1.5rem;
        }
        .flash-success svg, .flash-error svg { width: 18px; height: 18px; flex-shrink: 0; margin-top: 1px; }

        /* ── MAIN ── */
        .page-main {
            max-width: 1280px;
            margin: 0 auto;
            padding: 2rem 1.5rem;
        }

        /* ── BOTTOM MOBILE NAV ── */
        .bottom-nav {
            display: flex;
            position: fixed;
            bottom: 0; left: 0; right: 0;
            background: rgba(11,17,32,0.96);
            backdrop-filter: blur(16px);
            border-top: 1px solid var(--border);
            z-index: 200;
            padding: 0.5rem 0 calc(0.5rem + env(safe-area-inset-bottom));
        }
        .bottom-nav-item {
            flex: 1;
            display: flex; flex-direction: column; align-items: center; gap: 3px;
            padding: 0.4rem 0; text-decoration: none;
            color: var(--text-3); font-size: 0.6rem; font-weight: 600;
            letter-spacing: 0.04em; text-transform: uppercase;
            transition: color 0.15s;
        }
        .bottom-nav-item.active, .bottom-nav-item:hover { color: var(--blue-light); }
        .bottom-nav-item svg { width: 20px; height: 20px; }

        /* ── GLOBAL COMPONENTS ── */

        /* page header */
        .page-header { margin-bottom: 2rem; }
        .page-header h1 {
            font-size: 1.75rem; font-weight: 800;
            color: var(--text-1); letter-spacing: -0.02em;
        }
        .page-header p { color: var(--text-2); font-size: 0.875rem; margin-top: 0.3rem; }

        /* card */
        .card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 16px;
        }
        .card-header {
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid var(--border);
            display: flex; align-items: center; justify-content: space-between;
        }
        .card-header h2 { font-size: 1rem; font-weight: 700; color: var(--text-1); }
        .card-header p { font-size: 0.75rem; color: var(--text-2); margin-top: 0.15rem; }
        .card-body { padding: 1.5rem; }

        /* stat cards */
        .stat-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 1.5rem;
            display: flex; align-items: center; gap: 1rem;
            transition: transform 0.2s, box-shadow 0.2s, border-color 0.2s;
        }
        .stat-card:hover {
            transform: translateY(-3px);
            border-color: rgba(99,102,241,0.3);
            box-shadow: 0 12px 40px rgba(0,0,0,0.3);
        }
        .stat-icon {
            width: 50px; height: 50px; border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .stat-icon svg { width: 24px; height: 24px; }
        .stat-icon.blue  { background: rgba(99,102,241,0.15); color: var(--blue-light); }
        .stat-icon.green { background: rgba(16,185,129,0.15); color: #6ee7b7; }
        .stat-icon.amber { background: rgba(245,158,11,0.15); color: #fcd34d; }
        .stat-icon.red   { background: rgba(239,68,68,0.15); color: #fca5a5; }
        .stat-value { font-size: 2rem; font-weight: 800; color: var(--text-1); line-height: 1; }
        .stat-label { font-size: 0.8rem; color: var(--text-2); font-weight: 500; margin-top: 0.25rem; }

        /* event cards */
        .event-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 16px; overflow: hidden;
            transition: transform 0.22s ease, box-shadow 0.22s ease, border-color 0.22s ease;
        }
        .event-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 60px rgba(0,0,0,0.4);
            border-color: rgba(99,102,241,0.3);
        }
        .event-banner {
            height: 130px;
            display: flex; align-items: center; justify-content: center;
            position: relative;
            background: linear-gradient(135deg,#6366f1,#8b5cf6);
        }
        .event-banner-letter {
            font-size: 4rem; font-weight: 900;
            color: rgba(255,255,255,0.15);
            letter-spacing: -0.04em;
        }
        .event-banner-badge {
            position: absolute; top: 0.75rem; right: 0.75rem;
            font-size: 0.68rem; font-weight: 700;
            padding: 0.22rem 0.6rem; border-radius: 99px;
            letter-spacing: 0.04em;
        }
        .badge-available { background: rgba(16,185,129,0.2); color: #6ee7b7; border: 1px solid rgba(16,185,129,0.3); }
        .badge-limited   { background: rgba(245,158,11,0.2); color: #fcd34d; border: 1px solid rgba(245,158,11,0.3); }
        .badge-full      { background: rgba(239,68,68,0.2);  color: #fca5a5; border: 1px solid rgba(239,68,68,0.3); }
        .event-sport-badge {
            position: absolute; bottom: 0.75rem; left: 0.75rem;
            font-size: 0.72rem; font-weight: 600;
            padding: 0.2rem 0.65rem; border-radius: 99px;
            background: rgba(0,0,0,0.45); color: #fff;
            backdrop-filter: blur(8px);
        }
        .event-body { padding: 1.25rem; }
        .event-title {
            font-size: 1rem; font-weight: 700; color: var(--text-1);
            margin-bottom: 0.85rem; line-height: 1.3;
        }
        .event-meta { display: flex; flex-direction: column; gap: 0.4rem; }
        .event-meta-item {
            display: flex; align-items: center; gap: 0.5rem;
            font-size: 0.8rem; color: var(--text-2);
        }
        .event-meta-item svg { width: 14px; height: 14px; color: var(--blue-light); flex-shrink: 0; }
        .capacity-bar-wrap { margin-top: 1rem; }
        .capacity-bar-bg {
            height: 4px; background: rgba(255,255,255,0.08);
            border-radius: 99px; overflow: hidden;
        }
        .capacity-bar-fill {
            height: 4px; border-radius: 99px;
            background: linear-gradient(90deg, var(--blue), #8b5cf6);
            transition: width 0.6s ease;
        }
        .capacity-bar-fill.full  { background: linear-gradient(90deg,#ef4444,#dc2626); }
        .capacity-bar-fill.limited { background: linear-gradient(90deg,#f59e0b,#d97706); }
        .capacity-label {
            display: flex; justify-content: space-between;
            font-size: 0.72rem; color: var(--text-3);
            margin-top: 0.35rem;
        }
        .event-actions {
            display: flex; align-items: center; justify-content: space-between;
            padding: 1rem 1.25rem;
            border-top: 1px solid var(--border);
        }

        /* buttons */
        .btn {
            display: inline-flex; align-items: center; gap: 0.4rem;
            padding: 0.55rem 1.1rem; border-radius: 10px;
            font-size: 0.85rem; font-weight: 600;
            text-decoration: none; cursor: pointer;
            border: none; transition: all 0.18s ease;
            font-family: 'Inter', sans-serif;
        }
        .btn svg { width: 15px; height: 15px; }
        .btn-primary {
            background: linear-gradient(135deg,#6366f1,#4f46e5);
            color: #fff;
            box-shadow: 0 0 20px rgba(99,102,241,0.3);
        }
        .btn-primary:hover { transform: translateY(-1px); box-shadow: 0 0 30px rgba(99,102,241,0.5); }
        .btn-secondary {
            background: rgba(255,255,255,0.05);
            border: 1px solid var(--border);
            color: var(--text-2);
        }
        .btn-secondary:hover { background: rgba(255,255,255,0.1); color: var(--text-1); }
        .btn-success {
            background: rgba(16,185,129,0.15);
            border: 1px solid rgba(16,185,129,0.3);
            color: #6ee7b7;
        }
        .btn-success:hover { background: rgba(16,185,129,0.25); }
        .btn-danger {
            background: rgba(239,68,68,0.1);
            border: 1px solid rgba(239,68,68,0.25);
            color: #fca5a5;
        }
        .btn-danger:hover { background: rgba(239,68,68,0.2); }
        .btn-warning {
            background: rgba(245,158,11,0.1);
            border: 1px solid rgba(245,158,11,0.25);
            color: #fcd34d;
        }
        .btn-warning:hover { background: rgba(245,158,11,0.2); }
        .btn-sm { padding: 0.35rem 0.75rem; font-size: 0.78rem; border-radius: 8px; }
        .btn-block { width: 100%; justify-content: center; }
        .btn-lg { padding: 0.75rem 1.5rem; font-size: 0.95rem; }

        /* form inputs */
        .form-label {
            display: block; font-size: 0.82rem; font-weight: 600;
            color: var(--text-2); margin-bottom: 0.4rem;
            letter-spacing: 0.01em;
        }
        .form-input {
            width: 100%;
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 10px;
            padding: 0.7rem 1rem;
            color: var(--text-1); font-size: 0.875rem;
            font-family: 'Inter', sans-serif;
            transition: all 0.2s; outline: none;
        }
        .form-input::placeholder { color: var(--text-3); }
        .form-input:focus {
            border-color: rgba(99,102,241,0.6);
            background: rgba(99,102,241,0.05);
            box-shadow: 0 0 0 3px rgba(99,102,241,0.15);
        }
        .form-input.error { border-color: rgba(239,68,68,0.5); }
        .form-error { font-size: 0.75rem; color: #fca5a5; margin-top: 0.3rem; }
        .form-select {
            width: 100%;
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 10px;
            padding: 0.7rem 1rem;
            color: var(--text-1); font-size: 0.875rem;
            font-family: 'Inter', sans-serif;
            transition: all 0.2s; outline: none;
            cursor: pointer;
        }
        .form-select:focus {
            border-color: rgba(99,102,241,0.6);
            box-shadow: 0 0 0 3px rgba(99,102,241,0.15);
        }
        .form-select option { background: #111827; color: var(--text-1); }

        /* table */
        .data-table { width: 100%; border-collapse: collapse; font-size: 0.875rem; }
        .data-table thead tr {
            background: rgba(255,255,255,0.03);
            border-bottom: 1px solid var(--border);
        }
        .data-table th {
            padding: 0.75rem 1.25rem; text-align: left;
            font-size: 0.7rem; font-weight: 700; text-transform: uppercase;
            letter-spacing: 0.08em; color: var(--text-3);
        }
        .data-table th.center { text-align: center; }
        .data-table tbody tr { border-bottom: 1px solid var(--border); transition: background 0.15s; }
        .data-table tbody tr:last-child { border-bottom: none; }
        .data-table tbody tr:hover { background: rgba(255,255,255,0.02); }
        .data-table td { padding: 1rem 1.25rem; color: var(--text-2); vertical-align: middle; }
        .data-table td.center { text-align: center; }

        /* badge */
        .badge {
            display: inline-flex; align-items: center; gap: 0.3rem;
            font-size: 0.68rem; font-weight: 700;
            padding: 0.2rem 0.6rem; border-radius: 99px;
            letter-spacing: 0.04em; text-transform: uppercase;
        }
        .badge-admin { background: rgba(139,92,246,0.15); color: #c4b5fd; border: 1px solid rgba(139,92,246,0.25); }
        .badge-org   { background: rgba(16,185,129,0.15); color: #6ee7b7; border: 1px solid rgba(16,185,129,0.25); }
        .badge-user  { background: rgba(99,102,241,0.15); color: var(--blue-light); border: 1px solid rgba(99,102,241,0.25); }
        .badge-confirmed { background: rgba(16,185,129,0.15); color: #6ee7b7; border: 1px solid rgba(16,185,129,0.25); }
        .badge-cancelled { background: rgba(239,68,68,0.1); color: #fca5a5; border: 1px solid rgba(239,68,68,0.2); }

        /* back link */
        .back-link {
            display: inline-flex; align-items: center; gap: 0.4rem;
            font-size: 0.82rem; color: var(--text-3);
            text-decoration: none; margin-bottom: 1.5rem;
            transition: color 0.15s;
        }
        .back-link:hover { color: var(--blue-light); }
        .back-link svg { width: 16px; height: 16px; }

        /* empty state */
        .empty-state {
            text-align: center; padding: 4rem 2rem;
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 16px;
        }
        .empty-icon {
            width: 64px; height: 64px; border-radius: 18px;
            background: rgba(99,102,241,0.1);
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 1rem;
        }
        .empty-icon svg { width: 30px; height: 30px; color: var(--blue-light); }
        .empty-state h3 { font-size: 1.1rem; font-weight: 700; color: var(--text-1); margin-bottom: 0.4rem; }
        .empty-state p { font-size: 0.875rem; color: var(--text-2); margin-bottom: 1.5rem; }

        /* section-label divider */
        .section-label {
            font-size: 0.72rem; font-weight: 700; text-transform: uppercase;
            letter-spacing: 0.1em; color: var(--text-3);
            margin-bottom: 0.75rem;
        }

        /* ── RESPONSIVE ── */
        @media(min-width: 768px) {
            body { padding-bottom: 0; }
            .bottom-nav { display: none; }
            .nav-links { display: flex; }
            .btn-create { display: inline-flex; }
            .user-info { display: flex; }
            .logout-text { display: inline; }
            .hamburger { display: none; }
        }
    </style>
    @stack('styles')
</head>
<body>

    {{-- ══ NAVBAR ══ --}}
    <nav class="navbar">
        <div class="nav-inner">

            {{-- Brand --}}
            <a href="{{ route('events.index') }}" class="brand">
                <div class="brand-icon">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
                <div class="brand-text">
                    <div class="brand-name">Event<span>Sport</span></div>
                    <div class="brand-sub">Gestion Sportive</div>
                </div>
            </a>

            {{-- Desktop nav links --}}
            @auth
            <div class="nav-links" id="desktopNav">
                <a href="{{ route('events.index') }}" class="nav-link {{ request()->routeIs('events.index') ? 'active' : '' }}">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    Événements
                </a>
                <a href="{{ route('inscriptions.index') }}" class="nav-link {{ request()->routeIs('inscriptions.index') ? 'active' : '' }}">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                    Inscriptions
                </a>
                <a href="{{ route('favorites.index') }}" class="nav-link {{ request()->routeIs('favorites.index') ? 'active' : '' }}">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                    Favoris
                </a>
                @if(auth()->user()->isAdmin())
                <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.*') ? 'active' : '' }}">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                    Admin
                </a>
                @endif
            </div>
            @endauth

            {{-- Right --}}
            <div class="nav-right">
                @auth
                    @if(auth()->user()->isAdmin() || auth()->user()->isOrganisateur())
                    <a href="{{ route('events.create') }}" class="btn-create" id="createBtn">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                        Créer
                    </a>
                    @endif

                    <a href="{{ route('profile.edit') }}" class="user-pill">
                        <div class="user-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
                        <div class="user-info">
                            <span class="user-name">{{ auth()->user()->name }}</span>
                            <span class="role-pill {{ auth()->user()->isAdmin() ? 'badge-admin' : (auth()->user()->isOrganisateur() ? 'badge-org' : 'badge-user') }}">
                                {{ ucfirst(auth()->user()->role) }}
                            </span>
                        </div>
                    </a>

                    <form method="POST" action="{{ route('logout') }}" style="margin:0;">
                        @csrf
                        <button type="submit" class="logout-btn" title="Déconnexion">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                            <span class="logout-text">Déconnexion</span>
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="nav-link" id="loginLink" style="display:none;">Connexion</a>
                    <a href="{{ route('register') }}" class="btn btn-primary">S'inscrire</a>
                @endauth

                <button class="hamburger" id="hamburger" aria-label="Menu" onclick="toggleMenu()">
                    <span></span><span></span><span></span>
                </button>
            </div>
        </div>

        {{-- Mobile dropdown --}}
        <div class="mobile-menu" id="mobileMenu">
            @auth
            <a href="{{ route('events.index') }}" class="mobile-nav-link {{ request()->routeIs('events.index') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                Événements
            </a>
            <a href="{{ route('inscriptions.index') }}" class="mobile-nav-link {{ request()->routeIs('inscriptions.index') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                Inscriptions
            </a>
            <a href="{{ route('favorites.index') }}" class="mobile-nav-link {{ request()->routeIs('favorites.index') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                Favoris
            </a>
            @if(auth()->user()->isAdmin())
            <a href="{{ route('admin.dashboard') }}" class="mobile-nav-link {{ request()->routeIs('admin.*') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                Admin Dashboard
            </a>
            @endif
            @if(auth()->user()->isAdmin() || auth()->user()->isOrganisateur())
            <div class="mobile-divider"></div>
            <a href="{{ route('events.create') }}" class="btn btn-primary btn-block" style="margin-top:0.25rem;">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                Créer un événement
            </a>
            @endif
            <div class="mobile-divider"></div>
            <div style="display:flex;align-items:center;justify-content:space-between;padding:0.25rem 0.5rem;">
                <a href="{{ route('profile.edit') }}" style="display:flex;align-items:center;gap:0.6rem;text-decoration:none;">
                    <div class="user-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
                    <div>
                        <p style="font-size:0.875rem;font-weight:600;color:var(--text-1);">{{ auth()->user()->name }}</p>
                        <p style="font-size:0.72rem;color:var(--text-3);">{{ auth()->user()->email }}</p>
                    </div>
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="logout-btn">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    </button>
                </form>
            </div>
            @else
            <a href="{{ route('login') }}" class="mobile-nav-link">Connexion</a>
            <a href="{{ route('register') }}" class="btn btn-primary btn-block" style="margin-top:0.25rem;">S'inscrire</a>
            @endauth
        </div>
    </nav>

    {{-- ══ PAGE CONTENT ══ --}}
    <main class="page-main @yield('fullpage')">
        @if(session('success'))
        <div class="flash-success">
            <svg fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
            {{ session('success') }}
        </div>
        @endif
        @if(session('error'))
        <div class="flash-error">
            <svg fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/></svg>
            {{ session('error') }}
        </div>
        @endif
        @yield('content')
    </main>

    {{-- ══ BOTTOM MOBILE NAV ══ --}}
    @auth
    <nav class="bottom-nav" id="bottomNav">
        <a href="{{ route('events.index') }}" class="bottom-nav-item {{ request()->routeIs('events.index') ? 'active' : '' }}">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            Événements
        </a>
        <a href="{{ route('inscriptions.index') }}" class="bottom-nav-item {{ request()->routeIs('inscriptions.index') ? 'active' : '' }}">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
            Inscriptions
        </a>
        <a href="{{ route('favorites.index') }}" class="bottom-nav-item {{ request()->routeIs('favorites.index') ? 'active' : '' }}">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
            Favoris
        </a>
        <a href="{{ route('profile.edit') }}" class="bottom-nav-item {{ request()->routeIs('profile.*') ? 'active' : '' }}">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
            Profil
        </a>
    </nav>
    @endauth

    @stack('scripts')
    <script>
        function toggleMenu() {
            const menu = document.getElementById('mobileMenu');
            const btn  = document.getElementById('hamburger');
            menu.classList.toggle('open');
            btn.classList.toggle('open');
        }
        // Close mobile menu when resizing to desktop
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 768) {
                document.getElementById('mobileMenu')?.classList.remove('open');
                document.getElementById('hamburger')?.classList.remove('open');
            }
        });
    </script>
</body>
</html>
