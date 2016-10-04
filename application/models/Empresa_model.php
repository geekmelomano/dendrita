<?php defined('BASEPATH') OR exit('No direct script access allowed');

include_once('Abstract_model.php');

/**
 * La clase Empresa_model representa el modelo de datos de la tabla PUB_EMPRESAS.
 * Cada registro representa a una empresa que puede acceder al ERP.
 *
 * @author Jonathan Muñoz Aleman
 * @copyright (c) 2016, Jonathan Muñoz Aleman
 * @see Abstract_model
 * @since 1.0
 */
class Empresa_model extends Abstract_model {
    
    public $codemp;
    public $codgru;
    public $nomemp;
    public $dirfis;
    public $dirleg;
    public $ubigeo;
    public $ruc;
    public $representante;
    public $telefono;
    public $fax;
    public $email;
    public $pagweb;
    public $reg_patronal;
    public $giro_negocio;
    public $tipo_negocio;
    public $nom_representante;
    public $dni_representante;
    public $estado;
    public $usuario;
    public $nombrepc;
    public $fechamodificacion;
    public $ctaperdc;
    public $ctagandc;
    public $cenctodc;
    public $codopeperdc;
    public $codopegandc;
    public $codopea_ing;
    public $codopea_egr;
    public $codctaa_ing;
    public $codctaa_ingd;
    public $codctaa_egr;
    public $codctaa_egrd;
    public $codopev_ing;
    public $codopev_egr;
    public $codctav_ing;
    public $codctav_ingd;
    public $codctav_egr;
    public $codctav_egrd;
    public $iniciales;
    public $ciudad_legal;
    public $codcta_garcar;
    public $codcta_garabo;
    public $agente_retencion;
    public $sec_lote_detraccion;
    public $tipo_plan_ctas;
    public $agente_percepcion;
    public $aduana_datos;
    public $ind_operaciones;
    public $flag_rc_igvdif;
    public $flag_endeudamiento;
    public $tipo_vista_eeff;
    
    public function __construct() {
        parent::__construct('pub_empresas', 'codemp');
    }
    
    /**
     * Devuelve la lista de empresas a los que tiene acceso el usuario para el 
     * sistema especificado.
     * 
     * @param string $usuario Codigo del usuario
     * @param string $sistema Codigo del sistema
     * @return array La lista de empresas.
     */
    public function obtener_x_usuario_y_sistema($usuario, $sistema) {
        return $this->db->query('CALL seg_lista_empresa_sistema_usu(?, ?)', 
                array($usuario, $sistema))->result();
    }

    protected function _establecer_campos($accion) {
        $datos = json_decode(file_get_contents('php://input'));
        $this->_establecer_campos_basicos($datos);
        $this->usuario = $this->session->coduser;
        $this->fechamodificacion = date('Y-m-d H:i:s', now('America/Lima'));
        
        if ($accion == 'C') {
            $this->agente_retencion = '0';
            $this->agente_percepcion = '0';
        }
    }

    /**
     * Devuelve el código de la empresa enviado como parámetro HTTP con el método
     * POST.
     * 
     * @return array Un arreglo que contiene el código de la empresa.
     */
    protected function _obtener_id() {
        return array('codemp' => $this->input->post('codemp'));
    }
    
    private function _establecer_campos_basicos($datos) {
        $this->codemp = $datos->codemp;
        $this->codgru = $datos->codgru;
        $this->nomemp = $datos->nomemp;
        $this->dirfis = $datos->dirfis;
        $this->dirleg = $datos->dirleg;
        $this->ubigeo = $datos->ubigeo;
        $this->ruc = $datos->ruc;
        $this->telefono = $datos->telefono;
        $this->fax = $datos->fax;
        $this->email = $datos->email;
        $this->pagweb = $datos->pagweb;
        $this->reg_patronal = $datos->reg_patronal;
        $this->giro_negocio = $datos->giro_negocio;
        $this->tipo_negocio = $datos->tipo_negocio;
        $this->nom_representante = $datos->nom_representante;
        $this->dni_representante = $datos->dni_representante;
        $this->estado = $datos->estado->id;
    }

}
