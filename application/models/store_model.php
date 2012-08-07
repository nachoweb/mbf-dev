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
    /*function get_stores_by_user($id_user) {
        $query = $this->db->query(
                    "select *
                    from mbf_user_store join mbf_user join mbf_store
                    on mbf_user_store.user = mbf_user.id and mbf_user_store.store = mbf_store.id
                    where mbf_user.id = '$id_user'");
        return $query->result();
    }*/
    
    function get_stores_by_user($id_user){
        $sql = "SELECT mbf_store.id,mbf_store.offer, mbf_store.notification,  mbf_store.star, mbf_store.description, mbf_store.member, mbf_store.name, mbf_store.url, mbf_store.logo
                FROM mbf_store join mbf_store_user
                on mbf_store.id = mbf_store_user.store
                where mbf_store_user.user = $id_user
                order by mbf_store.id asc";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0){
            return $query->result();
        }
        return array();
    }
    
    function get_stores_by_session($session_id){
        $sql = "select distinct mbf_store.name, mbf_store.url
        from mbf_session join mbf_product join mbf_store
        on mbf_session.id = mbf_product.session and mbf_store.id = mbf_product.store
        where mbf_session.id = $session_id";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0){
            return $query->result();
        }
        return array();
    }
    

    
    
    function get_stores_by_st_category($st_category){
         $sql = "SELECT mbf_store.id, mbf_store.name, mbf_store.url, mbf_store.logo, mbf_st_category_store.st_category
                FROM mbf_store join mbf_st_category_store join mbf_st_category
                on mbf_store.id = mbf_st_category_store.store and mbf_st_category_store.st_category = mbf_st_category.id
                and mbf_st_category_store.st_category = $st_category
                order by mbf_store.id asc";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0){
            return $query->result();
        }
        return array();
    }
    
    
    function get_my_stores($id_user){
       
    }
    
    function get_members_stores(){
        $query = $this->db->query("SELECT *
            from mbf_store join mbf_st_category_store
            on mbf_store.id = mbf_st_category_store.store
            order by mbf_store.id");
        if ($query->num_rows() > 0){
            $stores_cats = $query->result();
            //k: Index of new array; $i: Index of the $stores_cats; $j:Index for check same store
            $k=0;
            for($i=0; $i< count($stores_cats); $i++){
                foreach($stores_cats[$i] as $key => $value){
                    if($key != "st_category"){
                        $stores[$k]->$key = $value;
                    }else{
                        $stores[$k]->categories[] = $value;
                    }
                }
                $j = $i + 1;
                while($j < count($stores_cats) && $stores_cats[$i]->id == $stores_cats[$j]->id){
                    $stores[$k]->categories[] = $stores_cats[$j]->st_category;
                    $i++;
                    $j++;
                }
                $k++;
            }
            return $stores;
        }
        return array();
    }
    
    function get_interest($st_category){
        $my_stores = array();
        $stores = $this->get_stores_by_st_category($st_category);
        //k: Index of new array; $i: Index of the products_cats; $j:Index for check same product, more than cats
        $k=0;
        for($i=0; $i< count($stores); $i++){
            foreach($stores[$i] as $key => $value){
                if($key != "st_category"){
                    $my_stores[$k]->$key = $value;
                }else{
                    $my_stores[$k]->st_categories[] = $value;
                }
            }
            $j = $i + 1;
            while($j < count($stores) && $stores[$i]->id == $stores[$j]->id){
                $my_stores[$k]->st_categories[] = $stores[$j]->st_category;
                $i++;
                $j++;
            }
            $k++;
        }
        return $my_stores;
    }
    
    function add_user_store($user_id, $store_id){
        $data = array(
                "store"     =>  $store_id,
                "user"      =>  $user_id,
                "dragger"   =>  '0'
        );
        $this->db->insert('mbf_user_store', $data); 
    }
}

?>