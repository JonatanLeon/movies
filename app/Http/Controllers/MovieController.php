<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelicula;

class MovieController extends Controller
{
    public function buscarPelicula(Request $request) {
        if ($request->get("buscar") != "") $peliculas = Pelicula::where('titulo', 'like', '%'.$request->get("buscar").'%')->paginate(10);
        else return view('busqueda_error');

        if ($peliculas->count() != 0) return view('busqueda', compact('peliculas'));
        else return view('busqueda_error');
    }

    public function listarTodas() {
        $peliculas = Pelicula::orderBy('titulo')->paginate(10);
        return view('busqueda', compact('peliculas'));
    }

    public function verPelicula($id) {
        $peliculaRecogida = Pelicula::find($id);
        return view('pelicula', compact('peliculaRecogida'));
    }

    public function peliculaAleatoria() {
        $listaIds = Pelicula::orderBy('id')->pluck('id');
        $random = rand(0, $listaIds->count());
        $idAleatorio = $listaIds[$random];
        $peliculaRecogida = Pelicula::find($idAleatorio);
        return view('pelicula', compact('peliculaRecogida'));
    }
}
