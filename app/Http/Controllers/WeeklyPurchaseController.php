<?php

namespace App\Http\Controllers;

use App\Models\UserWeeklyPurchase;
use App\Models\Food;
use App\Models\FoodCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WeeklyPurchaseController extends Controller
{
    public function index()
    {
        $semana = now()->startOfWeek()->toDateString();
        $purchases = UserWeeklyPurchase::with(['food.category'])
            ->where('user_id', Auth::id())
            ->where('semana_inicio', $semana)
            ->get();
        $categories = FoodCategory::with('foods')->get();
        return view('purchases.index', compact('purchases', 'categories', 'semana'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'food_id' => 'required|exists:foods,id',
            'quantidade_gramas' => 'required|numeric|min:1',
        ]);

        $semana = now()->startOfWeek()->toDateString();

        $existing = UserWeeklyPurchase::where('user_id', Auth::id())
            ->where('food_id', $request->food_id)
            ->where('semana_inicio', $semana)
            ->first();

        if ($existing) {
            $existing->update(['quantidade_gramas' => $existing->quantidade_gramas + $request->quantidade_gramas]);
        } else {
            UserWeeklyPurchase::create([
                'user_id' => Auth::id(),
                'food_id' => $request->food_id,
                'quantidade_gramas' => $request->quantidade_gramas,
                'semana_inicio' => $semana,
            ]);
        }

        return redirect()->route('purchases.index')->with('success', 'Produto adicionado com sucesso!');
    }

    public function destroy($id)
    {
        $purchase = UserWeeklyPurchase::where('user_id', Auth::id())->findOrFail($id);
        $purchase->delete();
        return redirect()->route('purchases.index')->with('success', 'Produto removido!');
    }
}
