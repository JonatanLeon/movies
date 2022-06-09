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
    <link rel="stylesheet" href="{{ asset('lib\jquery-ui-1.13.1\jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('lib\jquery-ui-1.13.1\jquery-ui.structure.css') }}">
    <link rel="stylesheet" href="{{ asset('lib\jquery-ui-1.13.1\jquery-ui.theme.min.css') }}">
    <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('lib\jquery-3.6.0.js') }}" type="text/javascript"></script>
    <script src="{{ asset('lib\jquery-ui-1.13.1\jquery-ui.js') }}" type="text/javascript"></script>
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
                    <div class="container-fluid" style="margin-bottom: 14px;margin-top: 14px;">
                        <a href="#" class="btn btn-primary" type="button"
                            style="width: 245px;background: var(--bs-pink);font-size: 20px;border-color: var(--bs-pink);">Editar
                            perfil</a>
                    </div>
                    @if (auth()->user()->id == $usuario->id)
                        <div class="container-fluid" style="margin-bottom: 14px;margin-top: 14px;">
                            <a href="#" class="btn btn-primary" type="button"
                                style="width: 245px;background: var(--bs-pink);font-size: 20px;border-color: var(--bs-pink);"
                                data-bs-toggle="modal" data-bs-target="#modalSugerencia">Enviar
                                sugerencia</a>
                        </div>
                        <div class="container-fluid" style="margin-bottom: 14px;margin-top: 14px;">
                            <a href="#" class="btn btn-primary" type="button"
                                style="width: 245px;background: var(--bs-yellow);font-size: 20px;border-color: var(--bs-yellow);color: var(--bs-red)"
                                data-bs-toggle="modal" data-bs-target="#modalBuscador">Añadir a
                                diario</a>
                        </div>
                    @endif
                    <div class="container-fluid" style="margin-bottom: 14px;margin-top: 14px;">
                        <a class="btn btn-primary" type="button"
                            style="width: 245px;font-size: 20px;background: var(--bs-white);border-color: var(--bs-red);color: var(--bs-red);"
                            data-bs-toggle="modal" data-bs-target="#confirmacionDesactivar">Desactivar
                            cuenta</a>
                    </div>
                @endauth
            </div>
            <div class="col">
                <ul class="nav nav-tabs">
                    <li class="nav-item"><a class="nav-link"
                            href="{{ route('ir.usuario.criticas', $usuario->id) }}">Reseñas</a></li>
                    <li class="nav-item"><a class="nav-link"
                            href="{{ route('ir.usuario.listas', $usuario->id) }}">Listas</a></li>
                    <li class="nav-item"><a class="nav-link active" href="#">Diario</a></li>
                </ul>
                @if ($calenPeliculas->count() != 0)
                    @foreach ($meses as $mes)
                        <div style="border-bottom: 1px solid;border-color: var(--bs-pink);">
                            <h2 style="margin-top: 20px;width: 400px;color: var(--bs-pink);">
                                {{ date('F Y', strtotime($mes->mes)) }}</h2>
                        </div>
                        @foreach ($calenPeliculas as $calen)
                            @if ($calen->mes == $mes->mes)
                                @foreach ($peliculas as $pelicula)
                                    @if ($pelicula->id == $calen->id_pelicula && $calen->mostrado != true)
                                        <?php $calen->mostrado = true; ?>
                                        <a href="{{ route('pelicula_seleccionada', $pelicula->id) }}">
                                            <div class="container">
                                                <div class="card border rounded-circle"
                                                    style="margin-top: 34px;box-shadow: 0px 0px;">
                                                    <div class="card-body border rounded"
                                                        style="background: #ffffff;box-shadow: 5px 5px 5px rgba(33,37,41,0.5);">
                                                        <div class="row">
                                                            <div class="col-md-4 col-lg-3 col-xl-2 col-xxl-1"
                                                                id="columna-1">
                                                                <h5 class="text-center">Day</h5>
                                                                <h1 class="text-center">
                                                                    {{ date('d', strtotime($calen->fecha)) }}</h1>
                                                            </div>
                                                            <div class="col-md-4 col-lg-3 col-xl-2 col-xxl-1"
                                                                id="columna-1">
                                                                <img class="img-fluid d-xl-flex align-items-xl-start"
                                                                    src="data:image/png;base64,{{ chunk_split(base64_encode($pelicula->poster)) }}">
                                                            </div>
                                                            <div class="col">
                                                                <div>
                                                                    <h4 href="/pelicula">{{ $pelicula->titulo }}</h4>
                                                                    <h6>{{ $pelicula->director }}</h6>
                                                                    <?php $date = date_create($pelicula->estreno); ?>
                                                                    <h6 class="text-muted mb-2">
                                                                        {{ date_format($date, 'Y') }}</h6>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    @endif
                                @endforeach
                            @endif
                        @endforeach
                    @endforeach
                    <div class="d-flex justify-content-center" style="margin-top: 30px;">
                        {!! $meses->appends($_GET)->links() !!}
                    </div>
                @else
                    <div style="margin-top: 34px;text-align: center;">
                        <h3>No hay películas en el diario</h3>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <!-- Modal de añadir pelicula -->
    <div class="modal fade" id="modalBuscador" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">¿Qué película quieres añadir?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body ui-front">
                    <form action='/pelicula/nombre/' method="post" class="busquedaPeli">
                        {{ csrf_field() }}
                        <div class="row form-group mb-3">
                            <div class="col-sm-20 input-column"><input id="auto" class="search form-control p-3"
                                    type="text" placeholder="Buscar..." name="pelicula" required>
                            </div>
                            <div class="modal-footer" style="margin-top: 25px;">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <input class="btn btn-light submit-button" type="submit" value="Añadir"
                                    name="insertarEnLista"
                                    style="background: var(--bs-pink);border-color: var(--bs-pink);color: #FFFFFF;" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal de desactivar cuenta -->
    @include('templates.modal_confirmacion')
    <!-- Modal de sugerencias -->
    @include('templates.modal_sugerencia')
</body>
<script type="text/javascript">
    $("#auto").autocomplete({
        source: function(request, response) {
            $.ajax({
                url: "{{ route('buscar') }}",
                dataType: 'json',
                data: {
                    term: request.term
                },
                success: function(data) {
                    response(data)
                }
            });
        }
    });
</script>

</html>
