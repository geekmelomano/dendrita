<?php defined('BASEPATH') OR exit('No direct script access allowed');

include_once('CrudController.php');

/**
 * La clase Sistemagrupomenu controla peticiones relacionadas con la obtención y 
 * mantenimiento de los menús asignados a los grupos o perfiles de sistemas.
 *
 * @author Jonathan Muñoz Aleman
 * @copyright (c) 2016, Jonathan Muñoz Aleman
 * @see CrudController
 * @since 1.0
 */
class Sistemagrupomenu extends CrudController {
    
    public function __construct() {
        parent::__construct('sistema_grupo_menu_model');
    }
    
    /**
     * Obtiene los menús asignados al grupo o perfil identificado con el código enviado 
     * como parámetro HTTP, y responde con la lista en formato JSON. Si se incluye el 
     * código del menú superior, se devolverán sus submenús; de lo contrario, se devolverán
     * los menús raíz.
     */
    public function obtenerPorGrupoYPadre() {
        $codsis = $this->input->get('codsis');
        
        if (!isset($codsis)) {
            log_message('info', 'No se ha especificado el código del sistema');
            show_error('No se ha especificado el código del sistema', 500);
        }
        
        $codsisgrupo = $this->input->get('cod_sisgrupo');
        
        if (!isset($codsisgrupo)) {
            log_message('info', 'No se ha especificado el código del grupo o perfil');
            show_error('No se ha especificado el código del grupo o perfil', 500);
        }
        
        $codmenu = $this->input->get('cod_menu');
        $menus = $this->modelo->obtener_x_grupo_y_padre($codsis, $codsisgrupo, $codmenu);
        $salida = json_encode($menus);
        $this->output->set_content_type('application/json')->set_output($salida);
    }
    
}
