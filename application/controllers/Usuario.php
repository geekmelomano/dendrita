<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Usuario
 *
 * @author Jonathan Munoz
 */
class Usuario extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('usuario_model');
    }
    
    public function index() {
        $this->load->view('gridcrud', array('grid' => 'gridUsuarios', 'funcion' => 'iniciarConfUsuarios'));
    }
    
    public function obtener() {
        $usuarios = json_encode($this->usuario_model->obtener_todos());
        $this->output->set_content_type('application/json')->set_output($usuarios);
    }
    
    public function crear() {
        $this->usuario_model->crear();
        $usuario = json_encode($this->input->post());
        $this->output->set_content_type('application/json')->set_output($usuario);
    }
    
    public function editar() {
        $this->usuario_model->editar();
        $usuario = json_encode($this->input->post());
        $this->output->set_content_type('application/json')->set_output($usuario);
    }
    
    public function eliminar() {
        $this->usuario_model->eliminar();
        $usuario = json_encode($this->input->post());
        $this->output->set_content_type('application/json')->set_output($usuario);
    }

    public function autenticar() {
        $usuario = $this->usuario_model->obtener();
        
        if (isset($usuario)) {
            if (password_verify($this->input->post('clave'), $usuario->clave1)) {
                $this->session->set_userdata('coduser', $usuario->cod_usuario);
                $this->session->set_userdata('nomuser', $usuario->nom_usuario);
                $estado = 'success';
                $mensaje = 'Se ha conseguido iniciar sesión de manera satisfactoria.';
            } else {
                $estado = 'warning';
                $mensaje = 'La contraseña especificada no coincide con la del usuario.';
            }
        } else {
            $estado = 'warning';
            $mensaje = 'El nombre de usuario ingresado no existe.';
        }
        
        log_message('info', $mensaje);
        $this->output->set_content_type('application/json')
                ->set_output(json_encode(array('estado' => $estado, 'mensaje' => $mensaje)));
    }
    
}
