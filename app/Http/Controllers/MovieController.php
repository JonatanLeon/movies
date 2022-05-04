<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelicula;

class MovieController extends Controller
{
    public function buscarPelicula(Request $request) {
        if ($request->buscar != "") $peliculas = Pelicula::where('titulo', 'like', '%'.$request->buscar.'%')->get();
        else return view('busqueda_error');
        /*foreach ($peliculas as $pelicula) {
            echo $pelicula->titulo."<br>";
        }*/

        if ($peliculas->count() != 0) return view('busqueda', compact('peliculas'));
        else return view('busqueda_error');
    }

    public function listarTodas() {
        $peliculas = Pelicula::orderBy('titulo')->get();

        return view('busqueda', compact('peliculas'));
    }
}
