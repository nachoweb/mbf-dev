<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends CI_Controller {
    
    /**
     * this controller is used to control the user login process
     * Example URL:
     * @author Nacho
     * @version 0.0.0
     */
    public function login(){
        $this->load->model('User_model');
        $successfull = $this->User_model->check_login($this->input->post('email'), md5($this->input->post('password')));
        if($sucessfull){
            if($this->input->post('invitation')!= ""){
                echo "que pasa aqui";
                $this->load->model('Session_model');
                $this->Session_model->add_session_user_by_hex($this->session->userdata('user_id'),$this->input->get('invitation'));
            }
            echo "ok";
        }else{
            echo "fail";
        }
    }
}
?>
