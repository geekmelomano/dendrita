<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Sistemagrupo
 *
 * @author Jonathan Munoz
 */
class Sistemagrupo extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('sistema_grupo_model');
    }
    
    public function index() {
        $this->load->view('gridcrud', array('grid' => 'gridSistemaGrupos', 'funcion' => 'iniciarConfSistemaGrupos'));
    }
    
    public function obtener() {
        $grupos = json_encode($this->sistema_grupo_model->obtener_todos());
        $this->output->set_content_type('application/json')->set_output($grupos);
    }
    
    public function crear() {
        $this->sistema_grupo_model->crear();
        $grupo = json_encode($this->input->post());
        $this->output->set_content_type('application/json')->set_output($grupo);
    }
    
    public function editar() {
        $this->sistema_grupo_model->editar();
        $grupo = json_encode($this->input->post());
        $this->output->set_content_type('application/json')->set_output($grupo);
    }
    
    public function eliminar() {
        $this->sistema_grupo_model->eliminar();
        $grupo = json_encode($this->input->post());
        $this->output->set_content_type('application/json')->set_output($grupo);
    }
    
    public function obtenerPorSistema() {
        $filtro = $this->input->get('filter');
        $sistema = $filtro['filters'][0]['value'];
        $grupos = $this->sistema_grupo_model->obtener_x_sistema($sistema);
        $salida = json_encode($grupos);
        $this->output->set_content_type('application/json')->set_output($salida);
    }
    
}
