<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Panel_Administrativo extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // $this->load->library('form_validation');
        // $this->load->helper('form');
        // $this->load->library('session');
        // $this->load->model('Usuario_model');
    }

    /**
     * verifica la sesion y muestra la vista correspondiente
     *
     * @return void
     */
    public function index()
    {
        $sesionIniciada = $this->session->sesion_sistema_administrativo;

        $datos = $this->Usuario_model->getUsuario($sesionIniciada['email']);

        if (($sesionIniciada['perfil'] == "admin" || $sesionIniciada['perfil'] == "usuario") &&
            json_decode($datos)->status == 1 && json_decode($datos)->data->activo == "true"
        ) {
            $this->load->view('include/header');
            $this->load->view('include/menu_panel');
            $data['intereses_usuario'] = $this->Usuario_model->getIntereses($sesionIniciada['email']);
            // print_r($data['intereses_usuario']);
            $this->load->view('panel_administrativo/usuario', $data);
            $this->load->view('include/footer');
        } else {
            $this->cerrarSesion();
            header("Location: " . base_url());
        }
    }

    /**
     * Cierra la session del sistema
     *
     * @return void
     */
    public function cerrarSesion()
    {
        $this->session->unset_userdata('sesion_sistema_administrativo');
        echo $this->mensaje("Sesion cerrada", 1);
    }

    /**
     * Ejecuta la funcion getUsuarios de Usuario_model para optener todos los usuarios
     *
     * @return mensaje con la lista de usuarios
     */
    public function obtenerUsuarios()
    {
        $datos = $this->Usuario_model->getUsuarios();
        echo $datos;
    }

    /**
     * Registra un usuario
     * funcion que ejecuta un administrador
     *
     * @return json
     */
    public function crearUsuario()
    {
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
            ],
            [
                "field" => "activo",
                "label" => "activo",
                "rules" => "required"
            ],
            [
                "field" => "perfil",
                "label" => "perfil",
                "rules" => "required"
            ]
        ]);
        // print_r($_POST);
        // die();
        if ($this->form_validation->run() == FALSE) {
            echo $this->mensaje("Datos incompletos");
        } else {
            $array = array(
                "nombres"   =>  strtoupper($this->input->post("nombres")),
                "apellidos" =>  strtoupper($this->input->post("apellidos")),
                "email"     =>  strtoupper($this->input->post("email")),
                "password"  =>  password_hash($_POST['password'], PASSWORD_BCRYPT),
                "activo"    =>  $this->input->post("activo"),
                "perfil"    =>  $this->input->post("perfil")
            );
            $datos = $this->Usuario_model->registrarUsuario($array);
            echo $datos;
        }
    }

    /**
     * Comunica los datos de editar perfil con el modelo que actualiza los datos del usuario
     *
     * @return void
     */
    public function editarPerfil()
    {
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
                "field" => "avatar",
                "label" => "avatar",
                "rules" => "required"
            ]
        ]);
        if ($this->form_validation->run() == FALSE) {
            echo $this->mensaje("Datos incompletos");
        } else {
            $array = array(
                "nombres"   =>  strtoupper($this->input->post("nombres")),
                "apellidos" =>  strtoupper($this->input->post("apellidos")),
                "email"     =>  strtoupper($this->input->post("email")),
                "avatar"    =>  $this->input->post("avatar")
            );

            $this->form_validation->set_rules([
                [
                    "field" => "password",
                    "label" => "password",
                    "rules" => "required"
                ]
            ]);
            if ($this->form_validation->run() == TRUE) {
                $array["password"] = password_hash($_POST['password'], PASSWORD_BCRYPT);
            }

            $datos = $this->Usuario_model->editarPerfil($array);
            if (json_decode($datos)->status) {
                $sesionIniciada = $this->session->sesion_sistema_administrativo;
                $arraySesion = array(
                    'sesion_sistema_administrativo' => array(
                        'id'        => $sesionIniciada['id'],
                        'nombres'   => strtoupper($this->input->post("nombres")),
                        'apellidos' => strtoupper($this->input->post("apellidos")),
                        'email'     => strtoupper($this->input->post("email")),
                        'avatar'    => $this->input->post("avatar"),
                        'activo'    => $sesionIniciada['activo'],
                        'perfil'    => $sesionIniciada['perfil']
                    )
                );
                $this->session->unset_userdata('sesion_sistema_administrativo');
                $this->session->set_userdata($arraySesion);
            }
            echo $datos;
        }
    }


    /**
     * Cominica los datos de editar perfil con el modelo que actualiza los datos del usuario
     *
     * @return void
     */
    public function editarIntereses()
    {
        // validar reglas
        $this->form_validation->set_rules([
            [
                "field" => "email",
                "label" => "email",
                "rules" => "required|valid_email"
            ],
            [
                "field" => "gastronomia",
                "label" => "gastronomia",
                "rules" => "required"
            ],
            [
                "field" => "deportes",
                "label" => "deportes",
                "rules" => "required"
            ],
            [
                "field" => "desarrolo_web",
                "label" => "desarrolo_web",
                "rules" => "required"
            ],
            [
                "field" => "desarrollo_movil",
                "label" => "desarrollo_movil",
                "rules" => "required"
            ],
            [
                "field" => "politica",
                "label" => "politica",
                "rules" => "required"
            ],
            [
                "field" => "cine",
                "label" => "cine",
                "rules" => "required"
            ],
            [
                "field" => "esoterismo",
                "label" => "esoterismo",
                "rules" => "required"
            ],
            [
                "field" => "hogar_y_moda",
                "label" => "hogar_y_moda",
                "rules" => "required"
            ],
            [
                "field" => "psicologia",
                "label" => "psicologia",
                "rules" => "required"
            ]
        ]);
        if ($this->form_validation->run() == FALSE) {
            echo $this->mensaje("Datos incompletos");
        } else {
            $array = array(
                "email_usuario"             =>  strtoupper($this->input->post("email")),
                "gastronomia"       =>  $this->input->post("gastronomia"),
                "deportes"          =>  $this->input->post("deportes"),
                "desarrolo_web"     =>  $this->input->post("desarrolo_web"),
                "desarrollo_movil"  =>  $this->input->post("desarrollo_movil"),
                "politica"          =>  $this->input->post("politica"),
                "cine"              =>  $this->input->post("cine"),
                "esoterismo"        =>  $this->input->post("esoterismo"),
                "hogar_y_moda"      =>  $this->input->post("hogar_y_moda"),
                "psicologia"        =>  $this->input->post("psicologia")
            );
            // print_r($array);
            $datos = $this->Usuario_model->editarIntereses($array);
            echo $datos;
        }
    }


    /**
     * Cominica los datos de editar usuario con el modelo que actualiza los datos de un usuario
     * accion que puede realizar un adminitrador
     *
     * @return void
     */
    public function editarUsuario()
    {
        // print_r($_POST);
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
                "field" => "activo",
                "label" => "activo",
                "rules" => "required"
            ],
            [
                "field" => "perfil",
                "label" => "perfil",
                "rules" => "required"
            ]
        ]);
        if ($this->form_validation->run() == FALSE) {
            echo $this->mensaje("Datos incompletos");
        } else {
            $array = array(
                "nombres"   =>  strtoupper($this->input->post("nombres")),
                "apellidos" =>  strtoupper($this->input->post("apellidos")),
                "email"     =>  strtoupper($this->input->post("email")),
                "activo"    =>  $this->input->post("activo"),
                "perfil"    =>  $this->input->post("perfil")
            );

            $this->form_validation->set_rules([
                [
                    "field" => "password",
                    "label" => "password",
                    "rules" => "required"
                ]
            ]);
            if ($this->form_validation->run() == TRUE) {
                $array["password"] = password_hash($_POST['password'], PASSWORD_BCRYPT);
            }
            $datos = $this->Usuario_model->editarPerfil($array);
            echo $datos;
        }
    }

    /**
     * Eliminar un usuario 
     *
     * @return void
     */
    public function eliminarUsuario()
    {
        // validar reglas
        $this->form_validation->set_rules([
            [
                "field" => "email",
                "label" => "email",
                "rules" => "required"
            ]
        ]);

        if ($this->form_validation->run() == FALSE) {
            echo $this->mensaje("Debe revisar los datos");
        } else {
            $datos = $this->Usuario_model->deleteUsuario($this->input->post("email"));
            echo $datos;
        }
    }

    /**
     * Descarga perfil en PDF
     *
     * @return void
     */
    public function GenerarPDF()
    {
        $this->load->library('generarpdf');
        $filename = 'PerfilSistemaAdministrativo';
        $html = $this->CuerpoPDF();
        $this->generarpdf->generate($html, $filename);
        // $intereses_usuario  = json_decode($this->Usuario_model->getIntereses($_GET['email']));
        // $datos_usuario     = json_decode($this->Usuario_model->getUsuario($_GET['email']));

        // if ($datos_usuario->status && $intereses_usuario->status) {

        //     $data['nombresapellidos'] = $datos_usuario->data->nombres . " " . $datos_usuario->data->apellidos;
        //     $data['email'] = $datos_usuario->data->email;
        //     $data['perfil'] = $datos_usuario->data->perfil = "admin" ? "Administrador" : "Usuario";
        //     $data['avatar'] = $datos_usuario->data->avatar;

        //     $listaIntereses = "";

        //     foreach ($intereses_usuario->data as $interes => $valor) {
        //         if ($valor == "true") {
        //             if ($listaIntereses == "")
        //                 $listaIntereses .= strtoupper($interes[0]). substr($interes,1);
        //             else
        //                 $listaIntereses = $listaIntereses.", " . strtoupper($interes[0]) . substr($interes, 1);
        //         }
        //     }
        //     $data['intereses'] = $listaIntereses;

        //     $html = $this->load->view('pdf/perfil', $data, TRUE);
        //     $this->load->library('generarpdf');
        //     $filename = 'PerfilSistemaAdministrativo'. $datos_usuario->data->nombres.$datos_usuario->data->apellidos;
        //     $this->generarpdf->generate($html, $filename);

        //     // $this->load->view('pdf/perfil', $data);
        // }else
        //     header("Location: " . base_url());
    }


    /**
     * Envia datos de perfil al email, en formato PDF
     *
     * @return void
     */
    public function EnviarPDF()
    {
        $this->load->library('generarpdf');
        $html = $this->CuerpoPDF();
        $filename = 'PerfilSistemaAdministrativo';
        $archivoPDF = $this->generarpdf->generate($html, $filename, false);

        $destino = $_GET['email'];
        $asunto    = "PerfilSistemaAdministrativo";
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
						<p>Se ha adjundado un archivo PDF con informacion de su perfil</p>
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

        // enviar archivo adjunto
        $this->email->attach($archivoPDF, 'attachment', 'report.pdf', 'application/pdf');

        // print_r("415");
        // die();
        //Enviamos el email y si se produce bien o mal que avise con una flasdata
        if ($this->email->send()) {
            header("Location: " . base_url());
            // return (json_encode([
            //     "message"       =>  "Correo enviado",
            //     "status"        =>  1,
            //     "data"          =>  "",
            //     "description"   =>  $asunto
            // ]));
        } else {
            header("Location: " . base_url());
            // return (json_encode([
            //     "message"       =>  "Correo no enviado",
            //     "status"        =>  0,
            //     "data"          =>  "",
            //     "description"   =>  $asunto
            // ]));
        }

        header("Location: " . base_url());
    }

    /**
     * crear el cuerpo del documento PDF
     * que se necesitapara generar o enviar el PDF 
     *
     * @return HTML
     */
    function CuerpoPDF()
    {
        $intereses_usuario  = json_decode($this->Usuario_model->getIntereses($_GET['email']));
        $datos_usuario     = json_decode($this->Usuario_model->getUsuario($_GET['email']));

        if ($datos_usuario->status && $intereses_usuario->status) {

            $data['nombresapellidos'] = $datos_usuario->data->nombres . " " . $datos_usuario->data->apellidos;
            $data['email'] = $datos_usuario->data->email;
            $data['perfil'] = $datos_usuario->data->perfil = "admin" ? "Administrador" : "Usuario";
            $data['avatar'] = $datos_usuario->data->avatar;

            $listaIntereses = "";

            foreach ($intereses_usuario->data as $interes => $valor) {
                if ($valor == "true") {
                    if ($listaIntereses == "")
                        $listaIntereses .= strtoupper($interes[0]) . substr($interes, 1);
                    else
                        $listaIntereses = $listaIntereses . ", " . strtoupper($interes[0]) . substr($interes, 1);
                }
            }
            $data['intereses'] = $listaIntereses;

            $html = $this->load->view('pdf/perfil', $data, TRUE);
            return ($html);
        } else
            header("Location: " . base_url());
    }

    /*

    public function GenerarPDF()
    {
        $intereses_usuario  = json_decode($this->Usuario_model->getIntereses($_GET['email']));
        $datos_usuario     = json_decode($this->Usuario_model->getUsuario($_GET['email']));

        if ($datos_usuario->status && $intereses_usuario->status) {

            $data['nombresapellidos'] = $datos_usuario->data->nombres . " " . $datos_usuario->data->apellidos;
            $data['email'] = $datos_usuario->data->email;
            $data['perfil'] = $datos_usuario->data->perfil = "admin" ? "Administrador" : "Usuario";
            $data['avatar'] = $datos_usuario->data->avatar;

            $listaIntereses = "";

            foreach ($intereses_usuario->data as $interes => $valor) {
                if ($valor == "true") {
                    if ($listaIntereses == "")
                        $listaIntereses .= strtoupper($interes[0]). substr($interes,1);
                    else
                        $listaIntereses = $listaIntereses.", " . strtoupper($interes[0]) . substr($interes, 1);
                }
            }
            $data['intereses'] = $listaIntereses;

            $html = $this->load->view('pdf/perfil', $data, TRUE);
            $this->load->library('generarpdf');
            $filename = 'PerfilSistemaAdministrativo'. $datos_usuario->data->nombres.$datos_usuario->data->apellidos;
            $this->generarpdf->generate($html, $filename);
            
            // $this->load->view('pdf/perfil', $data);
        }else
            header("Location: " . base_url());
    }

    */

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
