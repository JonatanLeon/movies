<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * Representa una película añadida a una lista concreta
 */
class ListaPelicula extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_pelicula',
        'id_lista',
    ];

    protected $table = 'lista_peliculas';
    public $timestamps = false;
}
