<?php

namespace App\Http\Controllers;

use App\Models\UserScore;
use App\Models\User;

class RankingController extends Controller
{
    public function index()
    {
        $semana = now()->startOfWeek()->toDateString();

        $ranking = UserScore::with('user')
            ->where('semana_inicio', $semana)
            ->orderByDesc('percentagem_conformidade')
            ->get()
            ->map(function ($score, $index) {
                $score->posicao = $index + 1;
                return $score;
            });

        return view('ranking.index', compact('ranking', 'semana'));
    }
}
