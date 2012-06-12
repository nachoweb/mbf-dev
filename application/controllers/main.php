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
                $this->load->helper('url');
                redirect('/welcome', 'location');
            }else{
                $this->home();
            }
	}
        
        private function home(){
            //USER
            $user_id = $this->session->userdata('user_id');
            $user_data['name'] = $this->session->userdata('user_name');

            $this->load->model('Product_model');
            $this->load->model('St_category_model');
            $this->load->model('Category_model');

            //Products
            $this->load->helper('url');
            $data_products['base_url_image'] = site_url("/images/products/$user_id");
            $data_products['products']=$this->Product_model->get_my_products($user_id);
            $content['content'] = $this->load->view('my_products',$data_products, true);
            $content['base_url'] = site_url();

            /************/
            /* Widgets  */
            /************/
            //Stores categories
            $data_categories_stores['st_categories']=$this->St_category_model->get_st_categories_by_user($user_id);
            $sidebar['widgets']['stores']['id']="stores";
            $sidebar['widgets']['stores']['html'] = $this->load->view('my_st_categories',$data_categories_stores, true);
            
            //Product categories
            $data_categories['categories']= $this->Category_model->get_categories_by_user($user_id);
            $sidebar['widgets']['categories']['id']="categories";
            $sidebar['widgets']['categories']['html'] = $this->load->view('my_categories',$data_categories, true);
           
            /* CARGAR VISTA DE LAS CATEGORIAS */

            //Interests
            $sidebar['widgets']['interest']['id']="interes";
            $sidebar['widgets']['interest']['html'] = $this->load->view('my_interests', '', true);
          
            $this->load->view('head');
            $this->load->view('header', $user_data);
            $this->load->view('sidebar', $sidebar);
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
            
            $data_stores['base_url_image'] = site_url("/images"); 
            $data_stores['image_no_logo'] = site_url("/images/no_logo.png");
            $data_stores['stores']=$this->Store_model->get_my_stores($user_id);
            $this->load->view('my_stores', $data_stores);
        }
}

/* End of file main.php */
/* Location: ./application/controllers/main.php */
