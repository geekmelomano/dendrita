<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Login
 *
 * @author Jonathan Munoz
 */
class Login extends CI_Controller {
    
    public function index() {
        $this->load->view('login');
    }
    
}
