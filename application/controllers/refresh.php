<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
class Refresh extends CI_Controller{
    
    public function __construct() {
        parent::__construct();
    }
    
    public function refresh_my_products($last_product){
         //Loader
        $this->load->library('session');       
        $this->load->model('Product_model'); 
        $this->load->model('Category_model');
        $this->load->model('Session_model');
        $this->load->helper('url');
        
        //User
        $user_id = $this->session->userdata('user_id');       
      while(1) {        
            $data_products['products'] = $this->Product_model->get_new_products($user_id, $last_product);           
            // if we have new data, return it to the client
            if(count($data_products['products'])>0) {
                    //Products & categories          
                    $data_products['sessions'] = $this->Session_model->get_sessions_by_user($user_id);
                    $data_products['base_url'] = site_url();
                    $data_products['base_url_image'] = site_url("/images/products/$user_id");
                    $data_products['categories'] = $this->Category_model->get_categories_by_user($user_id);
                    $json['html']           = $this->load->view('new_products', $data_products, true);
                    $json['last_product']   = $data_products['products'][0]->id;
                    echo json_encode($json);
                    break;
            }

            sleep(2);	// we sleep for 3s and check again for data          
        }   
    }

}


?>