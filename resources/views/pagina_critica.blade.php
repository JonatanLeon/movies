<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>{{ $critica->titulo }}</title>
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
            <div class="container">
                <div class="row">
                    <div class="col-xl-4 col-xxl-3" style="padding-left: 0px;">
                        <img class="img-fluid"
                            src="data:image/png;base64,{{ chunk_split(base64_encode($peliculaRecogida->poster)) }}"
                            style="padding: 53px;padding-left: 23px;">
                        @auth
                            @if (auth()->user()->id == $critica->id_usuario || auth()->user()->role == 'admin')
                                <div class="container-fluid" style="margin-bottom: 14px;"><button data-bs-toggle="modal"
                                        data-bs-target="#modificarCritica" class="btn btn-primary" type="button"
                                        style="width: 245px;background: var(--bs-pink);font-size: 20px;border-color: var(--bs-pink);">Editar
                                        reseña</button></div>
                                <div class="container-fluid" style="margin-bottom: 14px;"><button data-bs-toggle="modal"
                                        data-bs-target="#confirmacionBorrar" class="btn btn-primary" type="button"
                                        style="width: 245px;background: var(--bs-white);font-size: 20px;border-color: var(--bs-red);color: var(--bs-red);">Borrar
                                        reseña</button></div>
                            @endif
                        @endauth
                    </div>

                    <div class="col-xl-8" style="margin: 0px;margin-top: 45px;">
                        <div style="border-bottom: 1px solid;border-color: var(--bs-pink);">
                            <a href="{{ route('pelicula_seleccionada', $peliculaRecogida->id) }}">
                                <h1 style="padding-top: 0px;width: 867px;color: var(--bs-pink);">
                                    {{ $peliculaRecogida->titulo }}</h1>
                            </a>
                        </div>
                        <div class="container" data-bs-toggle="modal" data-bs-target="#criticaModal"
                            style="margin-top: 34px;box-shadow: 0px 0px;">
                            <div class="row">
                                <div class="col">
                                    <div>
                                        <h4>{{ $critica->titulo }}</h4>
                                        <h6>Nota: {{ $critica->puntuacion }}/5 <i class="bi bi-star-fill" style="color: var(--bs-yellow);"></i></h6>
                                        @auth
                                            <a href="{{ route('ir.usuario.criticas', $critica->id_usuario) }}">
                                                <h6 class="text-muted mb-2">Por: {{ $usuario->nombre }}</h6>
                                            </a>
                                        @else
                                            <h6 class="text-muted mb-2">Por: {{ $usuario->nombre }}</h6>
                                        @endauth
                                        <p>{{ $critica->texto }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Confirmación Borrar -->
                    <div class="modal fade" id="confirmacionBorrar" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">¿Seguro que quieres borrarla?
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        style="background: var(--bs-pink);border-color: var(--bs-pink);color: #FFFFFF;"
                                        data-bs-dismiss="modal">No</button>
                                    <a href="{{ route('borrar.critica', $critica->id) }}" type="button"
                                        class="btn btn-primary"
                                        style="background: var(--bs-white);border-color: var(--bs-red);color: var(--bs-red);">Sí</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modificar critica -->
                    <div class="modal fade" id="modificarCritica" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Modifica la reseña de
                                        {{ $critica->nombre_pelicula }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('modificar.critica', $critica->id) }}" method="post">
                                        {{ csrf_field() }}
                                        <div class="row form-group mb-3">
                                            <div class="col-sm-20 input-column"><input class="form-control"
                                                    type="text" value="{{ $critica->titulo }}"
                                                    placeholder="Título de la reseña" name="titulo" required></div>
                                        </div>
                                        <div class="row form-group mb-3">
                                            <div class="col-sm-20 input-column">
                                                <textarea class="form-control" type="text" placeholder="Texto de la reseña" rows="6" name="texto" required>{{ $critica->texto }}</textarea>
                                            </div>
                                        </div>
                                        <div class="row form-group mb-3">
                                            <div class="col-sm-2 label-column">
                                                <label class="col-form-label">Puntuación:</label>
                                            </div>
                                            <div class="col-sm-2 input-column" id="divnota">
                                                <select class="form-select" name="puntuacion" required>
                                                    <option value="" selected="selected" hidden="hidden">
                                                        {{ $critica->puntuacion }}</option>
                                                    <option>1</option>
                                                    <option>2</option>
                                                    <option>3</option>
                                                    <option>4</option>
                                                    <option>5</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Cerrar</button>
                                            <input class="btn btn-light submit-button" type="submit"
                                                value="Publicar reseña"
                                                style="background: var(--bs-pink);border-color: var(--bs-pink);color: #FFFFFF;" />
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>
