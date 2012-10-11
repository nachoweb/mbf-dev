<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
    }
   
    /**
     * this controller is used to control the user registration process.
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
            'hex'               => $hex,
            'nick'              => $this->input->post('nick'),
            'date_birth'        => $this->input->post('register-date').'-01-01'
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
        /*$this->load->model('St_category_model');
        $this->St_category_model->add_st_category("todas", $user_id);*/
        
        //User Sessions
        $this->load->model('Session_model');
        $new_session = $this->Session_model->add_session("myself", $user_id);
        $this->Session_model->add_session_user($new_session['id'], $user_id);
        
        //Invitation
        if($this->input->post('invitation')!= ""){
            $this->Session_model->add_session_user_by_hex($user_id,$this->input->post('invitation'));
        }
        
        //Make dirs
        $aux = "/images/products/";
        //echo $aux."<br/>";
        
        
        $path = ".";   
        mkdir( $path."/images/products/".$user_id, 0777);
        chmod( $path."/images/products/".$user_id, 0777);
        mkdir( $path."/images/products/$user_id/thumbs", 0777);
        chmod( $path."/images/products/$user_id/thumbs", 0777);
        
        
        
        //New Session
        $userdata = array(
                'user_id'   => $user_id,
                'user_name' => $this->input->post('register-name'),
                'user_nick' => $this->input->post('nick'),
                'user_hex'  => $hex,
                'myself'    => $new_session['id']
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
    
    public function check_login($email, $password, $invitation = ""){    
        $this->load->library('session');
        $email = urldecode($email);
        $password = md5(urldecode($password));
        $this->load->model('User_model');
        $user = $this->User_model->check_login($email, $password);
        
        //Session
        if( !is_numeric($user)){
            $myself = $this->User_model->get_user_session($user->id);            
            $userdata = array(
                'user_id'   => $user->id,
                'user_name' => $user->name,
                'user_nick' => $user->nick,
                'user_hex'  => $user->hex,
                'myself'    => $myself
            );
            $this->session->set_userdata($userdata);
            
            //Invitation
            if($invitation != ""){
                $this->load->model('Session_model');
                $this->Session_model->add_session_user_by_hex($user->id,$invitation);
            }            
            echo "ok";
        }else{
            echo "fail";
        }
    }
    
    public function delete_user(){
        $this->load->library('session');
        $user_id = $this->session->userdata('user_id');
        
        //BBDD
        $this->load->model('User_model');
        $this->User_model->delete_user($user_id);
        
        //Delete user
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('user_name');
        $this->session->unset_userdata('user_nick');
        $this->session->unset_userdata('myself');
        
    }
    
    
  
    /**
     * Show the explication about the platform for an user
     * @param string user_id the user_id
     */
    public function steps($hex = ""){
        $this->load->library('session');
        if($hex == ""){
            $hex = $this->session->userdata('user_hex');
        }
        
        $data_view['hex'] = $hex;
        $data_view['user_id'] = $this->session->userdata('user_id');
        
        $this->load->helper('url');
        $data_view['site_url'] = site_url();
        
        $data_view['script_bm'] =$this->config->item('bm_script');
        $data_view['close_session'] =false;
        
        //Show instructions¡
        $this->load->view('register_steps', $data_view);
        
    }
    
    public function activate($hex){
        $this->load->model('User_model');
        $user_id = $this->User_model->get_user_by_hex($hex, 'id');
        if($user_id != -1){
            $this->User_model->activate($user_id);
        }
    }
    
    public function reset_password(){
        $hex = $this->rand_text(8,8);
    }
}
?>
