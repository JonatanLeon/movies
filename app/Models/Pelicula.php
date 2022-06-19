<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * Representa la tabla películas en la BBDD
 */
class Pelicula extends Model
{
    use HasFactory;
    public $timestamps = false;
}
