<div class="modal fade" id="editarUsuario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar perfil de usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('editar.perfil', $usuario->id)}}" method="post">
                    {{ csrf_field() }}
                    <div class="row form-group mb-3">
                        <div class="col-sm-20 input-column"><input class="form-control" type="text"
                                placeholder="Nombre" value = "{{$usuario->nombre}}" name="nombre" required></div>
                    </div>
                    <div class="row form-group mb-3">
                        <div class="col-sm-20 input-column">
                            <div class="col-sm-20 input-column"><input class="form-control" type="password"
                                placeholder="Nueva contraseña" name="password" required></div>
                        </div>
                    </div>
                    <div class="row form-group mb-3">
                        <div class="col-sm-20 input-column">
                            <div class="col-sm-20 input-column"><input class="form-control" type="password"
                                placeholder="Repetir contraseña" name="password2" required></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <input class="btn btn-light submit-button" type="submit" value="Confirmar"
                            style="background: var(--bs-pink);border-color: var(--bs-pink);color: #FFFFFF;" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
