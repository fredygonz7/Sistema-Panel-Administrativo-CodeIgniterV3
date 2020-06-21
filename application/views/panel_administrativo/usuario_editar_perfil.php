<div class=" d-flex justify-content-center">
    <div class="row" id="div-registrar">
        <div class="">
            <div class="text-center">
                <h1>Editar perfil</h1>
            </div>
            <form method="post" action="<?= base_url() ?>index.php/Welcome/editarPerfil" id="formulario-editar">
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
                <!-- <div class="form-group">
					<label for="avatar">Example file input</label>
					<input type="file" class="form-control-file" id="avatar" accept="image/*" name="avatar">
				</div> -->
                <button type="submit" class="btn btn-primary">Aceptar</button>
            </form>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#formulario-editar').on('submit', function(e) { //evento submit
                e.preventDefault(); //para que no se abra el archivo php
                $.ajax({ //ajax jQuery
                    type: this.method, //metodo para enviar datos al servidor
                    url: this.action, //url del servidor "archivo php"
                    //contentType : "text/x-json",//prueba para enviarlo como json
                    data: $(this).serialize(), //enviando los datos del "formulario" al servidor
                    success: function(respuesta) { //recibiendo la respuesta del servidor, en caso de que todo este bien
                        // let objeto = JSON.parse(respuesta); //convirtiendo el JSON recibido a objeto JavaScript 
                        console.log(respuesta);
                        if (typeof respuesta === 'string') {
                            let objetoRespuesta = JSON.parse(respuesta);
                            if (objetoRespuesta.status) {
                                console.log(objetoRespuesta.message);
                                document.getElementById("formulario-editar").reset();
                            } else
                                alert(objetoRespuesta.message)
                        } else
                            console.log("Error inesperado");
                    }
                });
            });
        });
    </script>
</div>