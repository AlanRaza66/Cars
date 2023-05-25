<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use App\Models\Car;
use App\Models\Categorie;
use App\Models\Marque;
use App\Models\User;
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
    Route::get('/{id}', 'pick')->name('car');
});

Route::get('/dashboard', function () {
    $cars = Car::all();
    foreach ($cars as $car) {
        # code...
        try {
            //code...
            $car->marque_id = $car->marque->nom;
            $car->categorie_id = $car->categorie->nom;
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    return Inertia::render('Dashboard', ['cars' => $cars, 'categories' => Categorie::all(), 'marques' => Marque::all(), 'users' => User::all()]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::prefix('/dashboard')->name('dashboard.')->group(function ($id) {
    Route::get('/user/create', [RegisteredUserController::class, 'create'])->name('user.create');
    Route::post('/user', [RegisteredUserController::class, 'store'])->name('register');
    
    Route::get('/vehicles/create', [CarController::class, 'create'])->name('vehicle.create');
    Route::get('/vehicles', [CarController::class, 'indexVehicle'])->name('vehicle');
    Route::get('/vehicles/{id}', [CarController::class, 'updateVehicle'])->name('vehicle.update');
    Route::put('/vehicles/update', [CarController::class, 'change'])->name('vehicle.change');
    Route::post('/vehicles', [CarController::class, 'store'])->name('vehicle.store');
    Route::delete('/vehicles/{id}', [CarController::class, 'delete'])->name('vehicle.delete');

    Route::get('/categories', [CategorieController::class, 'indexCategorie'])->name('categorie');
    Route::get('/categories/create', [CategorieController::class, 'create'])->name('categorie.create');
    Route::put('/categories/update', [CategorieController::class, 'change'])->name('categorie.change');
    Route::get('/categories/{id}', [CategorieController::class, 'updateCategorie'])->name('categorie.update');
    Route::delete('/categories/{id}', [CategorieController::class, 'delete'])->name('categorie.delete');
    Route::post('/categories', [CategorieController::class, 'store'])->name('categorie.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
