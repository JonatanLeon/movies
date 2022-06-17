<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CalendarioPelicula;
use App\Models\Calendario;
use App\Models\Pelicula;
use RealRashid\SweetAlert\Facades\Alert;

class CalendarController extends Controller
{
    public function insertarEnCalendario(Request $request, $idPelicula) {
        $fecha = str_replace('/', '-', $request->fecha);
        $nuevaFecha = date("Y-m-d", strtotime($fecha));
        $calendario = Calendario::where('id_usuario', '=', Auth::user()->id)->first();
        $calendarioPelicula = new CalendarioPelicula();
        $calendarioPelicula->id_calendario = $calendario->id;
        $calendarioPelicula->id_pelicula = $idPelicula;
        $calendarioPelicula->fecha = $nuevaFecha;
        $calendarioPelicula->save();
        Alert::success('Hecho', 'Película añadida a tu calendario');
        return redirect('/pelicula/'.$idPelicula);
    }

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

    public function quitarDeCalendario(Request $request) {
        $pelicula = Pelicula::where('titulo', '=', $request->pelicula)->first();
        $calendario = Calendario::where('id_usuario', '=', Auth::user()->id)->first();
        if(CalendarioPelicula::where('id_calendario', '=', $calendario->id)->where('id_pelicula', '=', $pelicula->id)->delete()) {
            Alert::success('Hecho', 'Película quitada de tu diario');
        } else {
            Alert::error('Error', 'Esa película no está en tu diario');
        }
        return redirect()->back();
    }
}
