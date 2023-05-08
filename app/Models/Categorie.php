<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;
    protected $fillable = ['nom', 'description', 'cover'];

    public function cars(){
        return $this->hasMany(Car::class);
    }
}
