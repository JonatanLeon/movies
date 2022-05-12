<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>{{$peliculaRecogida->titulo}}</title>
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('fonts/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/styles.css')}}">
    <script src="{{ asset('bootstrap/js/bootstrap.min.js')}}"></script>
</head>

<body>
    <nav class="navbar navbar-light navbar-expand-md" style="color: var(--bs-indigo);background: var(--bs-pink);">
        <div class="container-fluid"><a class="navbar-brand" href="/" style="color: var(--bs-body-bg);font-weight: bold;font-style: italic;">MOVIES</a><button data-bs-toggle="collapse" data-bs-target="#navcol-1" class="navbar-toggler"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="/peliculas" style="color: var(--bs-light);">Películas</a></li>
                    <li class="nav-item"><a class="nav-link" href="#" style="color: var(--bs-light);">Críticas</a></li>
                    <li class="nav-item"><a class="nav-link" href="#" style="color: var(--bs-light);">Listas</a></li>
                </ul>
            </div>
            <form class="d-flex" style="margin-right: 16px;" action="/busqueda" method="get">
                {{ csrf_field() }}
                <i class="fa fa-search" style="margin: 2px;color: var(--bs-gray-300);font-size: 42px;margin-right: 14px;margin-top: 0px;margin-bottom: 0px;margin-left: 0px;"></i>
                <input class="form-control" type="search" style="height: 43px;" placeholder="Buscar películas..." name="buscar">
            </form>
            <div style="margin: 10px;"><button class="btn btn-primary" type="button" style="background: rgba(255,193,7,0);border-color: var(--bs-body-bg);margin-right: 16px;font-weight: bold;">Registrarse</button><button class="btn btn-primary" type="button" style="background: var(--bs-warning);border-color: var(--bs-body-bg);font-weight: bold;">Iniciar sesión</button></div>
        </div>
    </nav>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-xl-4 col-xxl-3" style="padding-left: 0px;"><img class="img-fluid" src="data:image/png;base64,{{ chunk_split(base64_encode($peliculaRecogida->poster)) }}" style="padding: 53px;padding-left: 23px;">
                    <div class="container-fluid" style="margin-bottom: 14px;"><button class="btn btn-primary" type="button" style="width: 245px;background: var(--bs-pink);font-size: 20px;border-color: var(--bs-pink);">Escribir Reseña</button></div>
                    <div class="container-fluid" style="margin-bottom: 14px;"><button class="btn btn-primary" type="button" style="width: 245px;background: var(--bs-pink);font-size: 20px;border-color: var(--bs-pink);">Guardar en lista</button></div>
                    <div class="container-fluid" style="margin-bottom: 14px;"><button class="btn btn-primary" type="button" style="width: 245px;background: var(--bs-pink);font-size: 20px;border-color: var(--bs-pink);">Añadir a calendario</button></div>
                </div>
                <div class="col-xl-8" style="margin: 0px;margin-top: 45px;">
                    <h1 style="padding-top: 0px;width: 867px;">{{$peliculaRecogida->titulo}}</h1>
                    <div class="row">
                        <div class="col-xl-4 col-xxl-8" style="padding-left: 0px;">
                            <div class="container-fluid" style="padding-top: 0px;padding-right: 0px;padding-left: 13px;">
                                <div>
                                    <h4 class="text-muted mb-2">Estreno</h4>
                                    <p>{{$peliculaRecogida->estreno}}</p>
                                </div>
                                <div>
                                    <h4 class="text-muted mb-2">Director</h4>
                                    <p>{{$peliculaRecogida->director}}</p>
                                </div>
                                <div>
                                    <h4 class="text-muted mb-2">Géneros</h4>
                                    <p>{{$peliculaRecogida->generos}}</p>
                                </div>
                                <div>
                                    <h4 class="text-muted mb-2">Duración</h4>
                                    <p>{{$peliculaRecogida->duracion}} minutos</p>
                                </div>
                                <div>
                                    <h4 class="text-muted mb-2">País</h4>
                                    <p>{{$peliculaRecogida->pais}}</p>
                                </div>
                                <div>
                                    <h4 class="text-muted mb-2">Productora</h4>
                                    <p>{{$peliculaRecogida->productora}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <div class="container-fluid" style="padding-top: 0px;margin-bottom: 14px;padding-right: 0px;padding-left: 0px;">
                                <div class="card" style="border-color: var(--bs-pink);">
                                    <div class="card-body border rounded" style="border-color: var(--bs-pink);">
                                        <h1 class="card-title" style="color: var(--bs-pink);">Nota: {{$peliculaRecogida->nota_media}}/5</h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid" style="padding-right: 0px;padding-left: 0px;">
                        <div>
                            <h4 class="text-muted mb-2 d-flex">Reparto</h4>
                            <p>{{$peliculaRecogida->reparto}}</p>
                        </div>
                        <div style="padding-right: 0px;padding-left: 0px;">
                            <h4 class="text-muted mb-2">Sinopsis</h4>
                            <p>{{$peliculaRecogida->sinopsis}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>
<footer class="text-center bg-dark" style="margin-top: 92px; bottom: 0; width: 100%; height: 10%;">
    <div class="container text-white py-4 py-lg-5">
        <p class="text-muted mb-0">Copyright © 2022 Jonatan León Caparrós</p>
    </div>
</footer>
</html>
