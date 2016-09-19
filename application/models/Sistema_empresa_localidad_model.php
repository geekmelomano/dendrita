<?php defined('BASEPATH') OR exit('No direct script access allowed');

include_once('Abstract_model.php');

/**
 * La clase Sistema_empresa_localidad_model representa el modelo de datos de la tabla 
 * PUB_SISTEMA_EMPRESA_LOCALIDAD. Cada registro representa una combinación de empresa
 * y localidad asignados a un sistema específico.
 *
 * @author Jonathan Muñoz Aleman
 * @copyright (c) 2016, Jonathan Muñoz Aleman
 * @see Abstract_model
 * @since 1.0
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
    
    /**
     * Devuelve la lista de empresas y localidades asignadas al sistema especificado.
     * 
     * @param string $sistema El código del sistema.
     * @return array La lista de empresas y localidades asignadas al sistema.
     */
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

    /**
     * Devuelve los datos de la clave primaria, la cual está compuesta por:
     *  - El código del sistema
     *  - El código de la empresa
     *  - El código de la localidad
     * 
     * @return array Los datos de la clave primaria.
     */
    protected function _obtener_id() {
        return array(
            'codsis' => $this->input->post('codsis'),
            'codemp' => $this->input->post('codemp'),
            'codloc' => $this->input->post('codloc')
        );
    }

}
