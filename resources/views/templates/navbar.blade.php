<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
<nav class="navbar navbar-light navbar-expand-md" style="color: var(--bs-indigo);background: var(--bs-pink);">
    <div class="container-fluid"><a class="navbar-brand" href="/"
            style="color: var(--bs-body-bg);font-weight: bold;font-style: italic;">MOVIES</a>
        <button data-bs-toggle="collapse" data-bs-target="#navcol-1" class="navbar-toggler"><span
                class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navcol-1">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="/peliculas" style="color: var(--bs-light);">Películas</a>
                </li>
                <li class="nav-item"><a class="nav-link" href="/criticas" style="color: var(--bs-light);">Reseñas</a>
                </li>
                <li class="nav-item"><a class="nav-link" href="/listas" style="color: var(--bs-light);">Listas</a></li>
                @auth
                <li class="nav-item"><a class="nav-link" href="/usuarios" style="color: var(--bs-light);">Usuarios</a>
                </li>
                @if (auth()->user()->role == 'admin')
                <li class="nav-item"><a class="nav-link" href="/sugerencias"
                        style="color: var(--bs-light);">Sugerencias</a></li>
                <li class="nav-item"><a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#insertPeliNueva"
                        style="color: var(--bs-white);border-color: var(--bs-white);
                                                                                            background-color: var(--bs-pink);font-weight: bold;">Añadir
                        película</a>
                </li>
                @endif
                @endauth
            </ul>
        </div>
        <div>
            <i data-bs-toggle="modal" data-bs-target="#filtrar" class="bi bi-filter-square-fill"
                style="color: var(--bs-white);font-size: 42px;margin-right: 14px;cursor: pointer;"></i>
        </div>
        <form class="d-flex" style="margin-right: 16px;" action="/busqueda" method="get">
            {{ csrf_field() }}
            <input class="form-control" type="search" style="height: 43px;" placeholder="Buscar películas..."
                name="buscar">
        </form>
        <div style="margin: 10px;">
            @auth
            <a href="{{ route('ir.usuario.criticas', auth()->user()->id) }}" class="btn btn-primary" type="button"
                style="background: rgba(255,193,7,0);border-color: var(--bs-body-bg);margin-right: 16px;font-weight: bold;">Mi
                perfil</a>
            <a href="/logout" class="btn btn-primary" type="button"
                style="background: var(--bs-warning);border-color: var(--bs-body-bg);font-weight: bold;">Cerrar
                sesión</a>
            @else
            <a href="/registro" class="btn btn-primary" type="button"
                style="background: rgba(255,193,7,0);border-color: var(--bs-body-bg);margin-right: 16px;font-weight: bold;">Registrarse</a>
            <a href="/login" class="btn btn-primary" type="button"
                style="background: var(--bs-warning);border-color: var(--bs-body-bg);font-weight: bold;">Iniciar
                sesión</a>
            @endauth
        </div>
    </div>
</nav>

<!-- Modal añadir película -->
<div class="modal fade" id="insertPeliNueva" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Añadir película
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/perfil/insertarpelicula/" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    {{ csrf_field() }}
                    <div class="row form-group mb-3">
                        <div class="col-sm-20 input-column"><input class="form-control" type="text" placeholder="Título"
                                name="titulo" required></div>
                    </div>
                    <div class="row form-group mb-3">
                        <div class="col-sm-20 input-column">
                            <div class="col-sm-20 input-column"><input class="form-control" type="date"
                                    placeholder="Estreno" name="estreno" required></div>
                        </div>
                    </div>
                    <div class="row form-group mb-3">
                        <div class="col-sm-20 input-column">
                            <div class="col-sm-20 input-column"><input class="form-control" type="text"
                                    placeholder="Director" name="director" required></div>
                        </div>
                    </div>
                    <div class="row form-group mb-3">
                        <div class="col-sm-20 input-column">
                            <div class="col-sm-20 input-column"><input class="form-control" type="text"
                                    placeholder="Géneros" name="generos" required></div>
                        </div>
                    </div>
                    <div class="row form-group mb-3">
                        <div class="col-sm-20 input-column">
                            <div class="col-sm-20 input-column"><input class="form-control" type="text"
                                    placeholder="Duración" name="duracion" required></div>
                        </div>
                    </div>
                    <div class="row form-group mb-3">
                        <div class="col-sm-20 input-column">
                            <div class="col-sm-20 input-column"><input class="form-control" type="text"
                                    placeholder="País" name="pais" required>
                            </div>
                        </div>
                    </div>
                    <div class="row form-group mb-3">
                        <div class="col-sm-20 input-column">
                            <div class="col-sm-20 input-column"><input class="form-control" type="text"
                                    placeholder="Productora" name="productora" required>
                            </div>
                        </div>
                    </div>
                    <div class="row form-group mb-3">
                        <div class="col-sm-20 input-column">
                            <div class="col-sm-20 input-column"><input class="form-control" type="text"
                                    placeholder="Reparto" name="reparto" required></div>
                        </div>
                    </div>
                    <div class="row form-group mb-3">
                        <div class="col-sm-20 input-column">
                            <div class="col-sm-20 input-column">
                                <textarea class="form-control" type="text" placeholder="Sinopsis" name="sinopsis"
                                    required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Subir poster de la
                            película:</label>
                        <input class="form-control" type="file" id="poster" name="poster" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <input name="crear" class="btn btn-light submit-button" type="submit" value="Confirmar"
                        style="background: var(--bs-pink);border-color: var(--bs-pink);color: #FFFFFF;" />
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal filtrar -->
<div class="modal fade" id="filtrar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Búsqueda avanzada
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/busqueda/avanzada" method="post">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group">
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="criterio" name="criterio"
                                placeholder="Buscar...">
                        </div>
                    </div>
                    <fieldset class="form-group" style="margin-top: 20px;">
                        <div class="col-sm-10">
                            <p>Filtrar por:</p>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1"
                                        value="director" checked>
                                    <label class="form-check-label" for="gridRadios1">
                                        Director
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2"
                                        value="generos">
                                    <label class="form-check-label" for="gridRadios2">
                                        Géneros
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2"
                                        value="reparto">
                                    <label class="form-check-label" for="gridRadios2">
                                        Reparto
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2"
                                        value="anio">
                                    <label class="form-check-label" for="gridRadios2">
                                        Año
                                    </label>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        style="background: #535252;border-color: #535252;color: #FFFFFF;"
                        data-bs-dismiss="modal">Cerrar</button>
                    <input href="#" type="submit" class="btn btn-primary"
                        style="background: var(--bs-pink);border-color: var(--bs-pink);color: var(--bs-white);"
                        value="Buscar">
                </div>
            </form>
        </div>
    </div>
</div>
