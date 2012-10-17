<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Analytics extends CI_Controller {
    
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
    
    public function st_click( $store, $product, $session){
        $this->load->library('session');
        $this->load->model('Ana_model');
        $user = $this->session->userdata('user_id');        
        $this->Ana_model->add_st_click($user, $store, $product, $session);      
    }
}