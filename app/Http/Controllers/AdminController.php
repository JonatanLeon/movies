<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Critica;
use App\Models\Pelicula;
use App\Models\User;
use App\Models\Sugerencia;
use RealRashid\SweetAlert\Facades\Alert;

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
}
