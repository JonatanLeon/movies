<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Registro</title>
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/Pretty-Registration-Form.css')}}">
    <link rel="stylesheet" href="{{ asset('css/Navigation-with-Search.css')}}">
    <link rel="stylesheet" href="{{ asset('fonts/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/styles.css')}}">
    <script src="{{ asset('bootstrap/js/bootstrap.min.js')}}"></script>
</head>

<body style="background:#abd7eb;">
    <nav class="navbar navbar-light navbar-expand-md" style="color: var(--bs-indigo);background: var(--bs-pink);">
        <div class="container-fluid"><a class="navbar-brand" href="/" style="color: var(--bs-body-bg);font-weight: bold;font-style: italic;">MOVIES</a><button data-bs-toggle="collapse" data-bs-target="#navcol-1" class="navbar-toggler"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
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
                <a href="/registro" class="btn btn-primary" type="button" style="background: rgba(255,193,7,0);border-color: var(--bs-body-bg);margin-right: 16px;font-weight: bold;">Registrarse</a>
                <a href="/login" class="btn btn-primary" type="button" style="background: var(--bs-warning);border-color: var(--bs-body-bg);font-weight: bold;">Iniciar sesión</a>
            </div>
        </div>
    </nav>
    <section>
        <div class="container">
            <div class="row register-form">
                <div class="col-md-8 offset-md-2">
                    <form class="custom-form" action="/registro" method="post">
                        {{ csrf_field() }}
                        <h1>Registro de usuario</h1>
                        <div class="row form-group">
                            <div class="col-sm-4 label-column"><label class="col-form-label" for="name-input-field">Nombre </label></div>
                            <div class="col-sm-6 input-column"><input class="form-control" type="text" name="nombre"></div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-4 label-column"><label class="col-form-label" for="pawssword-input-field">Contraseña </label></div>
                            <div class="col-sm-6 input-column"><input class="form-control" type="password" name="pass"></div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-4 label-column"><label class="col-form-label" for="repeat-pawssword-input-field">Repetir contraseña </label></div>
                            <div class="col-sm-6 input-column"><input class="form-control" type="password" name="pass2"></div>
                        </div>
                        <input class="btn btn-light submit-button" type="submit" value="Registrarse" style="background: var(--bs-pink);border-color: var(--bs-pink);"/>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
