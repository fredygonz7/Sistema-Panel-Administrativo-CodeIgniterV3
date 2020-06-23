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
				<div class="form-group">
					<label for="avatar">Avatar</label>
					<input type="file" class="form-control-file" id="avatar" accept="image/*" name="avatar" onchange="encodeImageFileAsURL(this.id);">
				</div>
				<!-- <div class="form-group form-check">
					<div class="g-recaptcha" data-sitekey="6LfTjqcZAAAAAGoiy59gcEWg6Nk5XF_wwk1b9XI6"></div>
				</div> -->
				<button type="submit" class="btn btn-primary">Registrarme</button>
			</form>
		</div>
	</div>

	<!-- style="display: none" -->
	<div class="row pt-4" id="div-correo-enviado" style="display: none">
		<!-- <div class=" text-center" style="display: none">
			<div class="">
				<h1>Activa tu cuenta</h1>
			</div>
			<div>
				<h4>Su cuenta ha sigo creada exitosamente</h4>
				<h4>Hemos enviado un mensaje a su correo electronico para validar su cuenta.</h4>
				<h4>Abra su email y haga clic en el link.</h4>
			</div>
			<button type="button" class="btn btn-primary" onclick="mostrarInicioSesion()">Iniciar sesion</button>
		</div> -->
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
		var avatarCode = "";
		$(document).ready(function() {
			$('#formulario-registrar').on('submit', function(e) { //evento submit
				e.preventDefault(); //para que no se abra el archivo phplet avatar;
				// if (avatarCode == "") {
				// 	avatar = "<?= $this->session->sesion_sistema_administrativo['avatar']; ?>";
				// } else
				data = {
					nombres: document.getElementById("nombres").value,
					apellidos: document.getElementById("apellidos").value,
					email: document.getElementById("email").value,
					password: document.getElementById("passwordRegistrar").value,
					avatar : avatarCode
				};
				// console.log("data", data);

				if (document.getElementById("passwordRegistrar").value === document.getElementById("passwordConfirmRegistrar").value) {
					$.ajax({ //ajax jQuery
						type: this.method, //metodo para enviar datos al servidor
						url: this.action, //url del servidor "archivo php"
						//contentType : "text/x-json",//prueba para enviarlo como json
						data, //enviando los datos del "formulario" al servidor
						success: function(respuesta) { //recibiendo la respuesta del servidor, en caso de que todo este bien
							// let objeto = JSON.parse(respuesta); //convirtiendo el JSON recibido a objeto JavaScript 
							console.log(respuesta);
							if (typeof respuesta === 'string') {
								let objetoRespuesta = JSON.parse(respuesta);
								if (objetoRespuesta.status) {
									// console.log(objetoRespuesta.message);
									mostrarMensajeCorreoEnviado();
								} else
									alert(objetoRespuesta.message)
							} else
								console.log("Error inesperado");
						}
					});
				} else {
					alert("las contraseñas no coinciden")
				}
			});
		});

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
	</script>
</div>