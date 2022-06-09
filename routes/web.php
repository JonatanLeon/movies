<?php

use App\Http\Controllers\MovieController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CriticasController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\ListasController;
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
Route::get('/perfil/criticas/{id}', [PerfilController::class, 'mostrarCriticas'])->middleware('auth.user')->name('ir.usuario.criticas');

Route::get('/perfil/listas/{id}', [PerfilController::class, 'mostrarListas'])->middleware('auth.user')->name('ir.usuario.listas');

Route::get('/perfil/calendario/{id}', [PerfilController::class, 'mostrarCalendario'])->middleware('auth.user')->name('ir.usuario.calendario');

Route::get('/perfil/borrarcritica/{id}', [PerfilController::class, 'borrarCritica'])->middleware('auth.user')->name('borrar.critica');

Route::post('/perfil/modcritica/{id}', [PerfilController::class, 'modificarCritica'])->middleware('auth.user')->name('modificar.critica');

// Si fallan estas rutas puede ser porque falta la barra del final
Route::get('/perfil/paginacritica/{id}', [PerfilController::class, 'cargarCritica'])->middleware('auth.user')->name('ir.critica');

Route::get('/perfil/paginalista/{id}', [PerfilController::class, 'cargarLista'])->middleware('auth.user')->name('ir.lista');

Route::post('/perfil/listas/crearlista/', [ListasController::class, 'crearListaMandarPerfilLista'])->middleware('auth.user');

Route::post('/perfil/enviarsugerencia/{id}', [PerfilController::class, 'enviarSugerencia'])->middleware('auth.user')->name('enviar.sugerencia');

Route::get('/perfil/desactivar/{id}', [PerfilController::class, 'desactivarCuenta'])->middleware('auth.user')->name('desactivar.cuenta');

// Para logear, cerrar sesión y registrar
Route::post('/intentologin', [LoginController::class, 'login']);

Route::get('/logout', [LoginController::class, 'logout'])->middleware('auth.user');

Route::post('/registro/formulario', [LoginController::class, 'registrar']);

// Buscador y vista de películas
Route::get('/busqueda', [MovieController::class, 'buscarPelicula'])->name('buscar');

Route::get('/busqueda/criticas/', [CriticasController::class, 'buscarCritica'])->name('buscar.critica');

Route::get('/busqueda/listas/', [ListasController::class, 'buscarLista'])->name('buscar.lista');

Route::get('/busqueda/usuarios/', [AdminController::class, 'buscarUsuario'])->name('buscar.usuario');

Route::get('/busqueda/sugerencias/', [AdminController::class, 'buscarSugerencia'])->name('buscar.sugerencia');

Route::get('/busqueda/quitar/{id}', [ListasController::class, 'buscarEnLista'])->middleware('auth.user')->name('buscar.quitar');

Route::get('/peliculas', [MovieController::class, 'listarTodas']);

Route::get('/criticas', [CriticasController::class, 'listarTodas']);

Route::get('/listas', [ListasController::class, 'listarTodas']);

Route::get('/usuarios', [AdminController::class, 'listarUsuarios'])->middleware('auth.admin');

Route::get('/sugerencias', [AdminController::class, 'listarSugerencias'])->middleware('auth.admin');

Route::get('/pelicula/{id}', [MovieController::class, 'verPelicula'])->name('pelicula_seleccionada');

Route::post('/pelicula/nombre/', [MovieController::class, 'buscarPorNombre'])->middleware('auth.user')->name('buscar.nombre');

Route::get('/pelicula', [MovieController::class, 'peliculaAleatoria'])->name('pelicula_random');

Route::post('/pelicula/critica/{id}', [CriticasController::class, 'publicarCritica'])->middleware('auth.user')->name('publicar.critica');

Route::post('/pelicula/{id}/crearlista', [ListasController::class, 'crearListaMandarPelicula'])->middleware('auth.user')->name('lista.pelicula');

Route::post('/pelicula/guardarlista/', [ListasController::class, 'guardarEnLista'])->middleware('auth.user');

Route::post('/pelicula/borrardelista/', [ListasController::class, 'quitarDeLista'])->middleware('auth.user');

Route::post('/pelicula/editarlista/{id}', [ListasController::class, 'modificarLista'])->middleware('auth.user')->name('modificar.lista');

Route::get('/pelicula/borrarlista/{id}', [ListasController::class, 'borrarLista'])->middleware('auth.user')->name('borrar.lista');

Route::post('/pelicula/insertarcalendario/{id}', [CalendarController::class, 'insertarEnCalendario'])->middleware('auth.user')->name('insertar.calendario');
