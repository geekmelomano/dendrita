<?php defined('BASEPATH') OR exit('No direct script access allowed');

include_once('CrudController.php');

/**
 * La clase Reglaaccesoempresa controla peticiones relacionadas con la obtención y 
 * mantenimiento de la información de las reglas de acceso.
 *
 * @author Jonathan Muñoz Aleman
 * @copyright (c) 2016, Jonathan Muñoz Aleman
 * @see CrudController
 * @since 1.0
 */
class Reglaaccesoempresa extends CrudController {
    
    public function __construct() {
        parent::__construct('reglaacceso_empresa_model');
    }
    
    /**
     * Carga la vista de detalle de grilla.
     */
    public function index() {
        $this->load->view('gridcruddet', array(
            'nombre' => 'ReglasAcceso',
            'subtitulo' => 'Empresas y Localidades para la Regla <strong>#: nom_regla #</strong>',
            'nombre_det' => 'ReglasAccesoDet'
        ));
    }
    
    /**
     * Obtiene las reglas de acceso del sistema identificado con el código enviado como
     * parámetro HTTP, y responde con la lista en formato JSON.
     */
    public function obtenerPorSistema() {
        $sistema = $this->input->get('codsis');
        
        if (!isset($sistema)) {
            log_message('info', 'No se ha especificado el código del sistema');
            show_error('No se ha especificado el código del sistema', 500);
        }
        
        $reglas = $this->modelo->obtener_x_sistema($sistema);
        $salida = json_encode($reglas);
        $this->output->set_content_type('application/json')->set_output($salida);
    }
    
}
