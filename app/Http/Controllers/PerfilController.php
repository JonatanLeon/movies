<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CriticasController;
use App\Models\Critica;
use App\Models\User;
use App\Models\Pelicula;
use App\Models\Lista;
use App\Models\ListaPelicula;
use App\Models\Calendario;
use App\Models\CalendarioPelicula;
use App\Models\Sugerencia;
use App\Models\Favorita;
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
        $criticas = Critica::join('peliculas', 'peliculas.id', '=', 'criticas.id_pelicula')->select('criticas.id','criticas.id_usuario',
        'criticas.titulo', 'criticas.texto','criticas.puntuacion', 'criticas.fecha', 'peliculas.titulo as nombre_pelicula')
        ->where('criticas.id_usuario', '=', $usuario->id)
        ->orderBy('fecha')
        ->paginate(10);
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
        $meses = CalendarioPelicula::select('fecha')->where('id_calendario', '=', $calendario->id)->orderBy('fecha', 'desc')->paginate(15);
        $calenPeliculas = CalendarioPelicula::where('id_calendario', '=', $calendario->id)->orderby('fecha', 'desc')->get();
        $peliculas = Pelicula::join('calendario_peliculas', 'calendario_peliculas.id_pelicula', '=', 'peliculas.id')
        ->where('calendario_peliculas.id_calendario', '=', $calendario->id)->get();
        return view('perfil_calendario', compact('usuario', 'peliculas', 'calenPeliculas', 'meses'));
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
        $sugerencia->save();
        Alert::success('Sugerencia enviada', 'Un administrador valorará tu sugerencia');
        return redirect()->back();
    }

    public function editarPerfil(Request $request, $idUsuario) {
        $nombre = $request->nombre;
        $contrasenia = $request->password;
        $repeContrasenia = $request->password2;

        $noRepetida = false;
        $passCorta = false;

        if ($contrasenia != $repeContrasenia) {
           $noRepetida = true;
        }
        if (strlen($contrasenia) < 8) {
            $passCorta = true;
        }
        if ($noRepetida == true) {
            Alert::error('Error', 'La contraseña debe tener al menos 8 caracteres');
            return redirect()->back();
        } else if ($passCorta == true) {
            Alert::error('Error', 'Los campos de contraseña no coinciden');
            return redirect()->back();
        }

        else {
            $usuario = User::find($idUsuario);
            $usuario->nombre = $nombre;
            $usuario->password = $contrasenia;
            $pass_fuerte = password_hash($contrasenia, PASSWORD_DEFAULT);
            $usuario->password = $pass_fuerte;
            $usuario->role = "user";
            $usuario->save();
            Alert::success('Hecho', 'Usuario editado correctamente');
            return redirect()->back();
        }
    }

    public function mostrarFavoritas($idUsuario) {
        $usuario = User::find($idUsuario);
        $peliculasFavoritas = Pelicula::join('favoritas', 'favoritas.id_pelicula', '=', 'peliculas.id')->where('favoritas.id_usuario', '=', $idUsuario)->paginate(10);
        return view('perfil_favoritas', compact('usuario', 'peliculasFavoritas'));
    }

    public function marcarFavorita(Request $request, $idPelicula) {
        if ($idPelicula == 0) {
            try {
                $pelicula = Pelicula::where('titulo', '=', $request->pelicula)->first();
                $idPelicula = $pelicula->id;
            } catch(\Exception $e) {
                Alert::error('Error', 'El nombre de esa película no existe');
                return redirect()->back();
            }
        }
        $fav = new Favorita();
        $fav->id_usuario = Auth::user()->id;
        $fav->id_pelicula = $idPelicula;
        $fav->save();
        Alert::success('Hecho', 'Película guardada en Favoritas');
        return redirect()->back();
    }

    public function buscarEnFavs(Request $request, $idUsuario) {
        $term = $request->get("term");
        $peliculas = Pelicula::join('favoritas', 'favoritas.id_pelicula', '=', 'peliculas.id')
        ->where('favoritas.id_usuario', '=', $idUsuario)->where('peliculas.titulo', 'like', '%'.$term.'%')->get();
        $data = [];
        foreach($peliculas as $pelicula) {
            $data[] = [
                'label' => $pelicula->titulo
            ];
        }
        return $data;
    }

    public function buscarEnCalendario(Request $request, $idUsuario) {
        $calendario = Calendario::where('id_usuario', '=', $idUsuario)->first();
        $term = $request->get("term");
        $peliculas = Pelicula::join('calendario_peliculas', 'calendario_peliculas.id_pelicula', '=', 'peliculas.id')
        ->where('calendario_peliculas.id_calendario', '=', $calendario->id)->where('peliculas.titulo', 'like', '%'.$term.'%')->get();
        $data = [];
        foreach($peliculas as $pelicula) {
            $data[] = [
                'label' => $pelicula->titulo
            ];
        }
        return $data;
    }

    public function quitarDeCalendario(Request $request) {
        $pelicula = Pelicula::where('titulo', '=', $request->pelicula)->first();
        $calendario = Calendario::where('id_usuario', '=', Auth::user()->id)->first();
        if(CalendarioPelicula::where('id_calendario', '=', $calendario->id)->where('id_pelicula', '=', $pelicula->id)->delete()) {
            Alert::success('Hecho', 'Película quitada de tu diario');
        } else {
            Alert::error('Error', 'Esa película no está en tu diario');
        }
        return redirect()->back();
    }

    public function quitarFavorita(Request $request, $idPelicula) {
        if ($idPelicula == 0) {
            try {
                $pelicula = Pelicula::where('titulo', '=', $request->pelicula)->first();
                $idPelicula = $pelicula->id;
            } catch(\Exception $e) {
                Alert::error('Error', 'El nombre de esa película no existe');
                return redirect()->back();
            }
        }
        $fav = Favorita::where('id_usuario', '=', Auth::user()->id)->where('id_pelicula', '=', $idPelicula)->delete();
        Alert::success('Hecho', 'Película quitada de Favoritas');
        return redirect()->back();

    }
}
