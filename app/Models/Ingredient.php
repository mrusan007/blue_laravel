<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model

{
    use \Dimsav\Translatable\Translatable;
    use HasFactory;

    public $translatedAttributes = ['title', 'description'];

    public function meals()
    {
        return $this->belongsToMany(Meal::class);
    }
}
