<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>{{ $peliculaRecogida->titulo }}</title>
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fonts/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('lib\jquery-3.6.0.js') }}" type="text/javascript"></script>
    <style>
        #listaBoton {
            border: 2px solid var(--bs-pink);
            width: 245px;
            font-size: 20px;
            background: var(--bs-white);
            color: var(--bs-pink);
            transition-duration: 1ms;
        }

        #listaBoton:hover {
            background: var(--bs-pink);
            color: var(--bs-white);
        }

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
    <section>
        <div class="container">
            <div class="row">
                <div class="col-xl-4 col-xxl-3" style="padding-left: 0px;">
                    <img class="img-fluid"
                        src="data:image/png;base64,{{ chunk_split(base64_encode($peliculaRecogida->poster)) }}"
                        style="padding: 53px;padding-left: 23px;">
                    <div class="container-fluid" style="margin-bottom: 14px;">
                        <div class="card" style="width: 245px;border-color: var(--bs-pink);">
                            <div class="border rounded" style="border-color: var(--bs-pink);text-align: center;">
                                <h1 class="card-title" style="color: var(--bs-pink);">
                                    {{ $peliculaRecogida->nota_media }}/5 <i class="bi bi-star-fill"
                                        style="color: var(--bs-yellow);"></i></h1>
                            </div>
                        </div>
                    </div>
                    @auth
                        @if ($favorita->id_usuario == auth()->user()->id && $favorita->id_pelicula == $peliculaRecogida->id)
                            <div class="container-fluid" style="margin-bottom: 14px;"><a
                                    href="{{ route('quitar.fav', $peliculaRecogida->id) }}" class="btn btn-primary"
                                    type="button"
                                    style="width: 245px;background: var(--bs-red);font-size: 20px;border-color: var(--bs-red);">Quitar
                                    de Favoritas <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z" />
                                    </svg></a></div>
                        @else
                            <div class="container-fluid" style="margin-bottom: 14px;"><a
                                    href="{{ route('marcar.fav', $peliculaRecogida->id) }}" class="btn btn-primary"
                                    type="button"
                                    style="width: 245px;background: var(--bs-pink);font-size: 20px;border-color: var(--bs-pink);">Marcar
                                    como favorita <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z" />
                                    </svg></a></div>
                        @endif
                        <div class="container-fluid" style="margin-bottom: 14px;"><button class="btn btn-primary"
                                type="button"
                                style="width: 245px;background: var(--bs-pink);font-size: 20px;border-color: var(--bs-pink);"
                                data-bs-toggle="modal" data-bs-target="#criticaModal">Escribir Rese??a</button></div>
                        <div class="container-fluid" style="margin-bottom: 14px;"><button class="btn btn-primary"
                                type="button"
                                style="width: 245px;background: var(--bs-pink);font-size: 20px;border-color: var(--bs-pink);"
                                data-bs-toggle="modal" data-bs-target="#listaModal">Guardar
                                en lista</button></div>
                        <div class="container-fluid" style="margin-bottom: 14px;"><button class="btn btn-primary"
                                type="button"
                                style="width: 245px;background: var(--bs-pink);font-size: 20px;border-color: var(--bs-pink);"
                                data-bs-toggle="modal" data-bs-target="#desplegarCalendario">A??adir
                                a diario</button></div>
                        @if (auth()->user()->role == 'admin')
                            <div class="container-fluid" style="margin-bottom: 14px;"><button class="btn btn-primary"
                                    type="button"
                                    style="width: 245px;background: var(--bs-yellow);font-size: 20px;border-color: var(--bs-red);color: var(--bs-red);"
                                    data-bs-toggle="modal" data-bs-target="#editarPelicula">Editar pel??cula</button>
                            </div>
                            <div class="container-fluid" style="margin-bottom: 14px;"><button class="btn btn-primary"
                                    type="button"
                                    style="width: 245px;background: var(--bs-yellow);font-size: 20px;border-color: var(--bs-red);color: var(--bs-red);"
                                    data-bs-toggle="modal" data-bs-target="#borrarPelicula">Borrar pel??cula</button>
                            </div>
                        @endif
                    @else
                        <div class="container-fluid" style="margin-bottom: 14px;"><a href="/login" class="btn btn-primary"
                                type="button"
                                style="width: 245px;background: var(--bs-pink);font-size: 20px;border-color: var(--bs-pink);">Marcar
                                como favorita <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z" />
                                </svg></a></div>
                        <div class="container-fluid" style="margin-bottom: 14px;"><a href="/login"
                                class="btn btn-primary" type="button"
                                style="width: 245px;background: var(--bs-pink);font-size: 20px;border-color: var(--bs-pink);">Escribir
                                Rese??a</a></div>
                        <div class="container-fluid" style="margin-bottom: 14px;"><a href="/login"
                                class="btn btn-primary" type="button"
                                style="width: 245px;background: var(--bs-pink);font-size: 20px;border-color: var(--bs-pink);">Guardar
                                en lista</a></div>
                        <div class="container-fluid" style="margin-bottom: 14px;"><a href="/login"
                                class="btn btn-primary" type="button"
                                style="width: 245px;background: var(--bs-pink);font-size: 20px;border-color: var(--bs-pink);">A??adir
                                a calendario</a></div>
                    @endauth
                </div>
                <div class="col-xl-8" style="margin: 0px;margin-top: 45px;">
                    <h1 style="padding-top: 0px;width: 867px;">{{ $peliculaRecogida->titulo }}</h1>
                    <div class="row">
                        <div class="col-xl-4 col-xxl-8" style="padding-left: 0px;">
                            <div class="container-fluid"
                                style="padding-top: 0px;padding-right: 0px;padding-left: 13px;">
                                <div>
                                    <h4 class="text-muted mb-2">Estreno</h4>
                                    <p>{{ date('d/m/Y', strtotime($peliculaRecogida->estreno)) }}</p>
                                </div>
                                <div>
                                    <h4 class="text-muted mb-2">Director</h4>
                                    <p>{{ $peliculaRecogida->director }}</p>
                                </div>
                                <div>
                                    <h4 class="text-muted mb-2">G??neros</h4>
                                    <p>{{ $peliculaRecogida->generos }}</p>
                                </div>
                                <div>
                                    <h4 class="text-muted mb-2">Duraci??n</h4>
                                    <p>{{ $peliculaRecogida->duracion }} min.</p>
                                </div>
                                <div>
                                    <h4 class="text-muted mb-2">Pa??s</h4>
                                    <p>{{ $peliculaRecogida->pais }}</p>
                                </div>
                                <div>
                                    <h4 class="text-muted mb-2">Productora</h4>
                                    <p>{{ $peliculaRecogida->productora }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid" style="padding-right: 0px;padding-left: 0px;">
                        <div>
                            <h4 class="text-muted mb-2 d-flex">Reparto</h4>
                            <p>{{ $peliculaRecogida->reparto }}</p>
                        </div>
                        <div style="padding-right: 0px;padding-left: 0px;">
                            <h4 class="text-muted mb-2">Sinopsis</h4>
                            <p>{{ $peliculaRecogida->sinopsis }}</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="row" style="margin-top: 34px;">
                        <div class="col" style="border-bottom-color: var(--bs-pink);">
                            <div style="border-bottom: 1px solid;border-color: var(--bs-pink);">
                                <h1 style="color: var(--bs-pink);">Rese??as de usuarios</h1>
                            </div>
                        </div>
                    </div>
                    @if ($criticas->count() != 0)
                        @foreach ($criticas as $critica)
                            <div class="container">
                                <div class="card border rounded-circle" style="margin-top: 34px;box-shadow: 0px 0px;">
                                    <a href="{{ route('ir.critica', $critica->id) }}">
                                        <div class="card-body border rounded"
                                            style="background: #ffffff;box-shadow: 5px 5px 5px rgba(33,37,41,0.5);">
                                            <div class="row">
                                                <div class="col">
                                                    <div>
                                                        <h4>{{ $critica->titulo }}</h4>
                                                        <h6>Nota: {{ $critica->puntuacion }}/5 <i
                                                                class="bi bi-star-fill"
                                                                style="color: var(--bs-yellow);"></i></h6>
                                                        <h6 class="text-muted mb-2">Por:
                                                            {{ $critica->nombre_usuario }}
                                                        </h6>
                                                        <p>{{ $critica->texto }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                        <div class="d-flex justify-content-center" style="margin-top: 30px;">
                            {!! $criticas->appends($_GET)->links() !!}
                        </div>
                    @else
                        <div style="margin-top: 34px;">
                            <h3>Esta pel??cula a??n no tiene rese??as</h3>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Escribir rese??a -->
    <div class="modal fade" id="criticaModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Escribe una rese??a de
                        {{ $peliculaRecogida->titulo }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('publicar.critica', $peliculaRecogida->id) }}" method="post">
                        {{ csrf_field() }}
                        <div class="row form-group mb-3">
                            <div class="col-sm-20 input-column"><input class="form-control" type="text"
                                    placeholder="T??tulo de la rese??a" name="titulo" required></div>
                        </div>
                        <div class="row form-group mb-3">
                            <div class="col-sm-20 input-column">
                                <textarea class="form-control" type="text" placeholder="Texto de la rese??a" rows="6" name="texto"
                                    required></textarea>
                            </div>
                        </div>
                        <div class="row form-group mb-3">
                            <div class="col-sm-2 label-column">
                                <label class="col-form-label">Puntuaci??n:</label>
                            </div>
                            <div class="col-sm-2 input-column" id="divnota">
                                <select class="form-select" name="puntuacion" required>
                                    <option selected>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <input class="btn btn-light submit-button" type="submit" value="Publicar rese??a"
                                style="background: var(--bs-pink);border-color: var(--bs-pink);color: #FFFFFF;" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Lista Modal -->
    <div class="modal fade" id="listaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Tus listas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @auth
                        @foreach ($listas as $lista)
                            <div class="container text-center" style="margin-bottom: 15px;">
                                <form action='/pelicula/guardarlista/' method="post">
                                    {{ csrf_field() }}
                                    <input value={{ $lista->id }} name="idLista" hidden="true">
                                    <input value={{ $peliculaRecogida->id }} name="idPelicula" hidden="true">
                                    <input id="listaBoton" value="{{ $lista->nombre }}" class="btn btn-primary"
                                        type="submit">
                                </form>
                            </div>
                        @endforeach
                    @endauth
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <a href="#" class="btn btn-primary" type="button"
                        style="background: var(--bs-pink);border-color: var(--bs-pink);" data-bs-toggle="modal"
                        data-bs-target="#crearLista">Crear
                        lista</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Ventana de crear lista -->
    <div class="modal fade" id="crearLista" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nueva lista de pel??culas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('lista.pelicula', $peliculaRecogida->id) }}" method="post">
                        {{ csrf_field() }}
                        <div class="row form-group mb-3">
                            <div class="col-sm-20 input-column"><input class="form-control" type="text"
                                    placeholder="Nombre de la lista" name="nombre" required></div>
                        </div>
                        <div class="row form-group mb-3">
                            <div class="col-sm-20 input-column">
                                <textarea class="form-control" type="text" placeholder="Descripci??n de la lista" rows="6"
                                    name="descripcion" required></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <input class="btn btn-light submit-button" type="submit" value="Crear lista"
                                style="background: var(--bs-pink);border-color: var(--bs-pink);color: #FFFFFF;" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Ventana de a??adir a calendario -->
    <div class="modal fade" id="desplegarCalendario" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">??Cu??ndo viste esta pel??cula?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <?php $fechaActual = date('d/m/Y'); ?>
                <div class="modal-body">
                    <form action="{{ route('insertar.calendario', $peliculaRecogida->id) }}" method="post">
                        {{ csrf_field() }}
                        <div class="row form-group">
                            <div class="input-group date" style="margin-bottom: 20px;">
                                <input type="date" class="form-control" value="{{ $fechaActual }}"
                                    name="fecha" aria-describedby="button-addon2" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <input class="btn btn-light submit-button" type="submit" value="A??adir"
                                style="background: var(--bs-pink);border-color: var(--bs-pink);color: #FFFFFF;" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Editar pelicula -->
    @include('templates.form_pelicula')
    <!-- Confirmaci??n Borrar -->
    <div class="modal fade" id="borrarPelicula" tabindex="-1" role="dialog"
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
                    <a href="{{ route('borrar.peli', $peliculaRecogida->id) }}" type="button"
                        class="btn btn-primary"
                        style="background: var(--bs-white);border-color: var(--bs-red);color: var(--bs-red);">S??</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
