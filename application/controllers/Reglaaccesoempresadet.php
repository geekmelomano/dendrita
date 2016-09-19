<?php defined('BASEPATH') OR exit('No direct script access allowed');

include_once('CrudController.php');

/**
 * La clase Reglaaccesoempresadet controla peticiones relacionadas con la obtención y 
 * mantenimiento de la información de las empresas y localidades asignadas a las reglas 
 * de acceso de los sistemas.
 *
 * @author Jonathan Muñoz Aleman
 * @copyright (c) 2016, Jonathan Muñoz Aleman
 * @see CrudController
 * @since 1.0
 */
class Reglaaccesoempresadet extends CrudController {
    
    public function __construct() {
        parent::__construct('reglaacceso_empresa_det_model');
    }
    
    /**
     * Obtiene las empresas y localidades de la regla de acceso identificada con el 
     * código enviado como parámetro HTTP, y responde con la lista en formato JSON.
     */
    public function obtenerPorReglaYSistema() {
        $codsistema = $this->input->get('codsis');
        
        if (!isset($codsistema)) {
            log_message('info', 'No se ha especificado el código del sistema');
            show_error('No se ha especificado el código del sistema', 500);
        }
        
        $codregla = $this->input->get('cod_regla');
        
        if (!isset($codregla)) {
            log_message('info', 'No se ha especificado el código de la regla de acceso');
            show_error('No se ha especificado el código de la regla de acceso', 500);
        }
        
        $reglas = $this->modelo->obtener_x_regla_y_sistema($codregla, $codsistema);
        $salida = json_encode($reglas);
        $this->output->set_content_type('application/json')->set_output($salida);
    }
    
}
