<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * Representa la tabla calendarios en la BBDD
 */
class Calendario extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'id_usuario',
    ];
    protected $table = 'calendarios';
    public $timestamps = false;
}
