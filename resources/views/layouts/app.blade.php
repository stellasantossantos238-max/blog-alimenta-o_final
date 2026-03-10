<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} - @yield('title', 'Blog Alimentação Saudável')</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif;
            background: url('/images/fundo.png') center/cover no-repeat fixed;
            min-height: 100vh;
            color: #1a1a1a;
        }

        /* ═══════════════════════════════════════════
           HEADER / NAVBAR
        ═══════════════════════════════════════════ */
        .navbar {
            background: #ffffff;
            border-bottom: 1px solid #e8e8e8;
            position: sticky;
            top: 0;
            z-index: 1000;
            padding: 0 2rem;
            box-shadow: 0 1px 8px rgba(0,0,0,0.08);
        }

        .navbar-inner {
            max-width: 1200px;
            margin-left: 110px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 65px;
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
        }

        .navbar-brand img {
            height: 38px;
            width: auto;
            object-fit: contain;
        }

        /* Nav esquerda — links simples verdes */
        .nav-left {
            display: flex;
            align-items: center;
            gap: 0.25rem;
            list-style: none;
        }

        .nav-left a {
            color: #5a8a5a;
            text-decoration: none;
            padding: 0.4rem 0.85rem;
            border-radius: 6px;
            font-size: 0.88rem;
            font-weight: 500;
            transition: all 0.2s;
        }

        .nav-left a:hover, .nav-left a.active {
            color: #2e7d32;
            background: #f0f9f0;
        }

        /* Nav direita — links coloridos em maiúsculas */
        .nav-right {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            list-style: none;
        }

        .nav-right a {
            text-decoration: none;
            padding: 0.4rem 0.85rem;
            border-radius: 6px;
            font-size: 0.82rem;
            font-weight: 700;
            letter-spacing: 0.04em;
            transition: all 0.2s;
        }

        .nav-right .link-noticias         { color: #2e7d32; }
        .nav-right .link-noticias:hover,
        .nav-right .link-noticias.active  { background: #e8f5e9; }

        .nav-right .link-sugestoes        { color: #1565c0; }
        .nav-right .link-sugestoes:hover,
        .nav-right .link-sugestoes.active { background: #e3f2fd; }

        .nav-right .link-aprender         { color: #6a1b9a; }
        .nav-right .link-aprender:hover,
        .nav-right .link-aprender.active  { background: #f3e5f5; }

        .nav-right .link-alimentacao         { color: #e65100; }
        .nav-right .link-alimentacao:hover,
        .nav-right .link-alimentacao.active  { background: #fff3e0; }

        .nav-right .link-admin       { color: #c62828; font-weight: 700; }
        .nav-right .link-admin:hover { background: #ffebee; }

        /* ═══════════════════════════════════════════
           CARDS BRANCOS
        ═══════════════════════════════════════════ */
        .card, .glass, .glass-strong, .glass-card {
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 2px 16px rgba(0,0,0,0.10);
            border: none;
            transition: box-shadow 0.3s ease, transform 0.3s ease;
        }

        .glass-card:hover, .card:hover {
            box-shadow: 0 8px 32px rgba(0,0,0,0.15);
            transform: translateY(-3px);
        }

        /* ═══════════════════════════════════════════
           LAYOUT
        ═══════════════════════════════════════════ */
        .container { max-width: 1200px; margin: 0 auto; padding: 0 2rem; }
        .section { padding: 3rem 0; }

        .section-title { font-size: 1.6rem; font-weight: 700; margin-bottom: 0.5rem; color: #1a2e1a; }
        .section-subtitle { color: #6a8a6a; margin-bottom: 2rem; }

        .green-dot { display: inline-block; width: 8px; height: 8px; background: #4caf50; border-radius: 50%; margin-right: 8px; }

        .grid-3 { display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 1.5rem; }
        .grid-2 { display: grid; grid-template-columns: repeat(auto-fill, minmax(380px, 1fr)); gap: 1.5rem; }
        .grid-4 { display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 1.5rem; }

        /* ═══════════════════════════════════════════
           POST CARDS
        ═══════════════════════════════════════════ */
        .post-card { padding: 1.5rem; }

        .post-tipo-badge {
            display: inline-block;
            padding: 0.28rem 0.85rem;
            border-radius: 5px;
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            margin-bottom: 0.85rem;
        }

        .badge-noticia              { background: #2e7d32; color: #fff; }
        .badge-sugestao             { background: #1565c0; color: #fff; }
        .badge-alimentacao_saudavel { background: #e65100; color: #fff; }

        .tag { display: inline-block; padding: 0.25rem 0.75rem; border-radius: 20px; font-size: 0.75rem; font-weight: 600; margin-bottom: 1rem; }
        .tag-normal { background: #e8f5e9; color: #2e7d32; border: 1px solid #c8e6c9; }
        .tag-ai     { background: #ede7f6; color: #512da8; border: 1px solid #d1c4e9; }
        .tag-oms    { background: #e3f2fd; color: #0d47a1; border: 1px solid #bbdefb; }

        .post-card h3 { font-size: 1rem; font-weight: 700; margin-bottom: 0.6rem; color: #1a1a1a; line-height: 1.4; }
        .post-card p  { font-size: 0.87rem; color: #555; line-height: 1.6; margin-bottom: 1rem; }
        .post-card .author { font-size: 0.78rem; color: #999; }

        .img-placeholder {
            width: 100%; height: 180px;
            background: linear-gradient(135deg, #e8f5e9, #c8e6c9);
            border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            font-size: 3rem; margin-bottom: 1rem;
        }

        /* ═══════════════════════════════════════════
           STATS
        ═══════════════════════════════════════════ */
        .stat-card { padding: 1.5rem; text-align: center; }

        .stat-number {
            font-size: 2.2rem; font-weight: 700;
            background: linear-gradient(135deg, #4caf50, #2e7d32);
            -webkit-background-clip: text; -webkit-text-fill-color: transparent;
        }

        .stat-label { font-size: 0.82rem; color: #888; margin-top: 0.25rem; }

        /* ═══════════════════════════════════════════
           BADGES
        ═══════════════════════════════════════════ */
        .badge { display: inline-flex; align-items: center; gap: 5px; padding: 0.28rem 0.75rem; border-radius: 20px; font-size: 0.78rem; font-weight: 500; }

        .badge-green  { background: #e8f5e9; color: #2e7d32; border: 1px solid #c8e6c9; }
        .badge-blue   { background: #e3f2fd; color: #1565c0; border: 1px solid #bbdefb; }
        .badge-purple { background: #f3e5f5; color: #6a1b9a; border: 1px solid #e1bee7; }
        .badge-gold   { background: #fffde7; color: #f57f17; border: 1px solid #ffe082; }

        .role-admin        { background: #c62828; color: #fff; padding: 0.2rem 0.6rem; border-radius: 5px; font-size: 0.7rem; font-weight: 700; }
        .role-profissional { background: #1565c0; color: #fff; padding: 0.2rem 0.6rem; border-radius: 5px; font-size: 0.7rem; font-weight: 700; }
        .role-utilizador   { background: #e8f5e9; color: #2e7d32; padding: 0.2rem 0.6rem; border-radius: 5px; font-size: 0.7rem; font-weight: 700; border: 1px solid #c8e6c9; }

        /* ═══════════════════════════════════════════
           FILTROS
        ═══════════════════════════════════════════ */
        .filter-bar { display: flex; align-items: center; gap: 0.5rem; flex-wrap: wrap; margin-bottom: 2rem; }

        .filter-btn {
            padding: 0.4rem 1rem; border-radius: 20px; font-size: 0.82rem; font-weight: 700;
            cursor: pointer; border: 2px solid #e0e0e0; background: #fff; color: #555;
            transition: all 0.2s; text-decoration: none;
        }

        .filter-btn:hover, .filter-btn.active { color: #fff; border-color: transparent; }
        .filter-btn.all.active,                 .filter-btn.all:hover                  { background: #4caf50; }
        .filter-btn.noticia.active,             .filter-btn.noticia:hover              { background: #2e7d32; }
        .filter-btn.sugestao.active,            .filter-btn.sugestao:hover             { background: #1565c0; }
        .filter-btn.alimentacao_saudavel.active,.filter-btn.alimentacao_saudavel:hover { background: #e65100; }

        /* ═══════════════════════════════════════════
           SIDEBAR
        ═══════════════════════════════════════════ */
        .sidebar-widget { background: #fff; border-radius: 12px; box-shadow: 0 2px 16px rgba(0,0,0,0.10); padding: 1.25rem; margin-bottom: 1.5rem; }

        .sidebar-widget-title {
            font-size: 0.75rem; font-weight: 700; letter-spacing: 0.08em; text-transform: uppercase;
            color: #fff; background: #4caf50; display: inline-block;
            padding: 0.22rem 0.7rem; border-radius: 5px; margin-bottom: 1rem;
        }

        .sidebar-result-item { display: flex; gap: 0.75rem; align-items: flex-start; padding: 0.55rem 0; border-bottom: 1px solid #f0f0f0; text-decoration: none; }
        .sidebar-result-item:last-child { border-bottom: none; }
        .sidebar-result-item img { width: 56px; height: 44px; object-fit: cover; border-radius: 6px; flex-shrink: 0; }
        .sidebar-result-item h4 { font-size: 0.82rem; font-weight: 600; color: #1a1a1a; line-height: 1.35; }
        .sidebar-result-item span { font-size: 0.73rem; color: #999; display: block; margin-top: 0.2rem; }

        /* ═══════════════════════════════════════════
           SUBSCRIBE
        ═══════════════════════════════════════════ */
        .subscribe-box { background: #fff; border-radius: 12px; box-shadow: 0 2px 16px rgba(0,0,0,0.10); padding: 1.25rem; }
        .subscribe-box h3 { font-size: 0.95rem; font-weight: 700; color: #1a1a1a; margin-bottom: 0.4rem; }
        .subscribe-box p  { font-size: 0.8rem; color: #888; margin-bottom: 0.8rem; }

        .subscribe-input-row { display: flex; border: 1.5px solid #c8e6c9; border-radius: 8px; overflow: hidden; }
        .subscribe-input-row input { flex: 1; padding: 0.6rem 1rem; border: none; outline: none; font-size: 0.85rem; color: #1a1a1a; font-family: 'Inter', sans-serif; }
        .subscribe-input-row button { background: #4caf50; border: none; padding: 0 1rem; color: #fff; font-size: 1rem; cursor: pointer; transition: background 0.2s; }
        .subscribe-input-row button:hover { background: #2e7d32; }

        /* ═══════════════════════════════════════════
           FORMS
        ═══════════════════════════════════════════ */
        .form-group { margin-bottom: 1.2rem; }
        .form-label { display: block; font-size: 0.83rem; color: #444; margin-bottom: 0.4rem; font-weight: 500; }

        .form-control {
            width: 100%; padding: 0.7rem 1rem; background: #fff;
            border: 1.5px solid #ddd; border-radius: 8px; color: #1a1a1a;
            font-size: 0.93rem; transition: all 0.2s; font-family: 'Inter', sans-serif;
        }

        .form-control:focus { outline: none; border-color: #4caf50; box-shadow: 0 0 0 3px rgba(76,175,80,0.10); }
        .form-control option { background: #fff; color: #1a1a1a; }

        /* ═══════════════════════════════════════════
           BUTTONS
        ═══════════════════════════════════════════ */
        .btn { display: inline-flex; align-items: center; gap: 8px; padding: 0.7rem 1.5rem; border-radius: 8px; font-size: 0.93rem; font-weight: 500; cursor: pointer; border: none; transition: all 0.3s ease; text-decoration: none; }

        .btn-primary { background: linear-gradient(135deg, #4caf50, #2e7d32); color: #fff; box-shadow: 0 4px 12px rgba(76,175,80,0.25); }
        .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(76,175,80,0.35); color: #fff; }

        .btn-outline { background: transparent; color: #2e7d32; border: 2px solid #4caf50; }
        .btn-outline:hover { background: #e8f5e9; color: #2e7d32; }

        .btn-danger { background: #ffeaea; color: #c62828; border: 1px solid #ffcdd2; }
        .btn-danger:hover { background: #ffcdd2; }

        .btn-green { background: linear-gradient(135deg, #4caf50, #2e7d32); color: white !important; padding: 0.45rem 1.1rem !important; border-radius: 7px !important; font-weight: 600 !important; }

        /* ═══════════════════════════════════════════
           ALERTS
        ═══════════════════════════════════════════ */
        .alert { padding: 1rem 1.25rem; border-radius: 10px; margin-bottom: 1.5rem; font-size: 0.9rem; }
        .alert-success { background: #e8f5e9; border: 1px solid #c8e6c9; color: #2e7d32; }
        .alert-error   { background: #ffeaea; border: 1px solid #ffcdd2; color: #c62828; }

        /* ═══════════════════════════════════════════
           PROGRESS
        ═══════════════════════════════════════════ */
        .progress-bar  { width: 100%; height: 8px; background: #e8e8e8; border-radius: 4px; overflow: hidden; }
        .progress-fill { height: 100%; border-radius: 4px; background: linear-gradient(90deg, #4caf50, #8bc34a); transition: width 1s ease; }

        /* ═══════════════════════════════════════════
           TABLE
        ═══════════════════════════════════════════ */
        .table { width: 100%; border-collapse: collapse; }
        .table th { padding: 0.9rem 1rem; text-align: left; font-size: 0.82rem; color: #888; border-bottom: 2px solid #f0f0f0; font-weight: 600; background: #fafafa; }
        .table td { padding: 0.9rem 1rem; font-size: 0.88rem; border-bottom: 1px solid #f5f5f5; color: #333; }
        .table tr:hover td { background: #fafff8; }

        .rank-1 { color: #f57f17; font-weight: 700; }
        .rank-2 { color: #78909c; font-weight: 700; }
        .rank-3 { color: #8d6e63; font-weight: 700; }

        /* ═══════════════════════════════════════════
           HERO
        ═══════════════════════════════════════════ */
        .hero { padding: 5rem 2rem; text-align: center; }
        .hero h1 { font-size: clamp(1.8rem, 4vw, 3rem); font-weight: 700; line-height: 1.2; margin-bottom: 1.5rem; color: #1a2e1a; }
        .hero h1 .highlight { background: linear-gradient(135deg, #4caf50, #2e7d32); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        .hero p { font-size: 1.05rem; color: #555; max-width: 600px; margin: 0 auto 2rem; }

        /* ═══════════════════════════════════════════
           ADMIN SIDEBAR
        ═══════════════════════════════════════════ */
        .admin-sidebar {
            background: rgba(255,255,255,0.96);
            border-right: 1px solid #e8e8e8;
            min-height: 100vh; width: 240px;
            padding: 1.5rem 1rem; flex-shrink: 0;
            box-shadow: 2px 0 12px rgba(0,0,0,0.06);
        }

        .admin-sidebar a { display: flex; align-items: center; gap: 0.75rem; padding: 0.7rem 1rem; border-radius: 8px; color: #555; text-decoration: none; font-size: 0.88rem; margin-bottom: 0.2rem; transition: all 0.2s; }
        .admin-sidebar a:hover, .admin-sidebar a.active { background: #e8f5e9; color: #2e7d32; font-weight: 600; }

        /* ═══════════════════════════════════════════
           FOOTER — só uma linha
        ═══════════════════════════════════════════ */
        .footer {
            border-top: 1px solid rgba(255,255,255,0.25);
            padding: 1rem 0;
            margin-top: 3rem;
            text-align: center;
        }

        .footer-text { font-size: 0.82rem; color: rgba(255,255,255,0.75); font-weight: 400; }

        /* ═══════════════════════════════════════════
           HAMBURGER / SCROLLBAR / FADE
        ═══════════════════════════════════════════ */
        .hamburger { display: none; cursor: pointer; color: #2e7d32; font-size: 1.4rem; }

        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #f0f0f0; }
        ::-webkit-scrollbar-thumb { background: #a5d6a7; border-radius: 3px; }

        .fade-in { opacity: 0; transform: translateY(16px); transition: opacity 0.5s ease, transform 0.5s ease; }
        .fade-in.visible { opacity: 1; transform: translateY(0); }

        /* ═══════════════════════════════════════════
           RESPONSIVE
        ═══════════════════════════════════════════ */
        @media (max-width: 900px) {
            .nav-right { display: none; }
        }

        @media (max-width: 768px) {
            .hamburger { display: block; }

            .nav-left {
                display: none; flex-direction: column;
                position: absolute; top: 65px; left: 0; right: 0;
                background: #fff; padding: 1rem;
                border-bottom: 2px solid #e8e8e8;
                box-shadow: 0 8px 24px rgba(0,0,0,0.08);
                z-index: 999;
            }

            .nav-left.open { display: flex; }
            .nav-left a { padding: 0.75rem 1rem; display: block; width: 100%; }

            .grid-3, .grid-2, .grid-4 { grid-template-columns: 1fr; }
            .hero { padding: 3rem 1rem; }
            .container { padding: 0 1rem; }
            #searchWrapper { display: none; }

            .table { font-size: 0.78rem; }
            .table th, .table td { padding: 0.6rem 0.4rem; }
            canvas { max-width: 100% !important; }

            .table th:nth-child(4), .table td:nth-child(4),
            .table th:nth-child(5), .table td:nth-child(5),
            .table th:nth-child(6), .table td:nth-child(6) { display: none; }

            .piramide-nivel { width: 100% !important; margin-bottom: 4px !important; border-radius: 8px !important; }

            .admin-sidebar { width: 100%; min-height: auto; border-right: none; border-bottom: 1px solid #e8e8e8; }
        }

        @media (max-width: 480px) {
            .navbar-inner { height: 58px; }
            .navbar-brand img { height: 30px; }
            .filter-btn { font-size: 0.75rem; padding: 0.35rem 0.75rem; }
        }
    </style>
</head>
<body>

<nav class="navbar">
    <div class="navbar-inner">

        <a href="{{ route('home') }}" class="navbar-brand">
            <img src="{{ asset('images/logo.png') }}" alt="Eco-Sustentável">
        </a>

        <ul class="nav-left" id="navLinks">
            <li><a href="{{ route('home') }}"          class="{{ request()->routeIs('home') ? 'active' : '' }}">Início</a></li>
            <li><a href="{{ route('posts.index') }}"   class="{{ request()->routeIs('posts.*') ? 'active' : '' }}">Notícias</a></li>
            <li><a href="{{ route('oms.index') }}"     class="{{ request()->routeIs('oms.*') ? 'active' : '' }}">OMS</a></li>
            <li><a href="{{ route('foods.index') }}"   class="{{ request()->routeIs('foods.*') ? 'active' : '' }}">Alimentos</a></li>
            <li><a href="{{ route('ranking.index') }}" class="{{ request()->routeIs('ranking.*') ? 'active' : '' }}">Ranking</a></li>

            @auth
                @if(auth()->user()->isAdmin())
                <li><a href="{{ route('admin.dashboard') }}"
                       class="link-admin {{ request()->routeIs('admin.*') ? 'active' : '' }}">
                    <i class="fas fa-shield-alt"></i> ADMIN
                </a></li>
                @endif
            @endauth
        </ul>

        <div style="display:flex;align-items:center;gap:0.75rem">

            <div style="position:relative" id="searchWrapper">
                <form method="GET" action="{{ route('search') }}" autocomplete="off">
                    <div style="position:relative">
                        <i class="fas fa-search" style="position:absolute;left:0.75rem;top:50%;transform:translateY(-50%);color:#aaa;font-size:0.82rem;pointer-events:none"></i>
                        <input type="text" name="q" id="searchInput" placeholder="Pesquisar..."
                            style="padding:0.45rem 1rem 0.45rem 2.2rem;background:#f5f5f5;border:1.5px solid #e0e0e0;border-radius:20px;color:#333;font-size:0.83rem;width:170px;transition:all 0.3s;font-family:'Inter',sans-serif;outline:none"
                            onfocus="this.style.width='240px';this.style.borderColor='#4caf50'"
                            onblur="this.style.width='170px';this.style.borderColor='#e0e0e0'"
                            oninput="fetchSuggestions(this.value)">
                    </div>
                </form>
                <div id="searchDropdown" style="display:none;position:absolute;top:40px;left:0;right:0;background:#fff;border:1.5px solid #e0e0e0;border-radius:12px;overflow:hidden;box-shadow:0 12px 32px rgba(0,0,0,0.10);z-index:9999;min-width:280px">
                    <div id="searchResults"></div>
                </div>
            </div>

            @auth
            <div style="position:relative" id="avatarMenu">
                <div onclick="toggleMenu()" style="width:38px;height:38px;background:linear-gradient(135deg,#4caf50,#2e7d32);border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:0.95rem;font-weight:700;cursor:pointer;border:2px solid #a5d6a7;color:#fff;user-select:none;transition:all 0.2s" title="{{ auth()->user()->name }}">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <div id="avatarDropdown" style="display:none;position:absolute;right:0;top:48px;width:230px;background:#fff;border:1px solid #e8e8e8;border-radius:12px;padding:0.5rem;box-shadow:0 12px 32px rgba(0,0,0,0.12);z-index:9999">
                    <div style="padding:0.75rem 1rem;border-bottom:1px solid #f0f0f0;margin-bottom:0.25rem">
                        <div style="display:flex;align-items:center;gap:0.5rem;margin-bottom:0.2rem">
                            <span style="font-weight:700;font-size:0.9rem;color:#1a1a1a">{{ auth()->user()->name }}</span>
                            @php $role = auth()->user()->role; @endphp
                            <span class="role-{{ $role }}">{{ ucfirst($role) }}</span>
                        </div>
                        <div style="font-size:0.73rem;color:#aaa">{{ auth()->user()->email }}</div>
                    </div>
                    <a href="{{ route('profile.show') }}" style="display:flex;align-items:center;gap:0.75rem;padding:0.6rem 1rem;border-radius:7px;color:#444;text-decoration:none;font-size:0.88rem;transition:background 0.2s" onmouseover="this.style.background='#f5fdf5'" onmouseout="this.style.background='transparent'">
                        <i class="fas fa-user" style="width:15px;color:#4caf50"></i> O Meu Perfil
                    </a>
                    <a href="{{ route('purchases.index') }}" style="display:flex;align-items:center;gap:0.75rem;padding:0.6rem 1rem;border-radius:7px;color:#444;text-decoration:none;font-size:0.88rem;transition:background 0.2s" onmouseover="this.style.background='#f5fdf5'" onmouseout="this.style.background='transparent'">
                        <i class="fas fa-shopping-basket" style="width:15px;color:#4caf50"></i> As Minhas Compras
                    </a>
                    <a href="{{ route('ranking.index') }}" style="display:flex;align-items:center;gap:0.75rem;padding:0.6rem 1rem;border-radius:7px;color:#444;text-decoration:none;font-size:0.88rem;transition:background 0.2s" onmouseover="this.style.background='#fffdf0'" onmouseout="this.style.background='transparent'">
                        <i class="fas fa-trophy" style="width:15px;color:#f57f17"></i> Ranking
                    </a>
                    @if(auth()->user()->canPost())
                    <a href="{{ route('posts.create') }}" style="display:flex;align-items:center;gap:0.75rem;padding:0.6rem 1rem;border-radius:7px;color:#444;text-decoration:none;font-size:0.88rem;transition:background 0.2s" onmouseover="this.style.background='#f5fdf5'" onmouseout="this.style.background='transparent'">
                        <i class="fas fa-pen" style="width:15px;color:#4caf50"></i> Novo Post
                    </a>
                    @endif
                    @if(auth()->user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}" style="display:flex;align-items:center;gap:0.75rem;padding:0.6rem 1rem;border-radius:7px;color:#c62828;text-decoration:none;font-size:0.88rem;font-weight:600;transition:background 0.2s" onmouseover="this.style.background='#fff5f5'" onmouseout="this.style.background='transparent'">
                        <i class="fas fa-shield-alt" style="width:15px"></i> Backoffice
                    </a>
                    @endif
                    <div style="border-top:1px solid #f0f0f0;margin:0.25rem 0"></div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" style="width:100%;display:flex;align-items:center;gap:0.75rem;padding:0.6rem 1rem;border-radius:7px;color:#c62828;background:none;border:none;font-size:0.88rem;cursor:pointer;font-family:'Inter',sans-serif;transition:background 0.2s;text-align:left" onmouseover="this.style.background='#fff5f5'" onmouseout="this.style.background='transparent'">
                            <i class="fas fa-sign-out-alt" style="width:15px"></i> Sair
                        </button>
                    </form>
                </div>
            </div>
            @else
            <a href="{{ route('login') }}" style="color:#555;text-decoration:none;padding:0.4rem 0.9rem;border-radius:7px;font-size:0.88rem;font-weight:500;transition:color 0.2s" onmouseover="this.style.color='#2e7d32'" onmouseout="this.style.color='#555'">Entrar</a>
            <a href="{{ route('register') }}" class="btn btn-primary" style="padding:0.45rem 1.1rem;font-size:0.87rem">Registar</a>
            @endauth

            <div class="hamburger" onclick="document.getElementById('navLinks').classList.toggle('open')">
                <i class="fas fa-bars"></i>
            </div>
        </div>
    </div>
</nav>

<main>
    @if(session('success'))
        <div class="container" style="padding-top:1rem">
            <div class="alert alert-success">✅ {{ session('success') }}</div>
        </div>
    @endif
    @if(session('error'))
        <div class="container" style="padding-top:1rem">
            <div class="alert alert-error">❌ {{ session('error') }}</div>
        </div>
    @endif

    @yield('content')
</main>

<footer class="footer">
    <div class="container">
        <p class="footer-text">Copyright Noble Strategy {{ date('Y') }}</p>
    </div>
</footer>

<script>
let searchTimeout;

function fetchSuggestions(query) {
    clearTimeout(searchTimeout);
    const dropdown = document.getElementById('searchDropdown');
    const results  = document.getElementById('searchResults');
    if (query.length < 2) { dropdown.style.display = 'none'; return; }
    searchTimeout = setTimeout(() => {
        fetch(`/pesquisa/sugestoes?q=${encodeURIComponent(query)}`)
            .then(res => res.json())
            .then(data => {
                if (data.length === 0) {
                    results.innerHTML = `<div style="padding:1rem;text-align:center;color:#aaa;font-size:0.85rem">🔍 Sem resultados para "${query}"</div>`;
                } else {
                    results.innerHTML = data.map(item => `
                        <a href="${item.url}" style="display:flex;align-items:center;gap:0.75rem;padding:0.75rem 1rem;text-decoration:none;transition:background 0.2s;border-bottom:1px solid #f5f5f5"
                           onmouseover="this.style.background='#f5fdf5'" onmouseout="this.style.background='transparent'">
                            <span style="font-size:1.2rem;flex-shrink:0">${item.icon}</span>
                            <div style="flex:1;min-width:0">
                                <div style="font-size:0.88rem;font-weight:500;color:#1a1a1a;white-space:nowrap;overflow:hidden;text-overflow:ellipsis">${item.label}</div>
                                <div style="font-size:0.73rem;color:#aaa">${item.sublabel}</div>
                            </div>
                            <span style="font-size:0.68rem;padding:0.18rem 0.45rem;border-radius:10px;flex-shrink:0;${
                                item.type==='food' ? 'background:#e8f5e9;color:#2e7d32' :
                                item.type==='author' ? 'background:#e3f2fd;color:#1565c0' :
                                'background:#f3e5f5;color:#6a1b9a'
                            }">${item.type==='food'?'Alimento':item.type==='author'?'Autor':'Artigo'}</span>
                        </a>`).join('');
                }
                results.innerHTML += `<a href="/pesquisa?q=${encodeURIComponent(query)}" style="display:flex;align-items:center;justify-content:center;gap:0.5rem;padding:0.7rem;text-decoration:none;color:#2e7d32;font-size:0.83rem;border-top:1px solid #f0f0f0;font-weight:500" onmouseover="this.style.background='#f5fdf5'" onmouseout="this.style.background='transparent'"><i class="fas fa-search"></i> Ver todos os resultados para "${query}"</a>`;
                dropdown.style.display = 'block';
            });
    }, 300);
}

function toggleMenu() {
    const d = document.getElementById('avatarDropdown');
    if (d) d.style.display = d.style.display === 'none' ? 'block' : 'none';
}

document.addEventListener('click', function(e) {
    const sw = document.getElementById('searchWrapper'), sd = document.getElementById('searchDropdown');
    if (sw && sd && !sw.contains(e.target)) sd.style.display = 'none';
    const am = document.getElementById('avatarMenu'), ad = document.getElementById('avatarDropdown');
    if (am && ad && !am.contains(e.target)) ad.style.display = 'none';
});

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        const sd = document.getElementById('searchDropdown'), ad = document.getElementById('avatarDropdown');
        if (sd) sd.style.display = 'none';
        if (ad) ad.style.display = 'none';
    }
});

const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry, i) => {
        if (entry.isIntersecting) setTimeout(() => entry.target.classList.add('visible'), i * 80);
    });
}, { threshold: 0.1 });

document.querySelectorAll('.glass-card, .glass, .glass-strong, .card, .stat-card').forEach(el => {
    el.classList.add('fade-in');
    observer.observe(el);
});
</script>
</body>
</html>
