<?php defined('BASEPATH') OR exit('No direct script access allowed');

include_once('Abstract_model.php');

/**
 * La clase Sistema_menu_model representa el modelo de datos de la tabla PUB_SISTEMAS_MENUS. 
 * Cada registro representa una opción de menú para un sistema específico. Los menús
 * pueden ser anidados con una referencia al menú superior o padre.
 *
 * @author Jonathan Muñoz Aleman
 * @copyright (c) 2016, Jonathan Muñoz Aleman
 * @see Abstract_model
 * @since 1.0
 */
class Sistema_menu_model extends Abstract_model {
    
    public $codsis;
    public $cod_menu;
    public $nom_menu;
    public $cod_menu_padre;
    public $usuario;
    public $nombrepc;
    public $fechamodificacion;

    public function __construct() {
        parent::__construct('pub_sistemas_menus');
    }
    
    /**
     * Devuelve los menús que se encuentran en el siguiente nivel del menú especificado,
     * para el sistema especificado.
     * 
     * @param string $codsis El código del sistema
     * @param string $cod_menu_padre El código del menú superior o padre.
     * @return array La lista de menús
     */
    public function obtener_x_padre($codsis, $cod_menu_padre) {
        return $this->db->get_where('pub_sistemas_menus', array(
            'codsis' => $codsis, 'cod_menu_padre' => $cod_menu_padre))->result();
    }
    
    protected function _establecer_campos($accion) {
        
    }

    protected function _obtener_id() {
        
    }

}
