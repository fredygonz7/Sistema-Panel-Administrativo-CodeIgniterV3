<div class="d-flex justify-content-center">
	<div class="row" id="div-registrar">
		<div class="">
			<div class="text-center">
				<h1>Registrate</h1>
			</div>
			<div>
				<h3>¿Ya estas registrado? <a href="#" onclick="mostrarInicioSesion()">¡Inicia sesion!</a></h3>
			</div>
			<form method="post" action="<?= base_url() ?>index.php/Welcome/registrar" id="formulario-registrar">
				<div class="form-group">
					<label for="nombres">Nombres</label>
					<input type="text" class="form-control" id="nombres" aria-describedby="emailHelp" name="nombres">
				</div>
				<div class="form-group">
					<label for="apellidos">Apellidos</label>
					<input type="text" class="form-control" id="apellidos" aria-describedby="emailHelp" name="apellidos">
				</div>
				<div class="form-group">
					<label for="email">Email</label>
					<input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email">
				</div>
				<div class="form-group">
					<label for="password">Contraseña</label>
					<input type="password" class="form-control" id="passwordRegistrar" name="password">
				</div>
				<div class="form-group">
					<label for="passwordConfirm">Confirmar contraseña</label>
					<input type="password" class="form-control" id="passwordConfirmRegistrar" name="passwordConfirm">
				</div>
				<!-- <div class="form-group form-check">
					<div class="g-recaptcha" data-sitekey="6LfTjqcZAAAAAGoiy59gcEWg6Nk5XF_wwk1b9XI6"></div>
				</div> -->
				<button type="submit" class="btn btn-primary">Registrarme</button>
			</form>
		</div>
	</div>

	<div class="row" id="div-correo-enviado" style="display: none">
		<div class=" text-center">
			<div class="">
				<h1>Registrate</h1>
			</div>
			<div>
				<h4>Su cuenta ha sigo crada exitosamente</h4>
				<h4>Hemos enviado un mensaje a su correo electronico para validar su cuenta.</h4>
				<h4>Haga clic en el vinculo enviado a su email para activar su cuenta.</h4>
			</div>
			<button type="button" class="btn btn-primary" onclick="mostrarRegistrar()">Iniciar sesion</button>
		</div>
	</div>

	<div class=" row" id="div-sesion" style="display: none;">
		<div class="">
			<div class="text-center">
				<h1>Inicia sesion</h1>
			</div>
			<div>
				<h3>¿No tienes una cuenta? <a href="#" onclick="mostrarRegistrar()">¡Registrate!</a></h3>
			</div>
			<form method="post" action="<?= base_url() ?>index.php/Welcome/login" id="formulario-sesion">
				<div class="form-group">
					<label for="email">Email</label>
					<input type="email" class="form-control" id="emailLogin" aria-describedby="emailHelp" name="email">
				</div>
				<div class="form-group">
					<label for="password">Contraseña</label>
					<input type="password" class="form-control" id="passwordLogin" name="password">
				</div>
				<div class="form-group form-check">
					<input type="checkbox" class="form-check-input" id="checkLogin">
					<label class="form-check-label" for="checkLogin">Check me out</label>
				</div>
				<div class="form-row">
					<div class="col">
						<button type="submit" class="btn btn-primary">Iniciar sesion</button>
					</div>
					<div class="col">
						<button type="button" class="btn btn-primary">Recuperar cuenta</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	<script>
		$(document).ready(function() {
			$('#formulario-registrar').on('submit', function(e) { //evento submit
				e.preventDefault(); //para que no se abra el archivo php
				if (document.getElementById("passwordRegistrar").value === document.getElementById("passwordConfirmRegistrar").value) {
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
									document.getElementById("formulario-registrar").reset();
								} else
									alert(objetoRespuesta.message)
							} else
								console.log("Error inesperado");
						}
					});
				}else{
					alert("las contraseñas no coinciden")
				}
			});
		});

		/**
		 * Funcion encargada de moestrar el formulario de inicio de sesion y ocultar los demas
		 *
		 * @return void
		 */
		function mostrarInicioSesion() {
			document.getElementById("div-registrar").style.display = "none";
			document.getElementById("div-sesion").style.display = "block";
			document.getElementById("formulario-registrar").reset();
			document.getElementById("formulario-sesion").reset();
		}

		$(document).ready(function() {
			$('#formulario-sesion').on('submit', function(e) { //evento submit
				e.preventDefault();
				$.ajax({ //ajax jQuery
					type: this.method, //metodo para enviar datos al servidor
					url: this.action, //url del servidor "archivo php"
					//contentType : "text/x-json",//prueba para enviarlo como json
					data: $(this).serialize(), //enviando los datos del "formulario" al servidor
					success: function(respuesta) { //recibiendo la respuesta del servidor, en caso de que todo este bien
						//var objeto = JSON.parse(respuesta); //convirtiendo el JSON recibido a objeto JavaScript 
						if (typeof respuesta === 'string') {
							let objetoRespuesta = JSON.parse(respuesta);
							if (objetoRespuesta.status) {
								console.log(objetoRespuesta.message);
								document.getElementById("formulario-sesion").reset();
								location.href = '<?= base_url() ?>index.php/Panel_Administrativo/';
								// setTimeout("location.href='< ?= base_url() ?>index.php/Panel_Administrativo/'", 1000);
							} else
								alert(objetoRespuesta.message)
						} else
							console.log("Error inesperado");
					}
				});
			});
		});

		/**
		 * Funcion encargada de mostrar el formulario de registrar y ocultar los otros
		 *
		 * @return void
		 */
		function mostrarRegistrar() {
			document.getElementById("div-sesion").style.display = "none";
			document.getElementById("div-registrar").style.display = "block";
			document.getElementById("div-correo-enviado").style.display = "none";
			document.getElementById("formulario-registrar").reset();
			document.getElementById("formulario-sesion").reset();
		}
	</script>
</div>