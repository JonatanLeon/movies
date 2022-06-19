<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * Representa la tabla críticas en la BBDD
 */
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
