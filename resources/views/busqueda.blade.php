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
    a,
    a:hover,
    a:focus,
    a:active {
        text-decoration: none;
        color: inherit;
    }
</style>

<body>
    @include('templates.navbar')
    @include('sweetalert::alert')
    @if ($peliculas->count()!=0)
    <div class="card"></div>
    <div class="row mb-5" style="margin-top: 38px;">
        <div class="col-md-8 col-xl-6 text-center mx-auto">
            @if ($radio == "director")
            <h2>Resultados por director</h2>
            @elseif ($radio == "generos")
            <h2>Resultados por género</h2>
            @elseif ($radio == "reparto")
            <h2>Resultados por reparto</h2>
            @elseif ($radio == "anio")
            <h2>Resultados por año de estreno</h2>
            @elseif ($radio == "titulo")
            <h2>Resultados por título</h2>
            @endif
        </div>
    </div>
    <div class="d-flex justify-content-center" style="margin-top: 30px;">
        {!! $peliculas->appends($_GET)->links() !!}
    </div>
    <section>
        @foreach ($peliculas as $pelicula)
        @include('templates.card_pelicula')
        @endforeach
        @else
        <div class="card"></div>
        <div class="row mb-5" style="margin-top: 38px;">
            <div class="col-md-8 col-xl-6 text-center mx-auto">
                <h2>No se ha encontrado ninguna película</h2>
            </div>
        </div>
        @endif
    </section>
    <div class="d-flex justify-content-center" style="margin-top: 30px;">
        {!! $peliculas->appends($_GET)->links() !!}
    </div>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>
