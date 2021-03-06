<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>{{ $lista->nombre }}</title>
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fonts/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Features-Cards.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Navigation-with-Search.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('lib\jquery-ui-1.13.1\jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('lib\jquery-ui-1.13.1\jquery-ui.structure.css') }}">
    <link rel="stylesheet" href="{{ asset('lib\jquery-ui-1.13.1\jquery-ui.theme.min.css') }}">
    <style>
        a,
        a:hover,
        a:focus,
        a:active {
            text-decoration: none;
            color: inherit;
            cursor: pointer;
        }

        .card-body {
            cursor: pointer;
        }
    </style>
</head>

<body>
    @include('templates.navbar')
    @include('sweetalert::alert')
    <div class="container py-4 py-xl-5">
        <div class="col">
            <div style="border-bottom: 1px solid;border-color: var(--bs-pink);">
                <h1 style="padding-top: 0px;width: 867px;color: var(--bs-pink);">
                    {{ $lista->nombre }}</h1>
            </div>
            <div style="margin-top: 15px;">
                @auth
                    <a href="{{ route('ir.usuario.criticas', $lista->id_usuario) }}">
                        <h5 id="propietario" class="text-muted mb-2">De: {{ $usuario->nombre }}</h5>
                    </a>
                @else
                    <h5 id="propietario" class="text-muted mb-2">De: {{ $usuario->nombre }}</h5>
                @endauth <p style="font-size: 20px;">{{ $lista->descripcion }}</p>
            </div>
            @auth
                @if (auth()->user()->id == $lista->id_usuario || auth()->user()->role == 'admin')
                    <div class="row">
                        <div class="col" style="margin-top: 15px;">
                            <a data-bs-toggle="modal" data-bs-target="#modalBuscador" class="btn btn-primary" type="button"
                                style="width: 245px;background: var(--bs-pink);font-size: 20px;border-color: var(--bs-pink);">A??adir
                                pel??cula</a>
                        </div>
                        <div class="col" style="margin-top: 15px;">
                            <a data-bs-toggle="modal" data-bs-target="#modalQuitar" class="btn btn-primary" type="button"
                                style="width: 245px;background: var(--bs-pink);font-size: 20px;border-color: var(--bs-pink);">Quitar
                                pel??cula</a>
                        </div>
                        <div class="col" style="margin-top: 15px;">
                            <a data-bs-toggle="modal" data-bs-target="#editarLista" class="btn btn-primary" type="button"
                                style="width: 245px;background: var(--bs-pink);font-size: 20px;border-color: var(--bs-pink);">Editar
                                Lista</a>
                        </div>
                        <div class="col" style="margin-top: 15px;">
                            <a data-bs-toggle="modal" data-bs-target="#confirmacionBorrar" class="btn btn-primary"
                                type="button"
                                style="width: 245px;background: var(--bs-white);border-color: var(--bs-red);color: var(--bs-red);font-size: 20px;">Borrar
                                Lista</a>
                        </div>
                    </div>
                @endif
            @endauth
            @if ($peliculas->count() != 0)
                @foreach ($peliculas as $pelicula)
                    <!-- Cards de las pel??culas -->
                    <div class="container">
                        <div class="card border rounded-circle" style="margin-top: 34px;box-shadow: 0px 0px;">
                            <div class="card-body border rounded" data-bs-toggle="modal"
                                data-bs-target="#borrar{{ $pelicula->id }}"
                                style="background: #ffffff;box-shadow: 5px 5px 5px rgba(33,37,41,0.5);">
                                <div class="row">
                                    <div class="col-md-4 col-lg-3 col-xl-2 col-xxl-1" id="columna-1">
                                        <img class="img-fluid d-xl-flex align-items-xl-start"
                                            src="data:image/png;base64,{{ chunk_split(base64_encode($pelicula->poster)) }}">
                                    </div>
                                    <div class="col">
                                        <div>
                                            <h4 href="/pelicula">{{ $pelicula->titulo }}</h4>
                                            <h6>{{ $pelicula->director }}</h6>
                                            <?php $date = date_create($pelicula->estreno); ?>
                                            <h6 class="text-muted mb-2">{{ date_format($date, 'Y') }}</h6>
                                            <p>{{ $pelicula->generos }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Confirmaci??n Borrar de la Card -->
                    <div class="modal fade" id="borrar{{ $pelicula->id }}" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5>{{ $pelicula->titulo }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>??Quitarla de la lista?</p>
                                </div>
                                <div class="modal-footer">
                                    <div style="margin-left: 50px;">
                                        <a href="{{ route('pelicula_seleccionada', $pelicula->id) }}" type="button"
                                            class="btn btn-primary"
                                            style="background: var(--bs-pink);border-color: var(--bs-pink);color: var(--bs-white);">P??gina
                                            de la pel??cula</a>
                                    </div>
                                    <button type="button" class="btn btn-secondary"
                                        style="background: #535252;border-color: #535252;color: #FFFFFF;"
                                        data-bs-dismiss="modal">No</button>
                                    <form action="/pelicula/borrardelista/{{ $pelicula->id }}" method="post">
                                        {{ csrf_field() }}
                                        <input value={{ $lista->id }} name="idLista" hidden="true">
                                        <input type="submit" class="btn btn-primary"
                                            style="background: var(--bs-white);border-color: var(--bs-red);color: var(--bs-red);"
                                            value="S??">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="d-flex justify-content-center" style="margin-top: 30px;">
                    {!! $peliculas->appends($_GET)->links() !!}
                </div>
            @else
                <div style="margin-top: 34px;">
                    <h3>Esta lista no tiene ninguna pel??cula todav??a</h3>
                </div>
            @endif
        </div>
    </div>
    <!-- Modal de a??adir pelicula -->
    <div class="modal fade" id="modalBuscador" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">A??adir pel??cula</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body ui-front">
                    <form action='/pelicula/guardarlista/' method="post" class="busquedaPeli">
                        {{ csrf_field() }}
                        <div class="row form-group mb-3">
                            <div class="col-sm-20 input-column"><input id="auto" class="search form-control p-3"
                                    type="text" placeholder="Buscar..." name="pelicula" required>
                                <input value={{ $lista->id }} name="idLista" hidden="true">
                            </div>
                            <div class="modal-footer" style="margin-top: 25px;">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <input class="btn btn-light submit-button" type="submit" value="A??adir"
                                    name="insertarEnLista"
                                    style="background: var(--bs-pink);border-color: var(--bs-pink);color: #FFFFFF;" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Quitar pelicula -->
    <div class="modal fade" id="modalQuitar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Quitar pel??cula</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body ui-front">
                    <form action="/pelicula/borrardelista/{{ 0 }}" method="post" class="busquedaPeli">
                        {{ csrf_field() }}
                        <div class="row form-group mb-3">
                            <div class="col-sm-20 input-column"><input id="quitar" class="search form-control p-3"
                                    type="text" placeholder="Buscar..." name="pelicula" required>
                                <input value={{ $lista->id }} name="idLista" hidden="true">
                            </div>
                            <div class="modal-footer" style="margin-top: 25px;">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <input class="btn btn-light submit-button" type="submit" value="Quitar"
                                    name="insertarEnLista"
                                    style="background: var(--bs-pink);border-color: var(--bs-pink);color: #FFFFFF;" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Editar Lista -->
    <div class="modal fade" id="editarLista" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar lista de pel??culas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('modificar.lista', $lista->id) }}" method="post">
                        {{ csrf_field() }}
                        <div class="row form-group mb-3">
                            <div class="col-sm-20 input-column"><input class="form-control" type="text"
                                    placeholder="Nombre de la lista" value="{{ $lista->nombre }}" name="nombre"
                                    required></div>
                        </div>
                        <div class="row form-group mb-3">
                            <div class="col-sm-20 input-column">
                                <textarea class="form-control" type="text" placeholder="Descripci??n de la lista" rows="6" name="descripcion" required>{{ $lista->descripcion }}</textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <input class="btn btn-light submit-button" type="submit" value="Modificar lista"
                                style="background: var(--bs-pink);border-color: var(--bs-pink);color: #FFFFFF;" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Confirmaci??n Borrar -->
    <div class="modal fade" id="confirmacionBorrar" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">??Seguro que quieres borrarla?
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        style="background: var(--bs-pink);border-color: var(--bs-pink);color: #FFFFFF;"
                        data-bs-dismiss="modal">No</button>
                    <a href="{{ route('borrar.lista', $lista->id) }}" type="button" class="btn btn-primary"
                        style="background: var(--bs-white);border-color: var(--bs-red);color: var(--bs-red);">S??</a>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('lib\jquery-3.6.0.js') }}" type="text/javascript"></script>
<script src="{{ asset('lib\jquery-ui-1.13.1\jquery-ui.js') }}" type="text/javascript"></script>
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
    $("#quitar").autocomplete({
        source: function(request, response) {
            $.ajax({
                url: "{{ route('buscar.quitar', $lista->id) }}",
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
