<?php defined('BASEPATH') OR exit('No direct script access allowed');

include_once('Abstract_model.php');

/**
 * Description of Reglaacceso_empresa_det_model
 *
 * @author Jonathan Munoz
 */
class Reglaacceso_empresa_det_model extends Abstract_model {
    
    public $cod_regla;
    public $codsis;
    public $codemp;
    public $codloc;
    public $usuario;
    public $nombrepc;
    public $fechamodificacion;
    
    public function __construct() {
        parent::__construct('pub_reglaacceso_empresa_det');
    }
    
    public function obtener_x_regla_y_sistema($regla, $sistema) {
        return $this->db->get_where('pub_reglaacceso_empresa_det', 
                array('cod_regla' => $regla, 'codsis' => $sistema))->result();
    }

    protected function _establecer_campos($accion) {
        $this->cod_regla = $this->input->post('cod_regla');
        $this->codsis = $this->input->post('codsis');
        $this->codemp = $this->input->post('codemp');
        $this->codloc = $this->input->post('codloc');
        $this->usuario = $this->session->coduser;
        $this->fechamodificacion = date('Y-m-d H:i:s', now('America/Lima'));
    }

    protected function _obtener_id() {
        return array(
            'cod_regla' => $this->input->post('cod_regla'),
            'codsis' => $this->input->post('codsis'),
            'codemp' => $this->input->post('codemp'),
            'codloc' => $this->input->post('codloc')
        );
    }

}
