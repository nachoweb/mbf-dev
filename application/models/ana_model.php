<?php
/**
 * Model: Products
 * Create: 18/05/2011
 * Version: 1.0
 * Author: Nacho 
 *
 */

class Ana_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
    }
    
     function add_saved_sent($user_id, $product_id, $session_id, $date = ""){
        $data = array(
            'user'      => $user_id,
            'product'   => $product_id,
            'session'   => $session_id,
            'date'      => date('Y-m-d H:i:s')
        );
        $this->db->insert('mbf_ana_saved_sent', $data); 
    }
    
    function add_st_click($user_id, $store, $product, $session, $date = ""){
        $date == "" ? $date = date('Y-m-d H:i:s') : $date = $date;
        $data = array(
            'user'      => $user_id,
            'store'     => $store,
            'product'   => $product,
            'date'      => $date,
            'session'   => $session
        );
        $this->db->insert('mbf_ana_st_click', $data); 
    }
    
    function get_st_click($user, $store){
        $date = date('Y-m-d H:i:s');
        $sql = "SELECT * FROM mbf_ana_st_click m
                    where DATE_ADD(date, INTERVAL 1 HOUR) < '".$date."' and user=$user
                    order by date DESC";
        $query = $this->db->query($sql);
        $result = $query->result();
        if ($query->num_rows() > 0){
             return $result[0];
        }else{
            return null;
        }
    }
}
 ?>