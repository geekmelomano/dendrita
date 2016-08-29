<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Empresa
 *
 * @author Jonathan Munoz
 */
class Empresa extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('empresa_model');
        $this->load->model('localidad_model');
    }
    
    public function index() {
        $this->load->view('configuracion/empresa_view');
    }
    
    public function obtener() {
        $empresas = json_encode($this->empresa_model->obtener_todos());
        $this->output->set_content_type('application/json')->set_output($empresas);
    }
    
    public function crear() {
        $this->empresa_model->crear();
        $empresa = json_encode($this->input->post());
        $this->output->set_content_type('application/json')->set_output($empresa);
    }
    
    public function editar() {
        $this->empresa_model->editar();
        $empresa = json_encode($this->input->post());
        $this->output->set_content_type('application/json')->set_output($empresa);
    }
    
    public function eliminar() {
        $this->empresa_model->eliminar();
        $empresa = json_encode($this->input->post());
        $this->output->set_content_type('application/json')->set_output($empresa);
    }
    
    public function obtenerPorSesion() {
        if (!isset($this->session->coduser)) {
            log_message('info', 'Ningun usuario ha iniciado sesion aun.');
            show_error('Ningun usuario ha iniciado sesion aun', 500);
        }
        
        if (!isset($this->session->codsis)) {
            log_message('info', 'Todavia no se ha seleccionado ningun sistema.');
            show_error('Todavia no se ha seleccionado ningun sistema.', 500);
        }
        
        $empresas = $this->empresa_model->obtener_x_usuario_y_sistema($this->session->coduser, 
                $this->session->codsis);
        $this->output->set_content_type('application/json')->set_output(json_encode($empresas));
    }
    
    public function recordar() {
        $empresa = $this->empresa_model->obtener();
        
        if (isset($empresa)) {
            $localidad = $this->localidad_model->obtener();
            
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
            $mensaje = 'No se ha podido encontrar los datos de la empresa seleccionado.';
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
