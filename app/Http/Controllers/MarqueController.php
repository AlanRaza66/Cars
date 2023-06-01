<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Marque;
use Illuminate\Http\Request;

class MarqueController extends Controller
{
    //
    public function store(Request $request)
    {
        Marque::create([
            'nom' => $request->input('nom')
        ]);
        return redirect()->route('dashboard');
    }
}
