<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>MovieShare</title>
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('fonts/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/Features-Cards.css')}}">
    <link rel="stylesheet" href="{{ asset('css/Navigation-with-Search.css')}}">
    <link rel="stylesheet" href="{{ asset('css/styles.css')}}">
    <script src="{{ asset('bootstrap/js/bootstrap.min.js')}}"></script>
</head>
<style>
    a,
    a:hover,
    a:focus,
    a:active {
        text-decoration: none;
        color: inherit;
    }

    .card-body {
        cursor: pointer;
    }
</style>

<body>
    @include('templates.navbar')
    @include('sweetalert::alert')
    <div class="border-0 d-flex flex-column justify-content-center align-items-center p-4 py-5"
        style="background: url({{ asset('img/1164207.jpg')}}) center / cover;height: 500px;">
        <div class="row">
            <div
                class="col-md-10 col-xl-11 col-xxl-12 text-center d-flex d-sm-flex d-md-flex justify-content-center align-items-center mx-auto justify-content-md-start align-items-md-center justify-content-xl-center">
                <div>
                    <h1 class="text-uppercase fw-bold mb-3" style="color: var(--bs-light);">¿No sabes qué ver?</h1>
                    <p class="mb-4" style="color: var(--bs-light);font-weight: bold;">Haz click en este botón y te
                        encontraremos algo</p>
                    <a href="/pelicula">
                        <button class="btn btn-primary fs-5 me-2 py-2 px-4" type="button"
                            style="background: var(--bs-pink);border-color: var(--bs-pink);">Película aleatoria</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
    @if (!auth()->user())
    <div class="container py-4 py-xl-5">
        <div class="row mb-5">
            <div class="col-md-8 col-xl-6 text-center mx-auto">
                <h2>¿Qué puedes hacer con MovieShare?</h2>
            </div>
        </div>
        <div class="row gy-4 row-cols-1 row-cols-md-2 row-cols-xl-3">
            <div class="col">
                <div class="card">
                    <div class="card-body p-4">
                        <div class="bs-icon-md bs-icon-rounded bs-icon-primary d-flex justify-content-center align-items-center d-inline-block mb-3 bs-icon"
                            style="background: var(--bs-pink);border-color: var(--bs-pink);"><i class="bi bi-camera-reels"></i></div>
                        <h4 class="card-title">Consultar información sobre películas</h4>
                        <p class="card-text">MovieShare cuenta con una extensa base de&nbsp; datos que almacena información
                            sobre miles de obras del séptimo arte</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body p-4">
                        <div class="bs-icon-md bs-icon-rounded bs-icon-primary d-flex justify-content-center align-items-center d-inline-block mb-3 bs-icon"
                            style="background: var(--bs-pink);border-color: var(--bs-pink);"><i class="bi bi-chat-right-dots"></i></div>
                        <h4 class="card-title">Publicar tus propias reseñas de películas</h4>
                        <p class="card-text">¿Te ha gustado una película que has visto? ¡Comparte tu opinión en MovieShare y
                            lee las reseñas de otros usuarios!</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body p-4">
                        <div class="bs-icon-md bs-icon-rounded bs-icon-primary d-flex justify-content-center align-items-center d-inline-block mb-3 bs-icon"
                            style="background: var(--bs-pink);border-color: var(--bs-pink);"><i class="bi bi-calendar-date"></i></div>
                        <h4 class="card-title">Llevar un diario con las películas que ves</h4>
                        <p class="card-text">MovieShare te permite llevar la cuenta de las películas que vas viendo y
                            añadirlas a un diario personal. ¡Tendrás un calendario de auténtico cine!</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-5" style="margin-top: 39px;">
            <div class="col-md-8 col-xl-6 text-center mx-auto">
                <h2>¡... y más!</h2>
            </div>
        </div>
        <footer class="text-center bg-dark"></footer>
    </div>
    @else
    <div class="container py-4 py-xl-5">
        <div class="row mb-5">
            <div class="col-md-8 col-xl-6 text-center mx-auto">
                <h2>¿Qué quieres consultar?</h2>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <a href="{{ route('ir.usuario.criticas', auth()->user()->id) }}">
                    <div class="card">
                        <div class="card-body p-4 border rounded"
                            style="background-color: var(--bs-blue);border-color: var(--bs-blue);color: var(--bs-white);box-shadow: 5px 5px 5px rgba(33,37,41,0.5);">
                            <h4 class="card-title"><i class="bi bi-chat-right-dots" style="margin-right: 20px;"></i>Mis
                                reseñas</h4>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col">
                <a href="{{ route('ir.usuario.listas', auth()->user()->id) }}">
                    <div class="card">
                        <div class="card-body p-4 border rounded"
                            style="background-color: var(--bs-orange);border-color: var(--bs-orange);color: var(--bs-white);box-shadow: 5px 5px 5px rgba(33,37,41,0.5);">
                            <h4 class="card-title"><i class="bi bi-list-ul" style="margin-right: 20px;"></i>Mis listas
                            </h4>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col">
                <a href="{{ route('ir.usuario.calendario', auth()->user()->id) }}">
                    <div class="card">
                        <div class="card-body p-4 border rounded"
                            style="background-color: var(--bs-green);border-color: var(--bs-green);color: var(--bs-white);box-shadow: 5px 5px 5px rgba(33,37,41,0.5);">
                            <h4 class="card-title"><i class="bi bi-calendar-date" style="margin-right: 20px;"></i>Mi
                                diario
                            </h4>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col">
                <a href="{{ route('ir.usuario.favoritas', auth()->user()->id) }}">
                    <div class="card">
                        <div class="card-body p-4 border rounded"
                            style="background-color: var(--bs-red);border-color: var(--bs-red);color: var(--bs-white);box-shadow: 5px 5px 5px rgba(33,37,41,0.5);">
                            <h4 class="card-title"><i class="bi bi-heart-fill" style="margin-right: 20px;"></i>Mis
                                favoritas
                            </h4>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <footer class="text-center bg-dark"></footer>
    </div>
    @endif
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>
<footer class="text-center bg-dark">
    <div class="container text-white py-4 py-lg-5">
        <p class="text-muted mb-0">Copyright © 2022 Jonatan León Caparrós</p>
    </div>
</footer>

</html>
