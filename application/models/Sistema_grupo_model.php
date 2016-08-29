<?php defined('BASEPATH') OR exit('No direct script access allowed');

include_once('Abstract_model.php');

/**
 * Description of Sistema_grupo_model
 *
 * @author Jonathan Munoz
 */
class Sistema_grupo_model extends Abstract_model {
    
    public $cod_sisgrupo;
    public $codsis;
    public $nom_sisgrupo;
    public $observacion;
    public $usuario;
    public $nombrepc;
    public $fechamodificacion;

    public function __construct() {
        parent::__construct('pub_sistemas_grupos');
    }
    
    public function obtener_x_sistema($sistema) {
        return $this->db->get_where('pub_sistemas_grupos', array('codsis' => $sistema))->result();
    }
    
    protected function _establecer_campos($accion) {
        $this->cod_sisgrupo = $this->input->post('cod_sisgrupo');
        $this->codsis = $this->input->post('codsis');
        $this->nom_sisgrupo = $this->input->post('nom_sisgrupo');
        $this->observacion = $this->input->post('observacion');
        $this->usuario = $this->session->coduser;
        $this->fechamodificacion = date('Y-m-d H:i:s', now('America/Lima'));
    }

    protected function _obtener_id() {
        return array('cod_sisgrupo' => $this->input->post('cod_sisgrupo'));
    }

}
