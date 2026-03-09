<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Models\FoodCategory;

class FoodController extends Controller
{
    public function index()
    {
        $categories = FoodCategory::with('foods')->get();
        return view('foods.index', compact('categories'));
    }

    public function show($id)
    {
        $food = Food::with('category')->findOrFail($id);
        return view('foods.show', compact('food'));
    }
}
