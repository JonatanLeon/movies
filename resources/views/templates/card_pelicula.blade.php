<a href="{{route('pelicula_seleccionada', $pelicula->id)}}">
    <div class="container">
        <div class="card border rounded-circle" style="margin-top: 34px;box-shadow: 0px 0px;">
            <div class="card-body border rounded"
                style="background: #ffffff;box-shadow: 5px 5px 5px rgba(33,37,41,0.5);">
                <div class="row">
                    <div class="col-md-4 col-lg-3 col-xl-2 col-xxl-1" id="columna-1">
                        <img class="img-fluid d-xl-flex align-items-xl-start"
                            src="data:image/png;base64,{{ chunk_split(base64_encode($pelicula->poster)) }}">
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
