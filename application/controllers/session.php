<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Session extends CI_Controller {
    
    /**
     * This controller is used for manage categories
     * 
     * @author Nacho
     * @version 0.0.0
     */
    public function __construct(){
        parent::__construct();
        // Your own constructor code
        $this->load->model('Session_model');
    }
    
   
    public function add($name){
        $this->load->library('session');
        $user_id = $this->session->userdata('user_id');
        $new_session = $this->Session_model->add_session(urldecode($name), $user_id); 
        $this->Session_model->add_session_user($new_session['id'],$user_id);
        echo json_encode($new_session);
    }
    
}
?>