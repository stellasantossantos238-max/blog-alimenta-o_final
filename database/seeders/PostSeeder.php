<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $posts = [
            [
                'author_id' => 1,
                'titulo' => 'Os Benefícios de uma Alimentação Equilibrada',
                'slug' => 'beneficios-alimentacao-equilibrada',
                'resumo' => 'Descubra como uma alimentação equilibrada pode transformar a sua saúde e bem-estar.',
                'conteudo' => 'Uma alimentação equilibrada é fundamental para manter a saúde física e mental. Estudos mostram que uma dieta rica em frutas, legumes, cereais integrais e proteínas magras reduz significativamente o risco de doenças crónicas como diabetes, doenças cardiovasculares e alguns tipos de cancro. A chave está na variedade e na moderação, garantindo que o organismo recebe todos os nutrientes essenciais para funcionar de forma otimizada.',
                'tipo' => 'normal',
                'publicado' => true,
            ],
            [
                'author_id' => 2,
                'titulo' => 'Cereais Integrais: O Segredo da Energia Sustentável',
                'slug' => 'cereais-integrais-energia-sustentavel',
                'resumo' => 'Como os cereais integrais podem fornecer energia duradoura ao longo do dia.',
                'conteudo' => 'Os cereais integrais são uma fonte essencial de hidratos de carbono complexos, fibra e micronutrientes. Ao contrário dos cereais refinados, os integrais mantêm o gérmen e o farelo, preservando vitaminas do complexo B, ferro, magnésio e fibra dietética. O consumo regular de cereais integrais está associado a uma melhor regulação do açúcar no sangue, maior saciedade e menor risco de doenças cardiovasculares.',
                'tipo' => 'normal',
                'publicado' => true,
            ],
            [
                'author_id' => 3,
                'titulo' => 'Receitas Saudáveis para o Dia a Dia',
                'slug' => 'receitas-saudaveis-dia-dia',
                'resumo' => 'Ideias simples e deliciosas para uma alimentação saudável sem complicações.',
                'conteudo' => 'Comer saudável não tem de ser complicado nem dispendioso. Com alguns ingredientes simples e técnicas culinárias básicas, é possível preparar refeições nutritivas e saborosas em poucos minutos. Desde saladas coloridas a sopas reconfortantes, passando por grelhados aromáticos, a cozinha saudável é uma aventura gastronómica que beneficia todo o organismo.',
                'tipo' => 'normal',
                'publicado' => true,
            ],
            [
                'author_id' => 4,
                'titulo' => 'As Recomendações da OMS para uma Vida Saudável',
                'slug' => 'recomendacoes-oms-vida-saudavel',
                'resumo' => 'Conheça as diretrizes oficiais da Organização Mundial de Saúde para a alimentação diária.',
                'conteudo' => 'A Organização Mundial de Saúde (OMS) estabelece diretrizes claras para uma alimentação saudável. Recomenda o consumo de pelo menos 400g de frutas e legumes por dia, limitar o consumo de açúcares livres a menos de 10% da ingestão calórica total, e reduzir o consumo de gorduras saturadas. Estas recomendações baseiam-se em décadas de investigação científica e visam reduzir o risco de doenças não transmissíveis.',
                'tipo' => 'oms',
                'publicado' => true,
            ],
            [
                'author_id' => null,
                'titulo' => 'IA e Nutrição: O Futuro da Alimentação Personalizada',
                'slug' => 'ia-nutricao-futuro-alimentacao',
                'resumo' => 'Como a inteligência artificial está a revolucionar a forma como pensamos sobre nutrição.',
                'conteudo' => 'A inteligência artificial está a transformar radicalmente o campo da nutrição e da saúde alimentar. Algoritmos avançados conseguem analisar padrões alimentares, dados genéticos e métricas de saúde para criar planos nutricionais verdadeiramente personalizados. Esta abordagem permite identificar deficiências nutricionais antes que se manifestem como sintomas, otimizar a composição de refeições para objetivos específicos e prever o impacto de escolhas alimentares na saúde a longo prazo.',
                'tipo' => 'ai',
                'publicado' => true,
            ],
            [
                'author_id' => 1,
                'titulo' => 'Hidratação e Saúde: Mais do que Beber Água',
                'slug' => 'hidratacao-saude',
                'resumo' => 'A importância da hidratação adequada para o funcionamento do organismo.',
                'conteudo' => 'A água é o nutriente mais essencial para a vida. O corpo humano é composto por cerca de 60% de água, e manter uma hidratação adequada é fundamental para praticamente todas as funções corporais. Desde a regulação da temperatura corporal à digestão, passando pelo transporte de nutrientes e eliminação de toxinas, a água desempenha um papel central na nossa saúde.',
                'tipo' => 'normal',
                'publicado' => true,
            ],
        ];

        foreach ($posts as $post) {
            Post::create($post);
        }
    }
}
