<?php defined('BASEPATH') OR exit('No direct script access allowed');

include_once('Abstract_model.php');

/**
 * Description of Sistema_menu_model
 *
 * @author Jonathan Munoz
 */
class Sistema_menu_model extends Abstract_model {
    
    public $codsis;
    public $cod_menu;
    public $nom_menu;
    public $cod_menu_padre;
    public $usuario;
    public $nombrepc;
    public $fechamodificacion;

    public function __construct() {
        parent::__construct('pub_sistemas_menus');
    }
    
    public function obtener_x_padre($codsis, $cod_menu_padre) {
        return $this->db->get_where('pub_sistemas_menus', array(
            'codsis' => $codsis, 'cod_menu_padre' => $cod_menu_padre))->result();
    }
    
    protected function _establecer_campos($accion) {
        
    }

    protected function _obtener_id() {
        
    }
    
    private function _tiene_subopciones($codsis, $codmenu) {
        $this->db->from('pub_sistemas_menus');
        $this->db->where(array('codsis' => $codsis, 'cod_menu_padre' => $codmenu));
        return $this->db->count_all_results() > 0;
    }

}
