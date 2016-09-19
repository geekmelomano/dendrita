<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * La clase Login controla las peticiones relacionadas al inicio y cierre de la sesión
 * de usuario.
 *
 * @author Jonathan Muñoz Aleman
 * @copyright (c) 2016, Jonathan Muñoz Aleman
 * @since 1.0
 */
class Login extends CI_Controller {
    
    public function index() {
        $this->load->view('login');
    }
    
    /**
     * Destruye la sesión de usuario actual.
     */
    public function cerrarsesion() {
        if (session_destroy()) {
            $estado = 'success';
            $mensaje = 'Se ha conseguido cerrar la sesión de manera satisfactoria.';
        } else {
            $estado = 'error';
            $mensaje = 'Ha ocurrido un error inesperado al intentar cerrar la sesión.';
        }
        
        $respuesta = json_encode(array('estado' => $estado, 'mensaje' => $mensaje));
        $this->output->set_content_type('application/json')->set_output($respuesta);
    }
    
}
