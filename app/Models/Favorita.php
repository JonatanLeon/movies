<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * Representa la tabla favoritas en la BBDD
 */
class Favorita extends Model
{
    use HasFactory;

    public $timestamps = false;
}
