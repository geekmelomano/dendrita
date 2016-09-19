<?php defined('BASEPATH') OR exit('No direct script access allowed');

include_once('Abstract_model.php');

/**
 * La clase Reglaacceso_empresa_det_model representa el modelo de datos de la tabla 
 * PUB_REGLAACCESO_EMPRESA_DET. Cada registro representa una combinación de empresa 
 * y localidad a las que se puede acceder a través de una regla de acceso específica,
 * para un sistema específico.
 *
 * @author Jonathan Muñoz Aleman
 * @copyright (c) 2016, Jonathan Muñoz Aleman
 * @see Abstract_model
 * @since 1.0
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
    
    /**
     * Devuelve la lista de empresas y localidades a los que se puede acceder con la
     * regla de acceso especificada, para el sistema indicado.
     * 
     * @param string $regla Código de la regla de acceso.
     * @param string $sistema Código del sistema
     * @return array La lista de empresas y localidades a los que se puede acceder.
     */
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

    /**
     * Devuelve los datos de la clave primaria, la cual está compuesta por:
     *  - El código de la regla de acceso
     *  - El código del sistema
     *  - El código de la empresa
     *  - El código de la localidad
     * 
     * @return array Los datos de la clave primaria.
     */
    protected function _obtener_id() {
        return array(
            'cod_regla' => $this->input->post('cod_regla'),
            'codsis' => $this->input->post('codsis'),
            'codemp' => $this->input->post('codemp'),
            'codloc' => $this->input->post('codloc')
        );
    }

}
