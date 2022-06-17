<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Critica;
use App\Models\User;
use App\Models\Pelicula;
use App\Models\Lista;
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
        $criticas = Critica::where('id_usuario', '=', $usuario->id)->orderBy('fecha', 'desc')->paginate(10);
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
        foreach ($meses as $mes) {
            $mes = date("F", strtotime($mes));
            echo $mes;
        }
        foreach ($meses as $mes) {
            echo $mes;
        }
        $calenPeliculas = CalendarioPelicula::where('id_calendario', '=', $calendario->id)->orderby('fecha', 'desc')->get();
        $peliculas = Pelicula::join('calendario_peliculas', 'calendario_peliculas.id_pelicula', '=', 'peliculas.id')
        ->where('calendario_peliculas.id_calendario', '=', $calendario->id)->get();
        return view('perfil_calendario', compact('usuario', 'peliculas', 'calenPeliculas', 'meses'));
    }

    public function mostrarFavoritas($idUsuario) {
        $usuario = User::find($idUsuario);
        $peliculasFavoritas = Pelicula::join('favoritas', 'favoritas.id_pelicula', '=', 'peliculas.id')->where('favoritas.id_usuario', '=', $idUsuario)->paginate(10);
        return view('perfil_favoritas', compact('usuario', 'peliculasFavoritas'));
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
}
