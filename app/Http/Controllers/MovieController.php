<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelicula;
use App\Models\Critica;
use App\Models\Lista;
use App\Http\Controllers\CriticasController;
use Illuminate\Support\Facades\Auth;

/**
 * Controlador con todos los métodos relacionados con la búsqueda y listado de películas
 */
class MovieController extends Controller
{
    // Método para buscar una película por su título en la barra de búsqueda
    public function buscarPelicula(Request $request) {
        if($request->get("buscar")) {
            $buscar = $request->get("buscar");
            $peliculas = Pelicula::where('titulo', 'like', '%'.$buscar.'%')->paginate(10);

            return view('busqueda', compact('peliculas'));
        } else {
            $term = $request->get("term");
            $peliculas = Pelicula::where('titulo', 'like', '%'.$term.'%')->get();
            $data = [];
            foreach($peliculas as $pelicula) {
                $data[] = [
                    'label' => $pelicula->titulo
                ];
            }
            return $data;
        }
    }

    public function buscarPorNombre(Request $request) {
        $pelicula = Pelicula::where('titulo', '=', $request->pelicula)->first();
        return redirect('/pelicula/'.$pelicula->id);
    }
    // Lista todas las películas en el botón de la barra superior
    public function listarTodas() {
        $peliculas = Pelicula::orderBy('titulo')->paginate(10);
        return view('busqueda', compact('peliculas'));
    }

    // Muestra la página de la película seleccionada
    public function verPelicula($id) {
        $listas = new Lista();
        $peliculaRecogida = Pelicula::find($id);
        $criticas = Critica::where('id_pelicula', '=', $id)->paginate(5);
        if (Auth::user()) {
            $listas = Lista::where('id_usuario', '=', Auth::user()->id)->get();
        }
        // Siempre que se cargue una película se recalcula su nota en la BBDD
        // Por si un admin ha borrado una critica
        // Si la película no tiene ninguna crítica se coge su nota por defecto
        if (!$criticas->count()==0) {
            $controller = new CriticasController;
            $controller->recalcularNota($id);
        }
        return view('pelicula', compact('peliculaRecogida', 'criticas', 'listas'));
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
