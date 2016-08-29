<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Localidad
 *
 * @author Jonathan Munoz
 */
class Localidad extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('localidad_model');
    }
    
    public function index() {
        $this->load->view('gridcrud', array('grid' => 'gridLocales', 'funcion' => 'iniciarConfLocales'));
    }
    
    public function crear() {
        $this->localidad_model->crear();
        $localidades = json_encode($this->input->post());
        $this->output->set_content_type('application/json')->set_output($localidades);
    }
    
    public function obtener() {
        $localidades = json_encode($this->localidad_model->obtener_todos());
        $this->output->set_content_type('application/json')->set_output($localidades);
    }
    
    public function editar() {
        $this->localidad_model->editar();
        $local = json_encode($this->input->post());
        $this->output->set_content_type('application/json')->set_output($local);
    }
    
    public function eliminar() {
        $this->localidad_model->eliminar();
        $local = json_encode($this->input->post());
        $this->output->set_content_type('application/json')->set_output($local);
    }
    
    public function obtenerPorEmpresa() {
        $filtro = $this->input->get('filter');
        
        if (!isset($filtro)) {
            log_message('info', 'No se ha especificado ninguna empresa.');
            show_error('No se ha especificado ninguna empresa', 500);
        }
        
        if (!isset($this->session->coduser)) {
            log_message('info', 'Ningun usuario ha iniciado sesion aun.');
            show_error('Ningun usuario ha iniciado sesion aun', 500);
        }
        
        if (!isset($this->session->codsis)) {
            log_message('info', 'Todavia no se ha seleccionado ningun sistema.');
            show_error('Todavia no se ha seleccionado ningun sistema.', 500);
        }
        
        $codemp = $filtro['filters'][0]['value'];
        $locales = $this->localidad_model->obtener_x_usuario_sistema_y_empresa(
                $this->session->coduser, $this->session->codsis, $codemp);
        $this->output->set_content_type('application/json')->set_output(json_encode($locales));
    }
    
}
