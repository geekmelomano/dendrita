<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Abstract_model
 *
 * @author Jonathan Munoz
 */
abstract class Abstract_model extends CI_Model {
    
    private $tabla;

    public function __construct($tabla) {
        parent::__construct();
        $this->tabla = $tabla;
    }

    public function crear() {
        $this->_establecer_campos('C');
        $this->db->insert($this->tabla, $this);
    }
    
    public function crear_lote($lote) {
        $this->db->insert_batch($this->tabla, $lote);
    }

    public function editar() {
        $this->_establecer_campos('U');
        $this->db->update($this->tabla, $this, $this->_obtener_id());
    }
    
    public function eliminar() {
        $this->db->delete($this->tabla, $this->_obtener_id());
    }
    
    public function obtener() {
        return $this->obtener_x_id($this->_obtener_id());
    }
    
    public function obtener_x_id($id) {
        return $this->db->get_where($this->tabla, $id)->row();
    }
    
    public function obtener_todos() {
        return $this->db->get($this->tabla)->result();
    }
    
    protected abstract function _obtener_id();
    protected abstract function _establecer_campos($accion);
    
}
