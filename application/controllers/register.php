<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends CI_Controller {
    
    /**
     * this controller is used to control the user registration process.
     * Example URL:
     * @author Nacho
     * @version 0.0.0
     */
    public function signup(){
        if($this->input->post('gender')=="male"){
            $gender = 1;
        }else{
            $gender = 0;
        }
        $password = md5($this->input->post('register-password1'));
        $user_data = array(
            'name'              => $this->input->post('register-name'),
            'surname'           => $this->input->post('register-surname'),
            'gender'            => $gender,
            'labor_situation'   => $this->input->post('register-work'),
            'email'             => $this->input->post('register-email'),
            'password'          => $password
        );
        $this->load->model('User_model');
        $this->User_model->register_user($user_data);
       
    }
    
    public function check_mail($email){
        $email = urldecode($email);
        $this->load->model('User_model');
        if($this->User_model->check_existing_email($email)){
            echo "fail";
        }else{
            echo "ok";
        }
    }
}
?>
