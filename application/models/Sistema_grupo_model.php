<?php defined('BASEPATH') OR exit('No direct script access allowed');

include_once('Abstract_model.php');

/**
 * La clase Sistema_grupo_model representa el modelo de datos de la tabla PUB_SISTEMAS_GRUPOS. 
 * Cada registro representa un grupo o perfil en un sistema específico, los cuales son
 * asignados a los usuarios del ERP.
 *
 * @author Jonathan Muñoz Aleman
 * @copyright (c) 2016, Jonathan Muñoz Aleman
 * @see Abstract_model
 * @since 1.0
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
    
    /**
     * Devuelve los grupos o perfiles registrados para el sistema especificado.
     * 
     * @param string $sistema El código del sistema
     * @return array La lista de grupos o perfiles.
     */
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

    /**
     * Devuelve el código de grupo o perfil enviado como parámetro HTTP con el método
     * POST.
     * 
     * @return array Un arreglo que contiene el código del grupo o perfil.
     */
    protected function _obtener_id() {
        return array('cod_sisgrupo' => $this->input->post('cod_sisgrupo'));
    }

}
