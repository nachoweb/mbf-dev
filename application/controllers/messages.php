<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Messages extends CI_Controller {
    
    /**
     * This controller is used for manage categories
     * 
     * @author Nacho
     * @version 0.0.0
     */
    public function __construct(){
        parent::__construct();
        // Your own constructor code
        $this->load->model('Message_model');
    }
    
   
    public function add($session_id,$text){
        $this->load->library('session');
        $user_id = $this->session->userdata('user_id');
        $this->Message_model->add_message($session_id, $user_id, $text);
    }
}
?>