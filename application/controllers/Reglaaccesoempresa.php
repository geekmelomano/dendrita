<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Reglaaccesoempresa
 *
 * @author Jonathan Munoz
 */
class Reglaaccesoempresa extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('reglaacceso_empresa_model');
    }
    
    public function index() {
        $this->load->view('gridcruddet', array(
            'nombre' => 'ReglasAcceso',
            'subtitulo' => 'Empresas y Localidades para la Regla <strong>#: nom_regla #</strong>',
            'nombre_det' => 'ReglasAccesoDet'
        ));
    }
    
    public function obtener() {
        $reglas = json_encode($this->reglaacceso_empresa_model->obtener_todos());
        $this->output->set_content_type('application/json')->set_output($reglas);
    }
    
    public function crear() {
        $this->reglaacceso_empresa_model->crear();
        $regla = json_encode($this->input->post());
        $this->output->set_content_type('application/json')->set_output($regla);
    }
    
    public function editar() {
        $this->reglaacceso_empresa_model->editar();
        $regla = json_encode($this->input->post());
        $this->output->set_content_type('application/json')->set_output($regla);
    }
    
    public function eliminar() {
        $this->reglaacceso_empresa_model->eliminar();
        $regla = json_encode($this->input->post());
        $this->output->set_content_type('application/json')->set_output($regla);
    }
    
    public function obtenerPorSistema() {
        $filtro = $this->input->get('filter');
        $sistema = $filtro['filters'][0]['value'];
        $reglas = $this->reglaacceso_empresa_model->obtener_x_sistema($sistema);
        $salida = json_encode($reglas);
        $this->output->set_content_type('application/json')->set_output($salida);
    }
    
}
