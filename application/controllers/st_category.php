<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class St_category extends CI_Controller {
    
    /**
     * This controller is used for manage categories
     * 
     * @author Nacho
     * @version 0.0.0
     */
    public function __construct(){
        parent::__construct();
        // Your own constructor code
        $this->load->model('St_category_model');
    }
    
   
    public function add($name){
        $this->load->library('session');
        $user_id = $this->session->userdata('user_id');
        $name = trim(strip_tags(urldecode($name)));
        $st_category = $this->St_category_model->add_st_category($name, $user_id);
        echo $st_category;
    }
    
    
    public function add_st_category_store($st_category, $store, $dragged){
        $this->St_category_model->add_st_category_store($st_category, $store, $dragged);
    } 
}
?>