<?php defined('BASEPATH') OR exit('No direct script access allowed');

include_once('Abstract_model.php');

/**
 * La clase Sistema_model representa el modelo de datos de la tabla PUB_SISTEMAS. 
 * Cada registro representa un sistema del ERP.
 *
 * @author Jonathan Muñoz Aleman
 * @copyright (c) 2016, Jonathan Muñoz Aleman
 * @see Abstract_model
 * @since 1.0
 */
class Sistema_model extends Abstract_model {
    
    public $codsis;
    public $nomsis;
    public $nom_basedato;
    public $nom_servidor;
    public $cod_acceso;
    public $imagen;
    public $ventana;
    public $menu;
    public $estado;
    public $usuario;
    public $nombrepc;
    public $fechamodificacion;

    public function __construct() {
        parent::__construct('pub_sistemas');
    }
    
    /**
     * Devuelve la lista de sistemas a los que tiene acceso el usuario especificado.
     * 
     * @param string $usuario El código del usuario
     * @return array La lista de sistemas.
     */
    public function obtener_x_usuario($usuario) {
        return $this->db->query('CALL seg_lista_sistema_usuario(?)', $usuario)->result();
    }
    
    protected function _establecer_campos($accion) {
        $this->codsis = $this->input->post('codsis');
        $this->nomsis = $this->input->post('nomsis');
        $this->nom_basedato = $this->input->post('nom_basedato');
        $this->nom_servidor = $this->input->post('nom_servidor');
        $this->cod_acceso = $this->input->post('cod_acceso');
        $this->imagen = $this->input->post('imagen');
        $this->ventana = $this->input->post('ventana');
        $this->menu = $this->input->post('menu');
        $this->estado = $this->input->post('estado');
        $this->usuario = $this->session->coduser;
        $this->fechamodificacion = date('Y-m-d H:i:s', now('America/Lima'));
    }

    /**
     * Devuelve el código del sistema enviado como parámetro HTTP con el método POST.
     * 
     * @return array Un arreglo que contiene el código del sistema.
     */
    protected function _obtener_id() {
        return array('codsis' => $this->input->post('codsis'));
    }

}
