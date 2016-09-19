<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * La clase CrudController implementa funcionalidad genérica para realizar las operaciones 
 * CRUD solicitadas desde un objeto DataSource de KendoUI. Todas los controladores que 
 * expongan una interfaz de mantenimiento para tablas de la base de datos heredan de esta clase.
 *
 * @author Jonathan Muñoz Aleman
 * @copyright (c) 2016, Jonathan Muñoz Aleman
 * @since 1.0
 */
abstract class CrudController extends CI_Controller {
    
    /**
     * Constructor. Carga la clase que implementa el modelo de acceso a datos, el cual
     * puede ser utilizado desde las subclases a través del campo "modelo".
     * 
     * @param string $clase_modelo El nombre de la clase modelo.
     */
    public function __construct($clase_modelo) {
        parent::__construct();
        $this->load->model($clase_modelo, 'modelo');
    }
    
    /**
     * Crea un registro utilizando el modelo de acceso a datos cargado. Los datos se 
     * obtienen desde los parámetros HTTP enviados con el método POST, y se responde
     * al cliente con el registro creado en formato JSON.
     */
    public function crear() {
        $this->_procesar('C');
    }
    
    /**
     * Obtiene todos los registros de una tabla utilizando el modelo de acceso a datos 
     * cargado, y los envía al cliente en formato JSON.
     */
    public function obtener() {
        $datos = json_encode($this->modelo->obtener_todos());
        $this->output->set_content_type('application/json')->set_output($datos);
    }
    
    /**
     * Actualiza un registro utilizando el modelo de acceso a datos cargado. Los datos 
     * se obtienen desde los parámetros HTTP enviados con el método POST, y se responde
     * al cliente con el registro actualizado en formato JSON.
     */
    public function editar() {
        $this->_procesar('U');
    }
    
    /**
     * Elimina un registro utilizando el modelo de acceso a datos cargado. Los datos 
     * del registro se obtienen desde los parámetros HTTP enviados con el método POST, 
     * y se responde al cliente con el registro eliminado en formato JSON.
     */
    public function eliminar() {
        $this->_procesar('D');
    }
    
    private function _procesar($accion) {
        switch ($accion) {
            case 'C': $this->modelo->crear(); break;
            case 'U': $this->modelo->editar(); break;
            case 'D': $this->modelo->eliminar(); break;
        }
        
        $salida = json_encode($this->input->post());
        $this->output->set_content_type('application/json')->set_output($salida);
    }
    
}
