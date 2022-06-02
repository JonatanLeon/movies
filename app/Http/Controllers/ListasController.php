<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lista;
use App\Models\Pelicula;
use App\Models\ListaPelicula;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Database\QueryException;

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

    public function crearListaMandarPerfilLista(Request $request) {
        $this->crearLista($request);
        Alert::success('Hecho', 'Lista creada');
        return redirect('/perfil/listas/');
    }

    public function crearListaMandarPelicula(Request $request, $idPelicula) {
        $this->crearLista($request);
        Alert::success('Hecho', 'Lista creada');
        return redirect('/pelicula/'.$idPelicula);
    }

    public function guardarEnLista(Request $request) {
        if(!$request->get("insertarEnLista")) {
            $listaPelicula = new ListaPelicula();
            $listaPelicula->id_lista = $request->idLista;
            $listaPelicula->id_pelicula = $request->idPelicula;
            $listaPelicula->save();
            Alert::success('Hecho', 'Pelicula añadida a lista');
            return redirect('/pelicula/'.$request->idPelicula);
        } else {
            $listaPelicula = new ListaPelicula();
            $pelicula = Pelicula::where('titulo', '=', $request->pelicula)->first();
            $listaPelicula->id_lista = $request->idLista;
            $listaPelicula->id_pelicula = $pelicula->id;

            try {
                $listaPelicula->save();
                Alert::success('Hecho', 'Pelicula añadida a lista');
                return redirect('/perfil/paginalista/'.$request->idLista);
            } catch(QueryException $e) {
                Alert::error('Error', 'Esa película ya está en la lista');
                return redirect('/perfil/paginalista/'.$request->idLista);
            }
        }
    }
}
