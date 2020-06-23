<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		// $this->load->library('form_validation');
		// $this->load->helper('form');
		// $this->load->helper('url');
		// $this->load->library('session');
		// $this->load->library('email');
		// $this->load->model('Usuario_model');
		// email.tests.pruebas@gmail.com
		// 123456Pruebas
	}
	public function index()
	{
		$sesionIniciada = $this->session->sesion_sistema_administrativo;

		$datos = $this->Usuario_model->getUsuario($sesionIniciada['email']);

		if (($sesionIniciada['perfil'] == "admin" || $sesionIniciada['perfil'] == "usuario") &&
			json_decode($datos)->status == 1
		) {
			header("Location: " . base_url() . "index.php/Panel_Administrativo/");
		} else {
			$this->load->view('include/header');
			$this->load->view('include/menu');
			$this->load->view('welcome_message');
			$this->load->view('include/footer');
		}
	}

	/**
	 * Undocumented function
	 *
	 * @return void
	 */
	public function login()
	{
		// print_r($_POST);
		// die();
		// validar reglas
		$this->form_validation->set_rules([
			[
				"field" => "email",
				"label" => "email",
				"rules" => "required"
			],
			[
				"field" => "password",
				"label" => "password",
				"rules" => "required"
			]
		]);

		if ($this->form_validation->run() == FALSE) {
			echo $this->mensaje("Debe revisar los datos");
		} else {
			$datos = $this->Usuario_model->validarUsuario(strtoupper($_POST['email']));
			$objetoUsuario = json_decode($datos);

			if ($objetoUsuario->status) {
				if ($objetoUsuario->data->activo == "true") {
					$arraySesion = array(
						'sesion_sistema_administrativo' => get_object_vars($objetoUsuario->data)
					);
					// print_r($arraySesion);die();
					$this->session->set_userdata($arraySesion);
					echo $this->mensaje("Usuario logeado", 1);
				}
				else {
					echo $this->mensaje("Usuario no activo", 0);
				}
			} else {
				echo $datos;
			}
		}
	}

	/**
	 * registra un usuario
	 * accion realizada por un usuario estandar
	 *
	 * @return void
	 */
	public function registrar()
	{

		// print_r($_POST);
		// $captcha = $_POST['g-recaptcha-response'];
		// $captcha_clave_secreta = '6LfTjqcZAAAAAI426GOq5mdrqmgZu5C-gACNFPvS';
		// $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=". $captcha_clave_secreta."&response=" . $captcha . "&remoteip=" . $_SERVER['REMOTE_ADDR']);

		// die();
		// validar reglas
		$this->form_validation->set_rules([
			[
				"field" => "nombres",
				"label" => "nombres",
				"rules" => "required"
			],
			[
				"field" => "apellidos",
				"label" => "apellidos",
				"rules" => "required"
			],
			[
				"field" => "email",
				"label" => "email",
				"rules" => "required"
			],
			[
				"field" => "password",
				"label" => "password",
				"rules" => "required"
			]
		]);

		if ($this->form_validation->run() == FALSE) {
			echo $this->mensaje("Debe revisar los datos");
		} else if (filter_var(strtoupper($this->input->post("email")), FILTER_VALIDATE_EMAIL)) {

			$array = array(
				"nombres"	=> 	strtoupper($this->input->post("nombres")),
				"apellidos" => 	strtoupper($this->input->post("apellidos")),
				"email" 	=> 	strtoupper($this->input->post("email")),
				"password" 	=> 	password_hash($_POST['password'], PASSWORD_BCRYPT),
				"avatar" 	=> 	$_POST['avatar']
			);
			$datos = $this->Usuario_model->registrarUsuario($array);
			$datosRespuesta = json_decode($datos);
			// verificando registro
			if ($datosRespuesta->status) {
				// enviando correo
				$respuestaEnviarCorreo = $this->enviarCorreo(strtoupper($this->input->post("email")));
				// verificando que el correo sea enviado
				if (json_decode($respuestaEnviarCorreo)->status)
					echo $this->mensaje("Usuario Agregado y correo enviado", 1);
				else
					echo $this->mensaje("Usuario Agregado pero no se pudo enviar el correo", 1);
			} else {
				echo $datos;
			}
		} else
			$this->mensaje("Correo invalido");
	}

	/*
				,
				"avatar"	=>	"data:image/png;base64,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"
	 */
	// public function sendEmail()
	// {
	// 	$email = "fredgonz7@gmail.com";
	// 	$emailFrom = "email.tests.pruebas@gmail.com";
	// 	// if (filter_var($emailFrom, FILTER_VALIDATE_EMAIL)) {
	// 	// 	echo 'email is valid';
	// 	// } else {
	// 	// 	echo 'email is not valid';
	// 	// }
	// 	if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
	// 		$this->load->library('email');

	// 		// $this->email->initialize($config);
	// 		// $this->email->initialize();

	// 		$config['protocol'] = 'sendmail';
	// 		$config['mailpath'] = '/usr/sbin/sendmail';
	// 		$config['charset'] = 'iso-8859-1';
	// 		$config['wordwrap'] = TRUE;

	// 		$this->email->initialize($config);

	// 		$this->email->from('email.tests.pruebas@gmail.com', 'Your Name');
	// 		$this->email->to($email);
	// 		$this->email->cc($email);
	// 		$this->email->bcc($email);

	// 		$this->email->subject('Email Test');
	// 		$this->email->message('Testing the email class.');
	// 		// $enviado = $this->email->send();
	// 		// print_r($enviado);
	// 		if ($this->email->send())
	// 			echo $this->mensaje("Correo de validacion enviado", 1);
	// 		else
	// 			echo $this->mensaje("Correo de validacion no enviado", 0);
	// 	} else
	// 		echo $this->mensaje("Correo invalido", 0);
	// }

	function enviarCorreo($destino)
	{
		// $this->load->library('enviaremail', array('fredgonz7@gmail.com', 'Test asunto', 'Test mensaje'));
		// $this->load->library('enviaremail');
		// $this->enviaremail->enviar('fredgonz7@gmail.com', 'Test asunto', 'Test mensaje');
		// $destino = "fredgonz7@gmail.com";
		$asunto	= "Test Asunto";
		$mensaje = '<!DOCTYPE html>
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
						<p>Para activar la cuenta haga clic al siguiente link</p>
						<a href="https://sistema-panel-administrativo.test/index.php/Panel_Administrativo/activarUsuario?email=' . $destino . '">https://sistema-panel-administrativo.test</a>
						<p style="margin-top: 15px";>Despues podra inicias sesion</p>
					</body>
					</html>';

		$mail_config['smtp_host'] = 'smtp.gmail.com';
		$mail_config['smtp_port'] = '587';
		$mail_config['smtp_user'] = 'email.tests.pruebas@gmail.com';
		$mail_config['_smtp_auth'] = TRUE;
		$mail_config['smtp_pass'] = '123456Pruebas';
		$mail_config['smtp_crypto'] = 'tls';
		$mail_config['protocol'] = 'smtp';
		$mail_config['mailtype'] = 'html';
		$mail_config['send_multipart'] = FALSE;
		$mail_config['charset'] = 'utf-8';
		$mail_config['wordwrap'] = TRUE;

		// $this->config->item('base_url');
		$this->email->initialize($mail_config);

		$this->email->set_newline("\r\n");

		$this->email->from('email.tests.pruebas@gmail.com', 'Sistema Panel Administrativo');

		//Definimos el destino del mensaje
		$this->email->to($destino);

		//Definimos el asunto del mensaje
		$this->email->subject($asunto);

		//Definimos el mensaje a enviar
		$this->email->message($mensaje);

		//Enviamos el email y si se produce bien o mal que avise con una flasdata
		if ($this->email->send()) {
			return (json_encode([
				"message"       =>  "Correo enviado",
				"status"        =>  1,
				"data"          =>  "",
				"description"   =>  $asunto
			]));
		} else {
			return (json_encode([
				"message"       =>  "Correo no enviado",
				"status"        =>  0,
				"data"          =>  "",
				"description"   =>  $asunto
			]));
			// echo $this->email->print_debugger();
			/*[
				"message"       =>  "failed",
				"description"   =>  "Error al enviar email"
			];*/
		}
	}
	function enviarCorreo1()
	{
		$mail_config['smtp_host'] = 'smtp.gmail.com';
		$mail_config['smtp_port'] = '587';
		$mail_config['smtp_user'] = 'email.tests.pruebas@gmail.com';
		$mail_config['_smtp_auth'] = TRUE;
		$mail_config['smtp_pass'] = '123456Pruebas';
		$mail_config['smtp_crypto'] = 'tls';
		$mail_config['protocol'] = 'smtp';
		$mail_config['mailtype'] = 'html';
		$mail_config['send_multipart'] = FALSE;
		$mail_config['charset'] = 'utf-8';
		$mail_config['wordwrap'] = TRUE;
		$this->email->initialize($mail_config);

		$this->email->set_newline("\r\n");

		//Ponemos la dirección de correo que enviará el email y un nombre
		$this->email->from('pruebasformactiva@gmail.com', 'Administración Sispecas');

		/**
		 * Ponemos el o los destinatarios para los que va el email
		 * en este caso al ser un formulario de contacto te lo
		 * enviarás a timismo
		 */
		$this->email->to('fredgonz7@gmail.com');

		//Definimos el asunto del mensaje
		$this->email->subject("Recuperación de contraseña");

		//Definimos el mensaje a enviar
		$this->email->message('Tu nueva contraseña: ');

		//Enviamos el email y si se produce bien o mal que avise con una flasdata
		if ($this->email->send()) {
			echo "send";/*[
				"message"       =>  "send",
				"description"   =>  "Contraseña actualizada y envida"
			];*/
		} else {
			echo $this->email->print_debugger();/*[
				"message"       =>  "failed",
				"description"   =>  "Error al enviar email"
			];*/
		}
	}


	// public function enviar()
	// {

	// 	//Cargamos la librería email
	// 	$this->load->library('email');

	// 	//Indicamos el protocolo a utilizar
	// 	$config['protocol'] = 'smtp';

	// 	//El servidor de correo que utilizaremos
	// 	$config["smtp_host"] = 'smtp.gmail.com';

	// 	//Nuestro usuario
	// 	$config["smtp_user"] = 'email.tests.pruebas@gmail.com';

	// 	//Nuestra contraseña
	// 	$config["smtp_pass"] = '123456Pruebas';

	// 	//El puerto que utilizará el servidor smtp
	// 	$config["smtp_port"] = '587';

	// 	//El juego de caracteres a utilizar
	// 	$config['charset'] = 'utf-8';

	// 	//Permitimos que se puedan cortar palabras
	// 	$config['wordwrap'] = TRUE;

	// 	//El email debe ser valido 
	// 	$config['validate'] = true;


	// 	//Establecemos esta configuración
	// 	$this->email->initialize($config);

	// 	//Ponemos la dirección de correo que enviará el email y un nombre
	// 	$this->email->from('email.tests.pruebas@gmail.com', 'Sistema Panel');

	// 	$this->email->to('fredgonz7@gmail.com', 'Fredy Gonzalez');

	// 	//Definimos el asunto del mensaje
	// 	$this->email->subject("Correo prueba asunto");

	// 	//Definimos el mensaje a enviar
	// 	$this->email->message(
	// 		"Email: "."fredgonz7@gmail.com" ." Mensaje: "."mensaje para enviar"
	// 	);

	// 	//Enviamos el email y si se produce bien o mal que avise con una flasdata
	// 	if ($this->email->send())
	// 		echo $this->mensaje("Correo de validacion enviado", 1);
	// 	else
	// 		echo $this->mensaje("Correo de validacion no enviado", 0);
	// }

	/**
	 * Function de respuestas
	 *
	 * @param string $message       mensaje que se puede mostrar al usuario
	 * @param integer $status       0 ó 1 
	 *                              0 para indicar error o respues negativa (false)
	 *                              1 para indicar ok o respues positiva (true)
	 * @param [type] $data
	 * @param string $description   detalles de la respuesta    
	 * @return JSON
	 */
	function mensaje($message, $status = 0, $data = null, $description = "")
	{
		return (json_encode([
			"message"       =>  $message,
			"status"        =>  $status,
			"data"          =>  $data,
			"description"   =>  $description
		]));
	}
}
