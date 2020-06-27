<div class="d-flex justify-content-center">
	<!-- script de reCaptcha -->
	<script type="text/javascript">
		var verifyCallback = function(response) {
			return response;
		};
		var widgetIdSesion;
		var widgetIdRegistrar;
		var onloadCallback = function() {
			widgetIdRegistrar = grecaptcha.render('recaptchaRegistrar', {
				'sitekey': '6Lcg1KgZAAAAAIwICpYfTzAATyeRrBDcPisOOviT',
				'theme': 'light'
			});
			widgetIdSesion = grecaptcha.render('recaptchaSesion', {
				'sitekey': '6Lcg1KgZAAAAAIwICpYfTzAATyeRrBDcPisOOviT',
				'callback': verifyCallback,
				'theme': 'light'
			});
		};
	</script>

	</script>
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
					<input type="text" class="form-control" id="nombres" required aria-describedby="emailHelp" name="nombres">
				</div>
				<div class="form-group">
					<label for="apellidos">Apellidos</label>
					<input type="text" class="form-control" id="apellidos" required aria-describedby="emailHelp" name="apellidos">
				</div>
				<div class="form-group">
					<label for="email">Email</label>
					<input type="email" class="form-control" id="email" required aria-describedby="emailHelp" name="email">
				</div>
				<div class="form-group">
					<label for="password">Contraseña</label>
					<input type="password" class="form-control" id="passwordRegistrar" required name="password">
				</div>
				<div class="form-group">
					<label for="passwordConfirm">Confirmar contraseña</label>
					<input type="password" class="form-control" id="passwordConfirmRegistrar" required name="passwordConfirm">
				</div>
				<div class="form-group">
					<label for="avatar">Avatar</label>
					<input type="file" class="form-control-file" id="avatar" accept="image/*" name="avatar" onchange="encodeImageFileAsURL(this.id);">
				</div>

				<div id="recaptchaRegistrar"></div>

				<button type="submit" class="btn btn-primary">Registrarme</button>
			</form>
		</div>
	</div>

	<!-- style="display: none" -->
	<div class="row pt-4" id="div-correo-enviado" style="display: none">
		<div class="card">
			<div class="card-header">
				Activa tu cuenta
			</div>
			<div class="card-body">
				<h3 class="card-title">Su cuenta ha sigo creada exitosamente</h3>
				<h4>Hemos enviado un mensaje a su correo electronico para validar su cuenta.</h4>
				<h4>Abra su email y haga clic en el link.</h4>
				<a href="#" class="btn btn-primary" onclick="mostrarInicioSesion()">Iniciar sesion</a>
			</div>
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
					<input type="email" class="form-control" id="emailLogin" required aria-describedby="emailHelp" name="email">
				</div>
				<div class="form-group">
					<label for="password">Contraseña</label>
					<input type="password" class="form-control" id="passwordLogin" required name="password">
				</div>
				<div id="recapcha-inicio-sesion">
					<div id="recaptchaSesion"></div>
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
		// variable que guarda el codigo del avatar
		var avatarCode = "";
		
		/**
		 * registrar usuario estandar
		 */
		document.getElementById("formulario-registrar").addEventListener("submit", function(e) { //evento submit
			e.preventDefault(); //para que no se abra el archivo php

			if (grecaptcha.getResponse(widgetIdRegistrar).length == 0) {
				alert("Por favor, verifique que usted es humano!");
				return false;
			}
			data = {
				nombres: document.getElementById("nombres").value,
				apellidos: document.getElementById("apellidos").value,
				email: document.getElementById("email").value,
				password: document.getElementById("passwordRegistrar").value,
				avatar: avatarCode
			};
			if (document.getElementById("passwordRegistrar").value === document.getElementById("passwordConfirmRegistrar").value) {
				// realizar la peticion
				petiones_ajax(this.method, this.action, data, respuestaRegistrar);
			} else {
				alert("las contraseñas no coinciden")
			}
		});

		/**
		 * callback de la peticion ajax de registrar
		 * funcion que controla la respuesta de peticion del formulario de registrar
		 *
		 * return void
		 */
		function respuestaRegistrar(objetoRespuesta) {
			if (typeof objetoRespuesta === 'object') {
				if (objetoRespuesta.status) {
					mostrarMensajeCorreoEnviado();
				} else
					alert(objetoRespuesta.message)
			} else
				console.log("Error inesperado");
		}

		/**
		 * Funcion encargada de moestrar el interfaz con mensaje de correo enviado y ocultar los demas
		 *
		 * @return void
		 */
		function mostrarMensajeCorreoEnviado() {
			document.getElementById("div-registrar").style.display = "none";
			document.getElementById("div-correo-enviado").style.display = "block";
			document.getElementById("formulario-registrar").reset();
		}

		/**
		 * Funcion encargada de moestrar el formulario de inicio de sesion y ocultar los demas
		 *
		 * @return void
		 */
		function mostrarInicioSesion() {
			document.getElementById("div-registrar").style.display = "none";
			document.getElementById("div-correo-enviado").style.display = "none";
			document.getElementById("div-sesion").style.display = "block";
			document.getElementById("formulario-registrar").reset();
			document.getElementById("formulario-sesion").reset();
		}

		/**
		 * funcion del formulario inicio de sesion
		 *
		 * return void
		 */
		// $(document).ready(function() {
		document.getElementById("formulario-sesion").addEventListener("submit", function(e) {
			e.preventDefault();
			if (grecaptcha.getResponse(widgetIdSesion).length == 0) {
				alert("Por favor, verifique que usted es humano!");
				return false;
			}
			petiones_ajax(this.method, this.action, $(this).serialize(), respuestaInicioSesion);
		});

		/**
		 * callback de la peticion ajax del inicio de sesion
		 * funcion que controla la respuesta de peticion del formulario inicio de sesion
		 *
		 * return void
		 */
		function respuestaInicioSesion(objetoRespuesta) {
			if (typeof objetoRespuesta === 'object') {
				if (objetoRespuesta.status) {
					// console.log(objetoRespuesta.message);
					document.getElementById("formulario-sesion").reset();
					location.href = '<?= base_url() ?>index.php/Panel_Administrativo/';
				} else
					alert(objetoRespuesta.message)
			} else
				console.log("Error inesperado");
		}

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

	<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>
	<!-- <script src="https://www.google.com/recaptcha/api.js" async defer></script> -->

</div>