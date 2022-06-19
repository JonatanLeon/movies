<div class="modal fade" id="editarPelicula" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Editar película
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/perfil/insertarpelicula/" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    {{ csrf_field() }}
                    <div class="row form-group mb-3">
                        <div class="col-sm-20 input-column"><input class="form-control" type="text" placeholder="Título"
                                value="{{ $peliculaRecogida->titulo }}" name="titulo" required></div>
                    </div>
                    <div class="row form-group mb-3">
                        <div class="col-sm-20 input-column">
                            <div class="col-sm-20 input-column"><input class="form-control" type="date"
                                    placeholder="Estreno" name="estreno" value="{{ $peliculaRecogida->estreno }}"
                                    required></div>
                        </div>
                    </div>
                    <div class="row form-group mb-3">
                        <div class="col-sm-20 input-column">
                            <div class="col-sm-20 input-column"><input class="form-control" type="text"
                                    placeholder="Director" name="director" value="{{ $peliculaRecogida->director }}"
                                    required></div>
                        </div>
                    </div>
                    <div class="row form-group mb-3">
                        <div class="col-sm-20 input-column">
                            <div class="col-sm-20 input-column"><input class="form-control" type="text"
                                    placeholder="Géneros" name="generos" value="{{ $peliculaRecogida->generos }}"
                                    required></div>
                        </div>
                    </div>
                    <div class="row form-group mb-3">
                        <div class="col-sm-20 input-column">
                            <div class="col-sm-20 input-column"><input class="form-control" type="number"
                                    placeholder="Duración" name="duracion" value="{{ $peliculaRecogida->duracion }}"
                                    required></div>
                        </div>
                    </div>
                    <div class="row form-group mb-3">
                        <div class="col-sm-20 input-column">
                            <div class="col-sm-20 input-column"><input class="form-control" type="text"
                                    placeholder="País" name="pais" value="{{ $peliculaRecogida->pais }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="row form-group mb-3">
                        <div class="col-sm-20 input-column">
                            <div class="col-sm-20 input-column"><input class="form-control" type="text"
                                    placeholder="Productora" value="{{ $peliculaRecogida->productora }}"
                                    name="productora" required>
                            </div>
                        </div>
                    </div>
                    <div class="row form-group mb-3">
                        <div class="col-sm-20 input-column">
                            <div class="col-sm-20 input-column"><input class="form-control" type="text"
                                    placeholder="Reparto" name="reparto" value="{{ $peliculaRecogida->reparto }}"
                                    required></div>
                        </div>
                    </div>
                    <div class="row form-group mb-3">
                        <div class="col-sm-20 input-column">
                            <div class="col-sm-20 input-column">
                                <textarea class="form-control" type="text" placeholder="Sinopsis" name="sinopsis" required>{{ $peliculaRecogida->sinopsis }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Subir poster de la
                            película:</label>
                        <input type="text" value="{{ $peliculaRecogida->id }}" name="id" hidden="true">
                        <input class="form-control" type="file" id="poster" name="poster"
                            value="data:image/png;base64,{{ chunk_split(base64_encode($peliculaRecogida->poster)) }}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <input name="editar" class="btn btn-light submit-button" type="submit" value="Confirmar"
                        style="background: var(--bs-pink);border-color: var(--bs-pink);color: #FFFFFF;" />
                </div>
            </form>
        </div>
    </div>
</div>
