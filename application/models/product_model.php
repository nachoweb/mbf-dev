<?php
/**
 * Model: Products
 * Create: 18/05/2011
 * Version: 1.0
 * Author: Nacho 
 *
 */

class Product_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
    }
    
    function get_products_by_session($session) {
        $query = $this->db->query('SELECT * FROM mbf_prodcut where session='.$session);
        return $query->result();
    }
    
    function get_product_by_id($id){
        $query = $this->db->query('SELECT * FROM mbf_prodcut where id='.$id);
        return $query->result();
    }
    
    function get_my_products($id_user){
        //Get session user
        $query = $this->db->query("SELECT * FROM mbf_session where user=$id_user and name='myself'");
        $row = $query->row();
        $session = $row->id;
        return get_products_by_session($session);
    }
    
    function save_product($user,$image,$price,$title,$description, $url, $store_url,$store_name, $browser, $status){
        
        //$user_id = $this->session->userdata('user_id');
        $user_id = 1;
            
        //Get session user
        $query = $this->db->query("SELECT * FROM mbf_session where user=$user and name='myself'");
        $row = $query->row();
        $session = $row->id;
        
        //Store
        $query = $this->db->query("SELECT * FROM mbf_store where url='$store_url'");
        if ($query->num_rows() > 0){
            $row = $query->row();
            $store = $row->id;
        
            //Check user-store
            $query = $this->db->query("SELECT * FROM mbf_user_store where store=$store AND user=$user_id");
            if ($query->num_rows() == 0){
                //Insert User Store
                $query = $this->db->query("insert into mbf_user_store(store, user) values ($store, $user_id)");
            }            
        }else{
            //Insert store
            $data = array(
                    "url"   =>  $store_url,
                    "name"  =>  $store_name
            );
            $this->db->insert('mbf_store', $data); 
            $store = $this->db->insert_id();
            //Insert User Store
            $query = $this->db->query("insert into mbf_user_store(store, user) values ($store, $user_id)");
        }

        //Insert product
        $data = array(
                'title'         => $title,
                'image'         => $image,
                'price'         => $price,
                'description'   => $description,
                'url'           => $url,
                'store'         => $store,
                'browser'       => $browser,
                'session'       => $session,
                'date'          => date('Y-m-d H:i:s'),
                'status'        => $status
            );
        $this->db->insert('mbf_product', $data); 
        $product = $this->db->insert_id();
    }
   
}

?>