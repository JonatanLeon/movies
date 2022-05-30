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
    <style>
        a, a:hover, a:focus, a:active {
        text-decoration: none;
        color: inherit;
        cursor: pointer;
        }
        </style>
</head>

<body>
    @include('templates.navbar')
    <div class="container py-4 py-xl-5">
        <div class="row mb-5">
            <div class="col-md-8 col-xl-3 text-center mx-auto">
                <h2>Perfil de {{$usuario->nombre}}</h2>
                <div class="container-fluid" style="margin-bottom: 14px;margin-top: 14px;">
                    <a href="/login" class="btn btn-primary" type="button" style="width: 245px;background: var(--bs-pink);font-size: 20px;border-color: var(--bs-pink);">Editar perfil</a>
                </div>
                <div class="container-fluid">
                    <h4 style="color: var(--bs-red);">Desactivar cuenta</h4>
                </div>
            </div>
            <div class="col">
                <ul class="nav nav-tabs">
                    <li class="nav-item"><a class="nav-link active" href="#">Reseñas</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Listas</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Calendario</a></li>
                </ul>
                @if ($criticas->count()!=0)
                @foreach ($criticas as $critica)
                <a data-bs-toggle="modal" data-bs-target="#criticaModal">
                <div class="container" data-bs-toggle="modal" data-bs-target="#criticaModal">
                    <div class="card border rounded-circle" style="margin-top: 34px;box-shadow: 0px 0px;">
                        <div class="card-body border rounded" style="background: #ffffff;box-shadow: 5px 5px 5px rgba(33,37,41,0.5);">
                            <div class="row">
                                <div class="col">
                                    <div>
                                        <h4>{{$critica->titulo}}</h4>
                                        <h6 class="text-muted mb-2">Película: {{$critica->nombre_pelicula}}</h6>
                                        <h6>Nota: {{$critica->puntuacion}}/5</h6>
                                        <p>{{$critica->texto}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </a>
        <!-- Modal -->
      <div class="modal fade" id="criticaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">¿Qué quieres hacer?</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" style="background: var(--bs-pink);border-color: var(--bs-pink);color: #FFFFFF;" data-bs-toggle="modal" data-bs-target="#modificarCritica" data-bs-dismiss="modal">Editar reseña</button>
                <button type="button" class="btn btn-primary" style="background: var(--bs-white);border-color: var(--bs-red);color: var(--bs-red);" data-bs-toggle="modal" data-bs-target="#confirmacionBorrar" data-bs-dismiss="modal">Borrar reseña</button>
            </div>
          </div>
        </div>
      </div>
      <!-- Confirmación Borrar -->
      <div class="modal fade" id="confirmacionBorrar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">¿Seguro que quieres borrarla?</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" style="background: var(--bs-pink);border-color: var(--bs-pink);color: #FFFFFF;" data-bs-dismiss="modal">No</button>
                <a href="{{route('borrar_critica', $critica->id)}}" type="button" class="btn btn-primary" style="background: var(--bs-white);border-color: var(--bs-red);color: var(--bs-red);">Sí</a>
            </div>
          </div>
        </div>
      </div>
        <!-- Modificar critica -->
  <div class="modal fade" id="modificarCritica" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modifica la reseña de {{$critica->nombre_pelicula}}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{route('publicar.critica', $critica->id_pelicula)}}" method="post">
            {{ csrf_field() }}
            <div class="row form-group mb-3">
                <div class="col-sm-20 input-column"><input class="form-control" type="text" value="{{$critica->titulo}}" placeholder="Título de la reseña" name="titulo" required></div>
            </div>
            <div class="row form-group mb-3">
                <div class="col-sm-20 input-column">
                    <textarea class="form-control" type="text" placeholder="Texto de la reseña" rows="6" name="texto" required>{{$critica->texto}}</textarea>
                </div>
            </div>
            <div class="row form-group mb-3">
                <div class="col-sm-2 label-column">
                    <label class="col-form-label">Puntuación:</label>
                </div>
                <div class="col-sm-2 input-column" id="divnota">
                    <select class="form-select" name="puntuacion" required>
                        <option value="" selected="selected" hidden="hidden">{{$critica->puntuacion}}</option>
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <input class="btn btn-light submit-button" type="submit" value="Publicar reseña" style="background: var(--bs-pink);border-color: var(--bs-pink);color: #FFFFFF;"/>
              </div>
          </form>
        </div>
      </div>
    </div>
  </div>
                @endforeach
                <div class="d-flex justify-content-center" style="margin-top: 30px;">
                    {!! $criticas->appends($_GET)->links() !!}
                </div>
                @else
                <div style="margin-top: 34px;">
                    <h3>Este usuario aún no ha publicado ninguna reseña</h3>
                </div>
                @endif
            </div>
        </div>
    </div>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>
