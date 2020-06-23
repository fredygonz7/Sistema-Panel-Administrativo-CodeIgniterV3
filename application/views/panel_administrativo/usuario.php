<!-- informacion del usuario logueado -->
<div class="row" id="div-perfil-usuario">

    <div class="col-sm-4 col-md-4">
        <div class="row justify-content-center pt-2">
            <img class="img-fluid" alt="Sin avatar" src="<?= $this->session->sesion_sistema_administrativo['avatar']; ?>">
        </div>
        <div class="row justify-content-center p-2 pb-4">
            <!-- <div class=" form-row"> -->
            <!-- <form method="post" action="<?= base_url() ?>index.php/Panel_Administrativo/descargarPefilt" id="formulario-descargarPefilt"> -->
            <div class="p-1">
                <button type="submit" class="btn btn-outline-secondary">Descargar mi perfil en PDF</button>
            </div>
            <!-- </form> -->
            <!-- <form method="post" action="<?= base_url() ?>index.php/Panel_Administrativo/enviarPefilt" id="formulario-enviarPefilt"> -->
            <div class="p-1">
                <button type="submit" class="btn btn-outline-secondary">Enviar mi perfil a mi correo</button>
            </div>
            <!-- </form> -->
            <!-- </div> -->
        </div>
    </div>
    <div class="col-sm-8 col-md-8 pt-2">
        <div class="row">
            <div class="col">
                <div class="text-center">
                    <h3><?= $this->session->sesion_sistema_administrativo['nombres'] ?> <?= $this->session->sesion_sistema_administrativo['apellidos']; ?></h3>
                    <h4><?= $this->session->sesion_sistema_administrativo['email']; ?></h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <h4>Intereses</h4>
            </div>
        </div>
        <div class="row">
            <!-- <form method="post" action="<?= base_url() ?>index.php/Panel_Administrativo/editarIntereses" id="formulario-registrar"> -->

            <div class="col">
                <form method="post" action="<?= base_url() ?>index.php/Panel_Administrativo/editarIntereses" id="formulario-intereses" onchange="editarIntereses()">

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="gastronomia" name="gastronomia">
                                    <label class="form-check-label" for="gastronomia">
                                        Gastronomia
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
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="desarrollo_movil" name="desarrollo_movil">
                                    <label class="form-check-label" for="desarrollo_movil">
                                        Desarrollo movil
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="politica" name="politica">
                                    <label class="form-check-label" for="politica">
                                        Politica
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="cine" name="cine">
                                    <label class="form-check-label" for="cine">
                                        Cine
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
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
                                    <input class="form-check-input" type="checkbox" id="psicologia" name="psicologia">
                                    <label class="form-check-label" for="psicologia">
                                        Psicologia
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal editar usuario logeado -->
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

<!-- Modal editar usuario accion del admin -->
<div class="modal fade" id="editarUsuarioModal" tabindex="-1" role="dialog" aria-labelledby="editarUsuarioModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editarUsuarioModalLabel">Editar Perfil</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="post" id="formulario-editar-usuario">

                <div class="modal-body">
                    <div class="form-group">
                        <label for="nombres">Nombres</label>
                        <input type="text" class="form-control" id="nombresEditarUsuario" name="nombres">
                    </div>
                    <div class="form-group">
                        <label for="apellidos">Apellidos</label>
                        <input type="text" class="form-control" id="apellidosEditarUsuario" name="apellidos">
                    </div>
                    <div class="form-group">
                        <label for="email">Correo</label>
                        <input type="text" class="form-control" id="emailEditarUsuario" aria-describedby="emailHelp" name="email">
                    </div>
                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <input type="password" class="form-control" id="passwordEditarUsuario" name="password">
                    </div>
                    <div class="form-group">
                        <label for="passwordConfirm">Confirmar contraseña</label>
                        <input type="password" class="form-control" id="passwordConfirmEditarUsuario" name="passwordConfirm">
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="activoEditarUsuario" name="activo">
                        <label class="form-check-label" for="activo">Activo</label>
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="perfilEditarUsuario" name="perfil">
                            <label class="form-check-label" for="perfil">Es administrador</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="btn-editar-usuario">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- tabla administrar usuarios -->
<div id="div-administrar-usuario" style="display: none;">
    <div class="row">
        <div class="col-12 p-2">
            <div>
                <h3>Administrar Usuarios</h3>
            </div>
            <div class="d-flex flex-row-reverse">
                <button type="button" class="btn btn-outline-secondary" onclick="crearUsuario_Admin()">Nuevo</button>
            </div>
        </div>
    </div>
    <div class="row">
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
</div>

<!-- inicio de script -->
<script>
    // verificar que perfil de usuario esta logeado
    if ("<?= $this->session->sesion_sistema_administrativo['perfil']; ?>" == "admin")
        document.getElementById("administrarUsuarios").style.display = "block";
    else
        document.getElementById("administrarUsuarios").style.display = "none";

    /**
     * actualizar los intereres, checked
     */
    let respuesInteresesUsuario = <?= $intereses_usuario; ?>;
    if (typeof respuesInteresesUsuario === 'object') {
        let arrayNombreInteres = ["gastronomia", "deportes", "desarrolo_web", "desarrollo_movil", "politica", "cine",
            "esoterismo", "hogar_y_moda", "psicologia"
        ];

        for (let index = 0; index < arrayNombreInteres.length; index++) {
            if (respuesInteresesUsuario.data[arrayNombreInteres[index]] == "true")
                document.getElementById(arrayNombreInteres[index]).checked = true;
            else
                document.getElementById(arrayNombreInteres[index]).checked = false;
        }
        console.
        log(respuesInteresesUsuario.data);
    }
    // console.log(respuesInteresesUsuario);
    /**
     * cierra la sesion
     *
     * @return void
     */

    function cerrarSesion() {
        if (confirm("Cerrar sesion ")) {
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
    }

    // avatarCode - almacena la imagen en formato texto base64
    var avatarCode = "";

    /**
     * #formulario-editar-perfil
     * edita el perfil del usuario actual
     */
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

    /**
     * Codifica la imagen a texto base64
     * 
     * @param string id
     * @return void
     */
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
     * muestra en formurario de editar datos del usuario
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
     * 
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
                            mostrarDatosDeAdministrarUsuarios(objetoRespuesta.data);
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

    /**
     * muestra la interfaz de administrar usuarios 
     * la tabla con los usuarios registrados, menos el usuario logeado 
     *
     * @return void
     */
    function mostrarDatosDeAdministrarUsuarios(objetoUsuarios) {
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
                    usuario.appendChild(document.createTextNode(objetoUsuarios[i].nombres + " " + objetoUsuarios[i].apellidos));
                    fila.appendChild(usuario);

                    // activo
                    let activo = document.createElement("td");
                    let inputActivo = document.createElement("input");
                    inputActivo.type = "radio"
                    if (objetoUsuarios[i].activo == "true")
                        inputActivo.checked = true;
                    else
                        inputActivo.setAttribute("disabled", "");
                    activo.appendChild(inputActivo);
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

    /**
     * envia informacion de perfil a un usuario por correo
     *
     * @return void
     */
    function enviarEmailUsuario(datos) {
        console.log("enviarEmailUsuario", datos);
    }

    /**
     * prepara modal para editar usuario
     *
     * @return void
     */
    function editarUsuario_Admin(datos) {
        console.log("editarUsuario_Admin", datos);
        let formulario = document.getElementById("formulario-editar-usuario");
        formulario.reset();
        document.getElementById("editarUsuarioModalLabel").innerHTML = "Editar Usuario";
        // document.getElementById("editarUsuarioModalLabel").dataset.activo = datos.activo;
        formulario.action = "<?= base_url() ?>index.php/Panel_Administrativo/editarUsuario"
        document.getElementById("nombresEditarUsuario").value = datos.nombres;
        document.getElementById("apellidosEditarUsuario").value = datos.apellidos;
        document.getElementById("emailEditarUsuario").value = datos.email;
        document.getElementById("activoEditarUsuario").checked = (datos.activo == "true" ? true : false)
        document.getElementById("perfilEditarUsuario").checked = (datos.perfil == "true" ? true : false)
        document.getElementById("activoEditarUsuario").parentElement.style.display = "block";
        document.getElementById("perfilEditarUsuario").parentElement.style.display = "block";
        document.getElementById("btn-editar-usuario").innerText = "Guardar Cambios";

        $('#editarUsuarioModal').modal('show');
    }

    /**
     * prepara modal para crear usuario
     *
     * @return void
     */
    function crearUsuario_Admin() {
        console.log("crearUsuario_Admin");
        let formulario = document.getElementById("formulario-editar-usuario");
        formulario.reset();
        document.getElementById("editarUsuarioModalLabel").innerHTML = "Crear Usuario";
        // document.getElementById("editarUsuarioModalLabel").dataset.activo = 'true';
        formulario.action = "<?= base_url() ?>index.php/Panel_Administrativo/crearUsuario";
        document.getElementById("activoEditarUsuario").checked = true;
        document.getElementById("perfilEditarUsuario").checked = false;
        document.getElementById("activoEditarUsuario").parentElement.style.display = "none";
        document.getElementById("perfilEditarUsuario").parentElement.style.display = "none";
        document.getElementById("btn-editar-usuario").innerText = "Crear Usuario";

        $('#editarUsuarioModal').modal('show');
    }

    /**
     * #formulario-editar-usuario
     * edita o crea un usuario
     * accion que realiza un admin
     */
    $(document).ready(function() {
        $('#formulario-editar-usuario').on('submit', function(e) {
            e.preventDefault();
            console.log("formulario-editar-usuario");

            let password = "";
            if ((document.getElementById("passwordEditarUsuario").value) != (document.getElementById("passwordConfirmEditarUsuario").value)) {
                alert("Las contraseñas no coinciden");
            } else {
                if (document.getElementById("passwordEditarUsuario").value == "" || document.getElementById("passwordConfirmEditarUsuario").value == "") {
                    password = "";
                } else if (document.getElementById("passwordEditarUsuario").value === document.getElementById("passwordConfirmEditarUsuario").value) {
                    password = document.getElementById("passwordEditarUsuario").value;
                } else {
                    password = "";
                }

                data = {
                    nombres: document.getElementById("nombresEditarUsuario").value,
                    apellidos: document.getElementById("apellidosEditarUsuario").value,
                    email: document.getElementById("emailEditarUsuario").value,
                    password,
                    // activo: document.getElementById("editarUsuarioModalLabel").getAttribute("data-activo")
                    activo: (document.getElementById("activoEditarUsuario").checked ? "true" : "false"),
                    perfil: (document.getElementById("perfilEditarUsuario").checked ? "admin" : "usuario")
                    // ,accion: document.getElementById("editarUsuarioModalLabel").innerHTML
                };
                console.log(data);

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
                                document.getElementById("formulario-editar-usuario").reset();
                                $('#editarUsuarioModal').modal('hide');
                                administrarUsuarios();
                            } else
                                alert(objetoRespuesta.message)
                        } else
                            console.log("Error inesperado");
                    }
                });
            }
        });
    });

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


    /**
     * #formulario-editar-usuario
     * edita o crea un usuario
     * accion que realiza un admin
     */
    // $(document).ready(function() {
    //     $('#formulario-intereses').on('submit', function(e) {
    //         e.preventDefault();
    function editarIntereses() {
        // console.log("formulario-editar-intereses");
        let arrayNombreInteres = ["gastronomia", "deportes", "desarrolo_web", "desarrollo_movil", "politica", "cine",
            "esoterismo", "hogar_y_moda", "psicologia"
        ];

        let contadorIntereses = 0;

        let objetoIntereses = {}

        for (let index = 0; index < arrayNombreInteres.length; index++) {
            if (document.getElementById(arrayNombreInteres[index]).checked) {
                objetoIntereses[arrayNombreInteres[index]] = "true";
                contadorIntereses++;
            } else
                objetoIntereses[arrayNombreInteres[index]] = "false";
        }
        // console.log("objetoIntereses", objetoIntereses);
        if (contadorIntereses > 4) {
            window.location = '<?= base_url() ?>index.php/Panel_Administrativo/';
        } else {
            objetoIntereses["email"] = "<?= $this->session->sesion_sistema_administrativo['email']; ?>";
            // console.log("objetoIntereses", objetoIntereses);
            $.ajax({ //ajax jQuery
                type: "post",
                url: "<?= base_url() ?>index.php/Panel_Administrativo/editarIntereses",
                data: objetoIntereses,
                success: function(respuesta) {
                    if (typeof respuesta === 'string') {
                        let objetoRespuesta = JSON.parse(respuesta);
                        if (objetoRespuesta.status) {
                            console.log(objetoRespuesta.message);
                        } else {
                            alert(objetoRespuesta.message);
                            // window.location = '<?= base_url() ?>index.php/Panel_Administrativo/';
                        }
                    } else
                        console.log("Error inesperado");
                }
            });
        }
    }

    /****************************************** */
    // administrarUsuarios();
</script>
<!-- <!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <style type="text/css">
        body {
            font-family: Helvetica Neue, Helvetica, Lucida Grande, tahoma, verdana, arialsans-serif;
            font-size: 16px;
            line-height: 21px;
            color: #141823;
        }
    </style>
</head>
<body>
    <p>Hola</p>
    <p>Para activar la cuenta ingrese al siguiente link</p>
    <a href="https://sistema-panel-administrativo.test/index.php/Panel_Administrativo/activarUsuario?email=fredy@gmail">https://sistema-panel-administrativo.test</a>
    <p style="margin-top: 15px";>Despues podra inicias sesion</p>
</body>
</html> -->