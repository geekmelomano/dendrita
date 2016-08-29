<?php defined('BASEPATH') OR exit('No direct script access allowed');

include_once('Abstract_model.php');

/**
 * Description of Reglaacceso_empresa_model
 *
 * @author Jonathan Munoz
 */
class Reglaacceso_empresa_model extends Abstract_model {
    
    public $cod_regla;
    public $codsis;
    public $nom_regla;
    public $observacion;
    public $usuario;
    public $nombrepc;
    public $fechamodificacion;

    public function __construct() {
        parent::__construct('pub_reglaacceso_empresa');
    }
    
    public function obtener_x_sistema($sistema) {
        return $this->db->get_where('pub_reglaacceso_empresa', array('codsis' => $sistema))->result();
    }
    
    protected function _establecer_campos($accion) {
        $this->cod_regla = $this->input->post('cod_regla');
        $this->codsis = $this->input->post('codsis');
        $this->nom_regla = $this->input->post('nom_regla');
        $this->observacion = $this->input->post('observacion');
        $this->usuario = $this->session->coduser;
        $this->fechamodificacion = date('Y-m-d H:i:s', now('America/Lima'));
    }

    protected function _obtener_id() {
        return array('cod_regla' => $this->input->post('cod_regla'));
    }

}
