<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Categorie;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;

class CarController extends Controller
{
    //
    public function preface()
    {
        $cars = Car::take(4)->get();
        $categories = Categorie::all();
        $car = Car::inRandomOrder()->take(4)->get();
        return Inertia::render('Home', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'cars' => $cars,
            'categories' => $categories,
            'car' => $car,

        ]);
    }
    public function index()
    {
        $cars = Car::all();
        foreach ($cars as $car) {
            # code...
            $car->categorie_id = $car->categorie();
        }
        $categories = Categorie::all();
        return Inertia::render('Showroom', ['cars' => $cars, 'categories' => $categories]);
    }

    public function create()
    {
        $cats = Categorie::all();
        return Inertia::render('Car/Create', ['categories' => $cats]);
    }

    public function store(Request $request)
    {

        /** @var UploadedFile|null $image */
        $image = $request->file('cover');
        $imagePath = $image->store('cars/cover', 'public');
        Car::create([
            'marque' => $request->input('marque'),
            'modele' => $request->input('modele'),
            'prix' => $request->input('prix'),
            'diesel' => $request->input('diesel'),
            'neuf' => $request->input('neuf'),
            'cover' => $imagePath,
            'categorie_id' => $request->input('categorie_id')
        ]);

        return redirect()->route('dashboard')->with('success', 'La voiture est maintenant disponible!');
    }
}