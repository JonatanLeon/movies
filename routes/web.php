<?php

use App\Http\Controllers\MovieController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CriticasController;
use Illuminate\Support\Facades\Route;

// Página principal
Route::view('/', 'home');

Route::get('/home', function () {
    return view('home');
});
// Página principal con logeo
Route::view('/home', 'home')->middleware('auth');

// Llevan a la ventana de login y a la de registro
Route::view('login', 'login');

Route::view('registro', 'registro');

// Para logear, cerrar sesión y registrar
Route::post('/intentologin', [LoginController::class, 'login']);

Route::get('/logout', [LoginController::class, 'logout']);

Route::post('/registro/formulario', [LoginController::class, 'registrar']);

// Buscador y vista de películas
Route::get('/busqueda', [MovieController::class, 'buscarPelicula']);

Route::get('/peliculas', [MovieController::class, 'listarTodas']);

Route::get('/pelicula/{id}', [MovieController::class, 'verPelicula'])->name('pelicula_seleccionada');

Route::get('/pelicula', [MovieController::class, 'peliculaAleatoria'])->name('pelicula_random');

Route::post('/pelicula/critica/{id}', [CriticasController::class, 'publicarCritica'])->name('publicar.critica');
