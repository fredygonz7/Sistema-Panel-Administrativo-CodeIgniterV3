<?php
// defined('BASEPATH') or exit('No direct script access allowed');

class EnviarEmail {

    public function __construct()//$destino, $asunto, $mensaje
    {
        
        // $this->arrayCorreo=$array;
        // $this->destino = $array['destino'];
        // $this->asunto = $asunto;
        // $this->mensaje = $mensaje;
        // print_r($this->destino);
        // die();
    }
    function enviar($destino, $asunto, $mensaje)
    {
        print_r($destino);
        // die();
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
        $this->email->to($this->destino);

        //Definimos el asunto del mensaje
        $this->email->subject($asunto);

        //Definimos el mensaje a enviar
        $this->email->message($mensaje);

        //Enviamos el email y si se produce bien o mal que avise con una flasdata
        if ($this->email->send()) {
            return (json_encode([
                "message"       =>  "Correo enviado",
                "status"        =>  "1",
                "data"          =>  "",
                "description"   =>  $asunto
            ]));
        } else {
            return (json_encode([
                "message"       =>  "Correo enviado",
                "status"        =>  "1",
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
}