<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Reglaaccesoempresadet
 *
 * @author Jonathan Munoz
 */
class Reglaaccesoempresadet extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('reglaacceso_empresa_det_model');
    }
    
    public function obtener() {
        $reglas = json_encode($this->reglaacceso_empresa_det_model->obtener_todos());
        $this->output->set_content_type('application/json')->set_output($reglas);
    }
    
    public function crear() {
        $this->reglaacceso_empresa_det_model->crear();
        $regla = json_encode($this->input->post());
        $this->output->set_content_type('application/json')->set_output($regla);
    }
    
    public function editar() {
        $this->reglaacceso_empresa_det_model->editar();
        $regla = json_encode($this->input->post());
        $this->output->set_content_type('application/json')->set_output($regla);
    }
    
    public function eliminar() {
        $this->reglaacceso_empresa_det_model->eliminar();
        $regla = json_encode($this->input->post());
        $this->output->set_content_type('application/json')->set_output($regla);
    }
    
    public function obtenerPorReglaYSistema() {
        $filtro = $this->input->get('filter');
        $regla = $filtro['filters'][0]['value'];
        $sistema = $filtro['filters'][1]['value'];
        $reglas = $this->reglaacceso_empresa_det_model->obtener_x_regla_y_sistema($regla, $sistema);
        $salida = json_encode($reglas);
        $this->output->set_content_type('application/json')->set_output($salida);
    }
    
}
