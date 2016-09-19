<?php defined('BASEPATH') OR exit('No direct script access allowed');

include_once('Abstract_model.php');

/**
 * La clase Reglaacceso_empresa_model representa el modelo de datos de la tabla 
 * PUB_REGLAACCESO_EMPRESA. Cada registro representa una regla de acceso para un
 * sistema específico, la cual es puede ser asignada a los usuarios del ERP.
 *
 * @author Jonathan Muñoz Aleman
 * @copyright (c) 2016, Jonathan Muñoz Aleman
 * @see Abstract_model
 * @since 1.0
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
    
    /**
     * Devuelve la lista de reglas de acceso registradas para el sistema especificado.
     * 
     * @param string $sistema El código del sistema
     * @return array La lista de reglas de acceso.
     */
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

    /**
     * Devuelve el código de regla de acceso enviado como parámetro HTTP con el método
     * POST.
     * 
     * @return array Un arreglo que contiene el código de la regla de acceso.
     */
    protected function _obtener_id() {
        return array('cod_regla' => $this->input->post('cod_regla'));
    }

}
