<?php

namespace App\Http\Controllers;

use App\Models\UserScore;
use App\Models\UserWeeklyPurchase;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $semana = now()->startOfWeek()->toDateString();

        $score = UserScore::where('user_id', $user->id)
            ->where('semana_inicio', $semana)
            ->first();

        $purchases = UserWeeklyPurchase::with('food.category')
            ->where('user_id', $user->id)
            ->where('semana_inicio', $semana)
            ->get();

        $historico = UserScore::where('user_id', $user->id)
            ->orderByDesc('semana_inicio')
            ->take(10)
            ->get();

        return view('profile.show', compact('user', 'score', 'purchases', 'historico'));
    }
}
