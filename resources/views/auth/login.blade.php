<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entrar</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { margin:0; padding:0; box-sizing:border-box; }

        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            background: url('/images/fundo.png') center/cover no-repeat fixed;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1.25rem;
            color: #1a1a1a;
        }

        /* ── Partículas ── */
        .particles {
            position: fixed; top:0; left:0;
            width:100%; height:100%;
            pointer-events:none; z-index:0;
        }
        .particle {
            position: absolute;
            background: rgba(76,175,80,0.35);
            border-radius: 50%;
            animation: floatUp linear infinite;
        }
        @keyframes floatUp {
            0%   { transform: translateY(100vh); opacity:0; }
            10%  { opacity:1; }
            90%  { opacity:1; }
            100% { transform: translateY(-100px); opacity:0; }
        }

        /* ── Decoração lateral ── */
        .auth-features {
            position: fixed;
            left: 5%; top: 50%;
            transform: translateY(-50%);
            display: flex;
            flex-direction: column;
            gap: 1.4rem;
            z-index: 1;
        }
        .feature-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 0.84rem;
            color: #fff;
            text-shadow: 0 1px 6px rgba(0,0,0,0.35);
        }
        .feature-icon {
            width: 38px; height: 38px;
            background: #fff;
            border-radius: 9px;
            display: flex; align-items: center; justify-content: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.14);
            font-size: 1.1rem;
            flex-shrink: 0;
        }
        @media (max-width: 900px) { .auth-features { display:none; } }

        /* ── Container ── */
        .auth-container {
            position: relative; z-index: 1;
            width: 100%; max-width: 420px;
            animation: slideUp 0.5s ease-out both;
        }
        @keyframes slideUp {
            from { opacity:0; transform:translateY(28px); }
            to   { opacity:1; transform:translateY(0); }
        }

        /* ── Card branco — igual ao .card do layout ── */
        .auth-card {
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 8px 40px rgba(0,0,0,0.18);
            padding: 2.25rem 2.5rem;
        }

        /* ── Logo ── */
        .auth-logo { text-align: center; margin-bottom: 2rem; }
        .auth-logo img  { height: 56px; margin-bottom: 0.6rem; }
        .emoji-logo     { font-size: 2.8rem; display:block; margin-bottom:0.4rem; }
        .auth-logo h1   { font-size: 1.4rem; font-weight: 700; color: #1a2e1a; }
        .auth-logo p    { font-size: 0.84rem; color: #888; margin-top: 0.2rem; }

        /* ── Erro ── */
        .error-msg {
            background: #ffeaea;
            border: 1px solid #ffcdd2;
            color: #c62828;
            padding: 0.7rem 1rem;
            border-radius: 8px;
            font-size: 0.84rem;
            margin-bottom: 1.1rem;
            display: flex; align-items: center; gap: 0.5rem;
        }

        /* ── Campos ── */
        .form-group { margin-bottom: 1.15rem; }
        .form-label {
            display: block; font-size: 0.83rem;
            color: #444; margin-bottom: 0.42rem; font-weight: 500;
        }
        .input-wrapper { position: relative; }
        .input-icon {
            position: absolute; left: 0.9rem; top: 50%;
            transform: translateY(-50%);
            color: #bbb; font-size: 0.88rem; pointer-events: none;
        }
        .form-control {
            width: 100%;
            padding: 0.72rem 1rem 0.72rem 2.5rem;
            background: #fff;
            border: 1.5px solid #ddd;
            border-radius: 8px;
            color: #1a1a1a;
            font-size: 0.93rem;
            font-family: 'Inter', sans-serif;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .form-control::placeholder { color: #bbb; }
        .form-control:focus {
            outline: none;
            border-color: #4caf50;
            box-shadow: 0 0 0 3px rgba(76,175,80,0.10);
        }

        /* ── Lembrar / Esqueceu ── */
        .remember-row {
            display: flex; justify-content: space-between;
            align-items: center; flex-wrap: wrap;
            gap: 0.5rem; margin-bottom: 1.4rem; font-size: 0.84rem;
        }
        .remember-row label {
            display: flex; align-items: center; gap: 0.45rem;
            color: #555; cursor: pointer;
        }
        .remember-row input[type="checkbox"] { accent-color: #4caf50; }
        .remember-row a {
            color: #2e7d32; text-decoration: none;
            font-weight: 500; transition: color 0.2s;
        }
        .remember-row a:hover { color: #4caf50; }

        /* ── Botão ── */
        .btn-submit {
            width: 100%; padding: 0.8rem;
            background: linear-gradient(135deg, #4caf50, #2e7d32);
            color: #fff; border: none; border-radius: 8px;
            font-size: 0.97rem; font-weight: 600; cursor: pointer;
            font-family: 'Inter', sans-serif;
            box-shadow: 0 4px 12px rgba(76,175,80,0.25);
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(76,175,80,0.35);
        }
        .btn-submit:active { transform: translateY(0); }

        /* ── Divisor ── */
        .divider {
            text-align: center; margin: 1.4rem 0;
            position: relative; color: #ccc; font-size: 0.83rem;
        }
        .divider::before, .divider::after {
            content: ''; position: absolute; top: 50%;
            width: 42%; height: 1px; background: #eee;
        }
        .divider::before { left:0; }
        .divider::after  { right:0; }

        /* ── Link ── */
        .auth-link { text-align: center; font-size: 0.88rem; color: #888; }
        .auth-link a {
            color: #2e7d32; text-decoration: none;
            font-weight: 600; transition: color 0.2s;
        }
        .auth-link a:hover { color: #4caf50; }

        @media (max-width: 480px) {
            .auth-card { padding: 1.75rem 1.5rem; }
        }
    </style>
</head>
<body>

<div class="particles" id="particles"></div>

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
                <img src="{{ asset('images/logo.png') }}" alt="NutriSaúde">
            @else
                <span class="emoji-logo">🌿</span>
            @endif
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
                    <input type="email" name="email" class="form-control"
                           placeholder="o-seu@email.com"
                           value="{{ old('email') }}" required autofocus>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Password</label>
                <div class="input-wrapper">
                    <i class="fas fa-lock input-icon"></i>
                    <input type="password" name="password" class="form-control"
                           placeholder="••••••••" required>
                </div>
            </div>

            <div class="remember-row">
                <label>
                    <input type="checkbox" name="remember"> Lembrar-me
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
const container = document.getElementById('particles');
for (let i = 0; i < 18; i++) {
    const p = document.createElement('div');
    p.className = 'particle';
    p.style.left              = Math.random() * 100 + '%';
    p.style.width             =
    p.style.height            = (Math.random() * 3 + 2) + 'px';
    p.style.animationDuration = (Math.random() * 14 + 10) + 's';
    p.style.animationDelay    = (Math.random() * 10) + 's';
    p.style.opacity           = Math.random() * 0.4 + 0.1;
    container.appendChild(p);
}
</script>
</body>
</html>
