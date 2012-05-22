<?php
/**
 * Model: Products
 * Create: 18/05/2011
 * Version: 1.0
 * Author: Nacho 
 *
 */

class Store_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
    }
    
    /**
     * Return in an array of object stores the user stores
     * @param int $id_user
     * @return array of objects stores 
     */
    function get_stores_by_user($id_user) {
        $query = $this->db->query(
                    "select *
                    from mbf_user_store join mbf_user join mbf_store
                    on mbf_user_store.user = mbf_user.id and mbf_user_store.store = mbf_store.id
                    where mbf_user.id = $id_user");
        return $query->result();
    }
   
}

?>