<?php defined('BASEPATH') OR exit('No direct script access allowed');

include_once('Abstract_model.php');

/**
 * Description of Grupo_empresa_model
 *
 * @author Jonathan Munoz
 */
class Grupo_empresa_model extends Abstract_model {
    
    public $cod_empresa_grupo;
    public $nom_empresa_grupo;
    public $observacion;
    public $usuario;
    public $nombrepc;
    public $fechamodificacion;
    
    public function __construct() {
        parent::__construct('pub_grupo_empresa');
    }

    protected function _establecer_campos($accion) {
        $this->cod_empresa_grupo = $this->input->post('cod_empresa_grupo');
        $this->nom_empresa_grupo = $this->input->post('nom_empresa_grupo');
        $this->observacion = $this->input->post('observacion');
        $this->usuario = $this->session->coduser;
        $this->fechamodificacion = date('Y-m-d H:i:s', now('America/Lima'));
    }

    protected function _obtener_id() {
        return array('cod_empresa_grupo' => $this->input->post('cod_empresa_grupo'));
    }

}
