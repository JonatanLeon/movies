<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Perfil usuario</title>
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fonts/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Features-Cards.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Navigation-with-Search.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
    <style>
        a,
        a:hover,
        a:focus,
        a:active {
            text-decoration: none;
            color: inherit;
            cursor: pointer;
        }
    </style>
</head>

<body>
    @include('templates.navbar')
    @include('sweetalert::alert')
    <div class="container py-4 py-xl-5">
        <div class="row mb-5">
            <div class="col-md-8 col-xl-3 text-center mx-auto">
                <h2>Perfil de {{ $usuario->nombre }}</h2>
                @auth
                    @if (auth()->user()->id == $usuario->id)
                        <div class="container-fluid" style="margin-bottom: 14px;margin-top: 14px;">
                            <a href="#" class="btn btn-primary" type="button"
                                style="width: 245px;background: var(--bs-pink);font-size: 20px;border-color: var(--bs-pink);"
                                data-bs-toggle="modal" data-bs-target="#editarUsuario">Editar
                                perfil</a>
                        </div>
                        <div class="container-fluid" style="margin-bottom: 14px;margin-top: 14px;">
                            <a href="#" class="btn btn-primary" type="button"
                                style="width: 245px;background: var(--bs-pink);font-size: 20px;border-color: var(--bs-pink);"
                                data-bs-toggle="modal" data-bs-target="#modalSugerencia">Enviar
                                sugerencia</a>
                        </div>
                        <div class="container-fluid" style="margin-bottom: 14px;margin-top: 14px;">
                            <a href="#" class="btn btn-primary" type="button"
                                style="width: 245px;background: var(--bs-yellow);font-size: 20px;border-color: var(--bs-red);color: var(--bs-red);"
                                data-bs-toggle="modal" data-bs-target="#crearLista">Crear
                                lista</a>
                        </div>
                        <div class="container-fluid" style="margin-bottom: 14px;margin-top: 14px;">
                            <a class="btn btn-primary" type="button"
                                style="width: 245px;font-size: 20px;background: var(--bs-white);border-color: var(--bs-red);color: var(--bs-red);"
                                data-bs-toggle="modal" data-bs-target="#confirmacionDesactivar">Desactivar
                                cuenta</a>
                        </div>
                    @endif
                @endauth
            </div>
            <div class="col">
                <ul class="nav nav-tabs">
                    <li class="nav-item"><a class="nav-link"
                            href="{{ route('ir.usuario.criticas', $usuario->id) }}">Reseñas</a></li>
                    <li class="nav-item"><a class="nav-link active" href="#">Listas</a></li>
                    <li class="nav-item"><a class="nav-link"
                            href="{{ route('ir.usuario.calendario', $usuario->id) }}">Diario</a></li>
                    <li class="nav-item"><a class="nav-link"
                            href="{{ route('ir.usuario.favoritas', $usuario->id) }}">Favoritas</a></li>
                </ul>
                @if ($listas->count() != 0)
                    @foreach ($listas as $lista)
                        <a href="{{ route('ir.lista', $lista->id) }}">
                            <div class="container">
                                <div class="card border rounded-circle" style="margin-top: 34px;box-shadow: 0px 0px;">
                                    <div class="card-body border rounded"
                                        style="background: #ffffff;box-shadow: 5px 5px 5px rgba(33,37,41,0.5);">
                                        <div class="row">
                                            <div class="col">
                                                <div>
                                                    <h4>{{ $lista->nombre }}</h4>
                                                    <h6 class="text-muted mb-2">{{ $lista->descripcion }}</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                    <div class="d-flex justify-content-center" style="margin-top: 30px;">
                        {!! $listas->appends($_GET)->links() !!}
                    </div>
                @else
                    <div style="margin-top: 34px;text-align: center;">
                        <h3>No hay ninguna lista</h3>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <!-- Crear lista -->
    @include('templates.modal_lista')
    <!-- Confirmar desactivación -->
    @include('templates.modal_confirmacion')
    <!-- Modal de sugerencias -->
    @include('templates.modal_sugerencia')
    <!-- Modal de editar perfil -->
    @include('templates.modal_editar_perfil')
</body>

</html>
