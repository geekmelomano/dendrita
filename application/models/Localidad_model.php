<?php defined('BASEPATH') OR exit('No direct script access allowed');

include_once('Abstract_model.php');

/**
 * Description of Localidad_model
 *
 * @author Jonathan Munoz
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
     * Devuelve la lista de locales a los que tiene acceso el usuario para el 
     * sistema y empresa especificados.
     * @param type $usuario Codigo del usuario
     * @param type $sistema Codigo del sistema
     * @param type $empresa Codigo de la empresa
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

    protected function _obtener_id() {
        return array('codloc' => $this->input->post('codloc'));
    }

}
