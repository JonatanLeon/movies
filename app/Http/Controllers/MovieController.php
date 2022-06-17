<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelicula;
use App\Models\Critica;
use App\Models\Lista;
use App\Models\Favorita;
use App\Http\Controllers\CriticasController;
use Illuminate\Support\Facades\Auth;

/**
 * Controlador con todos los métodos relacionados con la búsqueda y listado de películas
 */
class MovieController extends Controller
{
    // Método para buscar una película por su título en la barra de búsqueda
    public function buscarPelicula(Request $request) {
        $radio = "titulo";
        if($request->get("buscar")) {
            $buscar = $request->get("buscar");
            $peliculas = Pelicula::where('titulo', 'like', '%'.$buscar.'%')->paginate(10);

            return view('busqueda', compact('peliculas', 'radio'));
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

    public function busquedaAvanzada(Request $request) {
        $radio = $request->gridRadios;
        switch($radio) {
            case "director":
                $peliculas = Pelicula::where('director', 'like', '%'.$request->criterio.'%')->paginate(10);
                break;
            case "generos":
                $peliculas = Pelicula::where('generos', 'like', '%'.$request->criterio.'%')->paginate(10);
                break;
            case "reparto":
                $peliculas = Pelicula::where('reparto', 'like', '%'.$request->criterio.'%')->paginate(10);
                break;
            case "anio":
                $peliculas = Pelicula::where('estreno', 'like', '%'.$request->criterio.'%')->paginate(10);
                break;
        }
        return view('busqueda', compact('peliculas', 'radio'));
    }

    public function buscarPorNombre(Request $request) {
        $pelicula = Pelicula::where('titulo', '=', $request->pelicula)->first();
        return redirect('/pelicula/'.$pelicula->id);
    }
    // Lista todas las películas en el botón de la barra superior
    public function listarTodas() {
        $radio = "";
        $peliculas = Pelicula::orderBy('titulo')->paginate(10);
        return view('busqueda', compact('peliculas', 'radio'));
    }

    // Muestra la página de la película seleccionada
    public function verPelicula($id) {
        $favorita = new Favorita();
        $listas = new Lista();
        $peliculaRecogida = Pelicula::find($id);
        $criticas = Critica::join('usuarios', 'usuarios.id', '=', 'criticas.id_usuario')
        ->select('criticas.id','criticas.id_usuario',
        'criticas.titulo', 'criticas.texto','criticas.puntuacion', 'criticas.fecha', 'usuarios.nombre as nombre_usuario')
        ->where('id_pelicula', '=', $id)
        ->paginate(5);
        if (Auth::user()) {
            $listas = Lista::where('id_usuario', '=', Auth::user()->id)->get();
            if (!($favorita = Favorita::where('id_usuario', '=', Auth::user()->id)->where('id_pelicula', '=', $id)->first())) {
                $favorita = new Favorita();
                $favorita->id_usuario = 0;
                $favorita->id_pelicula = 0;
            }
        }
        return view('pelicula', compact('peliculaRecogida', 'criticas', 'listas', 'favorita'));
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
