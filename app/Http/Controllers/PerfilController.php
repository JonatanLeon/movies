<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\LoginController;
use App\Models\Critica;
use App\Models\User;
use App\Models\Pelicula;
use App\Models\Lista;
use App\Models\ListaPelicula;
use App\Models\Calendario;
use App\Models\CalendarioPelicula;
use App\Models\Sugerencia;
use RealRashid\SweetAlert\Facades\Alert;

class PerfilController extends Controller
{
    public function mostrarCriticas(Request $request, $idUsuario) {
        if ($idUsuario == Auth::user()->id) {
            $usuario = Auth::user();
        } else if ($idUsuario == 0) {
            $usuario = User::where('nombre', '=', $request->usuario)->first();
        } else {
            $usuario = User::find($idUsuario);
        }
        $criticas = Critica::where('id_usuario', '=', $usuario->id)->paginate(10);
        return view('perfil_criticas', compact('usuario', 'criticas'));
    }


    public function mostrarListas($idUsuario) {
        $usuario = User::find($idUsuario);
        $listas = Lista::where('id_usuario', '=', $usuario->id)->paginate(10);
        return view('perfil_listas', compact('usuario', 'listas'));
    }

    public function mostrarCalendario($idUsuario) {
        $usuario = User::find($idUsuario);
        $calendario = Calendario::where('id_usuario', '=', $idUsuario)->first();
        $meses = CalendarioPelicula::select('mes')->where('id_calendario', '=', $calendario->id)->distinct()->orderBy('mes', 'desc')->paginate(15);
        $calenPeliculas = CalendarioPelicula::where('id_calendario', '=', $calendario->id)->orderby('fecha', 'desc')->get();
        $peliculas = Pelicula::join('calendario_peliculas', 'calendario_peliculas.id_pelicula', '=', 'peliculas.id')
        ->where('calendario_peliculas.id_calendario', '=', $calendario->id)->get();
        return view('perfil_calendario', compact('usuario', 'peliculas', 'calenPeliculas', 'meses'));
    }

    public function borrarCritica($idCritica) {
        try {
            $critica = Critica::find($idCritica);
            $critica->delete();
            Alert::success('Hecho', 'Reseña borrada');
            if(auth()->user()->role == "admin") {
                return redirect('/criticas');
            } else {
                return redirect('/perfil/criticas/');
            }
        } catch (\Exception $e) {
            Alert::error('Error', 'No se ha podido borrar la reseña');
            return redirect('/perfil/criticas/');
        }
    }

    // TO-DO que solo la pueda modificar el usuario al que pertenece
    // if Auth::user->id == $critica->id_usuario o algo así
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

    public function cargarCritica(Request $request, $idCritica) {
        $usuario = Auth::user();
        if ($idCritica != 0) {
            $critica = Critica::find($idCritica);
            $peliculaRecogida = Pelicula::find($critica->id_pelicula);
            return view('pagina_critica', compact('critica', 'usuario', 'peliculaRecogida'));
        } else {
            try {
                $critica = Critica::where('titulo', '=', $request->critica)->first();
                $peliculaRecogida = Pelicula::find($critica->id_pelicula);
                return view('pagina_critica', compact('critica', 'usuario', 'peliculaRecogida'));
            } catch (\Exception $e) {
                Alert::error('Error', 'No se ha encontrado la reseña especificada');
                return redirect('/criticas');
            }
        }
    }

    public function cargarLista(Request $request, $idLista) {
        $usuario = Auth::user();
        if ($idLista != 0) {
            $lista = Lista::find($idLista);
            $peliculas = Pelicula::join('lista_peliculas', 'lista_peliculas.id_pelicula', '=', 'peliculas.id')->where('lista_peliculas.id_lista', '=', $idLista)->paginate(10);
            return view('pagina_lista', compact('usuario', 'lista', 'peliculas'));
        } else {
            try {
                $lista = Lista::where('nombre', '=', $request->lista)->first();
                $peliculas = Pelicula::join('lista_peliculas', 'lista_peliculas.id_pelicula', '=', 'peliculas.id')->where('lista_peliculas.id_lista', '=', $lista->id)->paginate(10);
            return view('pagina_lista', compact('usuario', 'lista', 'peliculas'));
            } catch (\Exception $e) {
                Alert::error('Error', 'No se ha encontrado la lista especificada');
                return redirect('/listas');
            }
        }
    }

    public function desactivarCuenta($idUsuario) {
        $usuario = User::find($idUsuario);
        if (Auth::user()->id == $idUsuario) {
            Auth::logout();
            request()->session()->invalidate();
            request()->session()->regenerateToken();
            $usuario->delete();
            Alert::success('Hecho', 'Usuario eliminado');
            return redirect('/');
        } else {
            $usuario->delete();
            Alert::success('Hecho', 'Usuario eliminado');
            return redirect('/usuarios');
        }
    }

    public function enviarSugerencia(Request $request, $idUsuario) {
        $sugerencia = new Sugerencia();
        $sugerencia->texto = $request->pelicula;
        $sugerencia->id_usuario = $idUsuario;
        $sugerencia->nombre_usuario = Auth::user()->nombre;
        $sugerencia->save();
        Alert::success('Sugerencia enviada', 'Un administrador valorará tu sugerencia');
        return redirect()->back();
    }
}
