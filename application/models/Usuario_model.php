<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Usuario_model extends CI_Model
{
    public function index()
    {
        $data['page_title'] = 'Productos - CodeIgniter';
        $this->load->view('include/header');
        $this->load->view('include/menu');
        $this->load->view('welcome_message', $data);
        $this->load->view('include/footer');
    }

    /**
     * Obtiene datos de un usuario
     *
     * @param string $email
     * @return void
     */
    public function getUsuario($email)
    {
        $datos = $this->db->where('email', $email)->get('usuario')->row();
        // print_r($datos);die();
        if ($datos) {
            $objetoUsuario = array(
                'id' => $datos->id,
                'nombres' => $datos->nombres,
                'apellidos' => $datos->apellidos,
                'email' => $datos->email,
                'avatar' => $datos->avatar,
                'activo' => $datos->activo,
                'perfil' => $datos->perfil
            );
            return ($this->mensaje("Usuario encontrado", 1, $objetoUsuario));
        }
        return ($this->mensaje("Error en alguno de los campos", 0, null, ""));
    }

    /**
     * consulta en la DB todos los usuarios
     *
     * @return json
     */
    public function getUsuarios()
    {
        $datos = $this->db->select('id, nombres, apellidos, email, activo, perfil')->get('usuario');
        // print_r($datos->result());die();
        if ($datos->row()) {
            return ($this->mensaje("Consulta realizada", 1, $datos->result()));
        }
        return ($this->mensaje("Error en alguno de los campos", 0, null, ""));
    }


    // public function insertUsuario ($array)
    // {
    //     $query = $this->db->where('email', $array["email"])->get('usuario')->row();
    //     if ($query == null) {

    //         $created = $this->db->insert("usuario", $array);
    //         if (!$created) {
    //             return $this->mensaje("Problemas al registrar", 0);
    //         } else
    //             return $this->mensaje("Usuario agregado", 1);
    //     }
    //     return $this->mensaje("El usuario ya existe", 0);
    // }

    /**
     * Valida inicio de sesion de usuario
     *
     * @param string $email
     * @return json
     */
    public function validarUsuario(string $email)
    {
        $datos = $this->db->where('email', $email)->get('usuario')->row();
        // print_r($datos);die();
        if ($datos) {
            if ($datos->email == $email && password_verify($_POST['password'], $datos->password)) {
                $objetoUsuario = array(
                    'id' => $datos->id,
                    'nombres' => $datos->nombres,
                    'apellidos' => $datos->apellidos,
                    'email' => $datos->email,
                    'avatar' => $datos->avatar,
                    'activo' => $datos->activo,
                    'perfil' => $datos->perfil
                );
                return ($this->mensaje("Usuario encontrado", 1, $objetoUsuario));
            }
        }
        return ($this->mensaje("Error en alguno de los campos", 0, null, ""));
    }

    /**
     * registra un usuario 
     *
     * @param array $array
     * @return json
     */
    public function registrarUsuario($array)
    {
        $query = $this->db->where('email', $array["email"])->get('usuario')->row();
        if ($query == null) {

            $created = $this->db->insert("usuario", $array);
            if (!$created) {
                return $this->mensaje("Problemas al registrar", 0);
            } else
                return $this->mensaje("Usuario agregado", 1);
        }
        return $this->mensaje("El usuario ya existe", 0);
    }

    /**
     * Edita el perfil propio de un usuario
     *
     * @param array $array
     * @return json
     */
    public function editarPerfil($array)
    {
        $query = $this->db->where('email', $array["email"])->get('usuario')->row();
        if ($query == null)
            return $this->mensaje("El usuario no existe", 0);
        else {
            $this->db->where('email', $array["email"]);
            // $this->db->update('mytable', $data);
            $editado = $this->db->update("usuario", $array);
            if (!$editado) {
                return $this->mensaje("Problemas al editar", 0);
            } else
                return $this->mensaje("Usuario editado", 1);
        }
    }


    /**
     * Elimina un usuario de la DB
     *
     * @param array $array
     * @return json
     */
    public function deleteUsuario($email)
    {
        $query = $this->db->where('email', $email)->get('usuario')->row();
        if ($query == null) {
            return $this->mensaje("El usuario no existe", 0);
            
        } else {
            $this->db->where('email', $email);

            $eliminado = $this->db->delete("usuario");
            if (!$eliminado) {
                return $this->mensaje("Problemas al eliminar", 0);
            } else
                return $this->mensaje("Usuario eliminado", 1);
        }
    }

    /**
     * Function de respuestas
     *
     * @param string $message       mensaje que se puede mostrar al usuario
     * @param integer $status       debe ser el numero 0 o el numero 1 
     *                              0 para indicar error o respues negativa (false)
     *                              1 para indicar ok o respues positiva (true)
     * @param [type] $data
     * @param string $description   detalles de la respuesta    
     * @return JSON
     */
    function mensaje($message, $status = 1, $data = null, $description = "")
    {
        return (json_encode([
            "message"       =>  $message,
            "status"        =>  $status,
            "data"          =>  $data,
            "description"   =>  $description
        ]));
    }
}
