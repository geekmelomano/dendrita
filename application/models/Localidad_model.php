<?php defined('BASEPATH') OR exit('No direct script access allowed');

include_once('Abstract_model.php');

/**
 * La clase Localidad_model representa el modelo de datos de la tabla PUB_LOCALIDAD.
 * Cada registro representa una localidad donde se gestiona la contabilidad de una empresa.
 *
 * @author Jonathan Muñoz Aleman
 * @copyright (c) 2016, Jonathan Muñoz Aleman
 * @see Abstract_model
 * @since 1.0
 */
class Localidad_model extends Abstract_model {
    
    public $codloc;
    public $nomloc;
    public $ubigeo;
    public $usuario;
    public $nombrepc;
    public $fechamodificacion;

    public function __construct() {
        parent::__construct('pub_localidad');
    }
    
    /**
     * Devuelve la lista de localidades a los que tiene acceso el usuario para el 
     * sistema y empresa especificados.
     * 
     * @param type $usuario Codigo del usuario
     * @param type $sistema Codigo del sistema
     * @param type $empresa Codigo de la empresa
     * @return array La lista de localidades.
     */
    public function obtener_x_usuario_sistema_y_empresa($usuario, $sistema, $empresa) {
        return $this->db->query('CALL seg_lista_loc_emp_sistema_usu(?, ?, ?)', 
                array($usuario, $sistema, $empresa))->result();
    }
    
    protected function _establecer_campos($accion) {
        $this->codloc = $this->input->post('codloc');
        $this->nomloc = $this->input->post('nomloc');
        $this->ubigeo = $this->input->post('ubigeo');
        $this->usuario = $this->session->coduser;
        $this->fechamodificacion = date('Y-m-d H:i:s', now('America/Lima'));
    }

    /**
     * Devuelve el código de la localidad enviado como parámetro HTTP con el método
     * POST.
     * 
     * @return array Un arreglo que contiene el código de la localidad.
     */
    protected function _obtener_id() {
        return array('codloc' => $this->input->post('codloc'));
    }

}
