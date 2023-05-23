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

Route::prefix('/showroom')->name('showroom.')->controller(CarController::class)->group(function ($id) {
    Route::get('/', 'index')->name('index');
    Route::get('/{id}','pick')->name('car');
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::prefix('/dashboard')->name('dashboard.')->group(function () {
    Route::get('/vehicles/create', [CarController::class, 'create'])->name('vehicle.create');
    Route::get('/vehicles', [CarController::class, 'indexVehicle'])->name('vehicle');
    Route::get('/vehicles/{id}', [CarController::class, 'updateVehicle'])->name('vehicle.update');
    Route::put('/vehicles/update', [CarController::class, 'change'])->name('vehicle.change');
    Route::post('/vehicles', [CarController::class, 'store'])->name('vehicle.store');
    Route::get('/categories', [CategorieController::class, 'create'])->name('categorie.create');
    Route::post('/categories',[CategorieController::class, 'store'])->name('categorie.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
