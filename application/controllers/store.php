<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Store extends CI_Controller {
    
    /**
     * This controller is used for manage categories
     * 
     * @author Nacho
     * @version 0.0.0
     */
    public function __construct(){
        parent::__construct();
        // Your own constructor code
        $this->load->model('Store_model');
    }
    
   
    public function add_user_store($store_id){
        //SESION
        $this->load->library('session');
        $user_id = $this->session->userdata('user_id');
        
        //Add
        $this->Store_model->add_user_store($user_id, $store_id);        
    }
    
}
?>