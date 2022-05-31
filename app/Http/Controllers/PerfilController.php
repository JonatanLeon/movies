<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Critica;
use App\Models\Pelicula;

class PerfilController extends Controller
{
    public function mostrarCriticas() {
        $usuario = Auth::user();
        $criticas = Critica::where('id_usuario', '=', $usuario->id)->paginate(10);
        return view('perfil_usuario', compact('usuario', 'criticas'));
    }

    public function borrarCritica($idCritica) {
        $critica = Critica::find($idCritica);
        $critica->delete();
        return redirect('/perfil');
    }

    // TO-DO que solo la pueda modificar el usuario al que pertenece
    // if Auth::user->id == $critica->id_usuario o algo así
    public function modificarCritica(Request $request, $idCritica) {
        $critica = Critica::find($idCritica);
        $critica->titulo = $request->titulo;
        $critica->texto = $request->texto;
        $critica->puntuacion = $request->puntuacion;
        $critica->save();
        return redirect('/perfil/paginacritica/'.$critica->id);
    }

    public function cargarCritica($idCritica) {
        $usuario = Auth::user();
        $critica = Critica::find($idCritica);
        $peliculaRecogida = Pelicula::find($critica->id_pelicula);
        return view('pagina_critica', compact('critica', 'usuario', 'peliculaRecogida'));
    }
}
