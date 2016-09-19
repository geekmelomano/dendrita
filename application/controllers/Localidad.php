<?php defined('BASEPATH') OR exit('No direct script access allowed');

include_once('CrudController.php');

/**
 * La clase Localidad controla peticiones relacionadas con la obtención y mantenimiento
 * de la información de las localidades.
 *
 * @author Jonathan Muñoz Aleman
 * @copyright (c) 2016, Jonathan Muñoz Aleman
 * @see CrudController
 * @since 1.0
 */
class Localidad extends CrudController {
    
    public function __construct() {
        parent::__construct('localidad_model');
    }
    
    /**
     * Carga la vista de mantenimiento que utiliza una grilla.
     */
    public function index() {
        $this->load->view('gridcrud', array('grid' => 'gridLocales', 'funcion' => 'iniciarConfLocales'));
    }
    
    /**
     * Responde con las localidades a las que tiene acceso el usuario que ha iniciado sesión
     * para el sistema y empresa que ha seleccionado. El código de la empresa se obtiene
     * desde el parámetro HTTP "filter" enviado por el widget KendoDropDownList; el código 
     * del sistema se obtiene desde la sesión. La lista se envía en formato JSON.
     */
    public function obtenerPorEmpresa() {
        $filtro = $this->input->get('filter');
        
        if (!isset($filtro)) {
            log_message('info', 'No se ha especificado ninguna empresa.');
            show_error('No se ha especificado ninguna empresa', 500);
        }
        
        if (!isset($this->session->coduser)) {
            log_message('info', 'Ningun usuario ha iniciado sesion aun.');
            show_error('Ningun usuario ha iniciado sesion aun', 500);
        }
        
        if (!isset($this->session->codsis)) {
            log_message('info', 'Todavia no se ha seleccionado ningun sistema.');
            show_error('Todavia no se ha seleccionado ningun sistema.', 500);
        }
        
        $codemp = $filtro['filters'][0]['value'];
        
        $locales = $this->modelo->obtener_x_usuario_sistema_y_empresa(
                $this->session->coduser, $this->session->codsis, $codemp);
        
        $salida = json_encode($locales);
        $this->output->set_content_type('application/json')->set_output($salida);
    }
    
    /**
     * Responde con las localidades a las que tiene acceso el usuario que ha iniciado sesión
     * para el sistema y empresa cuyos códigos han sido enviados como parámetros HTTP. La lista 
     * se envía en formato JSON.
     */
    public function obtenerPorSistemaYEmpresa() {
        if (!isset($this->session->coduser)) {
            log_message('info', 'Ningun usuario ha iniciado sesion aun.');
            show_error('Ningun usuario ha iniciado sesion aun', 500);
        }
        
        $codsis = $this->input->get('codsis');
        
        if (!isset($codsis)) {
            log_message('info', 'No se ha especificado ningún sistema.');
            show_error('No se ha especificado ningún sistema.', 500);
        }
        
        $codemp = $this->input->get('codemp');
        
        if (!isset($codemp)) {
            log_message('info', 'No se ha especificado ninguna empresa.');
            show_error('No se ha especificado ninguna empresa', 500);
        }
        
        $locales = $this->modelo->obtener_x_usuario_sistema_y_empresa($this->session->coduser, $codsis, $codemp);
        
        $salida = json_encode($locales);
        $this->output->set_content_type('application/json')->set_output($salida);
    }
    
}
