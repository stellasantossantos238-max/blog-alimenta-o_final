@extends('layouts.app')
@section('title', 'Recomendações OMS')
@section('content')

<div class="container section">

    {{-- ── CABEÇALHO ─────────────────────────────────────────────── --}}
    <div style="text-align:center;margin-bottom:2.5rem">
        <div style="display:inline-block;background:#1565c0;color:#fff;
                    font-size:0.8rem;font-weight:700;letter-spacing:0.06em;
                    text-transform:uppercase;padding:0.35rem 1rem;border-radius:4px;
                    margin-bottom:0.85rem">
            🏥 Organização Mundial de Saúde
        </div>
        <h1 style="font-size:clamp(1.6rem,4vw,2.4rem);font-weight:700;color:#fff;
                   text-shadow:0 2px 12px rgba(0,0,0,0.4);margin-bottom:0.5rem">
            <span class="green-dot"></span>Recomendações da OMS
        </h1>
        <p style="color:rgba(255,255,255,0.8);font-size:0.95rem">
            Diretrizes oficiais para uma alimentação diária equilibrada
        </p>
    </div>

    {{-- ── INTRO CARD ──────────────────────────────────────────────── --}}
    <div class="card" style="padding:1.75rem;margin-bottom:2.5rem;
                              border-left:4px solid #1565c0">
        <div style="display:flex;gap:1.25rem;align-items:flex-start;flex-wrap:wrap">
            <div style="font-size:3.5rem;flex-shrink:0;line-height:1">🌍</div>
            <div style="flex:1;min-width:200px">
                <h3 style="font-size:1rem;font-weight:700;color:#1a1a1a;margin-bottom:0.5rem">
                    O que é a OMS?
                </h3>
                <p style="color:#555;font-size:0.88rem;line-height:1.75;margin:0">
                    A Organização Mundial de Saúde estabelece diretrizes nutricionais baseadas em décadas de investigação científica. As recomendações abaixo representam as quantidades diárias ideais para um adulto saudável manter uma alimentação equilibrada e reduzir o risco de doenças crónicas.
                </p>
            </div>
        </div>
    </div>

    {{-- ── RECOMENDAÇÕES EM CARDS ──────────────────────────────────── --}}
    <div class="grid-2" style="margin-bottom:2.5rem">
        @foreach($recommendations as $rec)
        <div class="card" style="padding:1.4rem;display:flex;gap:1.25rem;align-items:flex-start">
            <div style="font-size:2.2rem;flex-shrink:0;line-height:1">{{ $rec->category->icone }}</div>
            <div style="flex:1;min-width:0">
                <div style="display:flex;justify-content:space-between;align-items:center;
                            gap:0.5rem;flex-wrap:wrap;margin-bottom:0.45rem">
                    <h3 style="font-size:0.95rem;font-weight:700;color:#1a1a1a">
                        {{ $rec->category->nome }}
                    </h3>
                    <span style="display:inline-block;background:#2e7d32;color:#fff;
                                 font-size:0.72rem;font-weight:700;letter-spacing:0.05em;
                                 padding:0.2rem 0.7rem;border-radius:4px;white-space:nowrap">
                        {{ $rec->quantidade_diaria_gramas }}{{ $rec->unidade }}/dia
                    </span>
                </div>
                <p style="font-size:0.84rem;color:#666;line-height:1.65;margin-bottom:0.85rem">
                    {{ $rec->descricao }}
                </p>
                <div class="progress-bar">
                    <div class="progress-fill"
                         style="width:{{ min(100, ($rec->quantidade_diaria_gramas / 500) * 100) }}%">
                    </div>
                </div>
                <div style="display:flex;justify-content:space-between;
                            font-size:0.72rem;color:#aaa;margin-top:0.35rem">
                    <span>0g</span>
                    <span>{{ $rec->quantidade_diaria_gramas }}g recomendado</span>
                    <span>500g</span>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- ── PIRÂMIDE ALIMENTAR ──────────────────────────────────────── --}}
    <div class="card" style="padding:1.75rem;margin-bottom:1.5rem">
        <h2 style="font-size:1.15rem;font-weight:700;color:#1a1a1a;margin-bottom:0.3rem">
            <span class="green-dot"></span>Pirâmide Alimentar Interativa
        </h2>
        <p style="color:#888;font-size:0.84rem;margin-bottom:2rem">
            Clica em cada nível para saber mais
        </p>
        <div style="max-width:560px;margin:0 auto">

            @php
            $niveis = [
                ['emoji'=>'🍬','label'=>'Açúcares',              'w'=>'12%', 'bg'=>'linear-gradient(135deg,rgba(244,67,54,0.18),rgba(244,67,54,0.08))',  'border'=>'rgba(244,67,54,0.3)',  'color'=>'#c62828'],
                ['emoji'=>'🥑','label'=>'Gorduras Saudáveis',    'w'=>'26%', 'bg'=>'linear-gradient(135deg,rgba(255,152,0,0.18),rgba(255,152,0,0.08))',   'border'=>'rgba(255,152,0,0.3)',  'color'=>'#e65100'],
                ['emoji'=>'🥛','label'=>'Laticínios & Proteínas','w'=>'40%', 'bg'=>'linear-gradient(135deg,rgba(33,150,243,0.18),rgba(33,150,243,0.08))',  'border'=>'rgba(33,150,243,0.3)', 'color'=>'#1565c0'],
                ['emoji'=>'🌾','label'=>'Cereais & Leguminosas', 'w'=>'55%', 'bg'=>'linear-gradient(135deg,rgba(255,193,7,0.18),rgba(255,193,7,0.08))',    'border'=>'rgba(255,193,7,0.3)',  'color'=>'#e65100'],
                ['emoji'=>'🍎','label'=>'Frutas',                'w'=>'70%', 'bg'=>'linear-gradient(135deg,rgba(139,195,74,0.2),rgba(139,195,74,0.08))',   'border'=>'rgba(139,195,74,0.3)', 'color'=>'#33691e'],
                ['emoji'=>'🥦','label'=>'Hortícolas (Base)',     'w'=>'85%', 'bg'=>'linear-gradient(135deg,rgba(76,175,80,0.22),rgba(76,175,80,0.08))',    'border'=>'rgba(76,175,80,0.35)', 'color'=>'#1b5e20'],
            ];
            @endphp

            @foreach($niveis as $i => $n)
            <div class="piramide-nivel" onclick="toggleNivel({{ $i }})"
                 data-idx="{{ $i }}"
                 style="cursor:pointer;margin:0 auto {{ $i < count($niveis)-1 ? '4px' : '0' }};
                        width:{{ $n['w'] }};padding:0.55rem 0;
                        background:{{ $n['bg'] }};
                        border:1px solid {{ $n['border'] }};
                        border-radius:6px;text-align:center;
                        font-size:0.75rem;color:{{ $n['color'] }};
                        font-weight:700;transition:all 0.25s;
                        box-shadow:0 1px 4px rgba(0,0,0,0.06)">
                {{ $n['emoji'] }} {{ $n['label'] }}
            </div>
            @endforeach

            {{-- Info box --}}
            <div id="piramide-info" style="display:none;margin-top:1.25rem">
                <div id="piramide-texto"
                     style="padding:1rem 1.2rem;border-radius:8px;
                            font-size:0.87rem;line-height:1.75;color:#444;
                            border:1px solid #e0e0e0;background:#fafafa">
                </div>
            </div>
        </div>
    </div>

    {{-- ── TABELA GRUPOS ETÁRIOS ───────────────────────────────────── --}}
    <div class="card" style="padding:1.75rem;margin-bottom:1.5rem">
        <h2 style="font-size:1.15rem;font-weight:700;color:#1a1a1a;margin-bottom:0.3rem">
            <span class="green-dot"></span>Doses Diárias por Grupo Etário
        </h2>
        <p style="color:#888;font-size:0.84rem;margin-bottom:1.5rem">
            Recomendações da OMS adaptadas por faixa etária
        </p>
        <div style="overflow-x:auto">
            <table class="table">
                <thead>
                    <tr>
                        <th>Grupo Etário</th>
                        <th>🥦 Hortícolas</th>
                        <th>🍎 Frutas</th>
                        <th>🌾 Cereais</th>
                        <th>🥩 Proteínas</th>
                        <th>🥛 Laticínios</th>
                        <th>💧 Água</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $grupos = [
                        ['badge'=>'badge-blue', 'icon'=>'👶', 'label'=>'1-3 anos',   'v'=>['150g','150g','85g', '60g', '250ml','1.3L']],
                        ['badge'=>'badge-blue', 'icon'=>'🧒', 'label'=>'4-8 anos',   'v'=>['200g','200g','130g','90g', '350ml','1.6L']],
                        ['badge'=>'badge-blue', 'icon'=>'🧑', 'label'=>'9-13 anos',  'v'=>['280g','250g','180g','130g','450ml','2.1L']],
                        ['badge'=>'badge-blue', 'icon'=>'🧑‍🎓','label'=>'14-18 anos','v'=>['350g','280g','220g','160g','500ml','2.3L']],
                        ['badge'=>'badge-green','icon'=>'🧑‍💼','label'=>'19-50 anos','v'=>['400g','300g','250g','180g','500ml','2.5L'], 'destaque'=>true],
                        ['badge'=>'badge-blue', 'icon'=>'🧓', 'label'=>'51-70 anos', 'v'=>['380g','280g','220g','160g','550ml','2.3L']],
                        ['badge'=>'badge-blue', 'icon'=>'👴', 'label'=>'+70 anos',   'v'=>['350g','250g','200g','150g','600ml','2.0L']],
                    ];
                    @endphp
                    @foreach($grupos as $g)
                    <tr @if(!empty($g['destaque'])) style="background:rgba(46,125,50,0.04)" @endif>
                        <td>
                            <span style="display:inline-block;
                                         background:{{ !empty($g['destaque']) ? '#2e7d32' : '#1565c0' }};
                                         color:#fff;font-size:0.72rem;font-weight:700;
                                         padding:0.2rem 0.7rem;border-radius:4px">
                                {{ $g['icon'] }} {{ $g['label'] }}
                            </span>
                        </td>
                        @foreach($g['v'] as $val)
                        <td @if(!empty($g['destaque'])) style="font-weight:700;color:#2e7d32" @endif>
                            {{ $val }}
                        </td>
                        @endforeach
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <p style="font-size:0.74rem;color:#aaa;margin-top:0.85rem">
            * A linha destacada a verde representa os valores de referência para adultos saudáveis usados neste sistema.
        </p>
    </div>

    {{-- ── LIMITES MÁXIMOS ─────────────────────────────────────────── --}}
    <div class="card" style="padding:1.75rem;margin-bottom:1.5rem">
        <h2 style="font-size:1.15rem;font-weight:700;color:#1a1a1a;margin-bottom:0.3rem">
            <span class="green-dot"></span>Limites Máximos Diários
        </h2>
        <p style="color:#888;font-size:0.84rem;margin-bottom:1.75rem">
            Valores que não devem ser ultrapassados para um adulto saudável
        </p>
        <div class="grid-3">

            {{-- Açúcar --}}
            <div class="card" style="padding:1.4rem;text-align:center;
                                      border-top:3px solid rgba(244,67,54,0.5)">
                <div style="font-size:2.5rem;margin-bottom:0.65rem">🍬</div>
                <h3 style="font-size:0.95rem;font-weight:700;color:#c62828;margin-bottom:0.4rem">
                    Açúcar Livre
                </h3>
                <div style="font-size:2.2rem;font-weight:700;color:#c62828;margin-bottom:0.2rem">25g</div>
                <div style="font-size:0.78rem;color:#888;margin-bottom:1rem">≈ 6 colheres de chá/dia</div>
                <div class="progress-bar">
                    <div style="height:100%;width:100%;border-radius:4px;
                                background:linear-gradient(90deg,#81c784,#ffe082,#ef5350)"></div>
                </div>
                <div style="font-size:0.73rem;color:#aaa;margin-top:0.5rem">
                    Ideal: &lt;10% das calorias diárias
                </div>
            </div>

            {{-- Sal --}}
            <div class="card" style="padding:1.4rem;text-align:center;
                                      border-top:3px solid rgba(255,193,7,0.5)">
                <div style="font-size:2.5rem;margin-bottom:0.65rem">🧂</div>
                <h3 style="font-size:0.95rem;font-weight:700;color:#e65100;margin-bottom:0.4rem">
                    Sal (Sódio)
                </h3>
                <div style="font-size:2.2rem;font-weight:700;color:#e65100;margin-bottom:0.2rem">5g</div>
                <div style="font-size:0.78rem;color:#888;margin-bottom:1rem">≈ 1 colher de chá/dia</div>
                <div class="progress-bar">
                    <div style="height:100%;width:100%;border-radius:4px;
                                background:linear-gradient(90deg,#81c784,#ffe082,#ef5350)"></div>
                </div>
                <div style="font-size:0.73rem;color:#aaa;margin-top:0.5rem">
                    Equivale a 2g de sódio
                </div>
            </div>

            {{-- Gordura --}}
            <div class="card" style="padding:1.4rem;text-align:center;
                                      border-top:3px solid rgba(255,152,0,0.5)">
                <div style="font-size:2.5rem;margin-bottom:0.65rem">🧈</div>
                <h3 style="font-size:0.95rem;font-weight:700;color:#bf360c;margin-bottom:0.4rem">
                    Gordura Saturada
                </h3>
                <div style="font-size:2.2rem;font-weight:700;color:#bf360c;margin-bottom:0.2rem">22g</div>
                <div style="font-size:0.78rem;color:#888;margin-bottom:1rem">para dieta de 2000 kcal</div>
                <div class="progress-bar">
                    <div style="height:100%;width:100%;border-radius:4px;
                                background:linear-gradient(90deg,#81c784,#ffe082,#ef5350)"></div>
                </div>
                <div style="font-size:0.73rem;color:#aaa;margin-top:0.5rem">
                    Máx. 10% das calorias diárias
                </div>
            </div>
        </div>
    </div>

    {{-- ── CALCULADORA IMC ─────────────────────────────────────────── --}}
    <div class="card" style="padding:1.75rem;margin-bottom:1.5rem">
        <h2 style="font-size:1.15rem;font-weight:700;color:#1a1a1a;margin-bottom:0.3rem">
            <span class="green-dot"></span>Calculadora de IMC
        </h2>
        <p style="color:#888;font-size:0.84rem;margin-bottom:1.75rem">
            Índice de Massa Corporal segundo a classificação da OMS
        </p>
        <div class="imc-grid">
            {{-- Formulário --}}
            <div>
                <div class="form-group">
                    <label class="form-label">Peso (kg)</label>
                    <input type="number" id="imcPeso" class="form-control"
                           placeholder="Ex: 70" min="1" max="300">
                </div>
                <div class="form-group">
                    <label class="form-label">Altura (cm)</label>
                    <input type="number" id="imcAltura" class="form-control"
                           placeholder="Ex: 170" min="50" max="250">
                </div>
                <div class="form-group">
                    <label class="form-label">Idade</label>
                    <input type="number" id="imcIdade" class="form-control"
                           placeholder="Ex: 30" min="1" max="120">
                </div>
                <button onclick="calcularIMC()" class="btn btn-primary" style="width:100%">
                    <i class="fas fa-calculator"></i> Calcular IMC
                </button>
            </div>
            {{-- Resultado --}}
            <div>
                <div id="imcResultado" style="display:none">
                    <div id="imcValor"
                         style="text-align:center;font-size:3.5rem;font-weight:700;
                                margin-bottom:0.4rem"></div>
                    <div id="imcCategoria"
                         style="text-align:center;font-size:1rem;font-weight:600;
                                margin-bottom:1.25rem;padding:0.65rem;border-radius:8px;
                                border:1px solid #e0e0e0"></div>
                    <div id="imcConselho"
                         style="font-size:0.85rem;color:#555;line-height:1.75;
                                padding:1rem;background:#f9f9f9;border-radius:8px;
                                border:1px solid #eee"></div>
                </div>
                <div id="imcTabela">
                    <table class="table" style="font-size:0.84rem">
                        <thead>
                            <tr><th>IMC</th><th>Classificação OMS</th></tr>
                        </thead>
                        <tbody>
                            <tr><td>&lt; 18.5</td><td style="color:#1565c0">Baixo Peso</td></tr>
                            <tr><td>18.5 – 24.9</td><td style="color:#2e7d32">✅ Peso Normal</td></tr>
                            <tr><td>25.0 – 29.9</td><td style="color:#e65100">⚠️ Pré-obesidade</td></tr>
                            <tr><td>30.0 – 34.9</td><td style="color:#bf360c">Obesidade Grau I</td></tr>
                            <tr><td>35.0 – 39.9</td><td style="color:#b71c1c">Obesidade Grau II</td></tr>
                            <tr><td>≥ 40.0</td>   <td style="color:#880e4f">Obesidade Grau III</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- ── RESUMO SEMANAL ───────────────────────────────────────────── --}}
    <div class="card" style="padding:1.75rem;margin-bottom:1.5rem">
        <h2 style="font-size:1.15rem;font-weight:700;color:#1a1a1a;margin-bottom:1.4rem">
            <span class="green-dot"></span>Resumo Semanal
        </h2>
        <div style="overflow-x:auto">
            <table class="table">
                <thead>
                    <tr>
                        <th>Categoria</th>
                        <th>Quantidade Diária</th>
                        <th>Quantidade Semanal</th>
                        <th>Equivalente</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recommendations as $rec)
                    <tr>
                        <td>
                            <span style="margin-right:6px">{{ $rec->category->icone }}</span>
                            {{ $rec->category->nome }}
                        </td>
                        <td>
                            <span style="display:inline-block;background:#2e7d32;color:#fff;
                                         font-size:0.72rem;font-weight:700;
                                         padding:0.2rem 0.65rem;border-radius:4px">
                                {{ $rec->quantidade_diaria_gramas }}g
                            </span>
                        </td>
                        <td>
                            <span style="display:inline-block;background:#1565c0;color:#fff;
                                         font-size:0.72rem;font-weight:700;
                                         padding:0.2rem 0.65rem;border-radius:4px">
                                {{ $rec->quantidade_diaria_gramas * 7 }}g
                            </span>
                        </td>
                        <td style="color:#888;font-size:0.84rem">
                            {{ round($rec->quantidade_diaria_gramas / 100, 1) }} porções de 100g
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- ── GRÁFICO ──────────────────────────────────────────────────── --}}
    <div class="card" style="padding:1.75rem">
        <h2 style="font-size:1.15rem;font-weight:700;color:#1a1a1a;margin-bottom:1.4rem">
            <span class="green-dot"></span>Distribuição Visual
        </h2>
        <div style="max-width:460px;margin:0 auto">
            <canvas id="omsChart" height="300"></canvas>
        </div>
    </div>

</div>

{{-- ── ESTILOS LOCAIS ───────────────────────────────────────────────── --}}
<style>
/* Pirâmide hover */
.piramide-nivel:hover {
    filter: brightness(0.94);
    transform: scaleX(1.02);
}
.piramide-nivel.active-nivel {
    box-shadow: 0 0 0 2px rgba(46,125,50,0.45);
}

/* Grelha IMC responsiva */
.imc-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 2rem;
    align-items: start;
}

/* Responsividade */
@media (max-width: 720px) {
    .grid-2  { grid-template-columns: 1fr !important; }
    .grid-3  { grid-template-columns: 1fr !important; }
    .imc-grid { grid-template-columns: 1fr !important; }
}
@media (max-width: 500px) {
    .table th, .table td { font-size: 0.78rem; padding: 0.5rem 0.6rem; }
}
</style>

{{-- ── SCRIPTS ──────────────────────────────────────────────────────── --}}
<script>
// ======= GRÁFICO =======
const ctx = document.getElementById('omsChart').getContext('2d');
new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: @json($recommendations->pluck('category.nome')),
        datasets: [{
            data: @json($recommendations->pluck('quantidade_diaria_gramas')),
            backgroundColor: [
                'rgba(76,175,80,0.75)','rgba(139,195,74,0.75)','rgba(255,193,7,0.75)',
                'rgba(255,87,34,0.75)','rgba(33,150,243,0.75)','rgba(156,39,176,0.75)',
                'rgba(0,188,212,0.75)','rgba(244,67,54,0.75)'
            ],
            borderColor: '#fff',
            borderWidth: 2
        }]
    },
    options: {
        plugins: {
            legend: {
                labels: { color: '#444', font: { size: 12, family: 'inherit' } }
            }
        }
    }
});

// ======= PIRÂMIDE =======
const piramideInfo = [
    { titulo:'🍬 Açúcares — Consumir com Moderação',
      texto:'Os açúcares livres devem representar menos de 10% da ingestão calórica diária (idealmente menos de 5%). Evite refrigerantes, bolos, biscoitos e alimentos ultraprocessados. A OMS recomenda no máximo 25g de açúcar livre por dia.',
      bg:'#fff3f3', border:'rgba(244,67,54,0.25)', cor:'#c62828' },
    { titulo:'🥑 Gorduras Saudáveis — Com Moderação',
      texto:'Prefira gorduras insaturadas presentes no azeite, abacate, nozes e sementes. Limite as gorduras saturadas a menos de 10% das calorias diárias. Elimine totalmente as gorduras trans industriais.',
      bg:'#fff8f0', border:'rgba(255,152,0,0.25)', cor:'#e65100' },
    { titulo:'🥛 Laticínios & Proteínas — 2 a 3 Porções/dia',
      texto:'Inclua diariamente fontes de proteína magra como peixe, frango, ovos e leguminosas. Os laticínios fornecem cálcio essencial. A OMS recomenda pelo menos 2 porções de peixe por semana, especialmente peixe gordo rico em ómega-3.',
      bg:'#f0f7ff', border:'rgba(33,150,243,0.25)', cor:'#1565c0' },
    { titulo:'🌾 Cereais & Leguminosas — 3 a 4 Porções/dia',
      texto:'Prefira sempre cereais integrais em vez de refinados. O arroz integral, aveia, quinoa e pão integral fornecem fibra, vitaminas do complexo B e energia de libertação lenta. As leguminosas são uma excelente fonte de proteína vegetal e fibra.',
      bg:'#fffdf0', border:'rgba(255,193,7,0.25)', cor:'#e65100' },
    { titulo:'🍎 Frutas — Mínimo 300g/dia',
      texto:'Consuma pelo menos 300g de fruta fresca por dia, preferencialmente variada e da época. A fruta fornece vitaminas, minerais, fibra e antioxidantes. Evite sumos de fruta industriais pois perdem a fibra e concentram os açúcares.',
      bg:'#f4fbf0', border:'rgba(139,195,74,0.3)', cor:'#33691e' },
    { titulo:'🥦 Hortícolas — Base da Alimentação (400g/dia)',
      texto:'Os hortícolas devem ser a base de todas as refeições. A OMS recomenda pelo menos 400g por dia entre frutas e vegetais. São ricos em fibra, vitaminas, minerais e fitoquímicos que protegem contra doenças cardiovasculares, diabetes e cancro.',
      bg:'#f1f8f1', border:'rgba(76,175,80,0.3)', cor:'#1b5e20' },
];

let nivelAtivo = -1;

function toggleNivel(index) {
    const infoBox = document.getElementById('piramide-info');
    const texto   = document.getElementById('piramide-texto');
    const info    = piramideInfo[index];

    document.querySelectorAll('.piramide-nivel').forEach(n => n.classList.remove('active-nivel'));

    if (nivelAtivo === index) {
        infoBox.style.display = 'none';
        nivelAtivo = -1;
        return;
    }

    nivelAtivo = index;
    document.querySelectorAll('.piramide-nivel')[index].classList.add('active-nivel');
    texto.innerHTML = `<strong style="color:${info.cor};display:block;margin-bottom:0.45rem">${info.titulo}</strong>${info.texto}`;
    texto.style.background   = info.bg;
    texto.style.borderColor  = info.border;
    infoBox.style.display = 'block';
}

// ======= CALCULADORA IMC =======
function calcularIMC() {
    const peso   = parseFloat(document.getElementById('imcPeso').value);
    const altura = parseFloat(document.getElementById('imcAltura').value) / 100;
    const idade  = parseInt(document.getElementById('imcIdade').value);

    if (!peso || !altura || !idade) {
        alert('Por favor preenche todos os campos!');
        return;
    }

    const imc = peso / (altura * altura);
    const imcFormatado = imc.toFixed(1);
    let categoria, cor, bg, conselho;

    if (imc < 18.5) {
        categoria = '⚠️ Baixo Peso';       cor = '#1565c0'; bg = '#f0f7ff';
        conselho  = 'O seu IMC está abaixo do normal. Consulte um nutricionista para aumentar a ingestão calórica de forma saudável. Foque-se em alimentos ricos em nutrientes como frutos secos, leguminosas e proteínas magras.';
    } else if (imc < 25) {
        categoria = '✅ Peso Normal';       cor = '#2e7d32'; bg = '#f1f8f1';
        conselho  = 'Parabéns! O seu peso está dentro dos valores saudáveis segundo a OMS. Mantenha os seus hábitos alimentares equilibrados e a prática regular de exercício físico.';
    } else if (imc < 30) {
        categoria = '⚠️ Pré-obesidade';    cor = '#e65100'; bg = '#fff8f0';
        conselho  = 'O seu IMC indica pré-obesidade. Considere reduzir o consumo de açúcares e gorduras saturadas, aumentar a ingestão de hortícolas e frutas e praticar pelo menos 150 minutos de exercício por semana.';
    } else if (imc < 35) {
        categoria = '🔴 Obesidade Grau I'; cor = '#bf360c'; bg = '#fff3f0';
        conselho  = 'Recomenda-se consultar um médico e nutricionista. Pequenas mudanças na alimentação e estilo de vida podem ter um grande impacto na sua saúde a longo prazo.';
    } else if (imc < 40) {
        categoria = '🔴 Obesidade Grau II';cor = '#b71c1c'; bg = '#fff0f0';
        conselho  = 'É importante consultar um profissional de saúde. Um programa estruturado de perda de peso com acompanhamento médico e nutricional é fortemente recomendado.';
    } else {
        categoria = '🔴 Obesidade Grau III';cor = '#880e4f'; bg = '#fdf0f6';
        conselho  = 'Consulte urgentemente um médico. A obesidade grau III está associada a riscos significativos para a saúde. O acompanhamento médico especializado é essencial.';
    }

    const valEl  = document.getElementById('imcValor');
    const catEl  = document.getElementById('imcCategoria');
    const conEl  = document.getElementById('imcConselho');
    const resEl  = document.getElementById('imcResultado');
    const tabEl  = document.getElementById('imcTabela');

    valEl.textContent = imcFormatado;
    valEl.style.color = cor;

    catEl.textContent        = categoria;
    catEl.style.color        = cor;
    catEl.style.background   = bg;
    catEl.style.borderColor  = cor + '44';

    conEl.textContent = conselho;

    resEl.style.display = 'block';
    tabEl.style.display = 'none';
}
</script>

@endsection
