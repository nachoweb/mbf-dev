<?php
/**
 * Model: user
 * Create: 05/06/2011
 * Version: 0.0
 * Author: Nacho 
 *
 */
class St_category_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
    }
    
    
    function get_st_categories_by_user($user_id){
        $query = $this->db->query("SELECT * FROM mbf_st_categories where user = $user_id");
        $result = $query->result();
        if ($query->num_rows() > 0){
             return $result;
        }else{
            return array();
        }
    }
    
}
