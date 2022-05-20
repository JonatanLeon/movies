<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Movies</title>
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('fonts/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/Features-Cards.css')}}">
    <link rel="stylesheet" href="{{ asset('css/Navigation-with-Search.css')}}">
    <link rel="stylesheet" href="{{ asset('css/styles.css')}}">
    <script src="{{ asset('bootstrap/js/bootstrap.min.js')}}"></script>
</head>

<body>
    <nav class="navbar navbar-light navbar-expand-md" style="color: var(--bs-indigo);background: var(--bs-pink);">
        <div class="container-fluid"><a class="navbar-brand" href="/" style="color: var(--bs-body-bg);font-weight: bold;font-style: italic;">MOVIES</a>
            <button data-bs-toggle="collapse" data-bs-target="#navcol-1" class="navbar-toggler"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="/peliculas" style="color: var(--bs-light);">Películas</a></li>
                    <li class="nav-item"><a class="nav-link" href="#" style="color: var(--bs-light);">Críticas</a></li>
                    <li class="nav-item"><a class="nav-link" href="#" style="color: var(--bs-light);">Listas</a></li>
                </ul>
            </div>
            <form class="d-flex" style="margin-right: 16px;" action="/busqueda" method="get">
              {{ csrf_field() }}
              <i class="fa fa-search" style="margin: 2px;color: var(--bs-gray-300);font-size: 42px;margin-right: 14px;margin-top: 0px;margin-bottom: 0px;margin-left: 0px;"></i>
              <input class="form-control" type="search" style="height: 43px;" placeholder="Buscar películas..." name="buscar">
            </form>
            <div style="margin: 10px;">
                <a href="/login" class="btn btn-primary" type="button" style="background: var(--bs-warning);border-color: var(--bs-body-bg);font-weight: bold;">Logout</a>
            </div>
        </div>
    </nav>
    <div class="border-0 d-flex flex-column justify-content-center align-items-center p-4 py-5" style="background: url({{ asset('img/1164207.jpg')}}) center / cover;height: 500px;">
        <div class="row">
            <div class="col-md-10 col-xl-11 col-xxl-12 text-center d-flex d-sm-flex d-md-flex justify-content-center align-items-center mx-auto justify-content-md-start align-items-md-center justify-content-xl-center">
                <div>
                    <h1 class="text-uppercase fw-bold mb-3" style="color: var(--bs-light);">¿No sabes qué ver?</h1>
                    <p class="mb-4" style="color: var(--bs-light);font-weight: bold;">Haz click en este botón y te encontraremos algo</p>
                    <a href="/pelicula">
                        <button class="btn btn-primary fs-5 me-2 py-2 px-4" type="button" style="background: var(--bs-pink);border-color: var(--bs-pink);">Recomiéndame una película</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="container py-4 py-xl-5">
        <div class="row mb-5">
            <div class="col-md-8 col-xl-6 text-center mx-auto">
                <h2>¿Qué puedes hacer con MOVIES?</h2>
            </div>
        </div>
        <div class="row gy-4 row-cols-1 row-cols-md-2 row-cols-xl-3">
            <div class="col">
                <div class="card">
                    <div class="card-body p-4">
                        <div class="bs-icon-md bs-icon-rounded bs-icon-primary d-flex justify-content-center align-items-center d-inline-block mb-3 bs-icon" style="background: var(--bs-pink);border-color: var(--bs-pink);"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-bell">
                                <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zM8 1.918l-.797.161A4.002 4.002 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4.002 4.002 0 0 0-3.203-3.92L8 1.917zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5.002 5.002 0 0 1 13 6c0 .88.32 4.2 1.22 6z"></path>
                            </svg></div>
                        <h4 class="card-title">Consultar información sobre películas</h4>
                        <p class="card-text">MOVIES cuenta con una extensa base de&nbsp; datos que almacena información sobre miles de obras del séptimo arte</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body p-4">
                        <div class="bs-icon-md bs-icon-rounded bs-icon-primary d-flex justify-content-center align-items-center d-inline-block mb-3 bs-icon" style="background: var(--bs-pink);border-color: var(--bs-pink);"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-bezier">
                                <path fill-rule="evenodd" d="M0 10.5A1.5 1.5 0 0 1 1.5 9h1A1.5 1.5 0 0 1 4 10.5v1A1.5 1.5 0 0 1 2.5 13h-1A1.5 1.5 0 0 1 0 11.5v-1zm1.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1zm10.5.5A1.5 1.5 0 0 1 13.5 9h1a1.5 1.5 0 0 1 1.5 1.5v1a1.5 1.5 0 0 1-1.5 1.5h-1a1.5 1.5 0 0 1-1.5-1.5v-1zm1.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1zM6 4.5A1.5 1.5 0 0 1 7.5 3h1A1.5 1.5 0 0 1 10 4.5v1A1.5 1.5 0 0 1 8.5 7h-1A1.5 1.5 0 0 1 6 5.5v-1zM7.5 4a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1z"></path>
                                <path d="M6 4.5H1.866a1 1 0 1 0 0 1h2.668A6.517 6.517 0 0 0 1.814 9H2.5c.123 0 .244.015.358.043a5.517 5.517 0 0 1 3.185-3.185A1.503 1.503 0 0 1 6 5.5v-1zm3.957 1.358A1.5 1.5 0 0 0 10 5.5v-1h4.134a1 1 0 1 1 0 1h-2.668a6.517 6.517 0 0 1 2.72 3.5H13.5c-.123 0-.243.015-.358.043a5.517 5.517 0 0 0-3.185-3.185z"></path>
                            </svg></div>
                        <h4 class="card-title">Publicar tus propias reseñas de películas</h4>
                        <p class="card-text">¿Te ha gustado una película que has visto? ¡Comparte tu opinión en MOVIES y lee las reseñas de otros usuarios!</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body p-4">
                        <div class="bs-icon-md bs-icon-rounded bs-icon-primary d-flex justify-content-center align-items-center d-inline-block mb-3 bs-icon" style="background: var(--bs-pink);border-color: var(--bs-pink);"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-flag">
                                <path d="M14.778.085A.5.5 0 0 1 15 .5V8a.5.5 0 0 1-.314.464L14.5 8l.186.464-.003.001-.006.003-.023.009a12.435 12.435 0 0 1-.397.15c-.264.095-.631.223-1.047.35-.816.252-1.879.523-2.71.523-.847 0-1.548-.28-2.158-.525l-.028-.01C7.68 8.71 7.14 8.5 6.5 8.5c-.7 0-1.638.23-2.437.477A19.626 19.626 0 0 0 3 9.342V15.5a.5.5 0 0 1-1 0V.5a.5.5 0 0 1 1 0v.282c.226-.079.496-.17.79-.26C4.606.272 5.67 0 6.5 0c.84 0 1.524.277 2.121.519l.043.018C9.286.788 9.828 1 10.5 1c.7 0 1.638-.23 2.437-.477a19.587 19.587 0 0 0 1.349-.476l.019-.007.004-.002h.001M14 1.221c-.22.078-.48.167-.766.255-.81.252-1.872.523-2.734.523-.886 0-1.592-.286-2.203-.534l-.008-.003C7.662 1.21 7.139 1 6.5 1c-.669 0-1.606.229-2.415.478A21.294 21.294 0 0 0 3 1.845v6.433c.22-.078.48-.167.766-.255C4.576 7.77 5.638 7.5 6.5 7.5c.847 0 1.548.28 2.158.525l.028.01C9.32 8.29 9.86 8.5 10.5 8.5c.668 0 1.606-.229 2.415-.478A21.317 21.317 0 0 0 14 7.655V1.222z"></path>
                            </svg></div>
                        <h4 class="card-title">Llevar un diario con las películas que ves</h4>
                        <p class="card-text">MOVIES te permite llevar la cuenta de las películas que vas viendo y añadirlas a un diario personal. ¡Tendrás un calendario de auténtico cine!</p>
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
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>
<footer class="text-center bg-dark">
    <div class="container text-white py-4 py-lg-5">
        <p class="text-muted mb-0">Copyright © 2022 Jonatan León Caparrós</p>
    </div>
</footer>
</html>