<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Critica;
use App\Models\Pelicula;
use RealRashid\SweetAlert\Facades\Alert;
/**
 * Controlador que gobierna las acciones del usuario
 */
class CriticasController extends Controller
{
    // Guarda una crítica en la BBDD y mostrarla en la página de la película
    public function publicarCritica(Request $request, $id) {
        $pelicula = Pelicula::find($id);
        $critica = new Critica();
        $critica->titulo = $request->titulo;
        $critica->texto = $request->texto;
        $critica->puntuacion = $request->puntuacion;
        $critica->id_pelicula = $id;
        $critica->id_usuario = Auth::user()->id;
        $critica->nombre_usuario = Auth::user()->nombre;
        $critica->nombre_pelicula = $pelicula->titulo;
        $critica->save();
        // Se recalcula la nota con la nueva
        $this->recalcularNota($id);
        Alert::success('Hecho', 'Crítica publicada');
        return redirect('/pelicula/'.$id);
    }
    // Hace media con las notas de todas las críticas de esa película
    public function recalcularNota($idPelicula) {
        $pelicula = Pelicula::find($idPelicula);
        $notaMedia = 0;
        $criticas = Critica::where('id_pelicula', '=', $idPelicula)->get();
        foreach ($criticas as $critica) {
            $notaMedia += $critica->puntuacion;
        }
        $notaMedia /= $criticas->count();
        $pelicula->nota_media = bcdiv($notaMedia, '1', 1);
        $pelicula->save();
    }

    public function listarTodas() {
        $criticas = Critica::orderBy('titulo')->paginate(10);
        return view('listado_criticas', compact('criticas'));
    }
}
