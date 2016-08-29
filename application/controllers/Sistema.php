<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Sistema
 *
 * @author Jonathan Munoz
 */
class Sistema extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('sistema_model');
    }
    
    public function index() {
        $this->load->view('gridcruddet', array(
            'titulo' => 'GESTION DE SISTEMAS',
            'nombre' => 'Sistemas',
            'subtitulo' => 'Empresas y Localidades asignados a <strong>#: nomsis #</strong>:',
            'nombre_det' => 'SistemasEmpresas'
        ));
    }
    
    public function obtener() {
        $sistemas = json_encode($this->sistema_model->obtener_todos());
        $this->output->set_content_type('application/json')->set_output($sistemas);
    }
    
    public function crear() {
        $this->sistema_model->crear();
        $sistema = json_encode($this->input->post());
        $this->output->set_content_type('application/json')->set_output($sistema);
    }
    
    public function editar() {
        $this->sistema_model->editar();
        $sistema = json_encode($this->input->post());
        $this->output->set_content_type('application/json')->set_output($sistema);
    }
    
    public function eliminar() {
        $this->sistema_model->eliminar();
        $sistema = json_encode($this->input->post());
        $this->output->set_content_type('application/json')->set_output($sistema);
    }
    
    public function obtenerPorSesion() {
        if (isset($this->session->coduser)) {
            $sistemas = $this->sistema_model->obtener_x_usuario($this->session->coduser);
            $this->output->set_content_type('application/json')->set_output(json_encode($sistemas));
        } else {
            log_message('info', 'Ningun usuario ha iniciado sesion.');
            show_error('Ningun usuario ha iniciado sesion', 500);
        }
    }
    
    public function recordar() {
        $sistema = $this->sistema_model->obtener();
        
        if (isset($sistema)) {
            $this->session->set_userdata('codsis', $sistema->codsis);
            $this->session->set_userdata('nomsis', $sistema->nomsis);
            $estado = 'success';
            $mensaje = 'Se ha conseguido almacenar el sistema seleccionado en la sesion.';
        } else {
            $estado = 'warning';
            $mensaje = 'No se ha podido encontrar los datos del sistema seleccionado.';
        }
        
        log_message('info', $mensaje);
        $this->output->set_content_type('application/json')
                ->set_output(json_encode(array('estado' => $estado, 'mensaje' => $mensaje)));
    }
    
}
