<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lista;
use App\Models\User;
use App\Models\Pelicula;
use App\Models\ListaPelicula;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Database\QueryException;

use Illuminate\Support\Facades\Auth;
/**
 * Controlador que gobierna todos los métodos
 * relacionados con las listas
 */
class ListasController extends Controller
{
    // Muestra todas las listas desde la pestaña de la navbar
    public function listarTodas() {
        $listas = Lista::join('usuarios', 'usuarios.id', '=', 'listas.id_usuario')
        ->select('listas.id','listas.id_usuario', 'listas.nombre', 'listas.descripcion', 'usuarios.nombre as nombre_usuario')
        ->orderBy('nombre')
        ->paginate(10);
        return view('listado_listas', compact('listas'));
    }
    // Busca entre las listas listadas
    public function buscarLista(Request $request) {
        $listas = Lista::join('usuarios', 'usuarios.id', '=', 'listas.id_usuario')
        ->select('listas.id','listas.id_usuario', 'listas.nombre', 'listas.descripcion', 'usuarios.nombre as nombre_usuario')
        ->where('listas.nombre', 'like', '%'.$request->lista.'%')
        ->orderBy('nombre')
        ->paginate(10);
        return view('listado_listas', compact('listas'));
    }
    // Crea una lista a gusto del usuario
    public function crearLista(Request $request) {
        $lista = new Lista();
        $lista->nombre = $request->nombre;
        $lista->descripcion = $request->descripcion;
        $lista->id_usuario = Auth::user()->id;
        $lista->save();
    }
    // Al crear una lista te manda a tu perfil
    public function crearListaMandarPerfilLista(Request $request) {
        $this->crearLista($request);
        Alert::success('Hecho', 'Lista creada');
        return redirect('/perfil/listas/'.Auth::user()->id);
    }
    // Al crear una lista desde la película te manda a la página de la película
    public function crearListaMandarPelicula(Request $request, $idPelicula) {
        $this->crearLista($request);
        Alert::success('Hecho', 'Lista creada');
        return redirect('/pelicula/'.$idPelicula);
    }
    // Inserta una película en la lista
    public function guardarEnLista(Request $request) {
        if(!$request->get("insertarEnLista")) {
            $listaPelicula = new ListaPelicula();
            $listaPelicula->id_lista = $request->idLista;
            $listaPelicula->id_pelicula = $request->idPelicula;
            try {
            $listaPelicula->save();
            Alert::success('Hecho', 'Pelicula añadida a lista');
            return redirect('/pelicula/'.$request->idPelicula);
            } catch(QueryException $e) {
                Alert::error('Error', 'Esa película ya está en la lista');
                return redirect('/pelicula/'.$request->idPelicula);
            }
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
    // carga la página de una lista específica
    public function cargarLista(Request $request, $idLista) {
        if ($idLista != 0) {
            $lista = Lista::find($idLista);
            $usuario = User::find($lista->id_usuario);
            $peliculas = Pelicula::join('lista_peliculas', 'lista_peliculas.id_pelicula', '=', 'peliculas.id')->where('lista_peliculas.id_lista', '=', $idLista)->paginate(10);
            return view('pagina_lista', compact('usuario', 'lista', 'peliculas'));
        } else {
            try {
                $lista = Lista::where('nombre', '=', $request->lista)->first();
                $usuario = User::find($lista->id_usuario);
                $peliculas = Pelicula::join('lista_peliculas', 'lista_peliculas.id_pelicula', '=', 'peliculas.id')->where('lista_peliculas.id_lista', '=', $lista->id)->paginate(10);
            return view('pagina_lista', compact('usuario', 'lista', 'peliculas'));
            } catch (\Exception $e) {
                Alert::error('Error', 'No se ha encontrado la lista especificada');
                return redirect('/listas');
            }
        }
    }
    // Quita una película de la lista
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
    // Edita las propiedades de la lista
    public function modificarLista(Request $request, $idLista) {
        $lista = Lista::find($idLista);
        $lista->nombre = $request->nombre;
        $lista->descripcion = $request->descripcion;
        $lista->save();
        Alert::success('Hecho', 'Lista editada');
        return redirect('/perfil/paginalista/'.$lista->id);
    }
    // Buscador con autocompletar de las películas uqe están en la lista
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
    // Borra una lista entera
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
