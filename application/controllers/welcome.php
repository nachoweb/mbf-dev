<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {
    public function index(){
            
            $this->load->helper('url');
            $data['base_url'] = base_url();
            $data['invitation'] = $this->input->get('invitation');
            $this->load->view('head');  
            $this->load->view('header'); 
            $this->load->view('welcome', $data);
            $this->load->view('footer_welcome'); 
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
?>