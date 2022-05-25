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
    @include('templates.navbar')
    <section>
        <div class="container">
            <div class="row register-form">
                <div class="col-md-8 offset-md-2">
                    <form class="custom-form" action="/registro/formulario" method="post">
                        {{ csrf_field() }}
                        <h1>Registro de usuario</h1>
                        <div class="row form-group">
                            <div class="col-sm-4 label-column"><label class="col-form-label" for="name-input-field">Nombre </label></div>
                            <div class="col-sm-6 input-column"><input class="form-control" type="text" name="nombre" required></div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-4 label-column"><label class="col-form-label" for="pawssword-input-field">Contraseña </label></div>
                            <div class="col-sm-6 input-column"><input class="form-control" type="password" name="pass" placeholder="(Longitud mínima: 8)" required></div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-4 label-column"><label class="col-form-label" for="repeat-pawssword-input-field">Repetir contraseña </label></div>
                            <div class="col-sm-6 input-column"><input class="form-control" type="password" name="pass2" required></div>
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
