<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Sugerencias</title>
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

    .card-body {
        cursor: pointer;
    }
</style>

<body>
    @include('templates.navbar')
    @include('sweetalert::alert')
    @if ($sugerencias->count() != 0)
        <div class="row mb-5" style="margin-top: 38px;">
            <div class="col-md-8 col-xl-6 text-center mx-auto">
                <div class="row form-group">
                    <div style="margin-bottom: 20px;">
                        <form action="{{ route('ir.lista', 0) }}" method="get">
                            {{ csrf_field() }}
                            <input id="auto" class="form-control" type="search" name="lista"
                                placeholder="Buscar sugerencias..." style="height: 43px;border-color: var(--bs-pink);">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <section>
        @if ($sugerencias->count() != 0)
            @foreach ($sugerencias as $sugerencia)
                <div class="container">
                    <div class="card border rounded-circle" style="margin-top: 34px;box-shadow: 0px 0px;">
                        <div class="card-body border rounded" data-bs-toggle="modal"
                            data-bs-target="#sugerencia{{ $sugerencia->id }}"
                            style="background: #ffffff;box-shadow: 5px 5px 5px rgba(33,37,41,0.5);">
                            <div class="row">
                                <div class="col">
                                    <div>
                                        <h4>{{ $sugerencia->texto }}</h4>
                                        <h6 class="text-muted mb-2">Por: {{ $sugerencia->nombre_usuario }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Añadir película -->
                <div class="modal fade" id="sugerencia{{ $sugerencia->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">{{ $sugerencia->texto }}
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form action="/perfil/insertarpelicula/" method="post" enctype="multipart/form-data">
                                <div class="modal-body">
                                    {{ csrf_field() }}
                                    <div class="row form-group mb-3">
                                        <div class="col-sm-20 input-column"><input class="form-control" type="text"
                                                placeholder="Título" value="{{ $sugerencia->texto }}" name="titulo"
                                                required></div>
                                    </div>
                                    <div class="row form-group mb-3">
                                        <div class="col-sm-20 input-column">
                                            <div class="col-sm-20 input-column"><input class="form-control"
                                                    type="date" placeholder="Estreno" name="estreno" required></div>
                                        </div>
                                    </div>
                                    <div class="row form-group mb-3">
                                        <div class="col-sm-20 input-column">
                                            <div class="col-sm-20 input-column"><input class="form-control"
                                                    type="text" placeholder="Director" name="director" required></div>
                                        </div>
                                    </div>
                                    <div class="row form-group mb-3">
                                        <div class="col-sm-20 input-column">
                                            <div class="col-sm-20 input-column"><input class="form-control"
                                                    type="text" placeholder="Géneros" name="generos" required></div>
                                        </div>
                                    </div>
                                    <div class="row form-group mb-3">
                                        <div class="col-sm-20 input-column">
                                            <div class="col-sm-20 input-column"><input class="form-control"
                                                    type="text" placeholder="Duración" name="duracion" required></div>
                                        </div>
                                    </div>
                                    <div class="row form-group mb-3">
                                        <div class="col-sm-20 input-column">
                                            <div class="col-sm-20 input-column"><input class="form-control"
                                                    type="text" placeholder="País" name="pais" required></div>
                                        </div>
                                    </div>
                                    <div class="row form-group mb-3">
                                        <div class="col-sm-20 input-column">
                                            <div class="col-sm-20 input-column"><input class="form-control"
                                                    type="text" placeholder="Productora" name="productora" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row form-group mb-3">
                                        <div class="col-sm-20 input-column">
                                            <div class="col-sm-20 input-column"><input class="form-control"
                                                    type="text" placeholder="Reparto" name="reparto" required></div>
                                        </div>
                                    </div>
                                    <div class="row form-group mb-3">
                                        <div class="col-sm-20 input-column">
                                            <div class="col-sm-20 input-column">
                                                <textarea class="form-control" type="text" placeholder="Sinopsis" name="sinopsis" required></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="formFile" class="form-label">Subir poster de la
                                            película:</label>
                                        <input type="text" name="sugerencia" value="{{ $sugerencia->id }}"
                                            hidden="true">
                                        <input class="form-control" type="file" id="poster" name="poster" value=""
                                            required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Cerrar</button>
                                    <a data-bs-toggle="modal" data-bs-target="#confirmacionBorrar{{$sugerencia->id}}"
                                        class="btn btn-light submit-button" type="submit"
                                        style="background: var(--bs-white);border-color: var(--bs-red);color: var(--bs-red);">Borrar
                                        sugerencia</a>
                                    <input name="boton" class="btn btn-light submit-button" type="submit"
                                        value="Confirmar"
                                        style="background: var(--bs-pink);border-color: var(--bs-pink);color: #FFFFFF;" />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Modal confirmación -->
                <div class="modal fade" id="confirmacionBorrar{{$sugerencia->id}}" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">¿Seguro que quieres borrar la
                                    sugerencia?
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    style="background: var(--bs-pink);border-color: var(--bs-pink);color: #FFFFFF;"
                                    data-bs-dismiss="modal">No</button>
                                <a href="{{ route('borrar.sugerencia', $sugerencia->id) }}" type="button"
                                    class="btn btn-primary"
                                    style="background: var(--bs-white);border-color: var(--bs-red);color: var(--bs-red);">Sí</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="card"></div>
            <div class="row mb-5" style="margin-top: 38px;">
                <div class="col-md-8 col-xl-6 text-center mx-auto">
                    <h2>No hay ninguna sugerencia</h2>
                </div>
            </div>
        @endif
    </section>
    <div class="d-flex justify-content-center" style="margin-top: 30px;">
        {!! $sugerencias->appends($_GET)->links() !!}
    </div>
    </div>
</body>
<script type="text/javascript">
    $("#auto").autocomplete({
        source: function(request, response) {
            $.ajax({
                url: "{{ route('buscar.sugerencia') }}",
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
