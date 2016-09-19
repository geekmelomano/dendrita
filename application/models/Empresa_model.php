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
        parent::__construct('pub_empresas');
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
        if ($accion == 'C') {
            $this->agente_retencion = '0';
            $this->agente_percepcion = '0';
        }
        
        $this->_establecer_campos_basicos();
        $this->usuario = $this->session->coduser;
        $this->fechamodificacion = date('Y-m-d H:i:s', now('America/Lima'));
        
        $grupo = $this->input->post('codgru');
        $this->codgru = $grupo == '' ? NULL : $grupo;
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
    
    private function _establecer_campos_basicos() {
        $this->codemp = $this->input->post('codemp');
        $this->nomemp = $this->input->post('nomemp');
        $this->dirfis = $this->input->post('dirfis');
        $this->dirleg = $this->input->post('dirleg');
        $this->ubigeo = $this->input->post('ubigeo');
        $this->ruc = $this->input->post('ruc');
        $this->telefono = $this->input->post('telefono');
        $this->fax = $this->input->post('fax');
        $this->email = $this->input->post('email');
        $this->pagweb = $this->input->post('pagweb');
        $this->reg_patronal = $this->input->post('reg_patronal');
        $this->giro_negocio = $this->input->post('giro_negocio');
        $this->tipo_negocio = $this->input->post('tipo_negocio');
        $this->nom_representante = $this->input->post('nom_representante');
        $this->dni_representante = $this->input->post('dni_representante');
        $this->estado = $this->input->post('estado');
    }

}
