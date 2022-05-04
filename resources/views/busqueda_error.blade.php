<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Busqueda</title>
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('fonts/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/dh-card-image-left-dark.css')}}">
    <link rel="stylesheet" href="{{ asset('css/styles.css')}}">
    <script src="{{ asset('bootstrap/js/bootstrap.min.js')}}"></script>
</head>

<body>
    <nav class="navbar navbar-light navbar-expand-md" style="color: var(--bs-indigo);background: var(--bs-pink);">
        <div class="container-fluid"><a class="navbar-brand" href="/" style="color: var(--bs-body-bg);font-weight: bold;font-style: italic;">MOVIES</a><button data-bs-toggle="collapse" data-bs-target="#navcol-1" class="navbar-toggler"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="/peliculas" style="color: var(--bs-light);">Películas</a></li>
                    <li class="nav-item"><a class="nav-link" href="#" style="color: var(--bs-light);">Críticas</a></li>
                    <li class="nav-item"><a class="nav-link" href="#" style="color: var(--bs-light);">Listas</a></li>
                </ul>
            </div>
            <form class="d-flex" style="margin-right: 16px;" action="/busqueda" method="POST">
                {{ csrf_field() }}
                <i class="fa fa-search" style="margin: 2px;color: var(--bs-gray-300);font-size: 42px;margin-right: 14px;margin-top: 0px;margin-bottom: 0px;margin-left: 0px;"></i>
                <input class="form-control" type="search" style="height: 43px;" placeholder="Buscar películas..." name="buscar">
            </form>
            <div style="margin: 10px;"><button class="btn btn-primary" type="button" style="background: rgba(255,193,7,0);border-color: var(--bs-body-bg);margin-right: 16px;font-weight: bold;">Registrarse</button><button class="btn btn-primary" type="button" style="background: var(--bs-warning);border-color: var(--bs-body-bg);font-weight: bold;">Iniciar sesión</button></div>
        </div>
    </nav>
    <div class="card"></div>
    <div class="row mb-5" style="margin-top: 38px;">
        <div class="col-md-8 col-xl-6 text-center mx-auto">
            <h2>No se ha encontrado ninguna película</h2>
        </div>
    </div>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>
<footer class="text-center bg-dark" style="margin-top: 92px; position: fixed; bottom: 0; width: 100%; height: 10%;">
    <div class="container text-white py-4 py-lg-5">
        <p class="text-muted mb-0">Copyright © 2022 Jonatan León Caparrós</p>
    </div>
</footer>
</html>