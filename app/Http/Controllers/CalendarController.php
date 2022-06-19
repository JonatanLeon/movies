<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CalendarioPelicula;
use App\Models\Calendario;
use App\Models\Pelicula;
use RealRashid\SweetAlert\Facades\Alert;

/**
 * Controlador con todas las funciones relacionadas con el diario o calendario
 */
class CalendarController extends Controller
{
    // Añade una película y su fecha asociada al calendario
    public function insertarEnCalendario(Request $request, $idPelicula) {
        $fecha = str_replace('/', '-', $request->fecha);
        $nuevaFecha = date("Y-m-d", strtotime($fecha));
        $calendario = Calendario::where('id_usuario', '=', Auth::user()->id)->first();
        $calendarioPelicula = new CalendarioPelicula();
        $calendarioPelicula->id_calendario = $calendario->id;
        $calendarioPelicula->id_pelicula = $idPelicula;
        $calendarioPelicula->fecha = $nuevaFecha;
        $calendarioPelicula->save();
        Alert::success('Hecho', 'Película añadida a tu diario');
        return redirect('/pelicula/'.$idPelicula);
    }
    // Busca una película en el diario del usuario para el autocompletar
    public function buscarEnCalendario(Request $request, $idUsuario) {
        $calendario = Calendario::where('id_usuario', '=', $idUsuario)->first();
        $term = $request->get("term");
        $peliculas = Pelicula::join('calendario_peliculas', 'calendario_peliculas.id_pelicula', '=', 'peliculas.id')
        ->where('calendario_peliculas.id_calendario', '=', $calendario->id)->where('peliculas.titulo', 'like', '%'.$term.'%')->get();
        $data = [];
        foreach($peliculas as $pelicula) {
            $data[] = [
                'label' => $pelicula->titulo
            ];
        }
        return $data;
    }
    // Borra una película que esté en el diario asociada a una fecha
    public function quitarDeCalendario(Request $request) {
        $pelicula = Pelicula::where('titulo', '=', $request->pelicula)->first();
        if(CalendarioPelicula::where('fecha', '=', $request->fecha)->where('id_pelicula', '=', $pelicula->id)->delete()) {
            Alert::success('Hecho', 'Película quitada de tu diario');
        } else {
            Alert::error('Error', 'Esa película no está o la fecha no coincide');
        }
        return redirect()->back();
    }
}
