<?php defined('BASEPATH') OR exit('No direct script access allowed');

include_once('CrudController.php');

/**
 * La clase Usuario controla peticiones relacionadas con la obtención y 
 * mantenimiento de los usuarios.
 *
 * @author Jonathan Muñoz Aleman
 * @copyright (c) 2016, Jonathan Muñoz Aleman
 * @see CrudController
 * @since 1.0
 */
class Usuario extends CrudController {
    
    public function __construct() {
        parent::__construct('usuario_model');
    }
    
    /**
     * Carga la vista de mantenimiento que utiliza grids.
     */
    public function index() {
        $this->load->view('gridcrud', array('grid' => 'gridUsuarios', 'funcion' => 'iniciarConfUsuarios'));
    }
    
    /**
     * Valida que el usuario enviado como parámetros HTTP con el método POST, exista
     * y se encuentre activo.
     */
    public function validar() {
        $datos = json_decode(file_get_contents('php://input'));
        $usuario = $this->modelo->obtener_x_id(array('cod_usuario' => $datos->cod_usuario));
        
        if (isset($usuario)) {
            if ($usuario->estado == 'A') {
                $estado = 'success';
                $mensaje = 'Se ha conseguido validar al usuario de manera satisfactoria.';
            } else {
                $estado = 'warning';
                $mensaje = 'El usuario no se encuentra activo actualmente.';
            }
        } else {
            $estado = 'warning';
            $mensaje = 'El nombre de usuario especificado no se encuentra registrado.';
        }
        
        $this->_enviar_respuesta($estado, $usuario, $mensaje);
    }

    /**
     * Valida el usuario y contraseña enviados como parámetros HTTP con el método POST.
     * Si el usuario existe, está activo y su contraseña coincide, se almacena su código
     * y nombre en la sesión.
     */
    public function autenticar() {
        $datos = json_decode(file_get_contents('php://input'));
        $usuario = $this->modelo->obtener_x_id(array('cod_usuario' => $datos->cod_usuario));
        
        if (!isset($usuario)) {
            $this->_enviar_respuesta('warning', $usuario, 'El nombre de usuario especificado no se encuentra registrado.');
            return;
        }
        
        if (!password_verify($datos->clave, $usuario->clave1)) {
            $this->_enviar_respuesta('warning', $usuario, 'La contraseña especificada no corresponde con la del usuario.');
            return;
        }
        
        if ($usuario->estado != 'A') {
            $this->_enviar_respuesta('warning', $usuario, 'El usuario no se encuentra activo actualmente');
            return;
        }
        
        $this->session->set_userdata('coduser', $usuario->cod_usuario);
        $this->session->set_userdata('nomuser', $usuario->nom_usuario);
        $this->session->set_userdata('tipo_usuario', $usuario->tipo_usuario);
        $this->_enviar_respuesta('success', $usuario, 'Se ha conseguido iniciar la sesión de manera satisfactoria.');
    }
    
    private function _enviar_respuesta($estado, $usuario, $mensaje) {
        log_message('info', $mensaje);
        $respuesta = json_encode(array('estado' => $estado, 'mensaje' => $mensaje, 'usuario' => $usuario));
        $this->output->set_content_type('application/json')->set_output($respuesta);
    }
    
}
