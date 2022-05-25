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
    @include('templates.navbar')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-xl-4 col-xxl-3" style="padding-left: 0px;"><img class="img-fluid" src="data:image/png;base64,{{ chunk_split(base64_encode($peliculaRecogida->poster)) }}" style="padding: 53px;padding-left: 23px;">
                    @auth
                    <div class="container-fluid" style="margin-bottom: 14px;"><button class="btn btn-primary" type="button" style="width: 245px;background: var(--bs-pink);font-size: 20px;border-color: var(--bs-pink);" data-bs-toggle="modal" data-bs-target="#exampleModal">Escribir Reseña</button></div>
                    @else
                    <div class="container-fluid" style="margin-bottom: 14px;"><a href="/login" class="btn btn-primary" type="button" style="width: 245px;background: var(--bs-pink);font-size: 20px;border-color: var(--bs-pink);">Escribir Reseña</a></div>
                    @endauth
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

  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Escribe una reseña de {{$peliculaRecogida->titulo}}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{route('publicar.critica', $peliculaRecogida->id)}}" method="post">
            {{ csrf_field() }}
            <div class="row form-group mb-3">
                <div class="col-sm-20 input-column"><input class="form-control" type="text" placeholder="Título de la reseña" name="titulo" required></div>
            </div>
            <div class="row form-group mb-3">
                <div class="col-sm-20 input-column">
                    <textarea class="form-control" type="text" placeholder="Texto de la reseña" rows="6" name="texto" required></textarea>
                </div>
            </div>
            <div class="row form-group mb-3">
                <div class="col-sm-2 label-column">
                    <label class="col-form-label">Puntuación:</label>
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
                <input class="btn btn-light submit-button" type="submit" value="Publicar reseña" style="background: var(--bs-pink);border-color: var(--bs-pink);color: #FFFFFF;"/>
              </div>
          </form>
        </div>
      </div>
    </div>
  </div>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>
<footer class="text-center bg-dark" style="margin-top: 92px; bottom: 0; width: 100%; height: 10%;">
    <div class="container text-white py-4 py-lg-5">
        <p class="text-muted mb-0">Copyright © 2022 Jonatan León Caparrós</p>
    </div>
</footer>
</html>
