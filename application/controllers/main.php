<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	/**
 	 * Main controlador para servir la página inicial y el javascript
	 * Este método devuelve la vista main donde estara alojada la página principal.
	 */
	public function index()
	{
		$this->load->view('main');
	}

	/**
	 * Para que se ejecute este método tienes que poner el navegador
	 * http://url/main/test/4 <--http://url/controlador/metodo/parametros
	 */
	public function test($limit=10)
	{
		$this->load->helper('html'); //Para usar la funcion br
		$query = $this->db->get('product',$limit);

		foreach ($query->result() as $row)
		{
				echo $row->description.br(2);
		}
	}
}

/* End of file main.php */
/* Location: ./application/controllers/main.php */
