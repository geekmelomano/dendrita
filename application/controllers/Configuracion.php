<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Configuracion
 *
 * @author Jonathan Munoz
 */
class Configuracion extends CI_Controller {
    
    public function index() {
        $this->load->view('configuracion');
    }
    
    public function confempresas() {
        $datos = array(
            'titulo' => 'EMPRESAS &amp; LOCALIDADES', 
            'nombre_tab' => 'tabEmpresasLocales',
            'pestanas' => array(
                array('etiqueta' => 'Gestión de Empresas', 'url' => 'empresa'), 
                array('etiqueta' => 'Gestión de Localidades', 'url' => 'localidad'),
                array('etiqueta' => 'Gestión de Grupos Empresariales', 'url' => 'grupoempresa')
            )
        );
        $this->load->view('confview', $datos);
    }
    
    public function confperfiles() {
        $this->load->view('configuracion/perfiles_view');
    }

    public function confusuarios() {
        $datos = array(
            'titulo' => 'Gestión de Usuarios', 
            'nombre_tab' => 'tabUsuarios',
            'pestanas' => array(
                array('etiqueta' => 'Listado de Usuarios', 'url' => 'usuario')
            )
        );
        $this->load->view('confview', $datos);
    }
    
}
