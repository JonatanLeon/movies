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
}
