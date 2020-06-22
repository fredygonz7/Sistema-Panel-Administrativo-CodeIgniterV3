<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Panel_Administrativo extends CI_Controller
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
        $this->load->view('include/header');
        $this->load->view('include/menu_panel');
        $sesionIniciada = $this->session->sesion_sistema_administrativo;
        // print_r($sesionIniciada);die();

        // print_r($this->session);
        if ($sesionIniciada['perfil'] == "admin" || $sesionIniciada['perfil'] == "usuario") {
            $this->load->view('panel_administrativo/usuario');
        } else {
            $this->load->view('welcome_message');
        }
        $this->load->view('include/footer');
    }


    public function cerrarSesion()
    {
        // $array_items = array('id','nombres','apellidos','email','avatar','activo','perfil');
        $this->session->unset_userdata('sesion_sistema_administrativo');
        echo $this->mensaje("Sesion cerrada", 1);
        // $this->index();
    }

    public function obtenerUsuarios()
    {
        $datos = $this->Usuario_model->getUsuarios();
    }


    public function obtenerUsuario()
    {
        $datos = $this->Usuario_model->getUsuario();
    }


    public function registrarUsuario()
    {
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
            echo $this->mensaje("Debe revisar los datos");
        } else {
            $array = array(
                "nombres"   =>  strtoupper($this->input->post("nombres")),
                "apellidos" =>  strtoupper($this->input->post("apellidos")),
                "email"     =>  strtoupper($this->input->post("email")),
                "password"  =>  password_hash($_POST['password'], PASSWORD_BCRYPT),
                "activo"    =>  strtoupper($this->input->post("activo")),
                "perfil"    =>  strtoupper($this->input->post("perfil"))
            );
            $datos = $this->Usuario_model->registrarUsuario($array);
            echo $datos;
        }
    }

    public function editarPerfil()
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
                "field" => "avatar",
                "label" => "avatar",
                "rules" => "required"
            ]
        ]);

        // print_r($this->session->sesion_sistema_administrativo);
        // die();

        if ($this->form_validation->run() == FALSE) {
            echo $this->mensaje("Debe revisar los datos");
        } else {
            $array = array(
                "nombres"   =>  strtoupper($this->input->post("nombres")),
                "apellidos" =>  strtoupper($this->input->post("apellidos")),
                "email"     =>  strtoupper($this->input->post("email")),
                // "password"  =>  password_hash($_POST['password'], PASSWORD_BCRYPT),
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
                $array["password"]= password_hash($_POST['password'], PASSWORD_BCRYPT);
            }
            // print_r($array);
            // die();

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
                // $this->session->sesion_sistema_administrativo['avatar']= $this->input->post("avatar");
                $this->session->unset_userdata('sesion_sistema_administrativo');
                $this->session->set_userdata($arraySesion);
                // $this->session->set_userdata('sesion_sistema_administrativo', $arraySesion);
            }
            echo $datos;
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
