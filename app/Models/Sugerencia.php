<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sugerencia extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'id_usuario',
        'texto',
        'nombre_usuario',
    ];
    protected $table = 'sugerencias';
    public $timestamps = false;
}
