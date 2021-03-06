<?php

use App\Http\Controllers\MovieController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CriticasController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\ListasController;
use App\Http\Controllers\FavController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

// Variables para mostrar las vistas de login y registro
$registrado = false;
$noRepetida = false;
$passCorta = false;
$error = false;

// Página principal
Route::view('/', 'home');

Route::get('/home', function () {
    return view('home');
});
// Página principal con logeo
Route::view('/home', 'home')->middleware('auth.user');

// Llevan a la ventana de login y a la de registro
Route::view('login', 'login', compact('error'));

Route::get('/login/admin/', [LoginController::class, 'loginAdmin'])->middleware('auth.admin');

Route::view('registro', 'registro', compact('registrado', 'noRepetida', 'passCorta'));

// Gestión de perfil
Route::post('/perfil/editarperfil/{id}', [PerfilController::class, 'editarperfil'])->middleware('auth.user')->name('editar.perfil');

Route::get('/perfil/criticas/{id}', [PerfilController::class, 'mostrarCriticas'])->middleware('auth.user')->name('ir.usuario.criticas');

Route::get('/perfil/listas/{id}', [PerfilController::class, 'mostrarListas'])->middleware('auth.user')->name('ir.usuario.listas');

Route::get('/perfil/calendario/{id}', [PerfilController::class, 'mostrarCalendario'])->middleware('auth.user')->name('ir.usuario.calendario');

Route::get('/perfil/favoritas/{id}', [PerfilController::class, 'mostrarFavoritas'])->middleware('auth.user')->name('ir.usuario.favoritas');

Route::get('/perfil/borrarcritica/{id}', [CriticasController::class, 'borrarCritica'])->middleware('auth.user')->name('borrar.critica');

Route::post('/perfil/modcritica/{id}', [CriticasController::class, 'modificarCritica'])->middleware('auth.user')->name('modificar.critica');

Route::get('/perfil/paginacritica/{id}', [CriticasController::class, 'cargarCritica'])->name('ir.critica');

Route::get('/perfil/paginalista/{id}', [ListasController::class, 'cargarLista'])->name('ir.lista');

Route::post('/perfil/listas/crearlista/', [ListasController::class, 'crearListaMandarPerfilLista'])->middleware('auth.user');

Route::post('/perfil/enviarsugerencia/{id}', [PerfilController::class, 'enviarSugerencia'])->middleware('auth.user')->name('enviar.sugerencia');

Route::get('/perfil/borrarsugerencia/{id}', [AdminController::class, 'borrarSugerencia'])->middleware('auth.user')->name('borrar.sugerencia');

Route::post('/perfil/insertarpelicula/', [AdminController::class, 'insertarPelicula'])->middleware('auth.user');

Route::get('/perfil/desactivar/{id}', [PerfilController::class, 'desactivarCuenta'])->middleware('auth.user')->name('desactivar.cuenta');

Route::post('/perfil/marcarfav/{id}', [FavController::class, 'marcarFavorita'])->middleware('auth.user')->name('marcar.favorita.perfil');

Route::post('/perfil/quitarfav/{id}', [FavController::class, 'quitarFavorita'])->middleware('auth.user')->name('quitar.favorita.perfil');

Route::post('/perfil/quitarcalendario/', [CalendarController::class, 'quitarDeCalendario'])->middleware('auth.user')->name('quitar.calendario');

// Para logear, cerrar sesión y registrar
Route::post('/intentologin', [LoginController::class, 'login']);

Route::get('/logout', [LoginController::class, 'logout'])->middleware('auth.user');

Route::post('/registro/formulario', [LoginController::class, 'registrar']);

// Buscador y vista de películas
Route::get('/busqueda', [MovieController::class, 'buscarPelicula'])->name('buscar');

Route::post('/busqueda/avanzada', [MovieController::class, 'busquedaAvanzada'])->name('busqueda.avanzada');

Route::get('/busqueda/criticas/', [CriticasController::class, 'buscarCritica'])->name('buscar.critica');

Route::get('/busqueda/listas/', [ListasController::class, 'buscarLista'])->name('buscar.lista');

Route::get('/busqueda/usuarios/', [AdminController::class, 'buscarUsuario'])->name('buscar.usuario');

Route::get('/busqueda/sugerencias/', [AdminController::class, 'buscarSugerencia'])->name('buscar.sugerencia');

Route::get('/busqueda/quitar/{id}', [ListasController::class, 'buscarEnLista'])->middleware('auth.user')->name('buscar.quitar');

// Búsquedas para autocompletar
Route::get('/busqueda/quitarfav/{id}', [FavController::class, 'buscarEnFavs'])->middleware('auth.user')->name('buscar.quitar.fav');

Route::get('/busqueda/quitarcalendario/{id}', [CalendarController::class, 'buscarEnCalendario'])->middleware('auth.user')->name('buscar.quitar.calendario');

// Muestran listados
Route::get('/peliculas', [MovieController::class, 'listarTodas']);

Route::get('/criticas', [CriticasController::class, 'listarTodas']);

Route::get('/listas', [ListasController::class, 'listarTodas']);

Route::get('/usuarios', [AdminController::class, 'listarUsuarios']);

Route::get('/sugerencias', [AdminController::class, 'listarSugerencias'])->middleware('auth.admin');

// Rutas de la página de una película
Route::get('/pelicula/{id}', [MovieController::class, 'verPelicula'])->name('pelicula_seleccionada');

Route::post('/pelicula/nombre/', [MovieController::class, 'buscarPorNombre'])->middleware('auth.user')->name('buscar.nombre');

Route::get('/pelicula', [MovieController::class, 'peliculaAleatoria'])->name('pelicula_random');

Route::get('/pelicula/fav/{id}', [FavController::class, 'marcarFavorita'])->middleware('auth.user')->name('marcar.fav');

Route::get('/pelicula/quitarfav/{id}', [FavController::class, 'quitarFavorita'])->middleware('auth.user')->name('quitar.fav');

Route::get('/pelicula/borrar/{id}', [AdminController::class, 'borrarPelicula'])->middleware('auth.admin')->name('borrar.peli');

Route::post('/pelicula/critica/{id}', [CriticasController::class, 'publicarCritica'])->middleware('auth.user')->name('publicar.critica');

Route::post('/pelicula/{id}/crearlista', [ListasController::class, 'crearListaMandarPelicula'])->middleware('auth.user')->name('lista.pelicula');

Route::post('/pelicula/guardarlista/', [ListasController::class, 'guardarEnLista'])->middleware('auth.user');

Route::post('/pelicula/borrardelista/{id}', [ListasController::class, 'quitarDeLista'])->middleware('auth.user');

Route::post('/pelicula/editarlista/{id}', [ListasController::class, 'modificarLista'])->middleware('auth.user')->name('modificar.lista');

Route::get('/pelicula/borrarlista/{id}', [ListasController::class, 'borrarLista'])->middleware('auth.user')->name('borrar.lista');

Route::post('/pelicula/insertarcalendario/{id}', [CalendarController::class, 'insertarEnCalendario'])->middleware('auth.user')->name('insertar.calendario');
