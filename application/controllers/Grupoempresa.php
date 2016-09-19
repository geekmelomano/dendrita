<?php defined('BASEPATH') OR exit('No direct script access allowed');

include_once('CrudController.php');

/**
 * La clase Grupoempresa controla peticiones relacionadas con la obtención y mantenimiento
 * de la información de los grupos empresariales.
 *
 * @author Jonathan Muñoz Aleman
 * @copyright (c) 2016, Jonathan Muñoz Aleman
 * @see CrudController
 * @since 1.0
 */
class Grupoempresa extends CrudController {
    
    public function __construct() {
        parent::__construct('grupo_empresa_model');
    }
    
    /**
     * Carga la vista de mantenimiento que utiliza una grilla.
     */
    public function index() {
        $this->load->view('gridcrud', array('grid' => 'gridGruposEmpresas', 
            'funcion' => 'iniciarConfGruposEmpresas'));
    }
    
}
