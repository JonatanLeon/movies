<nav class="navbar navbar-light navbar-expand-md" style="color: var(--bs-indigo);background: var(--bs-pink);">
    <div class="container-fluid"><a class="navbar-brand" href="/"
            style="color: var(--bs-body-bg);font-weight: bold;font-style: italic;">MOVIES</a>
        <button data-bs-toggle="collapse" data-bs-target="#navcol-1" class="navbar-toggler"><span
                class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navcol-1">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="/peliculas"
                        style="color: var(--bs-light);">Películas</a>
                </li>
                <li class="nav-item"><a class="nav-link" href="/criticas"
                        style="color: var(--bs-light);">Reseñas</a></li>
                <li class="nav-item"><a class="nav-link" href="/listas"
                        style="color: var(--bs-light);">Listas</a></li>
                @auth
                    @if (auth()->user()->role == 'admin')
                        <li class="nav-item"><a class="nav-link" href="/usuarios"
                                style="color: var(--bs-light);">Usuarios</a></li>
                        <li class="nav-item"><a class="nav-link" href="/sugerencias"
                                style="color: var(--bs-light);">Sugerencias</a></li>
                        <li class="nav-item"><a class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#insertPeliNueva" style="color: var(--bs-white);border-color: var(--bs-white);
                        background-color: var(--bs-pink);font-weight: bold;">Añadir película</a></li>
                    @endif
                @endauth
            </ul>
        </div>
        <form class="d-flex" style="margin-right: 16px;" action="/busqueda" method="get">
            {{ csrf_field() }}
            <i class="fa fa-search"
                style="margin: 2px;color: var(--bs-gray-300);font-size: 42px;margin-right: 14px;margin-top: 0px;margin-bottom: 0px;margin-left: 0px;"></i>
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
                        <div class="col-sm-20 input-column"><input class="form-control" type="text"
                                placeholder="Título" name="titulo" required></div>
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
                                <textarea class="form-control" type="text" placeholder="Sinopsis" name="sinopsis" required></textarea>
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
