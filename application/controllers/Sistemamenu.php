<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Sistemamenu
 *
 * @author Jonathan Munoz
 */
class Sistemamenu extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('sistema_menu_model');
    }
    
    public function obtenerPorPadre() {
        $codsist = $this->input->get('codsis');
        $codmenu = $this->input->get('cod_menu');
        $menus = json_encode($this->sistema_menu_model->obtener_x_padre($codsist, $codmenu));
        $this->output->set_content_type('application/json')->set_output($menus);
    }
    
}
