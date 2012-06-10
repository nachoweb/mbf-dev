<?php
/**
 * Model: user
 * Create: 05/06/2011
 * Version: 0.0
 * Author: Nacho 
 *
 */
class Category_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
    }
    
    function get_category_my_product($user_id){
        $query = $this->db->query("SELECT * FROM mbf_category where name='Mis productos' and user='$user_id'");
        $result = $query->result();
        if ($query->num_rows() > 0){
             return $result[0]->id;
        }else{
            return -1;
        }
    }
    
    function get_categories_by_user($user_id){
        $query = $this->db->query("SELECT * FROM mbf_category where user='$user_id'");
        $result = $query->result();
        if ($query->num_rows() > 0){
             return $result;
        }else{
            return array();
        }
    }
    
    function add_category($name, $user){
        //Insert store
        $data = array(
                "name"  =>  $name,
                "user"  =>  $user,
                "items"  =>  '0'
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
    
    function add_category_product($product_id, $category_id){
         $data = array(
                "product"  =>  $product_id,
                "category" =>  $category_id
        );
        @$this->db->insert('mbf_product_category', $data);
    }
    
}
