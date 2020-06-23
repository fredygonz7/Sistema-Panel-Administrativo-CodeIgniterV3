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
	
	function activarUsuario()
	{
		$array = array(
			"email"     =>  strtoupper($_GET['email']),
			"activo"    =>  "true"
		);
		$datos = $this->Usuario_model->editarPerfil($array);
		if (json_decode($datos)->status) {
			echo "<script>
                	alert('Usuario activado');
					window.location= 'https://sistema-panel-administrativo.test/';
				</script>";
		} else{
			echo "<script>
					alert('No se pudo activar el usuario');
					window.location= 'https://sistema-panel-administrativo.test/';
				</script>";
		}
	}

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
