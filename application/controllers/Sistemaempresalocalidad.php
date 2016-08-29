<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Sistemaempresalocalidad
 *
 * @author Jonathan Munoz
 */
class Sistemaempresalocalidad extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('sistema_empresa_localidad_model');
    }
    
    public function index() {
        $this->load->view('gridcrud', array(
            'grid' => 'gridSistemasEmpresas', 'funcion' => 'iniciarConfSistemasEmpresas'
        ));
    }
    
    public function obtener() {
        $sistemas_emprloc = json_encode($this->sistema_empresa_localidad_model->obtener_todos());
        $this->output->set_content_type('application/json')->set_output($sistemas_emprloc);
    }
    
    public function crear() {
        $this->sistema_empresa_localidad_model->crear();
        $sistema_emprloc = json_encode($this->input->post());
        $this->output->set_content_type('application/json')->set_output($sistema_emprloc);
    }
    
    public function editar() {
        $this->sistema_empresa_localidad_model->editar();
        $sistema_emprloc = json_encode($this->input->post());
        $this->output->set_content_type('application/json')->set_output($sistema_emprloc);
    }
    
    public function eliminar() {
        $this->sistema_empresa_localidad_model->eliminar();
        $sistema_emprloc = json_encode($this->input->post());
        $this->output->set_content_type('application/json')->set_output($sistema_emprloc);
    }
    
    public function obtenerPorSistema() {
        $filtro = $this->input->get('filter');
        $sistema = $filtro['filters'][0]['value'];
        $sistemas_emprloc = $this->sistema_empresa_localidad_model->obtener_x_sistema($sistema);
        $salida = json_encode($sistemas_emprloc);
        $this->output->set_content_type('application/json')->set_output($salida);
    }
    
}
