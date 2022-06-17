<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Critica;
use App\Models\Pelicula;
use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;
/**
 * Controlador que gobierna las acciones del usuario
 */
class CriticasController extends Controller
{
    // Guarda una crítica en la BBDD y mostrarla en la página de la película
    public function publicarCritica(Request $request, $id) {
        $pelicula = Pelicula::find($id);
        $critica = new Critica();
        $critica->titulo = $request->titulo;
        $critica->texto = $request->texto;
        $critica->puntuacion = $request->puntuacion;
        $critica->id_pelicula = $id;
        $critica->id_usuario = Auth::user()->id;
        $critica->fecha = date('Y-m-d H:i:s');
        if (Critica::where('id_pelicula', '=', $critica->id_pelicula)->where('id_usuario', '=', $critica->id_usuario)->first()) {
            Alert::Error('Error', 'Ya existe una reseña tuya de esta película');
            return redirect('/pelicula/'.$id);
        } else {
            $critica->save();
            // Se recalcula la nota con la nueva
            $this->recalcularNota($id);
            Alert::success('Hecho', 'Reseña publicada');
            return redirect('/pelicula/'.$id);
        }
    }
    // Hace media con las notas de todas las críticas de esa película
    public function recalcularNota($idPelicula) {
        $pelicula = Pelicula::find($idPelicula);
        $notaMedia = 0;
        $criticas = Critica::where('id_pelicula', '=', $idPelicula)->get();
        if ($criticas->count() > 0) {
            foreach ($criticas as $critica) {
                $notaMedia += $critica->puntuacion;
            }
            $notaMedia /= $criticas->count();
            $pelicula->nota_media = bcdiv($notaMedia, '1', 1);
        } else {
            $pelicula->nota_media = 0;
        }
        $pelicula->save();
    }

    public function listarTodas() {
        $criticas = Critica::join('peliculas', 'peliculas.id', '=', 'criticas.id_pelicula')
        ->join('usuarios', 'usuarios.id', '=', 'criticas.id_usuario')
        ->select('criticas.id','criticas.id_usuario',
        'criticas.titulo', 'criticas.texto','criticas.puntuacion', 'criticas.fecha', 'peliculas.titulo as nombre_pelicula',
        'usuarios.nombre as nombre_usuario')
        ->orderBy('fecha')
        ->paginate(10);
        return view('listado_criticas', compact('criticas'));
    }

    public function buscarCritica(Request $request) {
        $term = $request->get("term");
        $criticas = Critica::where('titulo', 'like', '%'.$term.'%')->get();
        $data = [];
        foreach($criticas as $critica) {
            $data[] = [
                'label' => $critica->titulo
            ];
        }
        return $data;
    }

    public function mostrarCriticaBuscador(Request $request) {
        try {
            $critica = Critica::where('titulo', '=', $request->critica)->first();
            return redirect('/perfil/paginacritica/'.$critica->id);
        } catch (\Exception $e) {
            Alert::error('Error', 'No se ha encontrado la reseña especificada');
            return redirect('/criticas');
        }
    }

    public function cargarCritica(Request $request, $idCritica) {
        if ($idCritica != 0) {
            $critica = Critica::find($idCritica);
            $usuario = User::find($critica->id_usuario);
            $peliculaRecogida = Pelicula::find($critica->id_pelicula);
            return view('pagina_critica', compact('critica', 'usuario', 'peliculaRecogida'));
        } else {
            try {
                $critica = Critica::where('titulo', '=', $request->critica)->first();
                $usuario = User::find($critica->id_usuario);
                $peliculaRecogida = Pelicula::find($critica->id_pelicula);
                return view('pagina_critica', compact('critica', 'usuario', 'peliculaRecogida'));
            } catch (\Exception $e) {
                Alert::error('Error', 'No se ha encontrado la reseña especificada');
                return redirect('/criticas');
            }
        }
    }

    public function modificarCritica(Request $request, $idCritica) {
        try {
            $usuario = Auth::user();
            $critica = Critica::find($idCritica);
            $peliculaRecogida = Pelicula::find($critica->id_pelicula);
            $critica->titulo = $request->titulo;
            $critica->texto = $request->texto;
            $critica->puntuacion = $request->puntuacion;
            $critica->save();
            Alert::success('Hecho', 'Reseña modificada');
            return view('pagina_critica', compact('critica', 'usuario', 'peliculaRecogida'));
        } catch (\Exception $e) {
            Alert::error('Error', 'No se ha podido modificar la reseña');
            return view('pagina_critica', compact('critica', 'usuario', 'peliculaRecogida'));
        }
    }

    public function borrarCritica($idCritica) {
        try {
            $critica = Critica::find($idCritica);
            $idPelicula = $critica->id_pelicula;
            $idUsuario = $critica->id_usuario;
            $critica->delete();
            $controller = new CriticasController;
            $controller->recalcularNota($idPelicula);
            Alert::success('Hecho', 'Reseña borrada');
        } catch (\Exception $e) {
            Alert::error('Error', 'No se ha podido borrar la reseña');
        }
        return redirect('/perfil/criticas/'.$idUsuario);
    }
}
