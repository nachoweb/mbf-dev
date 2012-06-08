<?php
/**
 * Model: actions
 * Create: 06/06/2011
 * Version: 0.0
 * Author: Nacho 
 *
 */
class Action_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
    }
    
    function save_function($action, $user_id, $var1 = "", $var2 = "", $var3 = ""){
        //Insert store
        $data = array(
                "name"  =>  $name,
                "user"  =>  $user,
                "item"  =>  '0'
        );
        $this->db->insert('mbf_category', $data); 
        $category = $this->db->insert_id();
        return $category;
    }
    
    
    function remove_category($id){
        $sql = "delete from mbf_category where id= $id";
        $query = $this->db->query($sql);
    }
    
    function rename_category($id, $new_name){
        $sql = "UPDATE mytable set name = '$new_name' where id=$id";
        $query = $this->db->query($sql);
    }
    
}
