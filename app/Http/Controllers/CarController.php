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
        if (count($cars) < 4) {
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
            return Inertia::render('Dashboard', ['cars' => $cars, 'categories' => Categorie::all(), 'marque' => Marque::all()]);
        } else {
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

    public function indexVehicle()
    {
        $marques = Marque::all();
        $cats = Categorie::all();
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
        return Inertia::render('Car/Index', ['cars' => $cars, 'categories' => $cats, 'marques' => $marques]);
    }

    public function updateVehicle($id)
    {
        $car = Car::find($id);
        $marques = Marque::all();
        $cats = Categorie::all();
        try {
            //code...
            $car->marque_id = $car->marque->nom;
            $car->categorie_id = $car->categorie->nom;
        } catch (\Throwable $th) {
            //throw $th;
        }
        return Inertia::render('Car/Profile', ['car' => $car, 'categories' => $cats, 'marques' => $marques]);
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

        return redirect()->route('dashboard.vehicle')->with('success', 'La voiture est maintenant disponible!');
    }

    public function change(Request $request)
    {
        $car = Car::find($request->input('id'));

        $car->marque_id = $request->input('marque');
        $car->modele = $request->input('modele');
        $car->prix = $request->input('prix');
        $car->puissance =  $request->input('puissance');
        $car->diesel = $request->input('diesel');
        $car->neuf = $request->input('neuf');
        if ($request->file('cover')) {
            $image = $request->file('cover');
            $imagePath = $image->store('cars/cover', 'public');
            $car->cover = $imagePath;
        }
        $car->save();
        return redirect()->route('dashboard.vehicle');
    }

    public function delete($id)
    {
        $car = Car::find($id);
        $car->delete();
        return redirect()->route('dashboard.vehicle');
    }
}
