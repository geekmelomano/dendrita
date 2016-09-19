<?php defined('BASEPATH') OR exit('No direct script access allowed');

include_once('Abstract_model.php');

/**
 * La clase Grupo_empresa_model representa el modelo de datos de la tabla PUB_GRUPO_EMPRESA.
 * Cada registro representa un grupo empresarial, que puede tener más de una empresa.
 *
 * @author Jonathan Muñoz Aleman
 * @copyright (c) 2016, Jonathan Muñoz Aleman
 * @see Abstract_model
 * @since 1.0
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

    /**
     * Devuelve el código del grupo empresarial enviado como parámetro HTTP con el 
     * método POST.
     * 
     * @return array Un arreglo que contiene el código del grupo empresarial.
     */
    protected function _obtener_id() {
        return array('cod_empresa_grupo' => $this->input->post('cod_empresa_grupo'));
    }

}
