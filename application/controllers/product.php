<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product extends CI_Controller {
    /**
     * This controller is used for manage categories
     * 
     * @author Nacho
     * @version 0.0.0
     */
    public function __construct(){
        parent::__construct();
        // Your own constructor code
        $this->load->model('Product_model');
    }
    
    
    public function delete($product_id){
        $this->load->library('session');
        $current_user_id    = $this->session->userdata('user_id');
        $product_data = $this->Product_model->get_product_category_user($product_id);
        if($current_user_id == $product_data->user){
            $this->Product_model->remove_product($product_id);
        }
    }
    
    public function remove_product_category($product_id, $category_id){
        $this->Product_model->remove_product_category($product_id, $category_id);
    }
    
    public function add_product_session($product_id, $session_id){
        $product_data = $this->Product_model->add_product_session($product_id, $session_id);
    }
 
    
}
?>