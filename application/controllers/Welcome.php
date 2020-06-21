<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->helper('form');
		$this->load->library('session');
		// $this->load->model('Usuario_model');
	}
	public function index()
	{
		$sesionIniciada = $this->session->sesion_sistema_administrativo;
		$this->load->view('include/header');
		$this->load->view('include/menu');

		if ($sesionIniciada['perfil'] == "admin" || $sesionIniciada['perfil'] == "usuario") {
			$this->load->view('panel_administrativo/usuario');
		} else {
			$this->load->view('welcome_message');
		}
		$this->load->view('include/footer');
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
			
			// print_r($datos); die();

			// $this->session->userdata('item');
			// print_r(json_decode($datos)->data);
			// die();
			if ($objetoUsuario->status){
				$arraySesion= array(
					'sesion_sistema_administrativo' => get_object_vars($objetoUsuario->data )
				);
				// print_r($arraySesion);die();
				$this->session->set_userdata($arraySesion);
				echo $this->mensaje("Usuario logeado", 1);
			}else{
				echo $datos;
			}
		}
	}

	public function registrar()
	{
		
		print_r($_POST);
		// $captcha = $_POST['g-recaptcha-response'];
		// $captcha_clave_secreta = '6LfTjqcZAAAAAI426GOq5mdrqmgZu5C-gACNFPvS';
		// $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=". $captcha_clave_secreta."&response=" . $captcha . "&remoteip=" . $_SERVER['REMOTE_ADDR']);

		die();
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
		} else {
			$array = array(
				"nombres"	=> 	strtoupper($this->input->post("nombres")),
				"apellidos" => 	strtoupper($this->input->post("apellidos")),
				"email" 	=> 	strtoupper($this->input->post("email")),
				"password" 	=> 	password_hash($_POST['password'], PASSWORD_BCRYPT)
			);
			$datos = $this->Usuario_model->registrarUsuario($array);
			echo $datos;
		}
	}

	public function sendEmail()
	{
		$email = "fredgonz7@gmail.com";
		if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$this->load->library('email');

			$this->email->from('fredgonz7@gmail.com', 'Your Name');
			$this->email->to($email);
			// $this->email->cc('another@another-example.com');
			// $this->email->bcc('them@their-example.com');

			$this->email->subject('Email Test');
			$this->email->message('Testing the email class.');

			if ($this->email->send())
				echo $this->mensaje("Correo de validacion enviado", 1);
			else
				echo $this->mensaje("Correo de validacion no enviado", 0);
		} else
			echo $this->mensaje("Correo invalido", 0);
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
