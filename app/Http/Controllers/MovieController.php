<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelicula;
use App\Models\Critica;
use App\Models\User;
use App\Http\Controllers\CriticasController;

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
        $criticas = Critica::where('id_pelicula', '=', $id)->paginate(5);
        // Siempre que se cargue una película se recalcula su nota en la BBDD
        // Por si un admin ha borrado una critica
        // Si la película no tiene ninguna crítica se coge su nota por defecto
        if (!$criticas->count()==0) {
            $controller = new CriticasController;
            $controller->recalcularNota($id);
        }
        return view('pelicula', compact('peliculaRecogida', 'criticas'));
    }

    // Muestra la página de una película aleatoria
    public function peliculaAleatoria() {
        $listaIds = Pelicula::orderBy('id')->pluck('id');
        $random = rand(0, $listaIds->count());
        $idAleatorio = $listaIds[$random];
        $peliculaRecogida = Pelicula::find($idAleatorio);
        // Se evita que al refrescar cargue otra película
        return redirect('/pelicula/'.$peliculaRecogida->id);
    }
}
