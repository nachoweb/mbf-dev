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
        $this->load->library('session');
        if($this->input->post('gender')=="male"){
            $gender = 1;
        }else{
            $gender = 0;
        }
        $password = md5($this->input->post('register-password1'));
        $hex = $this->rand_text(32,32);
        $user_data = array(
            'name'              => $this->input->post('register-name'),
            'surname'           => $this->input->post('register-surname'),
            'gender'            => $gender,
            'labor_situation'   => $this->input->post('register-work'),
            'email'             => $this->input->post('register-email'),
            'password'          => $password,
            'hex'               => $hex
        );
        //Register user
        $this->load->model('User_model');
        $user_id = $this->User_model->register_user($user_data);
        $this->load->helper('url');
        $data_view['site_url'] = site_url();
        
        //Categoría
        $this->load->model('Category_model');
        $this->Category_model->add_category("Mis productos", $user_id); 
        
        //St_categories
        $this->load->model('St_category_model');
        $this->St_category_model->add_st_category("todas", $user_id);
        
        //User Sessions
        $this->load->model('Session_model');
        $this->Session_model->add_session("myself", $user_id);
        
        //Make dirs
        $path = realpath("./images/products");
        mkdir( $path."/$user_id", "0775");
        mkdir( $path."/$user_id/thumbs", "0775");
        
        //New Session
        $userdata = array(
            'user_id'  => $user_id,
            'user_name'=> $this->input->post('register-name')
        );
        $this->session->set_userdata($userdata);
        
       
        //Show instructions
        redirect("/register/steps/$hex");
    }
    
    
    private function rand_text($min = 10,$max = 20,$randtext = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890'){
        if($min < 1) $min=1;
        $varlen = rand($min,$max);
        $randtextlen = strlen($randtext);
        $text = '';
        for($i=0; $i < $varlen; $i++){
            $text .= substr($randtext, rand(1, $randtextlen), 1);
        }
        return $text;
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
        if( !is_numeric($user)){
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
    
    
  
    /**
     * Show the explication about the platform for an user
     * @param string user_id the user_id
     */
    public function steps($hex = ""){
        $this->load->library('session');
        if($hex == ""){
            $this->load->model('User_model');
            $hex = $this->User_model->get_hex($this->session->userdata('user_id'));
        }
        
        $data_view['hex'] = $hex;
        $data_view['user_id'] = $this->session->userdata('user_id');
        
        $this->load->helper('url');
        $data_view['site_url'] = site_url();
        
        $data_view['script_bm'] =$this->config->item('bm_script');
        
        //Show instructions
         $this->load->view('register_steps', $data_view);
    }
}
?>
