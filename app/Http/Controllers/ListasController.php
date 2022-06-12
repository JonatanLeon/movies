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
    public function listarTodas() {
        $listas = Lista::orderBy('nombre')->paginate(10);
        return view('listado_listas', compact('listas'));
    }

    public function buscarLista(Request $request) {
        $term = $request->get("term");
        $listas = Lista::where('nombre', 'like', '%'.$term.'%')->get();
        $data = [];
        foreach($listas as $lista) {
            $data[] = [
                'label' => $lista->nombre
            ];
        }
        return $data;
    }

    public function crearLista(Request $request) {
        $lista = new Lista();
        $lista->nombre = $request->nombre;
        $lista->descripcion = $request->descripcion;
        $lista->id_usuario = Auth::user()->id;
        $lista->nombre_usuario = Auth::user()->nombre;
        $lista->save();
    }

    public function crearListaMandarPerfilLista(Request $request) {
        $this->crearLista($request);
        Alert::success('Hecho', 'Lista creada');
        return redirect('/perfil/listas/'.Auth::user()->id);
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

    public function quitarDeLista(Request $request, $idPelicula) {
        if ($idPelicula == 0) {
            $pelicula = Pelicula::where('titulo', '=', $request->pelicula)->first();
        }
        else {
            $pelicula = Pelicula::find($idPelicula);
        }
        try {
            ListaPelicula::where('id_pelicula', '=', $pelicula->id)->where('id_lista', '=', $request->idLista)->forceDelete();
            Alert::success('Hecho', 'Pelicula quitada de la lista');
            return redirect('/perfil/paginalista/'.$request->idLista);
        } catch(\Exception $e) {
            Alert::error('Error', 'No existe esa película en esta lista');
            return redirect('/perfil/paginalista/'.$request->idLista);
        }
    }

    public function quitarConCard($idPelicula) {
        ListaPelicula::where('id_pelicula', '=', $idPelicula)->where('id_lista', '=', $request->idLista)->forceDelete();
    }

    public function modificarLista(Request $request, $idLista) {
        $lista = Lista::find($idLista);
        $lista->nombre = $request->nombre;
        $lista->descripcion = $request->descripcion;
        $lista->save();
        Alert::success('Hecho', 'Lista editada');
        return redirect('/perfil/paginalista/'.$lista->id);
    }

    public function buscarEnLista(Request $request, $idLista) {
        $term = $request->get("term");
        $peliculas = Pelicula::join('lista_peliculas', 'lista_peliculas.id_pelicula', '=', 'peliculas.id')
        ->where('lista_peliculas.id_lista', '=', $idLista)->where('peliculas.titulo', 'like', '%'.$term.'%')->get();
        $data = [];
        foreach($peliculas as $pelicula) {
            $data[] = [
                'label' => $pelicula->titulo
            ];
        }
        return $data;
    }

    public function borrarLista($idLista) {
        $lista = Lista::find($idLista);
        $idUsuario = $lista->id_usuario;
        $lista->delete();
        Alert::success('Hecho', 'Lista eliminada');
        return redirect('/perfil/listas/'.$idUsuario);
    }

    public function mostrarListaBuscador(Request $request) {
        try {
            $lista = Lista::where('nombre', '=', $request->lista)->first();
            return redirect('/perfil/paginalista/'.$lista->id);
        } catch (\Exception $e) {
            Alert::error('Error', 'No se ha encontrado la lista especificada');
            return redirect('/listas');
        }
    }
}
