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

class AdminController extends Controller
{
    public function listarUsuarios() {
        $usuarios = User::orderBy('nombre')->paginate(10);
        return view('listado_usuarios', compact('usuarios'));
    }

    public function buscarUsuario(Request $request) {
        $term = $request->get("term");
        $usuarios = User::where('nombre', 'like', '%'.$term.'%')->get();
        $data = [];
        foreach($usuarios as $usuario) {
            $data[] = [
                'label' => $usuario->nombre
            ];
        }
        return $data;
    }

    public function listarSugerencias() {
        $sugerencias = Sugerencia::orderBy('id')->paginate(10);
        return view('listado_sugerencias', compact('sugerencias'));
    }

    public function buscarSugerencia(Request $request) {
        $term = $request->get("term");
        $sugerencias = Sugerencia::where('texto', 'like', '%'.$term.'%')->get();
        $data = [];
        foreach($sugerencias as $sugerencia) {
            $data[] = [
                'label' => $sugerencia->texto
            ];
        }
        return $data;
    }

    public function insertarPelicula(Request $request) {
        try {
            if ($request->get("editar")) {
                $pelicula = Pelicula::find($request->id);
            } else {
                $pelicula = new Pelicula();
                Sugerencia::find($request->sugerencia)->delete();
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
            } else {
                Alert::success('Hecho', 'Película añadida');
            }
        } catch (\Exception $e) {
            Alert::error('Error', 'Ha habido un error en los datos introducidos');
        } finally {
            return redirect()->back();
        }
    }

    public function borrarSugerencia($idSugerencia) {
        Sugerencia::find($idSugerencia)->delete();
        Alert::success('Hecho', 'Sugerencia eliminada');
        return redirect()->back();
    }
}
