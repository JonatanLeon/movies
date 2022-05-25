<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelicula;

/**
 * Controlador con todos los métodos relacionados con la búsqueda y listado de películas
 */
class MovieController extends Controller
{
    // Método para buscar una película por su título en la barra de búsqueda
    public function buscarPelicula(Request $request) {
        if ($request->get("buscar") != "") $peliculas = Pelicula::where('titulo', 'like', '%'.$request->get("buscar").'%')->paginate(10);
        else return view('busqueda_error');

        if ($peliculas->count() != 0) return view('busqueda', compact('peliculas'));
        else return view('busqueda_error');
    }
    // Lista todas las películas en el botón de la barra superior
    public function listarTodas() {
        $peliculas = Pelicula::orderBy('titulo')->paginate(10);
        return view('busqueda', compact('peliculas'));
    }

    // Muestra la página de la película seleccionada
    public function verPelicula($id) {
        $peliculaRecogida = Pelicula::find($id);
        return view('pelicula', compact('peliculaRecogida'));
    }

    // Muestra la página de una película aleatoria
    public function peliculaAleatoria() {
        $listaIds = Pelicula::orderBy('id')->pluck('id');
        $random = rand(0, $listaIds->count());
        $idAleatorio = $listaIds[$random];
        $peliculaRecogida = Pelicula::find($idAleatorio);
        return redirect('/pelicula/'.$peliculaRecogida->id);
    }
}
