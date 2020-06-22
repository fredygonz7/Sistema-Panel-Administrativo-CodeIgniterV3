<!-- <div class="container"> -->
<div class="row" id="div-perfil-usuario">

    <div class="col-sm-4 col-md-4">
        <div class="row justify-content-center">
            <img class="img-fluid" alt="Sin avatar" src="<?= $this->session->sesion_sistema_administrativo['avatar']; ?>">
        </div>
        <div class="row justify-content-center">
            <!-- <div class="form-row"> -->
            <form method="post" action="<?= base_url() ?>index.php/Panel_Administrativo/descargarPefilt" id="formulario-descargarPefilt">
                <div class="col">
                    <button type="submit" class="btn btn-primary">Descargar mi perfil en PDF</button>
                </div>
            </form>
            <form method="post" action="<?= base_url() ?>index.php/Panel_Administrativo/enviarPefilt" id="formulario-enviarPefilt">
                <div class="col">
                    <button type="submit" class="btn btn-primary">Enviar mi perfil a mi correo</button>
                </div>
            </form>
            <!-- </div> -->
        </div>
    </div>
    <div class="col-sm-8 col-md-8">
        <div class="row">
            <div class="col-9">
                <div class="text-center">
                    <h3><?= $this->session->sesion_sistema_administrativo['nombres'] ?> <?= $this->session->sesion_sistema_administrativo['apellidos']; ?></h3>
                    <h4><?= $this->session->sesion_sistema_administrativo['email']; ?></h4>
                </div>
            </div>
            <!-- <div class="col"> -->
            <!-- <form method="post" action="< ?= base_url() ?>index.php/Panel_Administrativo/cerrarSesion" id="formulario-registrar"> -->
            <!-- <button type="button" class="btn btn-primary" onclick="cerrarSesion()">Cerrar Sesion</button> -->
            <!-- Button editar perfil modal -->
            <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editarPerfilModal" onclick="mostrarDatosFormularioEditar()">
                        Editar Perfil
                    </button>
                    <button type="button" class="btn btn-primary" id="administrarUsuarios" onclick="administrarUsuarios()" style="display:none">Administrar Usuarios</button> -->
            <!-- </form> -->
            <!-- </div> -->
        </div>
        <div class="row">
            <!-- <form method="post" action="<?= base_url() ?>index.php/Panel_Administrativo/editarIntereses" id="formulario-registrar"> -->
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
            <!-- </form> -->
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
                        <input type="text" class="form-control" id="nombresEditarPerfil" aria-describedby="emailHelp" name="nombres">
                    </div>
                    <div class="form-group">
                        <label for="apellidos">Apellidos</label>
                        <input type="text" class="form-control" id="apellidosEditarPerfil" aria-describedby="emailHelp" name="apellidos">
                    </div>
                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <input type="password" class="form-control" id="passwordEditarPerfil" name="password">
                    </div>
                    <div class="form-group">
                        <label for="passwordConfirm">Confirmar contraseña</label>
                        <input type="password" class="form-control" id="passwordConfirmEditarPerfil" name="passwordConfirm">
                    </div>
                    <div class="form-group">
                        <label for="avatar">Avatar</label>
                        <input type="file" class="form-control-file" id="avatarEditarPerfil" accept="image/*" name="avatar" onchange="encodeImageFileAsURL('avatarEditarPerfil');">
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
<!-- </div> -->
<div id="div-administrar-usuario" style="display: none;">
    <table class="table table-striped">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Perfil</th>
                <th scope="col">Usuario</th>
                <th scope="col">Activo</th>
                <th scope="col">Email</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody id="tbody-administrar-usuario">
        </tbody>
    </table>
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

    // avatarCode - almacena la imagen en formato texto base64
    var avatarCode = "";
    $(document).ready(function() {
        $('#formulario-editar-perfil').on('submit', function(e) {
            e.preventDefault();
            let avatar;
            if (avatarCode == "") {
                avatar = "<?= $this->session->sesion_sistema_administrativo['avatar']; ?>";
            } else
                avatar = avatarCode;

            let password = "";
            if ((document.getElementById("passwordEditarPerfil").value) != (document.getElementById("passwordConfirmEditarPerfil").value)) {
                alert("Las contraseñas no coinciden");
            } else {
                if (document.getElementById("passwordEditarPerfil").value == "" || document.getElementById("passwordConfirmEditarPerfil").value == "") {
                    password = "";
                } else if (document.getElementById("passwordEditarPerfil").value === document.getElementById("passwordConfirmEditarPerfil").value) {
                    password = document.getElementById("passwordEditarPerfil").value;
                } else {
                    password = "";
                }

                data = {
                    nombres: document.getElementById("nombresEditarPerfil").value,
                    apellidos: document.getElementById("apellidosEditarPerfil").value,
                    email: "<?= $this->session->sesion_sistema_administrativo['email']; ?>",
                    password,
                    avatar
                };
                // console.log(data);

                $.ajax({ //ajax jQuery
                    type: this.method,
                    url: this.action,
                    data,
                    success: function(respuesta) {
                        // console.log(respuesta);
                        if (typeof respuesta === 'string') {
                            let objetoRespuesta = JSON.parse(respuesta);
                            if (objetoRespuesta.status) {
                                console.log(objetoRespuesta.message);
                                document.getElementById("formulario-editar-perfil").reset();
                                location.href = '<?= base_url() ?>index.php/Panel_Administrativo/';
                            } else
                                alert(objetoRespuesta.message)
                        } else
                            console.log("Error inesperado");
                    }
                });
            }
        });
    });

    function encodeImageFileAsURL(id) {
        // return "1";
        let filesSelected = document.getElementById(id).files;
        if (filesSelected.length > 0) {
            let fileToLoad = filesSelected[0];

            let fileReader = new FileReader();

            fileReader.onload = function(fileLoadedEvent) {
                srcData = fileLoadedEvent.target.result; // <--- data: base64
                avatarCode = srcData;
            }
            fileReader.readAsDataURL(fileToLoad);
        }
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    function mostrarDatosFormularioEditar() {
        document.getElementById("nombresEditarPerfil").value = "<?= $this->session->sesion_sistema_administrativo['nombres']; ?>";
        document.getElementById("apellidosEditarPerfil").value = "<?= $this->session->sesion_sistema_administrativo['apellidos']; ?>";
        // let avatar = "< ?= $this->session->sesion_sistema_administrativo['avatar']; ?>";
        // document.getElementById("avatarEditarPerfil").src = "";
    }

    /**
     * muestra la vista de administrar usuarios, con la tabla todos los usuarios 
     * div de aministrar usuario id= "div-administrar-usuario"
     * @return void
     */
    function administrarUsuarios() {
        $(document).ready(function() {
            $.ajax({
                type: "get",
                url: '<?= base_url() ?>index.php/Panel_Administrativo/obtenerUsuarios',
                data: "",
                success: function(respuesta) {
                    // console.log("respuesta", respuesta);
                    if (typeof respuesta === 'string') {
                        let objetoRespuesta = JSON.parse(respuesta);
                        if (objetoRespuesta.status) {
                            // console.log(objetoRespuesta.message);
                            mostrarDatosDeUsuarios(objetoRespuesta.data);
                            document.getElementById("div-perfil-usuario").style.display = "none";
                            document.getElementById("div-administrar-usuario").style.display = "block";
                            // setTimeout("location.href='< ?= base_url() ?>'", 1000);
                        } else
                            alert(objetoRespuesta.message)
                    } else
                        console.log("Error inesperado");
                }
            });
        });
    }


    function mostrarDatosDeUsuarios(objetoUsuarios) {
        // console.log(objetoUsuarios);
        if (typeof objetoUsuarios == 'object') {
            let tbody = document.getElementById("tbody-administrar-usuario");
            while (tbody.hasChildNodes()) {
                tbody.removeChild(tbody.firstChild);
            }
            for (let i = 0; i < objetoUsuarios.length; i++) {
                if ("<?= $this->session->sesion_sistema_administrativo['email']; ?>" != objetoUsuarios[i].email) {
                    let fila = document.createElement("tr");

                    let perfil = document.createElement("td");
                    perfil.appendChild(document.createTextNode(objetoUsuarios[i].perfil));
                    fila.appendChild(perfil);

                    let usuario = document.createElement("td");
                    usuario.appendChild(document.createTextNode(objetoUsuarios[i].nombres));
                    fila.appendChild(usuario);

                    // activo
                    let activo = document.createElement("td");
                    let checkbox = document.createElement("input");
                    checkbox.type = "radio"
                    if (objetoUsuarios[i].activo == "true")
                        checkbox.checked = true;
                    else
                        checkbox.setAttribute("disabled", "");
                    activo.appendChild(checkbox);
                    fila.appendChild(activo);

                    let email = document.createElement("td");
                    email.appendChild(document.createTextNode(objetoUsuarios[i].email));
                    fila.appendChild(email);

                    // inicio acciones ******************************
                    let acciones = document.createElement("td");

                    let enviarEmail = document.createElement("input");
                    enviarEmail.type = "button"
                    // a.href = '< ?= base_url() ?>index.php/producto/modificarProducto/?data=' + arrayData;
                    // a.href = '< ?= base_url() ?>index.php/producto/modificarProducto/?nombre=' + productos[i].nombre + '&precio=' + productos[i].precio;

                    // enviarEmail.appendChild(document.createTextNode("Enviar email"));
                    enviarEmail.value = "Enviar email";

                    // a.setAttribute("data-producto", productos[i].id);
                    enviarEmail.onclick = function() {
                        enviarEmailUsuario(objetoUsuarios[i])
                    };
                    // enviarEmail.className = "cursor_pointer";
                    acciones.appendChild(enviarEmail);

                    let editar = document.createElement("input");
                    editar.type = "button"
                    editar.value = "Editar";
                    editar.onclick = function() {
                        editarUsuario_Admin(objetoUsuarios[i])
                    };
                    acciones.appendChild(editar);

                    let elminar = document.createElement("input");
                    elminar.type = "button"
                    elminar.value = "Eliminar";
                    elminar.onclick = function() {
                        eliminarUsuario_Admin(objetoUsuarios[i])
                    };
                    acciones.appendChild(elminar);


                    fila.appendChild(acciones);
                    // fin acciones *******************************

                    // //agregar evento a la fila
                    // // fila.setAttribute("data-producto", productos[i].id);
                    // // fila.onclick = function() {
                    // //     eventoModificarProducto(this)
                    // // };
                    // // fila.className = "pointer";

                    tbody.appendChild(fila);
                }
            }
        }
    }


    function enviarEmailUsuario(datos) {
        console.log("enviarEmailUsuario", datos);

    }


    function editarUsuario_Admin(datos) {
        console.log("enviarEmailUsuario", datos);

    }
    
    /**
     * Eliminar un usuario,  la session del sistema
     *  
     * @param object datos
     * @return void
     */
    function eliminarUsuario_Admin(datos) {
        if (confirm("Eliminar usuario " + datos.email)) {
            data = {
                email: datos.email,
            };
            $.ajax({
                type: "post",
                url: '<?= base_url() ?>index.php/Panel_Administrativo/eliminarUsuario',
                data,
                success: function(respuesta) {
                    console.log(respuesta);
                    if (typeof respuesta === 'string') {
                        let objetoRespuesta = JSON.parse(respuesta);
                        if (objetoRespuesta.status) {
                            console.log(objetoRespuesta.message);
                            administrarUsuarios();
                        } else
                            alert(objetoRespuesta.message)
                    } else
                        console.log("Error inesperado");
                }
            });
        }
    }

    /****************************************** */
    // administrarUsuarios()
</script>