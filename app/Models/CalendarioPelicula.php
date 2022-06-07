<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalendarioPelicula extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_calendario',
        'id_pelicula',
        'fecha',
        'mostrado',
    ];
    protected $table = 'calendario_peliculas';
    public $timestamps = false;
}
