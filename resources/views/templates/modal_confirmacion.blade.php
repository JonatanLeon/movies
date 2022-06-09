    <!-- Confirmación Borrar -->
    <div class="modal fade" id="confirmacionDesactivar" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">¿Seguro que quieres desactivarla?
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        style="background: var(--bs-pink);border-color: var(--bs-pink);color: #FFFFFF;"
                        data-bs-dismiss="modal">No</button>
                    <a href="{{route('desactivar.cuenta', $usuario->id)}}" type="button" class="btn btn-primary"
                        style="background: var(--bs-white);border-color: var(--bs-red);color: var(--bs-red);">Sí</a>
                </div>
            </div>
        </div>
    </div>
