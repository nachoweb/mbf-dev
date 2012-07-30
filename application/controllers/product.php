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
    
    public function remove_producto_session($product_id, $session_id){
         //Load
        $this->load->model('Session_model');
        $this->load->model('Product_model');
        $this->load->library('session');
        
        $user_id = $this->session->userdata('user_id');
        if($this->Session_model->check_user_session($user_id, $session_id)){
            $this->Product_model->remove_product($product_id);
        }
    }
    
    public function remove_product($product_id){
        //Load
        $this->load->model('Product_model');
        $this->load->library('session');
        
        $user_id = $this->session->userdata('user_id');
        $product = $this->Product_model->get_product_by_id($product_id);
        if($product->user == $user_id){
            if($this->Product_model->remove_product($product_id) > 0){
                $image= $this->config->item('real_path')."/images/products/".$user_id."/$product->image";
                $thumb = $this->config->item('real_path')."/images/products/".$user_id."/thumbs/$product->image";
                $this->remove_image($image, $thumb);
            }
        }
        
    }
    
    private function remove_image($image, $thumb){
        unlink($image);
        unlink($thumb);
    }
 
    
}
?>