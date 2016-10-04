<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * La clase Abstract_model implementa funcionalidad genérica para realizar operaciones 
 * CRUD en la base de datos, a tráves de los métodos de la clase Query Builder de CodeIgniter. 
 * Todas los modelos de la aplicación heredan de esta clase.
 *
 * @author Jonathan Muñoz Aleman
 * @copyright (c) 2016, Jonathan Muñoz Aleman
 * @since 1.0
 */
abstract class Abstract_model extends CI_Model {
    
    // El nombre de la tabla de la base de datos sobre la que se realizarán las operaciones.
    private $tabla;
    
    // El nombre del campo que es la clave primaria de la tabla.
    // Solo para tablas cuya PK tenga un único campo.
    private $pk;

    /**
     * Constructor. Inicializa el nombre de la tabla de la base de datos y el campo
     * que es clave primaria en la tabla (solo para tablas cuya PK tenga un único campo).
     * 
     * @param string $tabla El nombre de la tabla.
     * @param string $pk El nombre del campo que es PK de la tabla.
     */
    public function __construct($tabla, $pk = NULL) {
        parent::__construct();
        $this->tabla = $tabla;
        $this->pk = $pk;
    }

    /**
     * Inserta un registro en la tabla de la base de datos. Los datos del registro
     * son obtenidos de los campos públicos de la subclase.
     */
    public function crear() {
        $this->_establecer_campos('C');
        $this->db->insert($this->tabla, $this);
    }

    /**
     * Actualiza un registro de la tabla de la base de datos. Los datos del registro
     * son obtenidos de los campos públicos de la subclase. La clave primaria del
     * registro se obtiene desde los parámetros HTTP enviados vía POST.
     */
    public function editar() {
        $this->_establecer_campos('U');
        $this->db->update($this->tabla, $this, $this->_obtener_id());
    }
    
    /**
     * Elimina un registro de la tabla de la base de datos. La clave primaria del
     * registro se obtiene desde los parámetros HTTP enviados vía POST.
     */
    public function eliminar() {
        $this->db->delete($this->tabla, $this->_obtener_id());
    }
    
    /**
     * Devuelve un registro de la tabla de la base de datos. Los datos de la clave
     * primaria se obtienen de los parámetros HTTP enviados vía POST.
     * 
     * @return object Un objeto que contiene los datos del registro.
     * @see Abstract_model::obtener_x_id($id)
     */
    public function obtener() {
        return $this->obtener_x_id($this->_obtener_id());
    }
    
    /**
     * Devuelve el registro de la tabla de la base de datos cuya clave primaria coincide
     * con el parámetro especificado.
     * 
     * @param array $id Los datos de la clave primaria del registro.
     * @return object Un objeto que contiene los datos del registro.
     */
    public function obtener_x_id($id) {
        return $this->db->get_where($this->tabla, $id)->row();
    }
    
    /**
     * Devuelve todos los registros de la tabla de la base de datos.
     * 
     * @return array La lista de registros de la tabla.
     */
    public function obtener_todos() {
        return $this->db->get($this->tabla)->result();
    }
    
    /**
     * Devuelve el último registro de la tabla en función del valor de su clave primaria.
     * Utilizado para obtener el registro insertado cuando la PK es autogenerada.
     * 
     * @return object Un objeto que contiene los datos del registro.
     */
    public function obtener_ultimo() {
        return $this->db->order_by($this->pk, 'DESC')->get($this->tabla, 1, 1)->row();
    }

    /**
     * Establece los campos de la tabla que van a ser creados o actualizados. Cada 
     * subclase debe declarar un campo público para cada campo de la tabla. 
     * 
     * @param string $accion Puede ser C (create), U (update) o D (delete)
     */
    protected abstract function _establecer_campos($accion);
    
    /**
     * Devuelve la clave primaria del registro.
     * 
     * @return array Los datos de la clave primaria del registro.
     */
    protected abstract function _obtener_id();
    
}
