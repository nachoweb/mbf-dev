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
    
   
    public function add($session_id,$text, $last = 0){
        $this->load->library('session');
        $this->load->model('Session_model');
        
        $user_id = $this->session->userdata('user_id');
        
        if($this->Session_model->check_user_session($user_id, $session_id)){
            $this->Message_model->add_message($session_id, $user_id, urldecode($text));
            $this->get_messages($session_id, $last, true);
        }
    }
    
    public function get_messages($session_id, $last = 0, $tested = false){
        //Load
        $this->load->model('Message_model');
        $this->load->model('Session_model');       
        
        //Checkeamos si usuario puede leer
        if($tested == false){
            $this->load->library('session');
            $user_id = $this->session->userdata('user_id');
            if(!$this->Session_model->check_user_session($user_id, $session_id)){
                $data["last_message"] = $last;
                $data["messages"] = array();
                echo json_encode($data);
                return;
            }
        }
        $data["messages"]  = $this->Message_model->get_messages_by_session($session_id, $last);
        if(count($data["messages"]) > 0){
            $data["last_message"] = $data["messages"][count($data["messages"])-1]->id;
        }else{
            $data["last_message"] = 0;
        }
        echo json_encode($data);
    }
}
?>