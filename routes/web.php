<?php

use App\Http\Controllers\MovieController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CriticasController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\ListasController;
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
Route::view('/home', 'home')->middleware('auth');

// Llevan a la ventana de login y a la de registro
Route::view('login', 'login', compact('error'));

Route::view('registro', 'registro', compact('registrado', 'noRepetida', 'passCorta'));

// Gestión de perfil
Route::get('/perfil/criticas/', [PerfilController::class, 'mostrarCriticas']);

Route::get('/perfil/listas/', [PerfilController::class, 'mostrarListas']);

Route::get('/perfil/borrarcritica/{id}', [PerfilController::class, 'borrarCritica'])->name('borrar.critica');

Route::post('/perfil/modcritica/{id}', [PerfilController::class, 'modificarCritica'])->name('modificar.critica');

Route::get('/perfil/paginacritica/{id}', [PerfilController::class, 'cargarCritica'])->name('ir.critica');

// Si falla esta ruta puede ser porque falta la barra del final
Route::get('/perfil/paginalista/{id}', [PerfilController::class, 'cargarLista'])->name('ir.lista');

Route::post('/perfil/listas/crearlista/', [ListasController::class, 'crearListaMandarPerfilLista']);

// Para logear, cerrar sesión y registrar
Route::post('/intentologin', [LoginController::class, 'login']);

Route::get('/logout', [LoginController::class, 'logout']);

Route::post('/registro/formulario', [LoginController::class, 'registrar']);

// Buscador y vista de películas
Route::get('/busqueda', [MovieController::class, 'buscarPelicula'])->name('buscar');

Route::get('/busqueda/quitar/{id}', [ListaController::class, 'quitarPelicula'])->name('buscar.quitar');

Route::get('/peliculas', [MovieController::class, 'listarTodas']);

Route::get('/criticas', [CriticasController::class, 'listarTodas']);

Route::get('/pelicula/{id}', [MovieController::class, 'verPelicula'])->name('pelicula_seleccionada');

Route::get('/pelicula', [MovieController::class, 'peliculaAleatoria'])->name('pelicula_random');

Route::post('/pelicula/critica/{id}', [CriticasController::class, 'publicarCritica'])->name('publicar.critica');

Route::post('/pelicula/{id}/crearlista', [ListasController::class, 'crearListaMandarPelicula'])->name('lista.pelicula');

Route::post('/pelicula/guardarlista/', [ListasController::class, 'guardarEnLista']);

Route::post('/pelicula/borrardeLista/', [ListasController::class, 'quitarPelicula']);
