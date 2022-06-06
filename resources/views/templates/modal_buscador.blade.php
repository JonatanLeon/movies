<div class="modal fade" id="modalBuscador" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Añadir película</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body ui-front">
                <form action='/pelicula/guardarlista/' method="post" class="busquedaPeli">
                    {{ csrf_field() }}
                    <div class="row form-group mb-3">
                        <div class="col-sm-20 input-column"><input id="auto" class="search form-control p-3"
                                type="text" placeholder="Buscar..." name="pelicula" required>
                                <input value={{ $lista->id }} name="idLista" hidden="true">
                        </div>
                        <div class="modal-footer" style="margin-top: 25px;">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <input class="btn btn-light submit-button" type="submit" value="Añadir"
                                name="insertarEnLista" style="background: var(--bs-pink);border-color: var(--bs-pink);color: #FFFFFF;" />
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>
