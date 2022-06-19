<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelicula;
use App\Models\Favorita;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

/**
 * Controlador que contiene los métodos relacionados con la funcionalidad
 * de marcar películas como favoritas
 */
class FavController extends Controller
{
    // Buscador con autocompeltar
    public function buscarEnFavs(Request $request, $idUsuario) {
        $term = $request->get("term");
        $peliculas = Pelicula::join('favoritas', 'favoritas.id_pelicula', '=', 'peliculas.id')
        ->where('favoritas.id_usuario', '=', $idUsuario)->where('peliculas.titulo', 'like', '%'.$term.'%')->get();
        $data = [];
        foreach($peliculas as $pelicula) {
            $data[] = [
                'label' => $pelicula->titulo
            ];
        }
        return $data;
    }
    // Permite marcar una película como favorita
    public function marcarFavorita(Request $request, $idPelicula) {
        if ($idPelicula == 0) {
            try {
                $pelicula = Pelicula::where('titulo', '=', $request->pelicula)->first();
                $idPelicula = $pelicula->id;
            } catch(\Exception $e) {
                Alert::error('Error', 'El nombre de esa película no existe');
                return redirect()->back();
            }
        }
        $fav = new Favorita();
        $fav->id_usuario = Auth::user()->id;
        $fav->id_pelicula = $idPelicula;
        $fav->save();
        Alert::success('Hecho', 'Película guardada en Favoritas');
        return redirect()->back();
    }
    // Permite quitar una película de favoritas
    public function quitarFavorita(Request $request, $idPelicula) {
        if ($idPelicula == 0) {
            try {
                $pelicula = Pelicula::where('titulo', '=', $request->pelicula)->first();
                $idPelicula = $pelicula->id;
            } catch(\Exception $e) {
                Alert::error('Error', 'El nombre de esa película no existe');
                return redirect()->back();
            }
        }
        $fav = Favorita::where('id_usuario', '=', Auth::user()->id)->where('id_pelicula', '=', $idPelicula)->delete();
        Alert::success('Hecho', 'Película quitada de Favoritas');
        return redirect()->back();

    }
}
