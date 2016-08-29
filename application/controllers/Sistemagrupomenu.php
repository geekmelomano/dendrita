<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Sistemagrupomenu
 *
 * @author Jonathan Munoz
 */
class Sistemagrupomenu extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('sistema_grupo_menu_model');
    }
    
    public function crear() {
        $this->output->set_content_type('application/json')->set_output(json_encode($this->input->post()));
    }
    
    public function editar() {
        $this->output->set_content_type('application/json')->set_output(json_encode($this->input->post()));
    }
    
    public function eliminar() {
        $this->output->set_content_type('application/json')->set_output(json_encode($this->input->post()));
    }
    
    public function obtenerPorGrupoYPadre() {
        $sistema = $this->input->get('codsis');
        $grupo = $this->input->get('cod_sisgrupo');
        $padre = $this->input->get('cod_menu');
        $menus = $this->sistema_grupo_menu_model->obtener_x_grupo_y_padre($sistema, $grupo, $padre);
        $this->output->set_content_type('application/json')->set_output(json_encode($menus));
    }
    
}
