<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Categorie;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CategorieController extends Controller
{
    //
    public function create()
    {
        return Inertia::render('Categorie/Create');
    }

    public function store(Request $request)
    {
        /** @var UploadedFile|null $image */
        $image = $request->file('cover');
        $imagePath = $image->store('categories/cover', 'public');
        Categorie::create([
            'nom' => $request->input('nom'),
            'description' => $request->input('description'),
            'cover' => $imagePath,
        ]);

        return redirect()->route('dashboard.categorie')->with('success', 'La catégoire a été créée!');
    }

    public function indexCategorie()
    {
        $cartegories = Categorie::all();
        return Inertia::render('Categorie/Index', ['categories' => $cartegories]);
    }

    public function updateCategorie($id)
    {
        $categorie = Categorie::find($id);
        //$cars = Car::all()->where('categorie_id', $id);
        $cars = $categorie->cars;
        return Inertia::render('Categorie/Profile', ['categorie' => $categorie, 'cars' => $cars]);
    }
    public function change(Request $request)
    {
        $cat = Categorie::find($request->input('id'));

        $cat->nom = $request->input('nom');
        $cat->description = $request->input('description');
        $cat->save();
        return redirect()->route('dashboard.categorie');
    }

    public function delete($id)
    {
        $cat = Categorie::find($id);
        $cars = Car::all()->where('categorie_id', $id);
        foreach ($cars as $car) {
            # code...
            $car->delete();
        }
        $cat->delete();
        return redirect()->route('dashboard.categorie');
    }
}
