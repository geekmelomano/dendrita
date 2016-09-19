<?php defined('BASEPATH') OR exit('No direct script access allowed');

include_once('CrudController.php');

/**
 * La clase Sistemaempresalocalidad controla peticiones relacionadas con la obtención 
 * y mantenimiento de las empresas y localidades asignadas a los sistemas.
 *
 * @author Jonathan Muñoz Aleman
 * @copyright (c) 2016, Jonathan Muñoz Aleman
 * @see CrudController
 * @since 1.0
 */
class Sistemaempresalocalidad extends CrudController {
    
    public function __construct() {
        parent::__construct('sistema_empresa_localidad_model');
    }
    
    /**
     * Carga la vista de mantenimiento que utiliza grids.
     */
    public function index() {
        $this->load->view('gridcrud', array(
            'grid' => 'gridSistemasEmpresas', 'funcion' => 'iniciarConfSistemasEmpresas'
        ));
    }
    
    /**
     * Obtiene las empresas y localidades asignadas al sistema identificado con el 
     * código enviado como parámetro HTTP, y responde con la lista en formato JSON.
     */
    public function obtenerPorSistema() {
        $codsis = $this->input->get('codsis');
        
        if (!isset($codsis)) {
            log_message('info', 'No se ha especificado el código del sistema');
            show_error('No se ha especificado el código del sistema', 500);
        }
        
        $sistemas_emprloc = $this->modelo->obtener_x_sistema($codsis);
        $salida = json_encode($sistemas_emprloc);
        $this->output->set_content_type('application/json')->set_output($salida);
    }
    
}
