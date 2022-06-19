<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Critica;
use App\Models\Pelicula;
use App\Models\User;
use App\Models\Sugerencia;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Database\QueryException;

/**
 * Controlador para todas las funciones del administrador
 */
class AdminController extends Controller
{
    // Lista los usuarios al pulsar el botón correspondiente de la navbar
    // Los usuarios normales también tienen acceso a esta pestaña
    public function listarUsuarios() {
        $usuarios = User::orderBy('nombre')->paginate(10);
        return view('listado_usuarios', compact('usuarios'));
    }
    // Busca un usuario en el listado de usuarios de la navbar
    public function buscarUsuario(Request $request) {
        $usuarios = User::where('nombre', 'like', '%'.$request->usuario.'%')
        ->orderBy('nombre')
        ->paginate(10);
        return view('listado_usuarios', compact('usuarios'));
    }
    // Muestra todas las sugerencias al pulsar el botón correspondiente de la navbar
    public function listarSugerencias() {
        $sugerencias = Sugerencia::join('usuarios', 'usuarios.id', '=', 'sugerencias.id_usuario')
        ->select('sugerencias.id','sugerencias.id_usuario',
        'sugerencias.texto', 'usuarios.nombre as nombre_usuario')
        ->orderBy('id')
        ->paginate(10);
        return view('listado_sugerencias', compact('sugerencias'));
    }
    // Busca una sugerencia concreta
    public function buscarSugerencia(Request $request) {
        $sugerencias = Sugerencia::join('usuarios', 'usuarios.id', '=', 'sugerencias.id_usuario')
        ->select('sugerencias.id','sugerencias.id_usuario',
        'sugerencias.texto', 'usuarios.nombre as nombre_usuario')
        ->where('sugerencias.texto', 'like', '%'.$request->sugerencia.'%')
        ->orderBy('sugerencias.texto')
        ->paginate(10);
        return view('listado_sugerencias', compact('sugerencias'));
    }
    // Añade o edita una película en la base de datos, según desde donde se llame
    public function insertarPelicula(Request $request) {
        try {
            if ($request->get("editar")) {
                $pelicula = Pelicula::find($request->id);
            } else {
                $pelicula = new Pelicula();
                if(!$request->get("crear")) {
                    Sugerencia::find($request->sugerencia)->delete();
                }
                $pelicula->nota_media = 0;
            }
            $pelicula->titulo = $request->titulo;
            $pelicula->estreno = date("Y-m-d", strtotime($request->estreno));
            $pelicula->director = $request->director;
            $pelicula->generos = $request->generos;
            $pelicula->duracion = $request->duracion;
            $pelicula->pais = $request->pais;
            $pelicula->productora = $request->productora;
            $pelicula->reparto = $request->reparto;
            $pelicula->sinopsis = $request->sinopsis;
            if ($request->poster != null) {
                $path = file_get_contents($request->poster->path());
                $poster = $path;
                $pelicula->poster = $poster;
            }
            $pelicula->save();
            if ($request->get("editar")) {
                Alert::success('Hecho', 'Película editada');
                return redirect('/pelicula/'.$pelicula->id);
            } else {
                Alert::success('Hecho', 'Película añadida');
                return redirect('/pelicula/'.$pelicula->id);
            }
        } catch (\Exception $e) {
            Alert::error('Error', 'Ha habido un error en los datos introducidos');
            return redirect('/pelicula/'.$pelicula->id);
        }
    }
    // Borra una sugerencia determinada
    public function borrarSugerencia($idSugerencia) {
        Sugerencia::find($idSugerencia)->delete();
        Alert::success('Hecho', 'Sugerencia eliminada');
        return redirect()->back();
    }
    // Borra una película determinada
    public function borrarPelicula($idPelicula) {
        Pelicula::find($idPelicula)->delete();
        Alert::success('Hecho', 'Película eliminada');
        return redirect('/peliculas');
    }
}
