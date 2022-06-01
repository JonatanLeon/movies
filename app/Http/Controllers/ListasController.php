<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lista;
use Illuminate\Support\Facades\Auth;

class ListasController extends Controller
{
    public function crearLista(Request $request) {
        $lista = new Lista();
        $lista->nombre = $request->nombre;
        $lista->descripcion = $request->descripcion;
        $lista->id_usuario = Auth::user()->id;

        $lista->save();
    }

    public function crearListaMandarPerfil(Request $request) {
        $this->crearLista($request);

        return redirect('/perfil');
    }

    public function crearListaMandarPelicula(Request $request, $idPelicula) {
        $this->crearLista($request);
        return redirect('/pelicula/'.$idPelicula);
    }

    public function guardarEnLista(Request $request) {
       echo $request->idLista;
       echo '<br>';
       echo $request->idPelicula;
    }
}
