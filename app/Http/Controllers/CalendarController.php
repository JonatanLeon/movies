<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CalendarioPelicula;
use App\Models\Calendario;
use RealRashid\SweetAlert\Facades\Alert;

class CalendarController extends Controller
{
    public function insertarEnCalendario(Request $request, $idPelicula) {
        $fecha = str_replace('/', '-', $request->fecha);
        $nuevaFecha = date("Y-m-d", strtotime($fecha));
        $mes = date("Y-m", strtotime($nuevaFecha));
        $calendario = Calendario::where('id_usuario', '=', Auth::user()->id)->first();
        $calendarioPelicula = new CalendarioPelicula();
        $calendarioPelicula->id_calendario = $calendario->id;
        $calendarioPelicula->id_pelicula = $idPelicula;
        $calendarioPelicula->fecha = $nuevaFecha;
        $calendarioPelicula->mes = $mes;
        $calendarioPelicula->save();
        Alert::success('Hecho', 'Película añadida a tu calendario');
        return redirect('/pelicula/'.$idPelicula);
    }
}
