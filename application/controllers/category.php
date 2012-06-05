<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category extends CI_Controller {
    
    /**
     * This controller is used for manage categories
     * 
     * @author Nacho
     * @version 0.0.0
     */
    public function __construct(){
        parent::__construct();
        // Your own constructor code
        $this->load->model('Category_model');
    }
    
    
    public function add($name, $user){
        $name = trim(strip_tags($name));
        $user = trim(strip_tags($user));
        $this->Category_model->add_category($name, $user);
    }
    
    public function rename_category($category_id, $new_name){
        $this->load->library('session');
        $current_user_id    = $this->session->userdata('user_id');
        if($this->check_user_has_category){
            $this->Category_model->rename_category($category_id, $new_name);
            return true;
        }else{
            return false;
        }
    }
    
    private function check_user_has_category($user_id, $category_id){
        $this->load->model('User_model');
        $user_has_category  = $this->User_model->get_user_id_by_category($category_id);
        if($user_has_category == $category_id){
            return true;
        }else{
            return false;
        }
        
    }
    
    
}
?>