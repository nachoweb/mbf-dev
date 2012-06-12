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
        $sql = "SELECT mbf_store.id, mbf_store.name, mbf_store.url, mbf_store.logo, mbf_st_category_store.st_category
                FROM mbf_store join mbf_st_category_store join mbf_st_category
                on mbf_store.id = mbf_st_category_store.store and mbf_st_category_store.st_category = mbf_st_category.id
                and mbf_st_category.user = $id_user
                order by mbf_store.id asc";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0){
            return $query->result();
        }
        return array();
    }
    
    function get_my_stores($id_user){
        $stores = $this->get_stores_by_user($id_user);
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
    
    function get_stores_by_st_category($st_category){
        $sql = "SELECT *
                FROM mbf_store join mbf_st_category_store join mbf_st_category
                on mbf_store.id = mbf_st_category_store.store and mbf_st_category_store.st_category = mbf_st_category.id
                and mbf_st_category.id = $st_category";
        $query = $this->db->query($sql);
        return $query->result();
    }
    
   
}

?>