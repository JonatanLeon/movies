<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Iniciar sesión</title>
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/Pretty-Registration-Form.css')}}">
    <link rel="stylesheet" href="{{ asset('css/Navigation-with-Search.css')}}">
    <link rel="stylesheet" href="{{ asset('fonts/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/styles.css')}}">
    <script src="{{ asset('bootstrap/js/bootstrap.min.js')}}"></script>
</head>

<body style="background:#abd7eb;">
    @include('templates.navbar')
    @include('sweetalert::alert')
    <section>
        <div class="container">
            <div class="row register-form">
                <div class="col-md-8 offset-md-2">
                    <form class="custom-form" action="/intentologin" method="post">
                        {{ csrf_field() }}
                        <h1>Iniciar sesión</h1>
                        <div class="row form-group">
                            <div class="col-sm-4 label-column"><label class="col-form-label"
                                    for="name-input-field">Nombre </label></div>
                            <div class="col-sm-6 input-column"><input class="form-control" type="text" name="nombre"
                                    required></div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-4 label-column"><label class="col-form-label"
                                    for="pawssword-input-field">Contraseña </label></div>
                            <div class="col-sm-6 input-column"><input class="form-control" type="password"
                                    name="password" required></div>
                        </div>
                        @if($error)
                        <div>
                            <h5 style="color: red;">El nombre o la contraseña no son correctos</h5>
                        </div>
                        @endif
                        <input class="btn btn-light submit-button" type="submit" value="Entrar"
                            style="background: var(--bs-pink);border-color: var(--bs-pink);" />
                    </form>
                </div>
            </div>
        </div>
    </section>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>
