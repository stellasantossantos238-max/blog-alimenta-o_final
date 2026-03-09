@extends('layouts.app')
@section('title', 'Recomendações OMS')
@section('content')

<div class="container section">
    <div style="text-align:center;margin-bottom:3rem">
        <span class="badge badge-blue" style="margin-bottom:1rem;font-size:0.9rem;padding:0.5rem 1rem">🏥 Organização Mundial de Saúde</span>
        <h1 class="section-title">Recomendações da OMS</h1>
        <p class="section-subtitle">Diretrizes oficiais para uma alimentação diária equilibrada</p>
    </div>

    <!-- Intro card -->
    <div class="glass-strong" style="padding:2rem;margin-bottom:3rem;background:linear-gradient(135deg,rgba(2,136,209,0.1),rgba(76,175,80,0.05));border-color:rgba(2,136,209,0.2)">
        <div style="display:grid;grid-template-columns:auto 1fr;gap:1.5rem;align-items:center">
            <div style="font-size:4rem">🌍</div>
            <div>
                <h3 style="margin-bottom:0.5rem;color:#90caf9">O que é a OMS?</h3>
                <p style="color:rgba(232,245,233,0.6);font-size:0.9rem;line-height:1.7">A Organização Mundial de Saúde estabelece diretrizes nutricionais baseadas em décadas de investigação científica. As recomendações abaixo representam as quantidades diárias ideais para um adulto saudável manter uma alimentação equilibrada e reduzir o risco de doenças crónicas.</p>
            </div>
        </div>
    </div>

    <!-- Recomendações em cards -->
    <div class="grid-2" style="margin-bottom:3rem">
        @foreach($recommendations as $rec)
        <div class="glass-card" style="padding:1.5rem;display:flex;gap:1.5rem;align-items:flex-start">
            <div style="font-size:2.5rem;flex-shrink:0">{{ $rec->category->icone }}</div>
            <div style="flex:1">
                <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:0.5rem">
                    <h3 style="font-size:1rem;font-weight:600;color:#e8f5e9">{{ $rec->category->nome }}</h3>
                    <span class="badge badge-green">{{ $rec->quantidade_diaria_gramas }}{{ $rec->unidade }}/dia</span>
                </div>
                <p style="font-size:0.85rem;color:rgba(232,245,233,0.6);margin-bottom:1rem">{{ $rec->descricao }}</p>
                <div class="progress-bar">
                    <div class="progress-fill" style="width:{{ min(100, ($rec->quantidade_diaria_gramas / 500) * 100) }}%"></div>
                </div>
                <div style="display:flex;justify-content:space-between;font-size:0.75rem;color:rgba(232,245,233,0.4);margin-top:0.4rem">
                    <span>0g</span>
                    <span>{{ $rec->quantidade_diaria_gramas }}g recomendado</span>
                    <span>500g</span>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- ==================== PIRÂMIDE ALIMENTAR ==================== -->
    <div class="glass" style="padding:2rem;margin-bottom:1.5rem">
        <h2 style="margin-bottom:0.5rem;font-size:1.3rem"><span class="green-dot"></span>Pirâmide Alimentar Interativa</h2>
        <p style="color:rgba(232,245,233,0.5);font-size:0.85rem;margin-bottom:2rem">Clica em cada nível para saber mais</p>
        <div style="max-width:600px;margin:0 auto">
            <!-- Nível 1 - Topo -->
            <div class="piramide-nivel" onclick="toggleNivel(0)" style="cursor:pointer;margin:0 auto 4px;width:12%;padding:0.6rem 0;background:linear-gradient(135deg,rgba(244,67,54,0.5),rgba(244,67,54,0.3));border-radius:6px;text-align:center;font-size:0.7rem;color:#ef9a9a;font-weight:600;transition:all 0.3s">
                🍬 Açúcares
            </div>
            <!-- Nível 2 -->
            <div class="piramide-nivel" onclick="toggleNivel(1)" style="cursor:pointer;margin:0 auto 4px;width:26%;padding:0.6rem 0;background:linear-gradient(135deg,rgba(255,152,0,0.5),rgba(255,152,0,0.3));border-radius:6px;text-align:center;font-size:0.75rem;color:#ffcc80;font-weight:600;transition:all 0.3s">
                🥑 Gorduras Saudáveis
            </div>
            <!-- Nível 3 -->
            <div class="piramide-nivel" onclick="toggleNivel(2)" style="cursor:pointer;margin:0 auto 4px;width:40%;padding:0.6rem 0;background:linear-gradient(135deg,rgba(33,150,243,0.5),rgba(33,150,243,0.3));border-radius:6px;text-align:center;font-size:0.75rem;color:#90caf9;font-weight:600;transition:all 0.3s">
                🥛 Laticínios & Proteínas
            </div>
            <!-- Nível 4 -->
            <div class="piramide-nivel" onclick="toggleNivel(3)" style="cursor:pointer;margin:0 auto 4px;width:55%;padding:0.6rem 0;background:linear-gradient(135deg,rgba(255,193,7,0.5),rgba(255,193,7,0.3));border-radius:6px;text-align:center;font-size:0.75rem;color:#ffe082;font-weight:600;transition:all 0.3s">
                🌾 Cereais & Leguminosas
            </div>
            <!-- Nível 5 -->
            <div class="piramide-nivel" onclick="toggleNivel(4)" style="cursor:pointer;margin:0 auto 4px;width:70%;padding:0.6rem 0;background:linear-gradient(135deg,rgba(139,195,74,0.5),rgba(139,195,74,0.3));border-radius:6px;text-align:center;font-size:0.75rem;color:#dce775;font-weight:600;transition:all 0.3s">
                🍎 Frutas
            </div>
            <!-- Nível 6 - Base -->
            <div class="piramide-nivel" onclick="toggleNivel(5)" style="cursor:pointer;margin:0 auto;width:85%;padding:0.6rem 0;background:linear-gradient(135deg,rgba(76,175,80,0.5),rgba(76,175,80,0.3));border-radius:6px;text-align:center;font-size:0.75rem;color:#a5d6a7;font-weight:600;transition:all 0.3s">
                🥦 Hortícolas (Base da Alimentação)
            </div>

            <!-- Info boxes -->
            <div id="piramide-info" style="margin-top:1.5rem;display:none" class="glass-card" style="padding:1.5rem">
                <div id="piramide-texto" style="padding:1rem;border-radius:10px;font-size:0.9rem;line-height:1.7;color:rgba(232,245,233,0.8)"></div>
            </div>
        </div>
    </div>

    <!-- ==================== TABELA GRUPOS ETÁRIOS ==================== -->
    <div class="glass" style="padding:2rem;margin-bottom:1.5rem">
        <h2 style="margin-bottom:0.5rem;font-size:1.3rem"><span class="green-dot"></span>Doses Diárias por Grupo Etário</h2>
        <p style="color:rgba(232,245,233,0.5);font-size:0.85rem;margin-bottom:1.5rem">Recomendações da OMS adaptadas por faixa etária</p>
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
                    <tr>
                        <td><span class="badge badge-blue">👶 1-3 anos</span></td>
                        <td>150g</td><td>150g</td><td>85g</td><td>60g</td><td>250ml</td><td>1.3L</td>
                    </tr>
                    <tr>
                        <td><span class="badge badge-blue">🧒 4-8 anos</span></td>
                        <td>200g</td><td>200g</td><td>130g</td><td>90g</td><td>350ml</td><td>1.6L</td>
                    </tr>
                    <tr>
                        <td><span class="badge badge-blue">🧑 9-13 anos</span></td>
                        <td>280g</td><td>250g</td><td>180g</td><td>130g</td><td>450ml</td><td>2.1L</td>
                    </tr>
                    <tr>
                        <td><span class="badge badge-blue">🧑‍🎓 14-18 anos</span></td>
                        <td>350g</td><td>280g</td><td>220g</td><td>160g</td><td>500ml</td><td>2.3L</td>
                    </tr>
                    <tr style="background:rgba(76,175,80,0.05)">
                        <td><span class="badge badge-green">🧑‍💼 19-50 anos</span></td>
                        <td><strong style="color:#81c784">400g</strong></td>
                        <td><strong style="color:#81c784">300g</strong></td>
                        <td><strong style="color:#81c784">250g</strong></td>
                        <td><strong style="color:#81c784">180g</strong></td>
                        <td><strong style="color:#81c784">500ml</strong></td>
                        <td><strong style="color:#81c784">2.5L</strong></td>
                    </tr>
                    <tr>
                        <td><span class="badge badge-blue">🧓 51-70 anos</span></td>
                        <td>380g</td><td>280g</td><td>220g</td><td>160g</td><td>550ml</td><td>2.3L</td>
                    </tr>
                    <tr>
                        <td><span class="badge badge-blue">👴 +70 anos</span></td>
                        <td>350g</td><td>250g</td><td>200g</td><td>150g</td><td>600ml</td><td>2.0L</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <p style="font-size:0.75rem;color:rgba(232,245,233,0.3);margin-top:1rem">* A linha destacada a verde representa os valores de referência para adultos saudáveis usados neste sistema.</p>
    </div>

    <!-- ==================== LIMITES MÁXIMOS ==================== -->
    <div class="glass" style="padding:2rem;margin-bottom:1.5rem">
        <h2 style="margin-bottom:0.5rem;font-size:1.3rem"><span class="green-dot"></span>Limites Máximos Diários</h2>
        <p style="color:rgba(232,245,233,0.5);font-size:0.85rem;margin-bottom:2rem">Valores que não devem ser ultrapassados para um adulto saudável</p>
        <div class="grid-3">
            <!-- Açúcar -->
            <div class="glass-card" style="padding:1.5rem;text-align:center;border-color:rgba(244,67,54,0.2)">
                <div style="font-size:3rem;margin-bottom:0.75rem">🍬</div>
                <h3 style="color:#ef9a9a;font-size:1.1rem;margin-bottom:0.5rem">Açúcar Livre</h3>
                <div style="font-size:2.5rem;font-weight:700;color:#ef9a9a;margin-bottom:0.25rem">25g</div>
                <div style="font-size:0.8rem;color:rgba(232,245,233,0.4);margin-bottom:1rem">≈ 6 colheres de chá/dia</div>
                <div class="progress-bar">
                    <div style="height:100%;width:100%;border-radius:4px;background:linear-gradient(90deg,rgba(76,175,80,0.7),rgba(255,193,7,0.7),rgba(244,67,54,0.7))"></div>
                </div>
                <div style="font-size:0.75rem;color:rgba(232,245,233,0.3);margin-top:0.5rem">Ideal: &lt;10% das calorias diárias</div>
            </div>
            <!-- Sal -->
            <div class="glass-card" style="padding:1.5rem;text-align:center;border-color:rgba(255,193,7,0.2)">
                <div style="font-size:3rem;margin-bottom:0.75rem">🧂</div>
                <h3 style="color:#ffe082;font-size:1.1rem;margin-bottom:0.5rem">Sal (Sódio)</h3>
                <div style="font-size:2.5rem;font-weight:700;color:#ffe082;margin-bottom:0.25rem">5g</div>
                <div style="font-size:0.8rem;color:rgba(232,245,233,0.4);margin-bottom:1rem">≈ 1 colher de chá/dia</div>
                <div class="progress-bar">
                    <div style="height:100%;width:100%;border-radius:4px;background:linear-gradient(90deg,rgba(76,175,80,0.7),rgba(255,193,7,0.7),rgba(244,67,54,0.7))"></div>
                </div>
                <div style="font-size:0.75rem;color:rgba(232,245,233,0.3);margin-top:0.5rem">Equivale a 2g de sódio</div>
            </div>
            <!-- Gordura saturada -->
            <div class="glass-card" style="padding:1.5rem;text-align:center;border-color:rgba(255,152,0,0.2)">
                <div style="font-size:3rem;margin-bottom:0.75rem">🧈</div>
                <h3 style="color:#ffcc80;font-size:1.1rem;margin-bottom:0.5rem">Gordura Saturada</h3>
                <div style="font-size:2.5rem;font-weight:700;color:#ffcc80;margin-bottom:0.25rem">22g</div>
                <div style="font-size:0.8rem;color:rgba(232,245,233,0.4);margin-bottom:1rem">para dieta de 2000 kcal</div>
                <div class="progress-bar">
                    <div style="height:100%;width:100%;border-radius:4px;background:linear-gradient(90deg,rgba(76,175,80,0.7),rgba(255,193,7,0.7),rgba(244,67,54,0.7))"></div>
                </div>
                <div style="font-size:0.75rem;color:rgba(232,245,233,0.3);margin-top:0.5rem">Máx. 10% das calorias diárias</div>
            </div>
        </div>
    </div>

    <!-- ==================== CALCULADORA IMC ==================== -->
    <div class="glass" style="padding:2rem;margin-bottom:1.5rem">
        <h2 style="margin-bottom:0.5rem;font-size:1.3rem"><span class="green-dot"></span>Calculadora de IMC</h2>
        <p style="color:rgba(232,245,233,0.5);font-size:0.85rem;margin-bottom:2rem">Índice de Massa Corporal segundo a classificação da OMS</p>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:2rem;align-items:start">
            <!-- Formulário -->
            <div>
                <div class="form-group">
                    <label class="form-label">Peso (kg)</label>
                    <input type="number" id="imcPeso" class="form-control" placeholder="Ex: 70" min="1" max="300">
                </div>
                <div class="form-group">
                    <label class="form-label">Altura (cm)</label>
                    <input type="number" id="imcAltura" class="form-control" placeholder="Ex: 170" min="50" max="250">
                </div>
                <div class="form-group">
                    <label class="form-label">Idade</label>
                    <input type="number" id="imcIdade" class="form-control" placeholder="Ex: 30" min="1" max="120">
                </div>
                <button onclick="calcularIMC()" class="btn btn-primary" style="width:100%">
                    <i class="fas fa-calculator"></i> Calcular IMC
                </button>
            </div>
            <!-- Resultado -->
            <div>
                <div id="imcResultado" style="display:none">
                    <div id="imcValor" style="text-align:center;font-size:4rem;font-weight:700;margin-bottom:0.5rem"></div>
                    <div id="imcCategoria" style="text-align:center;font-size:1.1rem;font-weight:600;margin-bottom:1.5rem;padding:0.75rem;border-radius:10px"></div>
                    <div id="imcConselho" style="font-size:0.85rem;color:rgba(232,245,233,0.6);line-height:1.7;padding:1rem;background:rgba(255,255,255,0.03);border-radius:8px"></div>
                </div>
                <div id="imcTabela">
                    <table class="table" style="font-size:0.85rem">
                        <thead>
                            <tr><th>IMC</th><th>Classificação OMS</th></tr>
                        </thead>
                        <tbody>
                            <tr><td>&lt; 18.5</td><td><span style="color:#90caf9">Baixo Peso</span></td></tr>
                            <tr><td>18.5 – 24.9</td><td><span style="color:#81c784">✅ Peso Normal</span></td></tr>
                            <tr><td>25.0 – 29.9</td><td><span style="color:#ffe082">⚠️ Pré-obesidade</span></td></tr>
                            <tr><td>30.0 – 34.9</td><td><span style="color:#ffab91">Obesidade Grau I</span></td></tr>
                            <tr><td>35.0 – 39.9</td><td><span style="color:#ef9a9a">Obesidade Grau II</span></td></tr>
                            <tr><td>≥ 40.0</td><td><span style="color:#f48fb1">Obesidade Grau III</span></td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabela resumo semanal -->
    <div class="glass" style="padding:2rem;margin-bottom:1.5rem">
        <h2 style="margin-bottom:1.5rem;font-size:1.3rem"><span class="green-dot"></span>Resumo Semanal</h2>
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
                        <td><span style="margin-right:8px">{{ $rec->category->icone }}</span>{{ $rec->category->nome }}</td>
                        <td><span class="badge badge-green">{{ $rec->quantidade_diaria_gramas }}g</span></td>
                        <td><span class="badge badge-blue">{{ $rec->quantidade_diaria_gramas * 7 }}g</span></td>
                        <td style="color:rgba(232,245,233,0.5);font-size:0.85rem">{{ round($rec->quantidade_diaria_gramas / 100, 1) }} porções de 100g</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Gráfico -->
    <div class="glass" style="padding:2rem">
        <h2 style="margin-bottom:1.5rem;font-size:1.3rem"><span class="green-dot"></span>Distribuição Visual</h2>
        <div style="max-width:500px;margin:0 auto">
            <canvas id="omsChart" height="300"></canvas>
        </div>
    </div>
</div>

<script>
// ========== GRÁFICO ==========
const ctx = document.getElementById('omsChart').getContext('2d');
new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: @json($recommendations->pluck('category.nome')),
        datasets: [{
            data: @json($recommendations->pluck('quantidade_diaria_gramas')),
            backgroundColor: [
                'rgba(76,175,80,0.7)','rgba(139,195,74,0.7)','rgba(255,193,7,0.7)',
                'rgba(255,87,34,0.7)','rgba(33,150,243,0.7)','rgba(156,39,176,0.7)',
                'rgba(0,188,212,0.7)','rgba(244,67,54,0.7)'
            ],
            borderColor: 'rgba(255,255,255,0.1)',
            borderWidth: 2
        }]
    },
    options: {
        plugins: {
            legend: { labels: { color: 'rgba(232,245,233,0.7)', font: { size: 12 } } }
        }
    }
});

// ========== PIRÂMIDE ==========
const piramideInfo = [
    { titulo: '🍬 Açúcares — Consumir com Moderação', texto: 'Os açúcares livres devem representar menos de 10% da ingestão calórica diária (idealmente menos de 5%). Evite refrigerantes, bolos, biscoitos e alimentos ultraprocessados. A OMS recomenda no máximo 25g de açúcar livre por dia.', cor: 'rgba(244,67,54,0.15)', border: 'rgba(244,67,54,0.3)', textoCor: '#ef9a9a' },
    { titulo: '🥑 Gorduras Saudáveis — Com Moderação', texto: 'Prefira gorduras insaturadas presentes no azeite, abacate, nozes e sementes. Limite as gorduras saturadas a menos de 10% das calorias diárias. Elimine totalmente as gorduras trans industriais.', cor: 'rgba(255,152,0,0.15)', border: 'rgba(255,152,0,0.3)', textoCor: '#ffcc80' },
    { titulo: '🥛 Laticínios & Proteínas — 2 a 3 Porções/dia', texto: 'Inclua diariamente fontes de proteína magra como peixe, frango, ovos e leguminosas. Os laticínios fornecem cálcio essencial. A OMS recomenda pelo menos 2 porções de peixe por semana, especialmente peixe gordo rico em ómega-3.', cor: 'rgba(33,150,243,0.15)', border: 'rgba(33,150,243,0.3)', textoCor: '#90caf9' },
    { titulo: '🌾 Cereais & Leguminosas — 3 a 4 Porções/dia', texto: 'Prefira sempre cereais integrais em vez de refinados. O arroz integral, aveia, quinoa e pão integral fornecem fibra, vitaminas do complexo B e energia de libertação lenta. As leguminosas são uma excelente fonte de proteína vegetal e fibra.', cor: 'rgba(255,193,7,0.15)', border: 'rgba(255,193,7,0.3)', textoCor: '#ffe082' },
    { titulo: '🍎 Frutas — Mínimo 300g/dia', texto: 'Consuma pelo menos 300g de fruta fresca por dia, preferencialmente variada e da época. A fruta fornece vitaminas, minerais, fibra e antioxidantes. Evite sumos de fruta industriais pois perdem a fibra e concentram os açúcares.', cor: 'rgba(139,195,74,0.15)', border: 'rgba(139,195,74,0.3)', textoCor: '#dce775' },
    { titulo: '🥦 Hortícolas — Base da Alimentação (400g/dia)', texto: 'Os hortícolas devem ser a base de todas as refeições. A OMS recomenda pelo menos 400g por dia entre frutas e vegetais. São ricos em fibra, vitaminas, minerais e fitoquímicos que protegem contra doenças cardiovasculares, diabetes e cancro.', cor: 'rgba(76,175,80,0.15)', border: 'rgba(76,175,80,0.3)', textoCor: '#a5d6a7' }
];

let nivelAtivo = -1;

function toggleNivel(index) {
    const infoBox = document.getElementById('piramide-info');
    const texto = document.getElementById('piramide-texto');
    const info = piramideInfo[index];

    if (nivelAtivo === index) {
        infoBox.style.display = 'none';
        nivelAtivo = -1;
        return;
    }

    nivelAtivo = index;
    texto.innerHTML = `<strong style="color:${info.textoCor};display:block;margin-bottom:0.5rem">${info.titulo}</strong>${info.texto}`;
    texto.style.background = info.cor;
    texto.style.border = `1px solid ${info.border}`;
    texto.style.borderRadius = '10px';
    infoBox.style.display = 'block';
}

// ========== CALCULADORA IMC ==========
function calcularIMC() {
    const peso = parseFloat(document.getElementById('imcPeso').value);
    const altura = parseFloat(document.getElementById('imcAltura').value) / 100;
    const idade = parseInt(document.getElementById('imcIdade').value);

    if (!peso || !altura || !idade) {
        alert('Por favor preenche todos os campos!');
        return;
    }

    const imc = peso / (altura * altura);
    const imcFormatado = imc.toFixed(1);

    let categoria, cor, conselho;

    if (imc < 18.5) {
        categoria = '⚠️ Baixo Peso';
        cor = 'rgba(33,150,243,0.15)';
        conselho = 'O seu IMC está abaixo do normal. Consulte um nutricionista para aumentar a ingestão calórica de forma saudável. Foque-se em alimentos ricos em nutrientes como frutos secos, leguminosas e proteínas magras.';
    } else if (imc < 25) {
        categoria = '✅ Peso Normal';
        cor = 'rgba(76,175,80,0.15)';
        conselho = 'Parabéns! O seu peso está dentro dos valores saudáveis segundo a OMS. Mantenha os seus hábitos alimentares equilibrados e a prática regular de exercício físico.';
    } else if (imc < 30) {
        categoria = '⚠️ Pré-obesidade';
        cor = 'rgba(255,193,7,0.15)';
        conselho = 'O seu IMC indica pré-obesidade. Considere reduzir o consumo de açúcares e gorduras saturadas, aumentar a ingestão de hortícolas e frutas e praticar pelo menos 150 minutos de exercício por semana.';
    } else if (imc < 35) {
        categoria = '🔴 Obesidade Grau I';
        cor = 'rgba(255,87,34,0.15)';
        conselho = 'Recomenda-se consultar um médico e nutricionista. Pequenas mudanças na alimentação e estilo de vida podem ter um grande impacto na sua saúde a longo prazo.';
    } else if (imc < 40) {
        categoria = '🔴 Obesidade Grau II';
        cor = 'rgba(244,67,54,0.15)';
        conselho = 'É importante consultar um profissional de saúde. Um programa estruturado de perda de peso com acompanhamento médico e nutricional é fortemente recomendado.';
    } else {
        categoria = '🔴 Obesidade Grau III';
        cor = 'rgba(156,39,176,0.15)';
        conselho = 'Consulte urgentemente um médico. A obesidade grau III está associada a riscos significativos para a saúde. O acompanhamento médico especializado é essencial.';
    }

    document.getElementById('imcValor').textContent = imcFormatado;
    document.getElementById('imcValor').style.color = imc < 18.5 ? '#90caf9' : imc < 25 ? '#81c784' : imc < 30 ? '#ffe082' : '#ef9a9a';
    document.getElementById('imcCategoria').textContent = categoria;
    document.getElementById('imcCategoria').style.background = cor;
    document.getElementById('imcConselho').textContent = conselho;
    document.getElementById('imcResultado').style.display = 'block';
    document.getElementById('imcTabela').style.display = 'none';
}
</script>
@endsection
