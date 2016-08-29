<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Grupoempresa
 *
 * @author Jonathan Munoz
 */
class Grupoempresa extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('grupo_empresa_model');
    }
    
    public function index() {
        $this->load->view('gridcrud', array('grid' => 'gridGruposEmpresas', 
            'funcion' => 'iniciarConfGruposEmpresas'));
    }
    
    public function obtener() {
        $grupos = json_encode($this->grupo_empresa_model->obtener_todos());
        $this->output->set_content_type('application/json')->set_output($grupos);
    }
    
    public function crear() {
        $this->grupo_empresa_model->crear();
        $grupo = json_encode($this->input->post());
        $this->output->set_content_type('application/json')->set_output($grupo);
    }
    
    public function editar() {
        $this->grupo_empresa_model->editar();
        $grupo = json_encode($this->input->post());
        $this->output->set_content_type('application/json')->set_output($grupo);
    }
    
    public function eliminar() {
        $this->grupo_empresa_model->eliminar();
        $grupo = json_encode($this->input->post());
        $this->output->set_content_type('application/json')->set_output($grupo);
    }
    
}
