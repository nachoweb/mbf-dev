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
                
                $data_header['close_session'] = false;
                
                $this->load->view('head');   
                $this->load->view('header', $data_header); 
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
            $myself = $this->session->userdata('myself');
            
            
            //Notifications
            $this->load->model('Notification_model');
            $data_sidebar['notifications'] = $this->Notification_model->get_user_notifications($user_id, $myself);
            
            //Actualize last visit
             $this->load->model('User_model');
             $this->User_model->refresh_last_visit($user_id, date('Y-m-d H:i:s')); 
                     
            //Add posible session
            if($this->input->get('invitation')!= ""){
                $this->load->model('Session_model');
                $this->Session_model->add_session_user_by_hex($user_id,$this->input->get('invitation'));
            }
            
            //Index content
            $hex = $this->session->userdata('user_hex');

            $data_view['hex'] = $hex;
            $data_view['user_id'] = $this->session->userdata('user_id');
            $this->load->helper('url');
            $data_view['site_url'] = site_url();
            $data_view['script_bm'] =$this->config->item('bm_script');

            //Show instructions¡
            $content['content'] = $this->load->view('steps_inside', $data_view, true);
            $data_header['close_session'] = true;
            $data_header['site_url'] = site_url();
            
            /* CARGAR VISTAS */
          
            $this->load->view('head');
            $this->load->view('header', $data_header);
            $this->load->view('sidebar', $data_sidebar);
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
        
        public function inicio(){
            $this->load->view('inicio');
        }
        
        public function products(){
            //USER
            $user_id = $this->session->userdata('user_id');
            $user_data['name'] = $this->session->userdata('user_name');
            
            //Loader
            $this->load->model('Product_model'); 
            $this->load->model('Category_model');
            $this->load->model('Session_model');
            $this->load->helper('url');
           
            //Products & categories          
            $data_products['sessions'] = $this->Session_model->get_sessions_by_user($user_id);
            $data_products['base_url_image'] = site_url("/images/products/$user_id");
            $data_products['products']=$this->Product_model->get_my_products($user_id);
            $data_products['categories'] = $this->Category_model->get_categories_by_user($user_id);
            $this->load->view('my_products', $data_products);
        }
        
        public function stores(){
            //USER
            $user_id = $this->session->userdata('user_id');
            $user_data['name'] = $this->session->userdata('user_name');
            
            //Loader
            $this->load->model('Store_model');
            $this->load->helper('url');
            
            $data_stores['members'] = $this->Store_model->get_members_stores();
            $data_stores['my_stores'] = $this->Store_model->get_stores_by_user($user_id);
            $data_stores['base_url_image'] = site_url("/images/stores/"); 
            $data_stores['image_no_logo'] = site_url("/images/stores/no_logo.png");
            $this->load->view('my_stores', $data_stores);
            
        }
        
        public function stores_category($st_category = 28){
            //Loader
            $this->load->model('Store_model');
            $this->load->helper('url');
            
            //Data
            $data_stores['stores'] = $this->Store_model->get_interest($st_category);
            $data_stores['base_url_image'] = site_url("/images"); 
            $data_stores['image_no_logo'] = site_url("/images/no_logo.png");
            
            //View
            $this->load->view('my_stores', $data_stores);
        }
        
        public function my_sessions(){
             //USER
            $user_id = $this->session->userdata('user_id');
            $user_data['name'] = $this->session->userdata('user_name');
            $myself_id = $this->session->userdata('myself');          
        
            //Loader
            $this->load->model('Session_model');
            $this->load->model('Notification_model');
            $this->load->helper('url');
            
            //Data
            $data_sessions['notifications'] = $this->Notification_model->get_sessions_notifications($user_id, $myself_id);
            $data_sessions['nicks'] = $this->Session_model->get_sessions_users($user_id);
            $data_sessions['sessions'] = $this->Session_model->get_sessions_by_user($user_id);
            $data_sessions['base_url_image'] = site_url("/images"); 
            
            //View
            $this->load->view('my_sessions', $data_sessions);
        }
        
        public function session($session_id){
            //USER
            $user_id = $this->session->userdata('user_id');
            $user_data->name = $this->session->userdata('user_name');
            $user_data->nick = $this->session->userdata("user_nick");
            
            //Loader
            $this->load->model('Session_model');
            $this->load->model('Product_model');
            $this->load->model('Message_model');
            $this->load->helper('url');
            
            //Update last_session
            $this->Session_model->update_last_visit($user_id, $session_id);
            
            if($this->Session_model->check_user_session($user_id, $session_id)){
                //Data               
                $data_session["session"]        = $this->Session_model->get_session($session_id);
                $data_session["messages"]       = $this->Message_model->get_messages_by_session($session_id);
                if(count($data_session["messages"]) > 0){
                    $data_session["last_message"] = $data_session["messages"][count($data_session["messages"])-1]->id;
                }else{
                    $data_session["last_message"] = 0;
                }
                $data_session["users"]          = $this->Session_model->get_users($session_id);
                $data_session["products"]       = $this->Product_model->get_products_by_session($session_id, false);
                $data_session['user']           = $user_data;
                $data_session['base_url_image_store'] = site_url("/images/stores");
                $data_session['base_url_image_product'] = site_url("/images/products");

                //View
                $this->load->view('session', $data_session);
            }else{
                echo "No tienes permisos para entrar en esta sesión.";
            }
        }
        
        public function steps(){
            $this->load->library('session');
            $hex = $this->session->userdata('user_hex');

            $data_view['hex'] = $hex;
            $data_view['user_id'] = $this->session->userdata('user_id');

            $this->load->helper('url');
            $data_view['site_url'] = site_url();

            $data_view['script_bm'] =$this->config->item('bm_script');

            //Show instructions¡
            $this->load->view('steps_inside', $data_view);
           
        }
        
        
        public function messages($session_id, $last = 0){
            $this->load->model('Message_model');
            $data["messages"]  = $this->Message_model->get_messages_by_session($session_id, $last);
            if(count($data["messages"]) > 0){
                $data["last_message"] = $data["messages"][count($data["messages"])-1]->id;
            }else{
                $data["last_message"] = 0;
            }
            echo json_encode($data);
        }
        
        public function close_session(){
            $this->session->unset_userdata('user_id');
            $this->session->unset_userdata('user_name');
            $this->session->unset_userdata('user_nick');
            $this->session->unset_userdata('myself');
        }
}

/* End of file main.php */
/* Location: ./application/controllers/main.php */
