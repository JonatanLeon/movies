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
/**
 * Controlador que lleva a cabo todos los métodos relacionados con
 * la oágina de perfil del usuario
 */
class PerfilController extends Controller
{
    // Muestra todas las críticas del usuario en la pestaña críticas
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
    // Muestra todas las listas del usuario en la pestaña listas
    public function mostrarListas($idUsuario) {
        $usuario = User::find($idUsuario);
        $listas = Lista::where('id_usuario', '=', $usuario->id)->paginate(10);
        return view('perfil_listas', compact('usuario', 'listas'));
    }
    // Muestra todas las películas del diario del usuario en la pestaña diario
    public function mostrarCalendario($idUsuario) {
        $usuario = User::find($idUsuario);
        $calendario = Calendario::where('id_usuario', '=', $idUsuario)->first();
        $meses = CalendarioPelicula::select('fecha')->where('id_calendario', '=', $calendario->id)->orderBy('fecha', 'desc')->paginate(15);
        $calenPeliculas = CalendarioPelicula::where('id_calendario', '=', $calendario->id)->orderby('fecha', 'desc')->get();
        $peliculas = Pelicula::join('calendario_peliculas', 'calendario_peliculas.id_pelicula', '=', 'peliculas.id')
        ->where('calendario_peliculas.id_calendario', '=', $calendario->id)->get();
        return view('perfil_calendario', compact('usuario', 'peliculas', 'calenPeliculas', 'meses'));
    }
    // Muestra las películas favoritas del usuario en la pestaña favoritas
    public function mostrarFavoritas($idUsuario) {
        $usuario = User::find($idUsuario);
        $peliculasFavoritas = Pelicula::join('favoritas', 'favoritas.id_pelicula', '=', 'peliculas.id')->where('favoritas.id_usuario', '=', $idUsuario)->paginate(10);
        return view('perfil_favoritas', compact('usuario', 'peliculasFavoritas'));
    }
    // Borra por completo al usuario de la base de datos y a todos los registros relacionados en otras tablas
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
    // Permite al usuario enviar la sugerencia de una película a los administradores
    public function enviarSugerencia(Request $request, $idUsuario) {
        $sugerencia = new Sugerencia();
        $sugerencia->texto = $request->pelicula;
        $sugerencia->id_usuario = $idUsuario;
        $sugerencia->save();
        Alert::success('Sugerencia enviada', 'Un administrador valorará tu sugerencia');
        return redirect()->back();
    }
    // Permite al usuario editar su propio perfil
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
