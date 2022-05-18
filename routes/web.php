<?php

use App\Http\Controllers\MovieController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/registro', function () {
    return view('registro');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/busqueda', [MovieController::class, 'buscarPelicula']);

Route::get('/peliculas', [MovieController::class, 'listarTodas']);

Route::get('/pelicula/{id}', [MovieController::class, 'verPelicula'])->name('pelicula_seleccionada');

Route::get('/pelicula', [MovieController::class, 'peliculaAleatoria'])->name('pelicula_random');


Route::post('/homelogged', [LoginController::class, 'login']);

Route::post('/registro', [LoginController::class, 'registrar']);
