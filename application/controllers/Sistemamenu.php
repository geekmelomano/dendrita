<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * La clase Sistemamenu controla peticiones relacionadas con la obtención y 
 * mantenimiento de los menús de los sistemas.
 *
 * @author Jonathan Muñoz Aleman
 * @copyright (c) 2016, Jonathan Muñoz Aleman
 * @since 1.0
 */
class Sistemamenu extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('sistema_menu_model', 'modelo');
    }
    
    /**
     * Obtiene los menús para el sistema identificado con el código enviado como parámetro 
     * HTTP, y responde con la lista en formato JSON. Si se incluye el código del menú superior, 
     * se devolverán sus submenús; de lo contrario, se devolverán los menús raíz.
     */
    public function obtenerPorPadre() {
        $codsis = $this->input->get('codsis');
        $codmenu = $this->input->get('cod_menu');
        $menus = json_encode($this->modelo->obtener_x_padre($codsis, $codmenu));
        $this->output->set_content_type('application/json')->set_output($menus);
    }
    
}
