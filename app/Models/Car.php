<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;
    protected $fillable = ['marque', 'modele', 'puissance', 'prix', 'diesel', 'neuf', 'categorie_id', 'cover'];

    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }
}
