<div class="modal fade" id="modalSugerencia" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">¿Qué película nos sugieres añadir?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body ui-front">
                <form action="{{ route('enviar.sugerencia', auth()->user()->id )}}" method="post" class="busquedaPeli">
                    {{ csrf_field() }}
                    <div class="row form-group mb-3">
                        <div class="col-sm-20 input-column"><input class="search form-control p-3"
                                type="text" placeholder="Nombre de la película" name="pelicula" required>
                        </div>
                        <div class="modal-footer" style="margin-top: 25px;">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <input class="btn btn-light submit-button" type="submit" value="Enviar"
                                name="sugerencia"
                                style="background: var(--bs-pink);border-color: var(--bs-pink);color: #FFFFFF;" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
