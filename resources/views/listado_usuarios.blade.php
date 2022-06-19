<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Usuarios</title>
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fonts/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dh-card-image-left-dark.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('lib\jquery-ui-1.13.1\jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('lib\jquery-ui-1.13.1\jquery-ui.structure.css') }}">
    <link rel="stylesheet" href="{{ asset('lib\jquery-ui-1.13.1\jquery-ui.theme.min.css') }}">
    <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('lib\jquery-3.6.0.js') }}" type="text/javascript"></script>
    <script src="{{ asset('lib\jquery-ui-1.13.1\jquery-ui.js') }}" type="text/javascript"></script>
</head>

<style>
    a,
    a:hover,
    a:focus,
    a:active {
        text-decoration: none;
        color: inherit;
    }
</style>

<body>
    @include('templates.navbar')
    @include('sweetalert::alert')
    @if ($usuarios->count() != 0)
        <div class="row mb-5" style="margin-top: 38px;">
            <div class="col-md-8 col-xl-6 text-center mx-auto">
                <div class="row form-group">
                    <div style="margin-bottom: 20px;">
                        <form action='/busqueda/usuarios/'>
                            {{ csrf_field() }}
                            <input id="auto" class="form-control" type="search" name="usuario"
                                placeholder="Buscar usuarios..." style="height: 43px;border-color: var(--bs-pink);">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <section>
        @if ($usuarios->count() != 0)
            @foreach ($usuarios as $usuario)
                <a href="{{ route('ir.usuario.criticas', $usuario->id) }}">
                    <div class="container">
                        <div class="card border rounded-circle" style="margin-top: 34px;box-shadow: 0px 0px;">
                            <div class="card-body border rounded"
                                style="background: #ffffff;box-shadow: 5px 5px 5px rgba(33,37,41,0.5);">
                                <div class="row">
                                    <div class="col">
                                        <div>
                                            <h4>{{ $usuario->nombre }}</h4>
                                            <h6 class="text-muted mb-2">Id: {{ $usuario->id }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        @else
            <div class="card"></div>
            <div class="row mb-5" style="margin-top: 38px;">
                <div class="col-md-8 col-xl-6 text-center mx-auto">
                    <h2>No hay usuarios registrados</h2>
                </div>
            </div>
        @endif
    </section>
    <div class="d-flex justify-content-center" style="margin-top: 30px;">
        {!! $usuarios->appends($_GET)->links() !!}
    </div>
</body>

</html>
