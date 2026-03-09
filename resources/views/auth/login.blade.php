<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entrar - NutriSaúde</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { margin:0; padding:0; box-sizing:border-box; }
        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            background: linear-gradient(135deg, #0a1628 0%, #0d2818 40%, #1a3a1a 70%, #0a1628 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            color: #e8f5e9;
        }

        /* Partículas de fundo */
        .particles { position:fixed; top:0; left:0; width:100%; height:100%; pointer-events:none; z-index:0; }
        .particle {
            position: absolute;
            width: 4px; height: 4px;
            background: rgba(76,175,80,0.6);
            border-radius: 50%;
            animation: float linear infinite;
        }
        @keyframes float {
            0% { transform: translateY(100vh) rotate(0deg); opacity:0; }
            10% { opacity:1; }
            90% { opacity:1; }
            100% { transform: translateY(-100px) rotate(720deg); opacity:0; }
        }

        /* Orbs de fundo */
        .orb {
            position: fixed;
            border-radius: 50%;
            filter: blur(80px);
            pointer-events: none;
        }
        .orb-1 { width:400px; height:400px; background:rgba(76,175,80,0.08); top:-100px; right:-100px; animation: orbMove 8s ease-in-out infinite; }
        .orb-2 { width:300px; height:300px; background:rgba(33,150,243,0.06); bottom:-50px; left:-50px; animation: orbMove 10s ease-in-out infinite reverse; }
        @keyframes orbMove { 0%,100%{transform:translate(0,0)} 50%{transform:translate(30px,30px)} }

        .auth-container {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 420px;
            padding: 1rem;
            animation: slideUp 0.6s ease-out;
        }

        @keyframes slideUp {
            from { opacity:0; transform:translateY(40px); }
            to { opacity:1; transform:translateY(0); }
        }

        .auth-card {
            background: rgba(255,255,255,0.06);
            backdrop-filter: blur(30px);
            border: 1px solid rgba(255,255,255,0.12);
            border-radius: 24px;
            padding: 2.5rem;
            box-shadow: 0 25px 50px rgba(0,0,0,0.4);
        }

        .auth-logo {
            text-align: center;
            margin-bottom: 2rem;
        }

        .auth-logo img {
            height: 60px;
            margin-bottom: 0.75rem;
        }

        .auth-logo .emoji-logo {
            font-size: 3rem;
            display: block;
            margin-bottom: 0.5rem;
            animation: bounce 2s ease-in-out infinite;
        }

        @keyframes bounce {
            0%,100%{transform:translateY(0)} 50%{transform:translateY(-8px)}
        }

        .auth-logo h1 {
            font-size: 1.5rem;
            font-weight: 700;
            background: linear-gradient(135deg, #4caf50, #8bc34a);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .auth-logo p { font-size:0.85rem; color:rgba(232,245,233,0.5); margin-top:0.25rem; }

        .form-group { margin-bottom: 1.2rem; }

        .form-label {
            display: block;
            font-size: 0.85rem;
            color: rgba(232,245,233,0.7);
            margin-bottom: 0.5rem;
            font-weight: 500;
        }

        .input-wrapper { position: relative; }

        .input-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(232,245,233,0.3);
            font-size: 0.9rem;
        }

        .form-control {
            width: 100%;
            padding: 0.85rem 1rem 0.85rem 2.75rem;
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 10px;
            color: #e8f5e9;
            font-size: 0.95rem;
            transition: all 0.3s;
            font-family: 'Inter', sans-serif;
        }

        .form-control:focus {
            outline: none;
            border-color: rgba(76,175,80,0.6);
            background: rgba(255,255,255,0.08);
            box-shadow: 0 0 0 3px rgba(76,175,80,0.1);
        }

        .form-control::placeholder { color: rgba(232,245,233,0.25); }

        .btn-submit {
            width: 100%;
            padding: 0.9rem;
            background: linear-gradient(135deg, #4caf50, #2e7d32);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            font-family: 'Inter', sans-serif;
            position: relative;
            overflow: hidden;
            margin-top: 0.5rem;
        }

        .btn-submit::before {
            content: '';
            position: absolute;
            top: 0; left: -100%;
            width: 100%; height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.15), transparent);
            transition: left 0.5s;
        }

        .btn-submit:hover::before { left: 100%; }
        .btn-submit:hover { transform: translateY(-2px); box-shadow: 0 8px 25px rgba(76,175,80,0.4); }
        .btn-submit:active { transform: translateY(0); }

        .divider {
            text-align: center;
            margin: 1.5rem 0;
            position: relative;
            color: rgba(232,245,233,0.3);
            font-size: 0.85rem;
        }

        .divider::before, .divider::after {
            content: '';
            position: absolute;
            top: 50%;
            width: 40%;
            height: 1px;
            background: rgba(255,255,255,0.08);
        }
        .divider::before { left: 0; }
        .divider::after { right: 0; }

        .auth-link {
            text-align: center;
            font-size: 0.9rem;
            color: rgba(232,245,233,0.5);
        }

        .auth-link a {
            color: #81c784;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s;
        }

        .auth-link a:hover { color: #4caf50; }

        .remember-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            font-size: 0.85rem;
        }

        .remember-row label {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: rgba(232,245,233,0.6);
            cursor: pointer;
        }

        .remember-row input[type="checkbox"] { accent-color: #4caf50; }

        .remember-row a {
            color: #81c784;
            text-decoration: none;
        }

        .error-msg {
            background: rgba(244,67,54,0.1);
            border: 1px solid rgba(244,67,54,0.3);
            color: #ef9a9a;
            padding: 0.75rem 1rem;
            border-radius: 8px;
            font-size: 0.85rem;
            margin-bottom: 1rem;
        }

        /* Decoração lateral */
        .auth-features {
            position: fixed;
            left: 5%;
            top: 50%;
            transform: translateY(-50%);
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
            opacity: 0.4;
        }

        .feature-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 0.85rem;
            color: rgba(232,245,233,0.6);
        }

        .feature-icon {
            width: 36px; height: 36px;
            background: rgba(76,175,80,0.1);
            border: 1px solid rgba(76,175,80,0.2);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        @media (max-width: 768px) {
            .auth-features { display: none; }
        }
    </style>
</head>
<body>

<!-- Orbs -->
<div class="orb orb-1"></div>
<div class="orb orb-2"></div>

<!-- Partículas -->
<div class="particles" id="particles"></div>

<!-- Decoração lateral -->
<div class="auth-features">
    <div class="feature-item">
        <div class="feature-icon">🥗</div>
        <span>Alimentação saudável</span>
    </div>
    <div class="feature-item">
        <div class="feature-icon">📊</div>
        <span>Análise nutricional</span>
    </div>
    <div class="feature-item">
        <div class="feature-icon">🏆</div>
        <span>Ranking semanal</span>
    </div>
    <div class="feature-item">
        <div class="feature-icon">🤖</div>
        <span>IA integrada</span>
    </div>
</div>

<div class="auth-container">
    <div class="auth-card">
        <div class="auth-logo">
            @if(file_exists(public_path('images/logo.png')))
                <img src="{{ asset('images/logo.png') }}" alt="Logo">
            @else
                <span class="emoji-logo">🌿</span>
            @endif
            <h1>NutriSaúde</h1>
            <p>Bem-vindo de volta!</p>
        </div>

        @if($errors->any())
        <div class="error-msg">
            <i class="fas fa-exclamation-circle"></i>
            {{ $errors->first() }}
        </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <label class="form-label">Email</label>
                <div class="input-wrapper">
                    <i class="fas fa-envelope input-icon"></i>
                    <input type="email" name="email" class="form-control" placeholder="o-seu@email.com" value="{{ old('email') }}" required autofocus>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Password</label>
                <div class="input-wrapper">
                    <i class="fas fa-lock input-icon"></i>
                    <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                </div>
            </div>

            <div class="remember-row">
                <label>
                    <input type="checkbox" name="remember">
                    Lembrar-me
                </label>
                @if(Route::has('password.request'))
                <a href="{{ route('password.request') }}">Esqueceu a password?</a>
                @endif
            </div>

            <button type="submit" class="btn-submit">
                <i class="fas fa-sign-in-alt"></i> Entrar
            </button>
        </form>

        <div class="divider">ou</div>

        <div class="auth-link">
            Não tem conta? <a href="{{ route('register') }}">Criar conta grátis</a>
        </div>
    </div>
</div>

<script>
// Criar partículas
const container = document.getElementById('particles');
for (let i = 0; i < 20; i++) {
    const p = document.createElement('div');
    p.className = 'particle';
    p.style.left = Math.random() * 100 + '%';
    p.style.width = p.style.height = (Math.random() * 4 + 2) + 'px';
    p.style.animationDuration = (Math.random() * 15 + 10) + 's';
    p.style.animationDelay = (Math.random() * 10) + 's';
    p.style.opacity = Math.random() * 0.6 + 0.2;
    container.appendChild(p);
}
</script>
</body>
</html>
