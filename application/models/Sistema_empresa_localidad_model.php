<?php defined('BASEPATH') OR exit('No direct script access allowed');

include_once('Abstract_model.php');

/**
 * Description of Sistema_empresa_localidad_model
 *
 * @author Jonathan Munoz
 */
class Sistema_empresa_localidad_model extends Abstract_model {
    
    public $codsis;
    public $codemp;
    public $codloc;
    public $estado;
    public $anio;
    public $mes;
    public $fectra_inicial;
    public $fectra_final;
    public $controldia;
    public $diferente_detalle;
    public $usuario;
    public $nombrepc;
    public $fechamodificacion;
    public $flag_niveles;
    
    public function __construct() {
        parent::__construct('pub_sistema_empresa_localidad');
    }
    
    public function obtener_x_sistema($sistema) {
        return $this->db->get_where('pub_sistema_empresa_localidad', 
                array('codsis' => $sistema))->result();
    }

    protected function _establecer_campos($accion) {
        $this->codsis = $this->input->post('codsis');
        $this->codemp = $this->input->post('codemp');
        $this->codloc = $this->input->post('codloc');
        $this->estado = $this->input->post('estado');
        $this->anio = $this->input->post('anio');
        $this->mes = $this->input->post('mes');
        $this->fectra_inicial = (new DateTime($this->input->post('fectra_inicial')))->format('Y-m-d');
        $this->fectra_final = (new DateTime($this->input->post('fectra_final')))->format('Y-m-d');
        $this->controldia = $this->input->post('controldia');
        $this->diferente_detalle = $this->input->post('diferente_detalle');
        $this->usuario = $this->session->coduser;
        $this->fechamodificacion = date('Y-m-d H:i:s', now('America/Lima'));
        $this->flag_niveles = $this->input->post('flag_niveles');
    }

    protected function _obtener_id() {
        return array(
            'codsis' => $this->input->post('codsis'),
            'codemp' => $this->input->post('codemp'),
            'codloc' => $this->input->post('codloc')
        );
    }

}
