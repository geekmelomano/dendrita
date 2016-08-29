<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Dashboard
 *
 * @author Jonathan Munoz
 */
class Dashboard extends CI_Controller {
    
    public function index() {
        $this->load->view('dashboard');
    }
    
}
