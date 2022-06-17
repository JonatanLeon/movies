<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Critica extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'id_pelicula',
        'id_usuario',
        'puntuacion',
        'texto',
        'titulo',
        'fecha',
        'nombre_usuario',
        'nombre_pelicula',
    ];
    protected $table = 'criticas';
    public $timestamps = false;
}
