@extends('layouts.app')
@section('title', 'IA & Nutrição')
@section('content')

<div class="container section">
    <div style="text-align:center;margin-bottom:3rem">
        <span class="badge badge-purple" style="margin-bottom:1rem;font-size:0.9rem;padding:0.5rem 1rem">✨ Inteligência Artificial</span>
        <h1 class="section-title">IA & Nutrição</h1>
        <p class="section-subtitle">Artigos gerados com inteligência artificial sobre alimentação</p>
    </div>

    <div class="glass-strong" style="padding:2rem;margin-bottom:3rem;background:linear-gradient(135deg,rgba(103,58,183,0.1),rgba(76,175,80,0.05));border-color:rgba(103,58,183,0.2)">
        <div style="display:grid;grid-template-columns:auto 1fr;gap:1.5rem;align-items:center">
            <div style="font-size:4rem">🤖</div>
            <div>
                <h3 style="margin-bottom:0.5rem">Como funciona a secção de IA?</h3>
                <p style="color:rgba(232,245,233,0.6);font-size:0.9rem;line-height:1.7">A nossa IA analisa as mais recentes investigações científicas em nutrição e gera conteúdo personalizado e atualizado sobre alimentação saudável, tendências nutricionais e recomendações baseadas em evidências.</p>
            </div>
        </div>
    </div>

    <!-- ==================== CHAT DE IA ==================== -->
    <div class="glass" style="padding:2rem;margin-bottom:3rem;border-color:rgba(103,58,183,0.2)">
        <div style="display:flex;align-items:center;gap:0.75rem;margin-bottom:1.5rem">
            <div style="width:40px;height:40px;background:linear-gradient(135deg,rgba(103,58,183,0.5),rgba(76,175,80,0.3));border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:1.2rem">🤖</div>
            <div>
                <h3 style="font-size:1.1rem;font-weight:600;color:#e8f5e9">NutriBot — Assistente de Nutrição</h3>
                <div style="display:flex;align-items:center;gap:6px">
                    <span style="width:8px;height:8px;background:#4caf50;border-radius:50%;display:inline-block;animation:pulse 2s infinite"></span>
                    <span style="font-size:0.75rem;color:#81c784">Online</span>
                </div>
            </div>
        </div>

        <!-- Área de mensagens -->
        <div id="chatMessages" style="height:380px;overflow-y:auto;padding:1rem;background:rgba(0,0,0,0.2);border-radius:12px;margin-bottom:1rem;display:flex;flex-direction:column;gap:1rem;scroll-behavior:smooth">
            <!-- Mensagem inicial da IA -->
            <div style="display:flex;gap:0.75rem;align-items:flex-start">
                <div style="width:32px;height:32px;background:linear-gradient(135deg,rgba(103,58,183,0.5),rgba(76,175,80,0.3));border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:0.9rem;flex-shrink:0">🤖</div>
                <div style="max-width:80%">
                    <div style="background:rgba(103,58,183,0.15);border:1px solid rgba(103,58,183,0.2);border-radius:12px 12px 12px 0;padding:0.85rem 1rem;font-size:0.9rem;color:#e8f5e9;line-height:1.6">
                        Olá! 👋 Sou o <strong>NutriBot</strong>, o teu assistente de nutrição baseado nas recomendações da OMS.<br><br>
                        Posso ajudar-te com perguntas sobre alimentação saudável, valores nutricionais, dicas para perder peso, aumentar massa muscular, e muito mais!<br><br>
                        <span style="color:#b39ddb">Experimenta perguntar:</span><br>
                        💬 <em>"O que comer ao pequeno-almoço?"</em><br>
                        💬 <em>"Alimentos ricos em proteína"</em><br>
                        💬 <em>"Como perder peso?"</em>
                    </div>
                    <div style="font-size:0.72rem;color:rgba(232,245,233,0.3);margin-top:0.3rem;padding-left:0.5rem">NutriBot • agora</div>
                </div>
            </div>
        </div>

        <!-- Sugestões rápidas -->
        <div style="display:flex;gap:0.5rem;flex-wrap:wrap;margin-bottom:1rem">
            <button onclick="enviarSugestao('O que comer ao pequeno-almoço?')" style="padding:0.4rem 0.85rem;background:rgba(103,58,183,0.1);border:1px solid rgba(103,58,183,0.2);border-radius:20px;color:#b39ddb;font-size:0.78rem;cursor:pointer;font-family:'Inter',sans-serif;transition:all 0.2s" onmouseover="this.style.background='rgba(103,58,183,0.2)'" onmouseout="this.style.background='rgba(103,58,183,0.1)'">☀️ Pequeno-almoço saudável</button>
            <button onclick="enviarSugestao('Alimentos ricos em proteína')" style="padding:0.4rem 0.85rem;background:rgba(103,58,183,0.1);border:1px solid rgba(103,58,183,0.2);border-radius:20px;color:#b39ddb;font-size:0.78rem;cursor:pointer;font-family:'Inter',sans-serif;transition:all 0.2s" onmouseover="this.style.background='rgba(103,58,183,0.2)'" onmouseout="this.style.background='rgba(103,58,183,0.1)'">💪 Proteínas</button>
            <button onclick="enviarSugestao('Como perder peso com alimentação saudável?')" style="padding:0.4rem 0.85rem;background:rgba(103,58,183,0.1);border:1px solid rgba(103,58,183,0.2);border-radius:20px;color:#b39ddb;font-size:0.78rem;cursor:pointer;font-family:'Inter',sans-serif;transition:all 0.2s" onmouseover="this.style.background='rgba(103,58,183,0.2)'" onmouseout="this.style.background='rgba(103,58,183,0.1)'">⚖️ Perder peso</button>
            <button onclick="enviarSugestao('Recomendações da OMS para alimentação')" style="padding:0.4rem 0.85rem;background:rgba(103,58,183,0.1);border:1px solid rgba(103,58,183,0.2);border-radius:20px;color:#b39ddb;font-size:0.78rem;cursor:pointer;font-family:'Inter',sans-serif;transition:all 0.2s" onmouseover="this.style.background='rgba(103,58,183,0.2)'" onmouseout="this.style.background='rgba(103,58,183,0.1)'">🏥 Recomendações OMS</button>
            <button onclick="enviarSugestao('Alimentos para aumentar energia')" style="padding:0.4rem 0.85rem;background:rgba(103,58,183,0.1);border:1px solid rgba(103,58,183,0.2);border-radius:20px;color:#b39ddb;font-size:0.78rem;cursor:pointer;font-family:'Inter',sans-serif;transition:all 0.2s" onmouseover="this.style.background='rgba(103,58,183,0.2)'" onmouseout="this.style.background='rgba(103,58,183,0.1)'">⚡ Mais energia</button>
            <button onclick="enviarSugestao('O que são antioxidantes?')" style="padding:0.4rem 0.85rem;background:rgba(103,58,183,0.1);border:1px solid rgba(103,58,183,0.2);border-radius:20px;color:#b39ddb;font-size:0.78rem;cursor:pointer;font-family:'Inter',sans-serif;transition:all 0.2s" onmouseover="this.style.background='rgba(103,58,183,0.2)'" onmouseout="this.style.background='rgba(103,58,183,0.1)'">🫐 Antioxidantes</button>
        </div>

        <!-- Input -->
        <div style="display:flex;gap:0.75rem">
            <input type="text" id="chatInput" placeholder="Escreve a tua pergunta sobre nutrição..." style="flex:1;padding:0.75rem 1rem;background:rgba(255,255,255,0.05);border:1px solid rgba(103,58,183,0.3);border-radius:10px;color:#e8f5e9;font-size:0.9rem;font-family:'Inter',sans-serif;outline:none;transition:all 0.2s" onfocus="this.style.borderColor='rgba(103,58,183,0.6)'" onblur="this.style.borderColor='rgba(103,58,183,0.3)'" onkeydown="if(event.key==='Enter') enviarMensagem()">
            <button onclick="enviarMensagem()" style="padding:0.75rem 1.25rem;background:linear-gradient(135deg,rgba(103,58,183,0.7),rgba(76,175,80,0.5));border:none;border-radius:10px;color:white;cursor:pointer;font-size:1rem;transition:all 0.2s" onmouseover="this.style.transform='translateY(-1px)'" onmouseout="this.style.transform='none'">
                <i class="fas fa-paper-plane"></i>
            </button>
        </div>
    </div>

    <!-- Artigos IA -->
    <div style="margin-bottom:1.5rem">
        <h2 class="section-title"><span class="green-dot"></span>Artigos Gerados por IA</h2>
        <p class="section-subtitle">Conteúdo criado com inteligência artificial</p>
    </div>

    <div class="grid-2">
        @foreach($posts as $post)
        <div class="glass-card post-card" style="background:linear-gradient(135deg,rgba(103,58,183,0.08),rgba(76,175,80,0.05))">
            @if($post->imagem)
                <img src="{{ $post->imagem }}" alt="{{ $post->titulo }}" style="width:100%;height:180px;object-fit:cover;border-radius:8px;margin-bottom:1rem" onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
                <div class="img-placeholder" style="font-size:4rem;display:none">🤖</div>
            @else
                <div class="img-placeholder" style="font-size:4rem">🤖</div>
            @endif
            <span class="tag tag-ai">✨ Gerado por IA</span>
            <h3>{{ $post->titulo }}</h3>
            <p>{{ Str::limit($post->resumo, 130) }}</p>
            <a href="{{ route('posts.show', $post->slug) }}" class="btn btn-primary" style="font-size:0.85rem;padding:0.6rem 1.2rem">
                <i class="fas fa-robot"></i> Ler Artigo
            </a>
        </div>
        @endforeach
    </div>
</div>

<script>
const respostas = [
    {
        keywords: ['pequeno-almoço', 'pequeno almoço', 'manha', 'manhã', 'breakfast'],
        resposta: '☀️ <strong>Pequeno-almoço saudável</strong><br><br>Um bom pequeno-almoço deve incluir:<br><br>🥣 <strong>Cereais integrais</strong> — aveia, pão integral ou granola sem açúcar<br>🍎 <strong>Fruta fresca</strong> — banana, maçã ou frutos vermelhos<br>🥛 <strong>Proteína</strong> — iogurte natural, ovos mexidos ou queijo cottage<br>🥜 <strong>Gorduras saudáveis</strong> — manteiga de amendoim ou abacate<br><br>💡 Evita cereais açucarados e sumos industriais. A OMS recomenda limitar o açúcar livre a menos de 25g por dia!'
    },
    {
        keywords: ['proteína', 'proteina', 'músculo', 'musculo', 'massa muscular'],
        resposta: '💪 <strong>Alimentos ricos em proteína</strong><br><br>As melhores fontes de proteína são:<br><br>🐟 <strong>Peixe</strong> — salmão (20g/100g), atum (28g/100g), sardinha (24g/100g)<br>🍗 <strong>Aves</strong> — frango (31g/100g), peru (29g/100g)<br>🥚 <strong>Ovos</strong> — 13g por 100g, muito versáteis<br>🫘 <strong>Leguminosas</strong> — lentilhas (25g/100g), grão (19g/100g)<br>🧀 <strong>Laticínios</strong> — queijo cottage (11g/100g), iogurte grego<br><br>💡 A OMS recomenda entre 0.8g a 1.2g de proteína por kg de peso corporal por dia!'
    },
    {
        keywords: ['perder peso', 'emagrecer', 'dieta', 'calorias', 'gordo', 'obesity', 'obesidade'],
        resposta: '⚖️ <strong>Alimentação para perder peso de forma saudável</strong><br><br>Dicas baseadas nas recomendações da OMS:<br><br>✅ Aumenta o consumo de <strong>hortícolas e frutas</strong> (mín. 400g/dia)<br>✅ Prefere <strong>cereais integrais</strong> em vez de refinados<br>✅ Reduz o <strong>açúcar livre</strong> para menos de 25g/dia<br>✅ Limita o <strong>sal</strong> a 5g por dia<br>✅ Bebe <strong>2 a 2.5L de água</strong> por dia<br>✅ Pratica pelo menos <strong>150 min de exercício</strong> moderado por semana<br><br>⚠️ Evita dietas radicais! A perda de peso saudável é de 0.5 a 1kg por semana.'
    },
    {
        keywords: ['oms', 'recomendação', 'recomendacao', 'organização mundial', 'diretriz'],
        resposta: '🏥 <strong>Recomendações da OMS para Alimentação Saudável</strong><br><br>As principais diretrizes são:<br><br>🥦 <strong>400g</strong> de hortícolas por dia<br>🍎 <strong>300g</strong> de fruta por dia<br>🌾 <strong>250g</strong> de cereais (preferencialmente integrais)<br>🥩 <strong>180g</strong> de proteínas magras<br>🧂 Máximo <strong>5g de sal</strong> por dia<br>🍬 Máximo <strong>25g de açúcar livre</strong> por dia<br>💧 Pelo menos <strong>2L de água</strong> por dia<br><br>💡 Seguir estas recomendações reduz significativamente o risco de doenças cardiovasculares, diabetes tipo 2 e alguns tipos de cancro!'
    },
    {
        keywords: ['energia', 'cansaço', 'cansaco', 'fadiga', 'disposição', 'disposicao'],
        resposta: '⚡ <strong>Alimentos para aumentar a energia</strong><br><br>Para manter a energia ao longo do dia:<br><br>🌾 <strong>Aveia</strong> — energia de libertação lenta, ideal ao pequeno-almoço<br>🍌 <strong>Banana</strong> — potássio e hidratos de rápida absorção<br>🥜 <strong>Frutos secos</strong> — nozes, amêndoas e cajus são excelentes<br>🐟 <strong>Peixe gordo</strong> — salmão e atum com ómega-3<br>🫐 <strong>Frutos vermelhos</strong> — antioxidantes que combatem o cansaço<br>☕ <strong>Chá verde</strong> — cafeína natural com L-teanina<br><br>💡 Evita açúcares simples que causam picos e quedas de energia!'
    },
    {
        keywords: ['antioxidante', 'antioxidantes', 'vitamina', 'mineral'],
        resposta: '🫐 <strong>Antioxidantes — O que são e onde encontrá-los</strong><br><br>Os antioxidantes protegem as células do envelhecimento e doenças crónicas.<br><br><strong>Melhores fontes:</strong><br>🫐 <strong>Mirtilos</strong> — campeões em antioxidantes<br>🍇 <strong>Uvas escuras</strong> — resveratrol poderoso<br>🥦 <strong>Brócolos</strong> — vitamina C e sulforafano<br>🍅 <strong>Tomate</strong> — licopeno (aumenta com o cozimento)<br>🫒 <strong>Azeite virgem extra</strong> — polifenóis<br>🍵 <strong>Chá verde</strong> — catequinas<br>🌰 <strong>Nozes</strong> — vitamina E e selénio<br><br>💡 A OMS recomenda uma dieta colorida e variada para maximizar a ingestão de antioxidantes!'
    },
    {
        keywords: ['hidratar', 'agua', 'água', 'beber', 'hidratação', 'hidratacao'],
        resposta: '💧 <strong>Hidratação e Alimentação Saudável</strong><br><br>A água é essencial para todas as funções do organismo!<br><br><strong>Recomendações da OMS:</strong><br>👩 <strong>Mulheres</strong> — 2.0 a 2.2L por dia<br>👨 <strong>Homens</strong> — 2.5 a 3.0L por dia<br>🏃 <strong>Atletas</strong> — adicionar 500ml a 1L por hora de exercício<br><br><strong>Alimentos ricos em água:</strong><br>🍉 Melancia (92%), 🥒 Pepino (96%), 🍓 Morango (91%), 🥬 Alface (95%)<br><br>💡 Bebe um copo de água antes de cada refeição — ajuda na digestão e no controlo do apetite!'
    },
    {
        keywords: ['vegetariano', 'vegano', 'vegan', 'vegetariana', 'plantas'],
        resposta: '🌱 <strong>Alimentação Vegetariana/Vegana Saudável</strong><br><br>É completamente possível ter uma dieta equilibrada sem carne!<br><br><strong>Proteínas vegetais completas:</strong><br>🫘 Leguminosas + cereais (feijão com arroz)<br>🌿 Quinoa (proteína completa)<br>🥜 Tofu e tempeh<br>🌱 Edamame<br><br><strong>Nutrientes a vigiar:</strong><br>💊 <strong>Vitamina B12</strong> — suplementar se vegano<br>🥩 <strong>Ferro</strong> — combinar com vitamina C para melhor absorção<br>🐟 <strong>Ómega-3</strong> — sementes de chia e linhaça<br>☀️ <strong>Vitamina D</strong> — exposição solar ou suplemento<br><br>💡 Consulta um nutricionista para personalizar o teu plano!'
    },
    {
        keywords: ['açúcar', 'acucar', 'doce', 'diabetes', 'glicemia'],
        resposta: '🍬 <strong>Açúcar e Saúde — O que precisas de saber</strong><br><br>A OMS recomenda limitar o açúcar livre a <strong>menos de 25g por dia</strong> (idealmente menos de 10% das calorias).<br><br><strong>Açúcares escondidos em produtos comuns:</strong><br>🥤 Refrigerante (330ml) — 35g de açúcar<br>🍦 Iogurte de frutas — 15-20g<br>🥣 Cereais de pequeno-almoço — 10-25g/porção<br>🍞 Pão de forma — 3-5g/fatia<br><br><strong>Alternativas saudáveis:</strong><br>🍯 Mel com moderação<br>🍌 Banana madura para adoçar<br>🫐 Frutos secos para snacks<br><br>⚠️ Lê sempre os rótulos! O açúcar esconde-se com nomes como "xarope de glucose", "frutose" ou "dextrose".'
    },
    {
        keywords: ['sal', 'sódio', 'sodio', 'pressão', 'pressao', 'hipertensão', 'hipertensao'],
        resposta: '🧂 <strong>Sal e Sódio na Alimentação</strong><br><br>A OMS recomenda no máximo <strong>5g de sal por dia</strong> (2g de sódio).<br><br><strong>Onde se esconde o sal:</strong><br>🍞 Pão — até 1g por fatia<br>🧀 Queijo — muito variável<br>🥫 Conservas e enlatados<br>🍿 Snacks processados<br>🥩 Carnes processadas (fiambre, salsicha)<br><br><strong>Como reduzir:</strong><br>🌿 Usa ervas aromáticas e especiarias<br>🍋 Limão e vinagre realçam sabores<br>📖 Lê os rótulos (procura "sódio")<br>🏠 Cozinha em casa mais frequentemente<br><br>💡 Reduzir o sal diminui significativamente o risco de hipertensão e doenças cardiovasculares!'
    }
];

function obterResposta(mensagem) {
    const msg = mensagem.toLowerCase().normalize('NFD').replace(/[\u0300-\u036f]/g, '');

    for (const item of respostas) {
        for (const keyword of item.keywords) {
            const kw = keyword.toLowerCase().normalize('NFD').replace(/[\u0300-\u036f]/g, '');
            if (msg.includes(kw)) {
                return item.resposta;
            }
        }
    }

    return '🤔 Não tenho uma resposta específica para essa pergunta, mas posso ajudar-te com temas como:<br><br>🥗 Alimentação saudável · 💪 Proteínas · ⚖️ Controlo de peso<br>🏥 Recomendações OMS · ⚡ Energia · 🫐 Antioxidantes<br>💧 Hidratação · 🌱 Dieta vegetariana · 🍬 Açúcar · 🧂 Sal<br><br>Tenta reformular a tua pergunta usando uma destas palavras-chave!';
}

function adicionarMensagem(texto, tipo) {
    const chat = document.getElementById('chatMessages');
    const agora = new Date().toLocaleTimeString('pt-PT', { hour: '2-digit', minute: '2-digit' });
    const div = document.createElement('div');

    if (tipo === 'user') {
        div.innerHTML = `
            <div style="display:flex;justify-content:flex-end;gap:0.75rem;align-items:flex-start">
                <div style="max-width:80%;text-align:right">
                    <div style="background:linear-gradient(135deg,rgba(76,175,80,0.25),rgba(76,175,80,0.15));border:1px solid rgba(76,175,80,0.2);border-radius:12px 12px 0 12px;padding:0.85rem 1rem;font-size:0.9rem;color:#e8f5e9;line-height:1.6">${texto}</div>
                    <div style="font-size:0.72rem;color:rgba(232,245,233,0.3);margin-top:0.3rem;padding-right:0.5rem">Tu • ${agora}</div>
                </div>
                <div style="width:32px;height:32px;background:linear-gradient(135deg,#4caf50,#2e7d32);border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:0.85rem;flex-shrink:0">👤</div>
            </div>`;
    } else {
        div.innerHTML = `
            <div style="display:flex;gap:0.75rem;align-items:flex-start">
                <div style="width:32px;height:32px;background:linear-gradient(135deg,rgba(103,58,183,0.5),rgba(76,175,80,0.3));border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:0.9rem;flex-shrink:0">🤖</div>
                <div style="max-width:80%">
                    <div style="background:rgba(103,58,183,0.15);border:1px solid rgba(103,58,183,0.2);border-radius:12px 12px 12px 0;padding:0.85rem 1rem;font-size:0.9rem;color:#e8f5e9;line-height:1.6">${texto}</div>
                    <div style="font-size:0.72rem;color:rgba(232,245,233,0.3);margin-top:0.3rem;padding-left:0.5rem">NutriBot • ${agora}</div>
                </div>
            </div>`;
    }

    chat.appendChild(div);
    chat.scrollTop = chat.scrollHeight;
}

function mostrarTyping() {
    const chat = document.getElementById('chatMessages');
    const div = document.createElement('div');
    div.id = 'typing';
    div.innerHTML = `
        <div style="display:flex;gap:0.75rem;align-items:flex-start">
            <div style="width:32px;height:32px;background:linear-gradient(135deg,rgba(103,58,183,0.5),rgba(76,175,80,0.3));border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:0.9rem;flex-shrink:0">🤖</div>
            <div style="background:rgba(103,58,183,0.15);border:1px solid rgba(103,58,183,0.2);border-radius:12px;padding:0.85rem 1rem">
                <span style="display:inline-flex;gap:4px;align-items:center">
                    <span style="width:6px;height:6px;background:#b39ddb;border-radius:50%;animation:bounce 0.8s infinite 0s"></span>
                    <span style="width:6px;height:6px;background:#b39ddb;border-radius:50%;animation:bounce 0.8s infinite 0.2s"></span>
                    <span style="width:6px;height:6px;background:#b39ddb;border-radius:50%;animation:bounce 0.8s infinite 0.4s"></span>
                </span>
            </div>
        </div>`;
    chat.appendChild(div);
    chat.scrollTop = chat.scrollHeight;
}

function enviarMensagem() {
    const input = document.getElementById('chatInput');
    const texto = input.value.trim();
    if (!texto) return;

    adicionarMensagem(texto, 'user');
    input.value = '';
    mostrarTyping();

    setTimeout(() => {
        document.getElementById('typing')?.remove();
        adicionarMensagem(obterResposta(texto), 'bot');
    }, 1000 + Math.random() * 800);
}

function enviarSugestao(texto) {
    document.getElementById('chatInput').value = texto;
    enviarMensagem();
}
</script>

<style>
@keyframes bounce {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-6px); }
}
</style>

@endsection
