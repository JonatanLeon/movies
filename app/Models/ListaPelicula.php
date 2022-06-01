<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListaPelicula extends Model
{
    use HasFactory;
    //protected $primaryKey = 'id_lista';
    protected $fillable = [
        'id_pelicula',
        'id_lista',
    ];

    protected $table = 'lista_peliculas';
    public $timestamps = false;
}
