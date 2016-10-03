<?php defined('BASEPATH') OR exit('No direct script access allowed');

include_once('CrudController.php');

/**
 * La clase Empresa controla peticiones relacionadas con la obtención y mantenimiento
 * de la información de las empresas.
 *
 * @author Jonathan Muñoz Aleman
 * @copyright (c) 2016, Jonathan Muñoz Aleman
 * @see CrudController
 * @since 1.0
 */
class Empresa extends CrudController {
    
    /**
     * Constructor. Carga el modelo de acceso a datos para las localidades, necesario
     * para almacenar en la sesión la localidad seleccionada por el usuario.
     */
    public function __construct() {
        parent::__construct('empresa_model');
        $this->load->model('localidad_model', 'localidad');
    }
    
    /**
     * Carga y devuelve la vista de mantenimiento de empresas.
     */
    public function index() {
        $this->load->view('configuracion/empresa_view');
    }
    
    /**
     * Responde con las empresas a las que tiene acceso el usuario que ha iniciado sesión
     * para el sistema que ha seleccionado. La lista se envía en formato JSON.
     */
    public function obtenerPorSesion() {
        if (!isset($this->session->coduser)) {
            log_message('info', 'Ningun usuario ha iniciado sesion aun.');
            show_error('Ningun usuario ha iniciado sesion aun', 500);
        }
        
        if (!isset($this->session->codsis)) {
            log_message('info', 'Todavia no se ha seleccionado ningun sistema.');
            show_error('Todavia no se ha seleccionado ningun sistema.', 500);
        }
        
        $empresas = $this->modelo->obtener_x_usuario_y_sistema(
                $this->session->coduser, $this->session->codsis);
        
        $salida = json_encode($empresas);
        $this->output->set_content_type('application/json')->set_output($salida);
    }
    
    /**
     * Responde con las empresas a las que tiene acceso el usuario que ha iniciado sesión
     * para el sistema cuyo código ha sido enviado como parámetro GET. La lista se envía 
     * en formato JSON.
     */
    public function obtenerPorSistema() {
        $codsis = $this->input->get('codsis');
        
        if (!isset($this->session->coduser)) {
            log_message('info', 'Ningun usuario ha iniciado sesion aun.');
            show_error('Ningun usuario ha iniciado sesion aun', 500);
        }
        
        if (!isset($codsis)) {
            log_message('info', 'No se ha especificado el código del sistema.');
            show_error('No se ha especificado el código del sistema.', 500);
        }
        
        $empresas = $this->modelo->obtener_x_usuario_y_sistema($this->session->coduser, $codsis);
        
        $salida = json_encode($empresas);
        $this->output->set_content_type('application/json')->set_output($salida);
    }
    
    /**
     * Almacena en la sesión la empresa y la localidad seleccionadas. Los datos que 
     * se guardan son los siguientes:
     * 
     *  - El código, nombre y RUC de la empresa
     *  - El codigo y nombre de la localidad
     * 
     * Se responde con un estado y un mensaje en formato JSON, indicando si hubo algún 
     * inconveniente.
     */
    public function recordar() {
        $empresa = $this->modelo->obtener();
        
        if (isset($empresa)) {
            $localidad = $this->localidad->obtener();
            
            if (isset($localidad)) {
                $this->_recordar($empresa, $localidad);
                $estado = 'success';
                $mensaje = 'Se ha conseguido almacenar la empresa y localidad seleccionadas en la sesion.';
            } else {
                $estado = 'warning';
                $mensaje = 'No se ha podido encontrar los datos de la localidad seleccionada.';
            }
        } else {
            $estado = 'warning';
            $mensaje = 'No se ha podido encontrar los datos de la empresa seleccionada.';
        }
        
        log_message('info', $mensaje);
        
        $this->output->set_content_type('application/json')
                ->set_output(json_encode(array('estado' => $estado, 'mensaje' => $mensaje)));
    }
    
    private function _recordar($empresa, $localidad) {
        $this->session->set_userdata('codemp', $empresa->codemp);
        $this->session->set_userdata('nomemp', $empresa->nomemp);
        $this->session->set_userdata('rucemp', $empresa->ruc);
        $this->session->set_userdata('codloc', $localidad->codloc);
        $this->session->set_userdata('nomloc', $localidad->nomloc);
    }
    
}
