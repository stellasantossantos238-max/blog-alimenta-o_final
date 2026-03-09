<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\OmsController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\WeeklyPurchaseController;
use App\Http\Controllers\ScoreController;
use App\Http\Controllers\RankingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;

// Rotas públicas
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/blog', [PostController::class, 'index'])->name('posts.index');
Route::get('/blog/{slug}', [PostController::class, 'show'])->name('posts.show');
Route::get('/ia', [PostController::class, 'ai'])->name('posts.ai');
Route::get('/oms', [OmsController::class, 'index'])->name('oms.index');
Route::get('/alimentos', [FoodController::class, 'index'])->name('foods.index');
Route::get('/alimentos/{id}', [FoodController::class, 'show'])->name('foods.show');
Route::get('/ranking', [RankingController::class, 'index'])->name('ranking.index');

// Rotas autenticadas
Route::middleware(['auth'])->group(function () {
    Route::get('/perfil', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/compras', [WeeklyPurchaseController::class, 'index'])->name('purchases.index');
    Route::post('/compras', [WeeklyPurchaseController::class, 'store'])->name('purchases.store');
    Route::delete('/compras/{id}', [WeeklyPurchaseController::class, 'destroy'])->name('purchases.destroy');
    Route::get('/calcular-pontuacao', [ScoreController::class, 'calcular'])->name('score.calcular');
    Route::get('/pesquisa', [SearchController::class, 'index'])->name('search');
    Route::get('/dashboard', function () {
    return redirect()->route('profile.show');
        Route::get('/pesquisa/sugestoes', [SearchController::class, 'suggestions'])->name('search.suggestions');
})->middleware(['auth'])->name('dashboard');
});


require __DIR__ . '/auth.php';
