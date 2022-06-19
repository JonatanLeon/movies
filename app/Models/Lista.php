<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * Representa la tabla listas en la BBDD
 */
class Lista extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'id_usuario',
        'nombre',
        'descripcion',
        'nombre_usuario',
    ];
    protected $table = 'listas';
    public $timestamps = false;
}
