<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
    }
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
    
    public function check_login($email, $password){    
        $this->load->library('session');
        $email = urldecode($email);
        $password = md5(urldecode($password));
        $this->load->model('User_model');
        $user = $this->User_model->check_login($email, $password);
        if( $user != -1){
            $userdata = array(
                'user_id'  => $user->id,
                'user_name' => $user->name
            );
            $this->session->set_userdata($userdata);
            echo "ok";
        }else{
            echo "fail";
        }
    }
}
?>
