<?php

use App\Http\Controllers\CarController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [CarController::class, 'preface'])->name('home');

Route::prefix('/showroom')->name('showroom.')->controller(CarController::class)->group(function () {
    Route::get('/', 'index')->name('index');
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::prefix('/form')->name('form.')->group(function () {
    Route::get('/vehicles', [CarController::class, 'create'])->name('vehicle');
    Route::post('/vehicles', [CarController::class, 'store'])->name('store');
    Route::get('/categories', [CategorieController::class, 'create'])->name('categorie.create');
    Route::post('/categories',[CategorieController::class, 'store'])->name('categorie.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
