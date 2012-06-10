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
    
    
    public function get_current_user_categories(){
        $this->load->library('session');
        $current_user_id    = $this->session->userdata('user_id');
        return $this->get_categories_by_user($current_user_id);
    }
    
    private function get_categories_by_user($user_id){
        $categories = $this->Category_model->get_categories_by_user($user_id);
        return $categories;
    }
    
    public function add($name){
        $this->load->library('session');
        $user_id = $this->session->userdata('user_id');
        $name = trim(strip_tags(urldecode($name)));
        $category_id = $this->Category_model->add_category($name, $user_id);
        echo $category_id;
    }
    
    public function rename_category($category_id, $new_name, $echo = false ){
        $this->load->library('session');
        $current_user_id    = $this->session->userdata('user_id');
        if($this->check_user_has_category($current_user_id, $category_id)){
            $this->Category_model->remove_category($category_id);
            if ($echo)  { echo "ok"; return true; }
        }else{
            if ($echo)  { echo "fail"; return false; }
        }
    }
    
    public function remove_category($category_id, $echo = false ){
        $this->load->model('User_model');
        $user_has_category  = $this->User_model->get_user_id_by_category($category_id);
        if($user_has_category == $user_id){
            return true;
        }else{
            return false;
        }
    }
    
    private function check_user_has_category($user_id, $category_id){
        $this->load->model('User_model');
        $user_has_category  = $this->User_model->get_user_id_by_category($category_id);
        if($user_has_category == $user_id){
            return true;
        }else{
            return false;
        }
    }
    
    
    public function add_product_category($product_id, $category_id){
        $this->Category_model->add_category_product($product_id, $category_id);
    } 
}
?>