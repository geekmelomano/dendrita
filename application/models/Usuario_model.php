<?php defined('BASEPATH') OR exit('No direct script access allowed');

include_once('Abstract_model.php');

/**
 * Description of Usuario_model
 *
 * @author Jonathan Munoz
 */
class Usuario_model extends Abstract_model {
    
    public $cod_usuario;
    public $nom_usuario;
    public $cargo;
    public $area;
    public $dni;
    public $estado;
    public $usuario;
    public $nombrepc;
    public $fechamodificacion;
    public $clave;
    public $carpeta_files;
    public $tipo_usuario;
    public $clave1;
    public $fec_creacion;
    public $fec_cambio_clave;
    public $fec_expira_clave;
    public $fec_baja;
    public $impresora;
    public $impresora2;
    public $firma;
    
    public function __construct() {
        parent::__construct('pub_usuarios');
    }

    protected function _establecer_campos($accion) {
        $this->cod_usuario = $this->input->post('cod_usuario');
        $this->nom_usuario = $this->input->post('nom_usuario');
        $this->cargo = $this->input->post('cargo');
        $this->area = $this->input->post('area');
        $this->dni = $this->input->post('dni');
        $this->estado = $this->input->post('estado');
        $this->clave1 = $this->input->post('clave1');
        $this->carpeta_files = $this->input->post('carpeta_files');
        $this->tipo_usuario = $this->input->post('tipo_usuario');
        $this->fec_cambio_clave = $this->input->post('fec_cambio_clave');
        $this->fec_expira_clave = $this->input->post('fec_expira_clave');
        $this->fec_baja = $this->input->post('fec_baja');
        $this->impresora = $this->input->post('impresora');
        $this->impresora2 = $this->input->post('impresora2');
        $this->firma = $this->input->post('firma');
        $this->usuario = $this->session->coduser;
        $this->fechamodificacion = date('Y-m-d H:i:s', now('America/Lima'));
        
        if ($accion == 'C') {
            $this->fec_creacion = date('Y-m-d H:i:s', now('America/Lima'));
        }
    }

    protected function _obtener_id() {
        return array('cod_usuario' => $this->input->post('cod_usuario'));
    }

}
