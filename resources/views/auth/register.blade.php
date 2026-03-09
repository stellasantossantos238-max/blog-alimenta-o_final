<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registar - NutriSaúde</title>
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
            overflow-x: hidden;
            color: #e8f5e9;
            padding: 2rem 1rem;
        }
        .orb { position:fixed; border-radius:50%; filter:blur(80px); pointer-events:none; }
        .orb-1 { width:400px;height:400px;background:rgba(76,175,80,0.08);top:-100px;right:-100px;animation:orbMove 8s ease-in-out infinite; }
        .orb-2 { width:300px;height:300px;background:rgba(33,150,243,0.06);bottom:-50px;left:-50px;animation:orbMove 10s ease-in-out infinite reverse; }
        @keyframes orbMove { 0%,100%{transform:translate(0,0)} 50%{transform:translate(30px,30px)} }
        .particles { position:fixed;top:0;left:0;width:100%;height:100%;pointer-events:none;z-index:0; }
        .particle { position:absolute;width:4px;height:4px;background:rgba(76,175,80,0.6);border-radius:50%;animation:float linear infinite; }
        @keyframes float { 0%{transform:translateY(100vh) rotate(0deg);opacity:0} 10%{opacity:1} 90%{opacity:1} 100%{transform:translateY(-100px) rotate(720deg);opacity:0} }

        .auth-container { position:relative;z-index:1;width:100%;max-width:460px;animation:slideUp 0.6s ease-out; }
        @keyframes slideUp { from{opacity:0;transform:translateY(40px)} to{opacity:1;transform:translateY(0)} }

        .auth-card {
            background: rgba(255,255,255,0.06);
            backdrop-filter: blur(30px);
            border: 1px solid rgba(255,255,255,0.12);
            border-radius: 24px;
            padding: 2.5rem;
            box-shadow: 0 25px 50px rgba(0,0,0,0.4);
        }

        .auth-logo { text-align:center; margin-bottom:2rem; }
        .auth-logo .emoji-logo { font-size:3rem;display:block;margin-bottom:0.5rem;animation:bounce 2s ease-in-out infinite; }
        @keyframes bounce { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-8px)} }
        .auth-logo h1 { font-size:1.5rem;font-weight:700;background:linear-gradient(135deg,#4caf50,#8bc34a);-webkit-background-clip:text;-webkit-text-fill-color:transparent; }
        .auth-logo p { font-size:0.85rem;color:rgba(232,245,233,0.5);margin-top:0.25rem; }

        .form-group { margin-bottom:1.1rem; }
        .form-label { display:block;font-size:0.85rem;color:rgba(232,245,233,0.7);margin-bottom:0.4rem;font-weight:500; }
        .input-wrapper { position:relative; }
        .input-icon { position:absolute;left:1rem;top:50%;transform:translateY(-50%);color:rgba(232,245,233,0.3);font-size:0.9rem; }
        .form-control {
            width:100%;padding:0.85rem 1rem 0.85rem 2.75rem;
            background:rgba(255,255,255,0.05);border:1px solid rgba(255,255,255,0.1);
            border-radius:10px;color:#e8f5e9;font-size:0.95rem;transition:all 0.3s;font-family:'Inter',sans-serif;
        }
        .form-control:focus { outline:none;border-color:rgba(76,175,80,0.6);background:rgba(255,255,255,0.08);box-shadow:0 0 0 3px rgba(76,175,80,0.1); }
        .form-control::placeholder { color:rgba(232,245,233,0.25); }

        .btn-submit {
            width:100%;padding:0.9rem;background:linear-gradient(135deg,#4caf50,#2e7d32);
            color:white;border:none;border-radius:10px;font-size:1rem;font-weight:600;
            cursor:pointer;transition:all 0.3s;font-family:'Inter',sans-serif;
            position:relative;overflow:hidden;margin-top:0.5rem;
        }
        .btn-submit::before { content:'';position:absolute;top:0;left:-100%;width:100%;height:100%;background:linear-gradient(90deg,transparent,rgba(255,255,255,0.15),transparent);transition:left 0.5s; }
        .btn-submit:hover::before { left:100%; }
        .btn-submit:hover { transform:translateY(-2px);box-shadow:0 8px 25px rgba(76,175,80,0.4); }

        .divider { text-align:center;margin:1.5rem 0;position:relative;color:rgba(232,245,233,0.3);font-size:0.85rem; }
        .divider::before,.divider::after { content:'';position:absolute;top:50%;width:40%;height:1px;background:rgba(255,255,255,0.08); }
        .divider::before { left:0; } .divider::after { right:0; }

        .auth-link { text-align:center;font-size:0.9rem;color:rgba(232,245,233,0.5); }
        .auth-link a { color:#81c784;text-decoration:none;font-weight:500; }
        .auth-link a:hover { color:#4caf50; }

        .error-msg { background:rgba(244,67,54,0.1);border:1px solid rgba(244,67,54,0.3);color:#ef9a9a;padding:0.75rem 1rem;border-radius:8px;font-size:0.85rem;margin-bottom:1rem; }

        /* Password strength */
        .strength-bar { height:4px;border-radius:2px;background:rgba(255,255,255,0.08);margin-top:0.5rem;overflow:hidden; }
        .strength-fill { height:100%;border-radius:2px;transition:all 0.3s;width:0; }
    </style>
</head>
<body>
<div class="orb orb-1"></div>
<div class="orb orb-2"></div>
<div class="particles" id="particles"></div>

<div class="auth-container">
    <div class="auth-card">
        <div class="auth-logo">
            @if(file_exists(public_path('images/logo.png')))
                <img src="{{ asset('images/logo.png') }}" alt="Logo" style="height:60px;margin-bottom:0.75rem">
            @else
                <span class="emoji-logo">🌿</span>
            @endif
            <h1>NutriSaúde</h1>
            <p>Crie a sua conta gratuita</p>
        </div>

        @if($errors->any())
        <div class="error-msg">
            <i class="fas fa-exclamation-circle"></i>
            {{ $errors->first() }}
        </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-group">
                <label class="form-label">Nome completo</label>
                <div class="input-wrapper">
                    <i class="fas fa-user input-icon"></i>
                    <input type="text" name="name" class="form-control" placeholder="O seu nome" value="{{ old('name') }}" required autofocus>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Email</label>
                <div class="input-wrapper">
                    <i class="fas fa-envelope input-icon"></i>
                    <input type="email" name="email" class="form-control" placeholder="o-seu@email.com" value="{{ old('email') }}" required>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Password</label>
                <div class="input-wrapper">
                    <i class="fas fa-lock input-icon"></i>
                    <input type="password" name="password" class="form-control" placeholder="Mínimo 8 caracteres" required id="password" oninput="checkStrength(this.value)">
                </div>
                <div class="strength-bar">
                    <div class="strength-fill" id="strengthFill"></div>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Confirmar Password</label>
                <div class="input-wrapper">
                    <i class="fas fa-lock input-icon"></i>
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Repita a password" required>
                </div>
            </div>

            <button type="submit" class="btn-submit">
                <i class="fas fa-user-plus"></i> Criar Conta Grátis
            </button>
        </form>

        <div class="divider">ou</div>
        <div class="auth-link">
            Já tem conta? <a href="{{ route('login') }}">Entrar</a>
        </div>
    </div>
</div>

<script>
const container = document.getElementById('particles');
for (let i = 0; i < 20; i++) {
    const p = document.createElement('div');
    p.className = 'particle';
    p.style.left = Math.random() * 100 + '%';
    p.style.width = p.style.height = (Math.random() * 4 + 2) + 'px';
    p.style.animationDuration = (Math.random() * 15 + 10) + 's';
    p.style.animationDelay = (Math.random() * 10) + 's';
    container.appendChild(p);
}

function checkStrength(val) {
    const fill = document.getElementById('strengthFill');
    let score = 0;
    if (val.length >= 8) score++;
    if (/[A-Z]/.test(val)) score++;
    if (/[0-9]/.test(val)) score++;
    if (/[^A-Za-z0-9]/.test(val)) score++;
    const colors = ['#ef5350','#ff7043','#ffa726','#66bb6a'];
    const widths = ['25%','50%','75%','100%'];
    fill.style.width = score > 0 ? widths[score-1] : '0';
    fill.style.background = score > 0 ? colors[score-1] : 'transparent';
}
</script>
</body>
</html>
