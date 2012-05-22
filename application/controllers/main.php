<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	/**
 	 * Main controlador para servir la página inicial y el javascript
	 * Este método devuelve la vista main donde estara alojada la página principal.
	 */
	public function index(){
            //USER
            $user_id = 1;
            
            $this->load->model('Product_model');
            $this->load->model('Store_model');
            
            //Products
            $data_products['products']=$this->Product_model->get_my_products($user_id);
            $content['content'] = $this->load->view('my_products',$data_products, true);
            
            /************/
            /* Widgets  */
            /************/
            //Stores
            $data_stores['stores']=$this->Store_model->get_stores_by_user($user_id);
            $sidebar['widgets']['stores'] = $this->load->view('my_stores',$data_stores, true);
            
            $this->load->view('head');
            $this->load->view('header');
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
}

/* End of file main.php */
/* Location: ./application/controllers/main.php */
