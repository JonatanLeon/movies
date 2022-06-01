<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Perfil usuario</title>
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('fonts/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/Features-Cards.css')}}">
    <link rel="stylesheet" href="{{ asset('css/Navigation-with-Search.css')}}">
    <link rel="stylesheet" href="{{ asset('css/styles.css')}}">
    <script src="{{ asset('bootstrap/js/bootstrap.min.js')}}"></script>
    <link rel="stylesheet" href="{{asset('js/jquery-ui.min.css')}}">
    <script src="{{asset('js/jquery-3.6.0.min.js')}}"></script>
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
    <div class="container py-4 py-xl-5">
        <div class="col">
            <div style="border-bottom: 1px solid;border-color: var(--bs-pink);">
                <h1 style="padding-top: 0px;width: 867px;color: var(--bs-pink);">
                    {{$lista->nombre}}</h1>
            </div>
            <div style="margin-top: 15px;">
                <p style="font-size: 20px;">{{$lista->descripcion}}</p>
            </div>
            <div class="row">
                <div class="col" style="margin-top: 15px;">
                    <a data-bs-toggle="modal" data-bs-target="#modalBuscador" class="btn btn-primary" type="button"
                        style="width: 245px;background: var(--bs-pink);font-size: 20px;border-color: var(--bs-pink);">Añadir
                        película</a>
                </div>
                <div class="col" style="margin-top: 15px;">
                    <a href="#" class="btn btn-primary" type="button"
                        style="width: 245px;background: var(--bs-pink);font-size: 20px;border-color: var(--bs-pink);">Quitar
                        película</a>
                </div>
                <div class="col" style="margin-top: 15px;">
                    <a href="#" class="btn btn-primary" type="button"
                        style="width: 245px;background: var(--bs-pink);font-size: 20px;border-color: var(--bs-pink);">Editar
                        Lista</a>
                </div>
                <div class="col" style="margin-top: 15px;">
                    <a href="#" class="btn btn-primary" type="button"
                        style="width: 245px;background: var(--bs-white);border-color: var(--bs-red);color: var(--bs-red);font-size: 20px;">Borrar
                        Lista</a>
                </div>
            </div>
            @if ($peliculas->count()!=0)
            @foreach ($peliculas as $pelicula)
            <!-- Cards de las películas -->
            @include('templates.card_pelicula')
            @endforeach
            <div class="d-flex justify-content-center" style="margin-top: 30px;">
                {!! $peliculas->appends($_GET)->links() !!}
            </div>
            @else
            <div style="margin-top: 34px;">
                <h3>Aún no has añadido ninguna película a esta lista</h3>
            </div>
            @endif
        </div>
    </div>
    <div class="modal fade" id="modalBuscador" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Añadir película</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="#" method="post">
                        {{ csrf_field() }}
                        <div class="row form-group mb-3">
                            <div class="col-sm-20 input-column"><input class="search form-control p-3" type="text"
                                    placeholder="Buscar..." name="nombre" required>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <input class="btn btn-light submit-button" type="submit" value="Añadir"
                                    style="background: var(--bs-pink);border-color: var(--bs-pink);color: #FFFFFF;" />
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="{{asset('js/jquery-ui.min.js')}}"></script>
    <script>
        var pelis = ['hola', 'adios'];

        $('#search').autocomplete({
            source: pelis;
        });
    </script>
</body>

</html>
