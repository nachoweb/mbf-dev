<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {
        
        public function __construct(){
            parent::__construct();
            // Your own constructor code
            $this->load->library('session');
        }
	/**
 	 * Main controlador para servir la página inicial y el javascript
	 * Este método devuelve la vista main donde estara alojada la página principal.
	 */
	public function index(){
            if(!$this->session->userdata('user_id')){
                /*$this->load->helper('url');
                redirect('/welcome', 'location');*/
                $this->load->helper('url');
                
                $data['base_url'] = base_url();
                $data['invitation'] = $this->input->get('invitation');
                
                $this->load->view('head');   
                $this->load->view('welcome', $data);
                $this->load->view('footer'); 
            }else{
                $this->home();
            }
	}
        
        private function home(){
            //USER
            $user_id = $this->session->userdata('user_id');
            $user_data['name'] = $this->session->userdata('user_name');
            
            //Actualize last visit
             $this->load->model('User_model');
             $this->User_model->refresh_last_visit($user_id, date('Y-m-d H:i:s')); 
                     
            //Add posible session
            if($this->input->get('invitation')!= ""){
                $this->load->model('Session_model');
                $this->Session_model->add_session_user_by_hex($user_id,$this->input->get('invitation'));
            }

                
           
          

            //Products
            $this->load->model('Product_model');        
            $this->load->helper('url');
            $this->load->model('Category_model');
            $data_products['base_url_image'] = site_url("/images/products/$user_id");
            $data_products['products']=$this->Product_model->get_my_products($user_id);
            $data_products['categories'] = $this->Category_model->get_categories_by_user($user_id);
            $content['content'] = $this->load->view('my_products', $data_products , true);
            $content['base_url'] = site_url();
          
            //Stores
            $this->load->model('Store_model');
            $data_stores['members'] = $this->Store_model->get_members_stores();
            $data_stores['my_stores'] = $this->Store_model->get_stores_by_user($user_id);
            $data_stores['base_url_image'] = site_url("/images/stores/"); 
            $data_stores['image_no_logo'] = site_url("/images/stores/no_logo.png");
            //$content['content'] = $this->load->view('my_stores',$data_stores, true);
           
            /* CARGAR VISTAS */
          
            $this->load->view('head');
            $this->load->view('header');
            $this->load->view('sidebar');
            $this->load->view('content', $content);
            $this->load->view('footer');
        }
                

	/**
	 * Para que se ejecute este método tienes que poner el navegador
	 * http://url/main/test/4 <--http://url/controlador/metodo/parametros
	 */
	public function test($limit=10)
	{
		$this->load->helper('html'); //Para usar la funcion br
		$query = $this->db->get('product',$limit);
                
		foreach ($query->result() as $row){
                    echo $row->description.br(2);
		}
	}
        
        public function products(){
            //USER
            $user_id = $this->session->userdata('user_id');
            $user_data['name'] = $this->session->userdata('user_name');
            
            //Loader
            $this->load->model('Product_model');
            $this->load->helper('url');
           
            //Products             
            $data_products['base_url_image'] = site_url("/images/products/$user_id");
            $data_products['products']=$this->Product_model->get_my_products($user_id);
            $this->load->view('my_products',$data_products);
        }
        
        public function stores(){
            //USER
            $user_id = $this->session->userdata('user_id');
            $user_data['name'] = $this->session->userdata('user_name');
            
            //Loader
            $this->load->model('Store_model');
            $this->load->helper('url');
            
            $data_stores['base_url_image'] = site_url("/images/stores/"); 
            $data_stores['image_no_logo'] = site_url("/images/stores/no_logo.png");
            $data_stores['stores']=$this->Store_model->get_my_stores($user_id);
            $this->load->view('my_stores', $data_stores);
        }
        
        public function stores_category($st_category = 28){
            //Loader
            $this->load->model('Store_model');
            $this->load->helper('url');
            
            
            $data_stores['stores'] = $this->Store_model->get_interest($st_category);
            $data_stores['base_url_image'] = site_url("/images"); 
            $data_stores['image_no_logo'] = site_url("/images/no_logo.png");
            $this->load->view('my_stores', $data_stores);
        }
}

/* End of file main.php */
/* Location: ./application/controllers/main.php */
