<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
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

        return redirect()->route('dashboard')->with('success', 'La catégoire a été créée!');
    }

    public function indexCategorie()
    {
        $cartegories = Categorie::all();
        return Inertia::render('Categorie/Index', ['categories' => $cartegories]);
    }
}
