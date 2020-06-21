<div class="container">
    <div class="row">
        <div class="col">
            <div class="row">
                <img src="" class="img-fluid" alt="Responsive image">
            </div>
            <div class="row">
                <div class="form-row">
                    <form method="post" action="<?= base_url() ?>index.php/Panel_Administrativo/descargarPefilt" id="formulario-registrar">
                        <div class="col">
                            <button type="submit" class="btn btn-primary">Descargar mi perfil en PDF</button>
                        </div>
                    </form>
                    <form method="post" action="<?= base_url() ?>index.php/Panel_Administrativo/enviarPefilt" id="formulario-registrar">
                        <div class="col">
                            <button type="submit" class="btn btn-primary">Enviar mi perfil a mi correo</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-9">
            <div class="row">
                <div class="col-6">
                    <div class="text-center">
                        <h3><?= $this->session->sesion_sistema_administrativo['nombres'] ?> <?= $this->session->sesion_sistema_administrativo['apellidos']; ?></h3>
                        <h4><?= $this->session->sesion_sistema_administrativo['email']; ?></h4>
                    </div>
                </div>
                <div class="col">
                    <!-- <form method="post" action="< ?= base_url() ?>index.php/Panel_Administrativo/cerrarSesion" id="formulario-registrar"> -->
                    <button type="button" class="btn btn-primary" onclick="cerrarSesion()">Cerrar Sesion</button>
                    <!-- Button editar perfil modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editarPerfilModal">
                        Editar Perfil
                    </button>
                    <button type="button" class="btn btn-primary" id="administrarUsuarios" onclick="administrarUsuarios()" style="display:none">Administrar Usuarios</button>
                    <!-- </form> -->
                </div>
            </div>
            <div class="row">
                <form method="post" action="<?= base_url() ?>index.php/Panel_Administrativo/editarIntereses" id="formulario-registrar">
                    <div class="col">
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="gastronomia" name="gastronomia">
                                <label class="form-check-label" for="gastronomia">
                                    Gastronomia
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="desarrollo_movil" name="desarrollo_movil">
                                <label class="form-check-label" for="desarrollo_movil">
                                    Desarrollo movil
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="esoterismo" name="esoterismo">
                                <label class="form-check-label" for="esoterismo">
                                    Esoterismo
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="deportes" name="deportes">
                                <label class="form-check-label" for="deportes">
                                    Deportes
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="politica" name="politica">
                                <label class="form-check-label" for="politica">
                                    Politica
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="hogar_y_moda" name="hogar_y_moda">
                                <label class="form-check-label" for="hogar_y_moda">
                                    Hogar y moda
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="desarrolo_web" name="desarrolo_web">
                                <label class="form-check-label" for="desarrolo_web">
                                    Desarrolo web
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="cine" name="cine">
                                <label class="form-check-label" for="cine">
                                    Cine
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="psicologia" name="psicologia">
                                <label class="form-check-label" for="psicologia">
                                    Psicologia
                                </label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="editarPerfilModal" tabindex="-1" role="dialog" aria-labelledby="editarPefilModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editarPefilModalLabel">Editar Perfil</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form method="post" action="<?= base_url() ?>index.php/Panel_Administrativo/editarPerfil" id="formulario-editar-perfil">

                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nombres">Nombres</label>
                            <input type="text" class="form-control" id="nombres" aria-describedby="emailHelp" name="nombres">
                        </div>
                        <div class="form-group">
                            <label for="apellidos">Apellidos</label>
                            <input type="text" class="form-control" id="apellidos" aria-describedby="emailHelp" name="apellidos">
                        </div>
                        <div class="form-group">
                            <label for="password">Contraseña</label>
                            <input type="password" class="form-control" id="passwordRegistrar" name="password">
                        </div>
                        <div class="form-group">
                            <label for="passwordConfirm">Confirmar contraseña</label>
                            <input type="password" class="form-control" id="passwordConfirmRegistrar" name="passwordConfirm">
                        </div>
                        <div class="form-group">
                            <label for="avatar">Example file input</label>
                            <input type="file" class="form-control-file" id="avatar" accept="image/*" name="avatar">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function cerrarSesion() {
        $(document).ready(function() {
            $.ajax({ //ajax jQuery
                type: "get",
                url: '<?= base_url() ?>index.php/Panel_Administrativo/cerrarSesion',
                data: "",
                success: function(respuesta) {
                    // console.log("respuesta", respuesta);

                    if (typeof respuesta === 'string') {
                        let objetoRespuesta = JSON.parse(respuesta);
                        if (objetoRespuesta.status) {
                            // console.log(objetoRespuesta.message);
                            setTimeout("location.href='<?= base_url() ?>'", 1000);
                        } else
                            alert(objetoRespuesta.message)
                    } else
                        console.log("Error inesperado");
                }
            });
        });
    }

    if ("<?= $this->session->sesion_sistema_administrativo['perfil']; ?>" == "admin")
        document.getElementById("administrarUsuarios").style.display = "block";
    else
        document.getElementById("administrarUsuarios").style.display = "none";


    $(document).ready(function() {
        $('#formulario-editar-perfil').on('submit', function(e) {
            e.preventDefault();
            $.ajax({ //ajax jQuery
                type: this.method,
                url: this.action,
                data: $(this).serialize(),
                success: function(respuesta) {
                    // console.log(respuesta);
                    if (typeof respuesta === 'string') {
                        let objetoRespuesta = JSON.parse(respuesta);
                        if (objetoRespuesta.status) {
                            console.log(objetoRespuesta.message);
                            document.getElementById("formulario-editar-perfil").reset();
                            $('#editarPerfilModal').modal('hide');
                        } else
                            alert(objetoRespuesta.message)
                    } else
                        console.log("Error inesperado");
                }
            });
        });
    });
</script>