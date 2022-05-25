<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Critica;
use App\Models\Pelicula;
/**
 * Controlador que gobierna las acciones del usuario
 */
class ActionsController extends Controller
{
    // Guarda una crítica en la BBDD y mostrarla en la página de la película
    public function publicarCritica(Request $request, $id) {
        $critica = new Critica();
        $critica->titulo = $request->titulo;
        $critica->texto = $request->texto;
        $critica->puntuacion = $request->puntuacion;
        $critica->id_pelicula = $id;
        $critica->id_usuario = Auth::user()->id;
        $critica->nombre_usuario = Auth::user()->nombre;
        $critica->save();
        // Se recalcula la nota con la nueva
        $this->recalcularNota($id);

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
}
