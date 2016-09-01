<?php defined('BASEPATH') OR exit('No direct script access allowed');

include_once('Abstract_model.php');

/**
 * Description of Sistema_grupo_menu_model
 *
 * @author Jonathan Munoz
 */
class Sistema_grupo_menu_model extends Abstract_model {
    
    public $codsis;
    public $cod_sisgrupo;
    public $cod_menu;
    public $espadre;
    public $crear;
    public $modificar;
    public $consultar;
    public $eliminar;
    public $procesar;
    public $especial01;
    public $especial02;
    public $usuario;
    public $nombrepc;
    public $fecmod;
    
    public function __construct() {
        parent::__construct('pub_sistemas_grupos_menu');
    }
    
    public function obtener_x_grupo_y_padre($sistema, $grupo, $padre) {
        $this->db->select('pub_sistemas_grupos_menu.*, pub_sistemas_menus.nom_menu')
                ->from('pub_sistemas_grupos_menu')
                ->join('pub_sistemas_menus', 'pub_sistemas_menus.codsis = pub_sistemas_grupos_menu.codsis AND '
                        . 'pub_sistemas_menus.cod_menu = pub_sistemas_grupos_menu.cod_menu')
                ->where('pub_sistemas_grupos_menu.codsis', $sistema)
                ->where('pub_sistemas_grupos_menu.cod_sisgrupo', $grupo)
                ->where('pub_sistemas_menus.cod_menu_padre', $padre);
        
        return $this->db->get()->result();
    }
    
    protected function _establecer_campos($accion) {
        $this->codsis = $this->input->post('codsis');
        $this->cod_sisgrupo = $this->input->post('cod_sisgrupo');
        $this->cod_menu = $this->input->post('cod_menu');
        $this->espadre = $this->input->post('espadre');
        $this->crear = $this->input->post('crear');
        $this->modificar = $this->input->post('modificar');
        $this->consultar = $this->input->post('consultar');
        $this->eliminar = $this->input->post('eliminar');
        $this->procesar = $this->input->post('procesar');
        $this->especial01 = $this->input->post('especial01');
        $this->especial02 = $this->input->post('especial02');
        $this->usuario = $this->session->coduser;
        $this->fecmod = date('Y-m-d H:i:s', now('America/Lima'));
    }

    protected function _obtener_id() {
        return array(
            'codsis' => $this->input->post('codsis'),
            'cod_sisgrupo' => $this->input->post('cod_sisgrupo'),
            'cod_menu' => $this->input->post('cod_menu')
        );
    }

}
