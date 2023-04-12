<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', [\App\Http\Controllers\ArticleController::class, 'index'])->name('home');

Route::prefix('article')
    ->middleware('auth')
    ->controller(\App\Http\Controllers\ArticleController::class)
    ->group(function () {
        Route::get('/create', 'create')->name('article.create');
        Route::post('/', 'store')->name('article.store');
        Route::get('/{article}/edit', 'edit')->name('article.edit');
        Route::put('/{article}', 'update')->name('article.update');
        Route::delete('/{article}', 'destroy')->name('article.destroy');
    });

Route::get('article/{article}', [\App\Http\Controllers\ArticleController::class, 'show'])->name('article.show');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
