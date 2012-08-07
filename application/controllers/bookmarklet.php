<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bookmarklet extends CI_Controller {
    
    /**
     * This controller is used for manage categories
     * 
     * @author Nacho
     * @version 0.0.0
     */
    public function __construct(){
        parent::__construct();
        // Your own constructor code
       
    }
    
    public function sessions($hex = ""){    
        $this->load->model('Session_model');
        $this->load->model('Category_model');
        $this->load->database();
         
        $query = $this->db->query("SELECT id FROM mbf_user where hex='$hex'");
        $result = $query->result();
        if ($query->num_rows() > 0){
            $user_id = $result[0]->id;
        }else{
            return -1;
        }    
        $json = array();
        $sessions = $this->Session_model->get_sessions_by_user($user_id);
        $categories = $this->Category_model->get_categories_by_user($user_id);
        foreach($sessions as $session){
            if($session->name == "myself"){
                $json['myself'] = $session->id;
                $json['sessions'][] = array("id" => $session->id, "name" => "-----------");
            }else{
                 $json['sessions'][] = array("id" => $session->id, "name" => $session->name);
            }
        }
        foreach($categories as $cat){
            $json['categories'][] = array("id" => $cat->id, "name" => $cat->name);
        }
        
        /*$sessions= array(
            array( "id" => 1, "name" => "session1"),
            array( "id" => 2, "name" => "session2")
        );*/
        echo $this->input->get('callback');
        echo "(";
        echo json_encode($json);
        echo ")";
    }
    
}

?>
