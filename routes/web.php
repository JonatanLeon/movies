<?php

use App\Http\Controllers\MovieController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ActionsController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home');

Route::get('/home', function () {
    return view('home');
});

Route::view('/home', 'home')->middleware('auth');

Route::view('login', 'login');

Route::view('registro', 'registro');

Route::get('/busqueda', [MovieController::class, 'buscarPelicula']);

Route::get('/peliculas', [MovieController::class, 'listarTodas']);

Route::get('/pelicula/{id}', [MovieController::class, 'verPelicula'])->name('pelicula_seleccionada');

Route::get('/pelicula', [MovieController::class, 'peliculaAleatoria'])->name('pelicula_random');

Route::post('/pelicula/critica/{id}', [ActionsController::class, 'publicarCritica'])->name('publicar.critica');

Route::post('/intentologin', [LoginController::class, 'login']);

Route::get('/logout', [LoginController::class, 'logout']);

Route::post('/registro/formulario', [LoginController::class, 'registrar']);
