<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Condiciones extends CI_Controller {
    
    /**
     * This controller is used for manage categories
     * 
     * @author Nacho
     * @version 0.0.0
     */
    public function __construct(){
        parent::__construct();
        // Your own constructor code
       
    }
    
    public function index(){
        $this->load->view('condiciones');
    }
    
}
?>