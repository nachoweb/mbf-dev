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
                    where mbf_user.id = '$id_user'");
        return $query->result();
    }
    
    function get_my_stores($id_user){
        //Get category_todas
        $query = $this->db->query("SELECT * FROM mbf_st_categories where user='$id_user' and name='todas' order by  id ASC");
        if ($query->num_rows() > 0){
            $row = $query->row();
            $category = $row->id;
            $products_cats = $this->get_products_by_session($session);
            
            //k: Index of new array; $i: Index of the products_cats; $j:Index for check same product, more than cats
            $k=0;
            for($i=0; $i< count($products_cats); $i++){
                foreach($products_cats[$i] as $key => $value){
                    if($key != "category"){
                        $products[$k]->$key = $value;
                    }else{
                        $products[$k]->categories[] = $value;
                    }
                }
                $j = $i + 1;
                while($j < count($products_cats) && $products_cats[$i]->id == $products_cats[$j]->id){
                    $products[$k]->categories[] = $products_cats[$j]->category;
                    $i++;
                    $j++;
                }
                $k++;
            }
            return $products;
        }else{
            return array();
        }
    }
    
    function get_stores_by_st_category($st_category){
        $sql = "SELECT *
                FROM mbf_product join mbf_product_category join mbf_category
                on mbf_product.id = mbf_product_category.product and mbf_product_category.category = mbf_category.id
                and mbf_category.id = $category_id";
        $query = $this->db->query($sql);
        return $query->result();
    }
   
}

?>