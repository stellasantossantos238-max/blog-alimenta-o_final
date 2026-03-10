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
use App\Http\Controllers\Admin\AdminController;

// Rotas públicas
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/blog', [PostController::class, 'index'])->name('posts.index');
Route::get('/blog/{slug}', [PostController::class, 'show'])->name('posts.show');
Route::get('/ia', [PostController::class, 'ai'])->name('posts.ai');
Route::get('/oms', [OmsController::class, 'index'])->name('oms.index');
Route::get('/alimentos', [FoodController::class, 'index'])->name('foods.index');
Route::get('/alimentos/{id}', [FoodController::class, 'show'])->name('foods.show');
Route::get('/ranking', [RankingController::class, 'index'])->name('ranking.index');
Route::get('/pesquisa', [SearchController::class, 'index'])->name('search');
Route::get('/pesquisa/sugestoes', [SearchController::class, 'suggestions'])->name('search.suggestions');

// Rotas autenticadas
Route::middleware(['auth'])->group(function () {
    Route::get('/perfil', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/compras', [WeeklyPurchaseController::class, 'index'])->name('purchases.index');
    Route::post('/compras', [WeeklyPurchaseController::class, 'store'])->name('purchases.store');
    Route::delete('/compras/{id}', [WeeklyPurchaseController::class, 'destroy'])->name('purchases.destroy');
    Route::get('/calcular-pontuacao', [ScoreController::class, 'calcular'])->name('score.calcular');
    Route::get('/dashboard', function () {
        return redirect()->route('profile.show');
    })->name('dashboard');
});

// Rotas profissional + admin (criar/editar posts)
Route::middleware(['auth', 'profissional'])->group(function () {
    Route::get('/blog/criar', [PostController::class, 'create'])->name('posts.create');
    Route::post('/blog', [PostController::class, 'store'])->name('posts.store');
    Route::get('/blog/{slug}/editar', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/blog/{slug}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/blog/{slug}', [PostController::class, 'destroy'])->name('posts.destroy');
});

// Backoffice Admin
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/utilizadores', [AdminController::class, 'users'])->name('users');
    Route::patch('/utilizadores/{user}/role', [AdminController::class, 'updateUserRole'])->name('users.role');
    Route::get('/posts', [AdminController::class, 'posts'])->name('posts');
    Route::patch('/posts/{post}/toggle', [AdminController::class, 'togglePost'])->name('posts.toggle');
    Route::delete('/posts/{post}', [AdminController::class, 'deletePost'])->name('posts.delete');
});

require __DIR__ . '/auth.php';
