<?php
$limite = 10;
$total = $peliculas->count();
$paginas = ceil($total / $limite);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Busqueda</title>
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('fonts/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/dh-card-image-left-dark.css')}}">
    <link rel="stylesheet" href="{{ asset('css/styles.css')}}">
    <script src="{{ asset('bootstrap/js/bootstrap.min.js')}}"></script>
</head>

<style>
a, a:hover, a:focus, a:active {
text-decoration: none;
color: inherit;
}
</style>

<body>
    @include('templates.navbar')
    <div class="card"></div>
    <div class="row mb-5" style="margin-top: 38px;">
        <div class="col-md-8 col-xl-6 text-center mx-auto">
            <h2>Resultados</h2>
        </div>
    </div>
    <div class="d-flex justify-content-center" style="margin-top: 30px;">
        {!! $peliculas->appends($_GET)->links() !!}
    </div>
    <section>
        @foreach ($peliculas as $pelicula)
        <a href="{{route('pelicula_seleccionada', $pelicula->id)}}">
        <div class="container">
            <div class="card border rounded-circle" style="margin-top: 34px;box-shadow: 0px 0px;">
                <div class="card-body border rounded" style="background: #ffffff;box-shadow: 5px 5px 5px rgba(33,37,41,0.5);">
                    <div class="row">
                        <div class="col-md-4 col-lg-3 col-xl-2 col-xxl-1" id="columna-1">
                            <img class="img-fluid d-xl-flex align-items-xl-start" src="data:image/png;base64,{{ chunk_split(base64_encode($pelicula->poster)) }}" >
                        </div>
                        <div class="col">
                            <div>
                                <h4 href="/pelicula">{{$pelicula->titulo}}</h4>
                                <h6>{{$pelicula->director}}</h6>
                                <?php $date = date_create($pelicula->estreno);?>
                                <h6 class="text-muted mb-2">{{date_format($date, 'Y')}}</h6>
                                <p>{{$pelicula->generos}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </a>
        @endforeach
    </section>
    <div class="d-flex justify-content-center" style="margin-top: 30px;">
    {!! $peliculas->appends($_GET)->links() !!}
    </div>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
