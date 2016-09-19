<?php defined('BASEPATH') OR exit('No direct script access allowed');

include_once('CrudController.php');

/**
 * La clase Sistema controla peticiones relacionadas con la obtención y mantenimiento 
 * de la información de los sistemas.
 *
 * @author Jonathan Muñoz Aleman
 * @copyright (c) 2016, Jonathan Muñoz Aleman
 * @see CrudController
 * @since 1.0
 */
class Sistema extends CrudController {
    
    public function __construct() {
        parent::__construct('sistema_model');
    }
    
    /**
     * Carga la vista de detalle de grilla.
     */
    public function index() {
        $this->load->view('gridcruddet', array(
            'titulo' => 'GESTION DE SISTEMAS',
            'nombre' => 'Sistemas',
            'subtitulo' => 'Empresas y Localidades asignados a <strong>#: nomsis #</strong>:',
            'nombre_det' => 'SistemasEmpresas'
        ));
    }
    
    /**
     * Obtiene los sistemas a los que tiene acceso el usuario que ha iniciado sesión
     * y devuelve la lista en formato JSON.
     */
    public function obtenerPorSesion() {
        if (isset($this->session->coduser)) {
            $sistemas = $this->modelo->obtener_x_usuario($this->session->coduser);
            $salida = json_encode($sistemas);
            $this->output->set_content_type('application/json')->set_output($salida);
        } else {
            log_message('info', 'Ningun usuario ha iniciado sesion todavía.');
            show_error('Ningun usuario ha iniciado sesion todavía', 500);
        }
    }
    
    /**
     * Almacena en la sesión el código y el nombre del sistema seleccionado por el usuario.
     */
    public function recordar() {
        $datos = json_decode(file_get_contents('php://input'));
        $sistema = $this->modelo->obtener_x_id(array('codsis' => $datos->codsis));
        
        if (isset($sistema)) {
            $this->session->set_userdata('codsis', $sistema->codsis);
            $this->session->set_userdata('nomsis', $sistema->nomsis);
            $estado = 'success';
            $mensaje = 'Se ha conseguido almacenar el sistema seleccionado en la sesion.';
        } else {
            $estado = 'warning';
            $mensaje = 'No se ha podido encontrar los datos del sistema seleccionado.';
        }
        
        log_message('info', $mensaje);
        
        $this->output->set_content_type('application/json')
                ->set_output(json_encode(array('estado' => $estado, 'mensaje' => $mensaje)));
    }
    
}
