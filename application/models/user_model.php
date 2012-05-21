<?php
/**
 * Model: Products
 * Create: 18/05/2011
 * Version: 1.0
 * Author: Nacho 
 *
 */

class User_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
    }
    
    function get_user_by_id($id) {
        $query = $this->db->query('SELECT * FROM mbf_user where id='.$id);
        $result = $query->result();
        if ($query->num_rows() > 0){
             return $result[0];
        }
    }
    
    function get_users_by_session($session){
        $query = $this->db->query("select *
                        from mbf_session_user join mbf_user join mbf_session
                        on mbf_session_user.user = mbf_user.id and mbf_session_user.session = mbf_session.id
                        where mbf_session.id = $session");
        return $query->result();
    }
}

?>