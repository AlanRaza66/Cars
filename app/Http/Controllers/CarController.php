<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Categorie;
use App\Models\Marque;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;

class CarController extends Controller
{
    //
    public function preface()
    {
        $cars = Car::take(4)->get();
        foreach ($cars as $c) {
            # code...
            try {
                //code...
                $c->marque_id = $c->marque->nom;
                $c->categorie_id = $c->categorie->nom;
            } catch (\Throwable $th) {
                //throw $th;
            }
        }
        $categories = Categorie::all();
        $car = Car::inRandomOrder()->take(4)->get();
        foreach ($car as $c) {
            # code...
            try {
                //code...
                $c->marque_id = $c->marque->nom;
                $c->categorie_id = $c->categorie->nom;
            } catch (\Throwable $th) {
                //throw $th;
            }
        }
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
        $cars = Car::inRandomOrder()->get();
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
        $categories = Categorie::all();
        return Inertia::render('Showroom', ['cars' => $cars, 'categories' => $categories]);
    }

    public function pick($id)
    {
        $car = Car::find($id);
        try {
            //code...
            $car->marque_id = $car->marque->nom;
            $car->categorie_id = $car->categorie->nom;
        } catch (\Throwable $th) {
            //throw $th;
        }
        return Inertia::render('Showroom/Profile', ['car' => $car]);
    }

    public function create()
    {
        $marques = Marque::all();
        $cats = Categorie::all();
        return Inertia::render('Car/Create', ['categories' => $cats, 'marques' => $marques]);
    }

    public function store(Request $request)
    {

        /** @var UploadedFile|null $image */
        $image = $request->file('cover');
        $imagePath = $image->store('cars/cover', 'public');
        Car::create([
            'marque_id' => $request->input('marque'),
            'modele' => $request->input('modele'),
            'prix' => $request->input('prix'),
            'puissance' => $request->input('puissance'),
            'diesel' => $request->input('diesel'),
            'neuf' => $request->input('neuf'),
            'cover' => $imagePath,
            'categorie_id' => $request->input('categorie_id')
        ]);

        return redirect()->route('dashboard')->with('success', 'La voiture est maintenant disponible!');
    }
}
