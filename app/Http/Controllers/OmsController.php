<?php

namespace App\Http\Controllers;

use App\Models\OmsRecommendation;
use App\Models\FoodCategory;

class OmsController extends Controller
{
    public function index()
    {
        $recommendations = OmsRecommendation::with('category')->get();
        $categories = FoodCategory::with('omsRecommendations')->get();
        return view('oms.index', compact('recommendations', 'categories'));
    }
}
