<nav class="navbar navbar-light navbar-expand-md" style="color: var(--bs-indigo);background: var(--bs-pink);">
    <div class="container-fluid"><a class="navbar-brand" href="/" style="color: var(--bs-body-bg);font-weight: bold;font-style: italic;">MOVIES</a>
        <button data-bs-toggle="collapse" data-bs-target="#navcol-1" class="navbar-toggler"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navcol-1">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="/peliculas" style="color: var(--bs-light);">Películas</a></li>
                <li class="nav-item"><a class="nav-link" href="#" style="color: var(--bs-light);">Reseñas</a></li>
                <li class="nav-item"><a class="nav-link" href="#" style="color: var(--bs-light);">Listas</a></li>
            </ul>
        </div>
        <form class="d-flex" style="margin-right: 16px;" action="/busqueda" method="get">
          {{ csrf_field() }}
          <i class="fa fa-search" style="margin: 2px;color: var(--bs-gray-300);font-size: 42px;margin-right: 14px;margin-top: 0px;margin-bottom: 0px;margin-left: 0px;"></i>
          <input class="form-control" type="search" style="height: 43px;" placeholder="Buscar películas..." name="buscar">
        </form>
        <div style="margin: 10px;">
            @auth
            <a class="btn btn-primary" type="button" style="background: rgba(255,193,7,0);border-color: var(--bs-body-bg);margin-right: 16px;font-weight: bold;">Mi perfil</a>
            <a href="/logout" class="btn btn-primary" type="button" style="background: var(--bs-warning);border-color: var(--bs-body-bg);font-weight: bold;">Cerrar sesión</a>
            @else
            <a href="/registro" class="btn btn-primary" type="button" style="background: rgba(255,193,7,0);border-color: var(--bs-body-bg);margin-right: 16px;font-weight: bold;">Registrarse</a>
            <a href="/login" class="btn btn-primary" type="button" style="background: var(--bs-warning);border-color: var(--bs-body-bg);font-weight: bold;">Iniciar sesión</a>
            @endauth
        </div>
    </div>
</nav>
