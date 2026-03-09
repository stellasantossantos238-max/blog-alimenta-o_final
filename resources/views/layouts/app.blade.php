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
            background: linear-gradient(135deg, #0a1628 0%, #0d2818 40%, #1a3a1a 70%, #0a1628 100%);
            min-height: 100vh;
            color: #e8f5e9;
        }

        .glass {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 16px;
        }

        .glass-strong {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(30px);
            -webkit-backdrop-filter: blur(30px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 16px;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.06);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .glass-card:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: rgba(76, 175, 80, 0.4);
            transform: translateY(-4px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.3);
        }

        .navbar {
            background: rgba(10, 22, 40, 0.8);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255,255,255,0.08);
            position: sticky;
            top: 0;
            z-index: 1000;
            padding: 0 2rem;
        }

        .navbar-inner {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 70px;
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 1.3rem;
            font-weight: 700;
            color: #4caf50;
            text-decoration: none;
        }

        .navbar-brand span { color: #e8f5e9; }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            list-style: none;
        }

        .nav-links a {
            color: rgba(232, 245, 233, 0.7);
            text-decoration: none;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-size: 0.9rem;
            transition: all 0.2s;
        }

        .nav-links a:hover, .nav-links a.active {
            color: #4caf50;
            background: rgba(76, 175, 80, 0.1);
        }

        .btn-green {
            background: linear-gradient(135deg, #4caf50, #2e7d32);
            color: white !important;
            padding: 0.5rem 1.2rem !important;
            border-radius: 8px !important;
            font-weight: 500;
        }

        .btn-green:hover {
            background: linear-gradient(135deg, #66bb6a, #388e3c) !important;
            transform: translateY(-1px);
        }

        .hero {
            position: relative;
            padding: 6rem 2rem;
            text-align: center;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(ellipse at center, rgba(76,175,80,0.15) 0%, transparent 60%);
            animation: pulse 4s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); opacity: 0.5; }
            50% { transform: scale(1.1); opacity: 1; }
        }

        .hero h1 {
            font-size: clamp(2rem, 5vw, 3.5rem);
            font-weight: 700;
            line-height: 1.2;
            margin-bottom: 1.5rem;
            position: relative;
        }

        .hero h1 .highlight {
            background: linear-gradient(135deg, #4caf50, #8bc34a);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .hero p {
            font-size: 1.1rem;
            color: rgba(232,245,233,0.7);
            max-width: 600px;
            margin: 0 auto 2rem;
            position: relative;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 0.75rem 1.5rem;
            border-radius: 10px;
            font-size: 0.95rem;
            font-weight: 500;
            cursor: pointer;
            border: none;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .btn-primary {
            background: linear-gradient(135deg, #4caf50, #2e7d32);
            color: white;
            box-shadow: 0 4px 15px rgba(76,175,80,0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(76,175,80,0.4);
            color: white;
        }

        .btn-outline {
            background: transparent;
            color: #4caf50;
            border: 1px solid rgba(76,175,80,0.4);
        }

        .btn-outline:hover {
            background: rgba(76,175,80,0.1);
            color: #4caf50;
        }

        .btn-danger {
            background: rgba(244,67,54,0.2);
            color: #ef9a9a;
            border: 1px solid rgba(244,67,54,0.3);
        }

        .btn-danger:hover { background: rgba(244,67,54,0.3); }

        .container { max-width: 1200px; margin: 0 auto; padding: 0 2rem; }
        .section { padding: 4rem 0; }

        .section-title {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            color: #e8f5e9;
        }

        .section-subtitle {
            color: rgba(232,245,233,0.5);
            margin-bottom: 2.5rem;
        }

        .green-dot {
            display: inline-block;
            width: 8px;
            height: 8px;
            background: #4caf50;
            border-radius: 50%;
            margin-right: 8px;
        }

        .grid-3 { display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 1.5rem; }
        .grid-2 { display: grid; grid-template-columns: repeat(auto-fill, minmax(400px, 1fr)); gap: 1.5rem; }
        .grid-4 { display: grid; grid-template-columns: repeat(auto-fill, minmax(230px, 1fr)); gap: 1.5rem; }

        .post-card { padding: 1.5rem; }
        .post-card .tag {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }
        .tag-normal { background: rgba(76,175,80,0.2); color: #81c784; border: 1px solid rgba(76,175,80,0.3); }
        .tag-ai { background: rgba(103,58,183,0.2); color: #b39ddb; border: 1px solid rgba(103,58,183,0.3); }
        .tag-oms { background: rgba(2,136,209,0.2); color: #81d4fa; border: 1px solid rgba(2,136,209,0.3); }

        .post-card h3 { font-size: 1.1rem; font-weight: 600; margin-bottom: 0.75rem; color: #e8f5e9; }
        .post-card p { font-size: 0.9rem; color: rgba(232,245,233,0.6); line-height: 1.6; margin-bottom: 1rem; }
        .post-card .author { font-size: 0.8rem; color: rgba(232,245,233,0.4); }

        .img-placeholder {
            width: 100%;
            height: 180px;
            background: linear-gradient(135deg, rgba(76,175,80,0.15), rgba(139,195,74,0.1));
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            margin-bottom: 1rem;
            border: 1px dashed rgba(76,175,80,0.2);
        }

        .stat-card { padding: 1.5rem; text-align: center; }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            background: linear-gradient(135deg, #4caf50, #8bc34a);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .stat-label { font-size: 0.85rem; color: rgba(232,245,233,0.5); margin-top: 0.25rem; }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .badge-green { background: rgba(76,175,80,0.15); color: #81c784; border: 1px solid rgba(76,175,80,0.2); }
        .badge-blue { background: rgba(33,150,243,0.15); color: #90caf9; border: 1px solid rgba(33,150,243,0.2); }
        .badge-purple { background: rgba(156,39,176,0.15); color: #ce93d8; border: 1px solid rgba(156,39,176,0.2); }
        .badge-gold { background: rgba(255,193,7,0.15); color: #ffe082; border: 1px solid rgba(255,193,7,0.2); }

        .form-group { margin-bottom: 1.2rem; }
        .form-label { display: block; font-size: 0.85rem; color: rgba(232,245,233,0.7); margin-bottom: 0.4rem; }
        .form-control {
            width: 100%;
            padding: 0.75rem 1rem;
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 8px;
            color: #e8f5e9;
            font-size: 0.95rem;
            transition: all 0.2s;
        }
        .form-control:focus {
            outline: none;
            border-color: rgba(76,175,80,0.5);
            background: rgba(255,255,255,0.08);
            box-shadow: 0 0 0 3px rgba(76,175,80,0.1);
        }
        .form-control option { background: #1a2e1a; color: #e8f5e9; }

        .alert { padding: 1rem 1.25rem; border-radius: 10px; margin-bottom: 1.5rem; font-size: 0.9rem; }
        .alert-success { background: rgba(76,175,80,0.15); border: 1px solid rgba(76,175,80,0.3); color: #a5d6a7; }
        .alert-error { background: rgba(244,67,54,0.15); border: 1px solid rgba(244,67,54,0.3); color: #ef9a9a; }

        .progress-bar { width: 100%; height: 8px; background: rgba(255,255,255,0.08); border-radius: 4px; overflow: hidden; }
        .progress-fill { height: 100%; border-radius: 4px; background: linear-gradient(90deg, #4caf50, #8bc34a); transition: width 1s ease; }

        .table { width: 100%; border-collapse: collapse; }
        .table th { padding: 1rem; text-align: left; font-size: 0.85rem; color: rgba(232,245,233,0.5); border-bottom: 1px solid rgba(255,255,255,0.08); font-weight: 500; }
        .table td { padding: 1rem; font-size: 0.9rem; border-bottom: 1px solid rgba(255,255,255,0.05); }
        .table tr:hover td { background: rgba(255,255,255,0.02); }

        .rank-1 { color: #ffd700; }
        .rank-2 { color: #c0c0c0; }
        .rank-3 { color: #cd7f32; }

        .footer {
            background: rgba(0,0,0,0.3);
            border-top: 1px solid rgba(255,255,255,0.05);
            padding: 3rem 0 1.5rem;
            margin-top: 4rem;
        }

        .hamburger { display: none; cursor: pointer; color: #e8f5e9; font-size: 1.5rem; }

        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: rgba(0,0,0,0.2); }
        ::-webkit-scrollbar-thumb { background: rgba(76,175,80,0.4); border-radius: 3px; }

        /* Animações de entrada */
        .fade-in {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.6s ease, transform 0.6s ease;
        }
        .fade-in.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* ===== RESPONSIVE GERAL ===== */
        @media (max-width: 768px) {
            .hamburger { display: block; }
            .nav-links { display: none; flex-direction: column; position: absolute; top: 70px; left: 0; right: 0; background: rgba(10,22,40,0.98); backdrop-filter: blur(20px); padding: 1rem; border-bottom: 1px solid rgba(255,255,255,0.08); }
            .nav-links.open { display: flex; }
            .nav-links a { padding: 0.75rem 1rem; display: block; }
            .grid-3, .grid-2, .grid-4 { grid-template-columns: 1fr; }
            .hero { padding: 4rem 1rem; }
            .container { padding: 0 1rem; }

            /* Pesquisa mobile - esconde */
            #searchWrapper { display: none; }

            /* ===== HERO VIDEO ===== */
            #heroMedia video,
            #heroMedia img {
                object-position: center center;
            }
            .hero .container {
                padding: 4rem 1rem 5rem !important;
            }
            .hero h1 {
                font-size: 1.8rem !important;
            }
            .hero p {
                font-size: 0.95rem !important;
            }

            /* ===== OMS PIRÂMIDE ===== */
            .piramide-nivel {
                width: 100% !important;
                margin-bottom: 4px !important;
                border-radius: 8px !important;
            }

            /* Tabela grupos etários - esconde colunas menos importantes */
            .table th:nth-child(4),
            .table td:nth-child(4),
            .table th:nth-child(5),
            .table td:nth-child(5),
            .table th:nth-child(6),
            .table td:nth-child(6) {
                display: none;
            }

            /* Calculadora IMC stack vertical */
            #imcResultado,
            #imcTabela {
                margin-top: 1.5rem;
            }

            /* Grid 1fr 1fr → bloco */
            .glass [style*="grid-template-columns:1fr 1fr"] {
                display: block !important;
            }

            /* Tabela scroll + texto menor */
            .table { font-size: 0.78rem; }
            .table th, .table td { padding: 0.6rem 0.4rem; }

            /* Gráfico OMS */
            canvas { max-width: 100% !important; }

            /* IA Section home - esconde emoji gigante */
            .glass-strong [style*="font-size:8rem"] {
                display: none !important;
            }

            /* Cards OMS flex → column */
            .glass-card [style*="display:flex;gap:1.5rem"] {
                flex-direction: column !important;
                gap: 0.75rem !important;
            }
        }
    </style>
</head>
<body>

<nav class="navbar">
    <div class="navbar-inner">
        <a href="{{ route('home') }}" class="navbar-brand">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" style="height:35px;width:auto;object-fit:contain">
            <span>Eco-Sustentável</span>
        </a>

        <ul class="nav-links" id="navLinks">
            <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Início</a></li>
            <li><a href="{{ route('posts.index') }}" class="{{ request()->routeIs('posts.*') ? 'active' : '' }}">Blog</a></li>
            <li><a href="{{ route('oms.index') }}" class="{{ request()->routeIs('oms.*') ? 'active' : '' }}">OMS</a></li>
            <li><a href="{{ route('foods.index') }}" class="{{ request()->routeIs('foods.*') ? 'active' : '' }}">Alimentos</a></li>
            <li><a href="{{ route('posts.ai') }}" class="{{ request()->routeIs('posts.ai') ? 'active' : '' }}">IA</a></li>
            <li><a href="{{ route('ranking.index') }}" class="{{ request()->routeIs('ranking.*') ? 'active' : '' }}">Ranking</a></li>
        </ul>

        <div style="display:flex;align-items:center;gap:1rem">

            <!-- Pesquisa com sugestões -->
            <div style="position:relative" id="searchWrapper">
                <form method="GET" action="{{ route('search') }}" autocomplete="off">
                    <div style="position:relative">
                        <i class="fas fa-search" style="position:absolute;left:0.75rem;top:50%;transform:translateY(-50%);color:rgba(232,245,233,0.3);font-size:0.85rem;pointer-events:none"></i>
                        <input
                            type="text"
                            name="q"
                            id="searchInput"
                            placeholder="Pesquisar..."
                            style="padding:0.5rem 1rem 0.5rem 2.25rem;background:rgba(255,255,255,0.05);border:1px solid rgba(255,255,255,0.1);border-radius:20px;color:#e8f5e9;font-size:0.85rem;width:180px;transition:all 0.3s;font-family:'Inter',sans-serif;outline:none"
                            onfocus="this.style.width='260px';this.style.borderColor='rgba(76,175,80,0.4)'"
                            onblur="this.style.width='180px';this.style.borderColor='rgba(255,255,255,0.1)'"
                            oninput="fetchSuggestions(this.value)"
                        >
                    </div>
                </form>
                <div id="searchDropdown" style="display:none;position:absolute;top:42px;left:0;right:0;background:rgba(10,22,40,0.98);backdrop-filter:blur(20px);border:1px solid rgba(255,255,255,0.1);border-radius:12px;overflow:hidden;box-shadow:0 20px 40px rgba(0,0,0,0.4);z-index:9999;min-width:280px">
                    <div id="searchResults"></div>
                </div>
            </div>

            @auth
            <div style="position:relative" id="avatarMenu">
                <div onclick="toggleMenu()" style="width:40px;height:40px;background:linear-gradient(135deg,#4caf50,#2e7d32);border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:1rem;font-weight:700;cursor:pointer;border:2px solid rgba(76,175,80,0.4);transition:all 0.2s;user-select:none" title="{{ auth()->user()->name }}">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <div id="avatarDropdown" style="display:none;position:absolute;right:0;top:50px;width:220px;background:rgba(10,22,40,0.98);backdrop-filter:blur(20px);border:1px solid rgba(255,255,255,0.1);border-radius:12px;padding:0.5rem;box-shadow:0 20px 40px rgba(0,0,0,0.4);z-index:9999">
                    <div style="padding:0.75rem 1rem;border-bottom:1px solid rgba(255,255,255,0.08);margin-bottom:0.25rem">
                        <div style="font-weight:600;font-size:0.9rem;color:#e8f5e9">{{ auth()->user()->name }}</div>
                        <div style="font-size:0.75rem;color:rgba(232,245,233,0.4)">{{ auth()->user()->email }}</div>
                    </div>
                    <a href="{{ route('profile.show') }}" style="display:flex;align-items:center;gap:0.75rem;padding:0.65rem 1rem;border-radius:8px;color:rgba(232,245,233,0.7);text-decoration:none;font-size:0.9rem;transition:all 0.2s" onmouseover="this.style.background='rgba(76,175,80,0.1)';this.style.color='#81c784'" onmouseout="this.style.background='transparent';this.style.color='rgba(232,245,233,0.7)'">
                        <i class="fas fa-user" style="width:16px"></i> O Meu Perfil
                    </a>
                    <a href="{{ route('purchases.index') }}" style="display:flex;align-items:center;gap:0.75rem;padding:0.65rem 1rem;border-radius:8px;color:rgba(232,245,233,0.7);text-decoration:none;font-size:0.9rem;transition:all 0.2s" onmouseover="this.style.background='rgba(76,175,80,0.1)';this.style.color='#81c784'" onmouseout="this.style.background='transparent';this.style.color='rgba(232,245,233,0.7)'">
                        <i class="fas fa-shopping-basket" style="width:16px"></i> As Minhas Compras
                    </a>
                    <a href="{{ route('ranking.index') }}" style="display:flex;align-items:center;gap:0.75rem;padding:0.65rem 1rem;border-radius:8px;color:rgba(232,245,233,0.7);text-decoration:none;font-size:0.9rem;transition:all 0.2s" onmouseover="this.style.background='rgba(76,175,80,0.1)';this.style.color='#81c784'" onmouseout="this.style.background='transparent';this.style.color='rgba(232,245,233,0.7)'">
                        <i class="fas fa-trophy" style="width:16px"></i> Ranking
                    </a>
                    <div style="border-top:1px solid rgba(255,255,255,0.08);margin:0.25rem 0"></div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" style="width:100%;display:flex;align-items:center;gap:0.75rem;padding:0.65rem 1rem;border-radius:8px;color:rgba(239,154,154,0.8);background:none;border:none;font-size:0.9rem;cursor:pointer;font-family:'Inter',sans-serif;transition:all 0.2s;text-align:left" onmouseover="this.style.background='rgba(244,67,54,0.1)';this.style.color='#ef9a9a'" onmouseout="this.style.background='transparent';this.style.color='rgba(239,154,154,0.8)'">
                            <i class="fas fa-sign-out-alt" style="width:16px"></i> Sair
                        </button>
                    </form>
                </div>
            </div>
            @else
            <a href="{{ route('login') }}" style="color:rgba(232,245,233,0.7);text-decoration:none;padding:0.5rem 1rem;border-radius:8px;font-size:0.9rem;transition:all 0.2s" onmouseover="this.style.color='#4caf50'" onmouseout="this.style.color='rgba(232,245,233,0.7)'">Entrar</a>
            <a href="{{ route('register') }}" class="btn btn-primary" style="padding:0.5rem 1.2rem;font-size:0.9rem">Registar</a>
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
        <div class="grid-3" style="margin-bottom:2rem">
            <div>
                <div class="navbar-brand" style="margin-bottom:1rem">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" style="height:30px;width:auto;object-fit:contain">
                    <span>Eco-Sustentável</span>
                </div>
                <p style="color:rgba(232,245,233,0.5);font-size:0.9rem;line-height:1.6">O seu guia para uma alimentação saudável e equilibrada, baseado nas recomendações da OMS.</p>
            </div>
            <div>
                <h4 style="margin-bottom:1rem;color:#81c784">Explorar</h4>
                <ul style="list-style:none;display:flex;flex-direction:column;gap:0.5rem">
                    <li><a href="{{ route('posts.index') }}" style="color:rgba(232,245,233,0.5);text-decoration:none;font-size:0.9rem">Blog</a></li>
                    <li><a href="{{ route('oms.index') }}" style="color:rgba(232,245,233,0.5);text-decoration:none;font-size:0.9rem">Recomendações OMS</a></li>
                    <li><a href="{{ route('foods.index') }}" style="color:rgba(232,245,233,0.5);text-decoration:none;font-size:0.9rem">Base de Alimentos</a></li>
                    <li><a href="{{ route('ranking.index') }}" style="color:rgba(232,245,233,0.5);text-decoration:none;font-size:0.9rem">Ranking</a></li>
                </ul>
            </div>
            <div>
                <h4 style="margin-bottom:1rem;color:#81c784">Área Pessoal</h4>
                <ul style="list-style:none;display:flex;flex-direction:column;gap:0.5rem">
                    @auth
                        <li><a href="{{ route('purchases.index') }}" style="color:rgba(232,245,233,0.5);text-decoration:none;font-size:0.9rem">As Minhas Compras</a></li>
                        <li><a href="{{ route('profile.show') }}" style="color:rgba(232,245,233,0.5);text-decoration:none;font-size:0.9rem">O Meu Perfil</a></li>
                    @else
                        <li><a href="{{ route('register') }}" style="color:rgba(232,245,233,0.5);text-decoration:none;font-size:0.9rem">Registar</a></li>
                        <li><a href="{{ route('login') }}" style="color:rgba(232,245,233,0.5);text-decoration:none;font-size:0.9rem">Entrar</a></li>
                    @endauth
                </ul>
            </div>
        </div>
        <div style="border-top:1px solid rgba(255,255,255,0.05);padding-top:1.5rem;text-align:center;color:rgba(232,245,233,0.3);font-size:0.85rem">
            © {{ date('Y') }} Eco-Sustentável — Feito com 💚 para uma vida mais saudável
        </div>
    </div>
</footer>

<script>
let searchTimeout;

function fetchSuggestions(query) {
    clearTimeout(searchTimeout);
    const dropdown = document.getElementById('searchDropdown');
    const results = document.getElementById('searchResults');

    if (query.length < 2) {
        dropdown.style.display = 'none';
        return;
    }

    searchTimeout = setTimeout(() => {
        fetch(`/pesquisa/sugestoes?q=${encodeURIComponent(query)}`)
            .then(res => res.json())
            .then(data => {
                if (data.length === 0) {
                    results.innerHTML = `<div style="padding:1rem;text-align:center;color:rgba(232,245,233,0.4);font-size:0.85rem">🔍 Sem resultados para "${query}"</div>`;
                } else {
                    results.innerHTML = data.map(item => `
                        <a href="${item.url}" style="display:flex;align-items:center;gap:0.75rem;padding:0.75rem 1rem;text-decoration:none;transition:background 0.2s;border-bottom:1px solid rgba(255,255,255,0.04)"
                           onmouseover="this.style.background='rgba(76,175,80,0.1)'"
                           onmouseout="this.style.background='transparent'">
                            <span style="font-size:1.3rem;flex-shrink:0">${item.icon}</span>
                            <div style="flex:1;min-width:0">
                                <div style="font-size:0.9rem;font-weight:500;color:#e8f5e9;white-space:nowrap;overflow:hidden;text-overflow:ellipsis">${item.label}</div>
                                <div style="font-size:0.75rem;color:rgba(232,245,233,0.4)">${item.sublabel}</div>
                            </div>
                            <span style="font-size:0.7rem;padding:0.2rem 0.5rem;border-radius:10px;flex-shrink:0;${
                                item.type === 'food' ? 'background:rgba(76,175,80,0.15);color:#81c784' :
                                item.type === 'author' ? 'background:rgba(33,150,243,0.15);color:#90caf9' :
                                'background:rgba(156,39,176,0.15);color:#ce93d8'
                            }">${item.type === 'food' ? 'Alimento' : item.type === 'author' ? 'Autor' : 'Artigo'}</span>
                        </a>
                    `).join('');
                }
                results.innerHTML += `
                    <a href="/pesquisa?q=${encodeURIComponent(query)}" style="display:flex;align-items:center;justify-content:center;gap:0.5rem;padding:0.75rem;text-decoration:none;color:#81c784;font-size:0.85rem;border-top:1px solid rgba(255,255,255,0.06)"
                       onmouseover="this.style.background='rgba(76,175,80,0.05)'"
                       onmouseout="this.style.background='transparent'">
                        <i class="fas fa-search"></i> Ver todos os resultados para "${query}"
                    </a>`;
                dropdown.style.display = 'block';
            });
    }, 300);
}

function toggleMenu() {
    const dropdown = document.getElementById('avatarDropdown');
    if (dropdown) {
        dropdown.style.display = dropdown.style.display === 'none' ? 'block' : 'none';
    }
}

document.addEventListener('click', function(e) {
    const searchWrapper = document.getElementById('searchWrapper');
    const searchDropdown = document.getElementById('searchDropdown');
    if (searchWrapper && searchDropdown && !searchWrapper.contains(e.target)) {
        searchDropdown.style.display = 'none';
    }
    const avatarMenu = document.getElementById('avatarMenu');
    const avatarDropdown = document.getElementById('avatarDropdown');
    if (avatarMenu && avatarDropdown && !avatarMenu.contains(e.target)) {
        avatarDropdown.style.display = 'none';
    }
});

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        const searchDropdown = document.getElementById('searchDropdown');
        const avatarDropdown = document.getElementById('avatarDropdown');
        if (searchDropdown) searchDropdown.style.display = 'none';
        if (avatarDropdown) avatarDropdown.style.display = 'none';
    }
});

const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry, i) => {
        if (entry.isIntersecting) {
            setTimeout(() => entry.target.classList.add('visible'), i * 100);
        }
    });
}, { threshold: 0.1 });

document.querySelectorAll('.glass-card, .glass, .glass-strong, .stat-card').forEach(el => {
    el.classList.add('fade-in');
    observer.observe(el);
});
</script>
</body>
</html>
