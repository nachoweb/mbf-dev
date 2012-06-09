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
    
    /**
     * Get array of products in a session
     * @param int $session_id Session id
     * @return array Array of products 
     */
    function get_products_by_session($session_id) {
        $sql = "select mbf_product.id, mbf_product_category.category, mbf_product.title,mbf_product.image, mbf_product.price, mbf_product.description, mbf_product.url, mbf_store.url 'store_url', mbf_store.name 'store_name'
            from mbf_product join mbf_store join mbf_product_category
            on mbf_product.store = mbf_store.id and mbf_product.id = mbf_product_category.product
            where session=$session_id
            order by mbf_product.id";
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    
    
    function get_products_by_category($category_id){
        $sql = "SELECT *
                FROM mbf_product join mbf_product_category join mbf_category
                on mbf_product.id = mbf_product_category.product and mbf_product_category.category = mbf_category.id
                and mbf_category.id = $category_id";
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    /**
     * Get product object by id
     * @param int $id the product id
     * @return object product 
     */
    function get_product_by_id($id){
        $query = $this->db->query('SELECT * FROM mbf_prodcut where id='.$id);
        return $query->result();
    }
    
    /**
     * Get the user products in myself session
     * @param int $id_user User id
     * @return array of objects product 
     */
    
    function get_my_products($id_user){
        //Get session user
        $query = $this->db->query("SELECT * FROM mbf_session where user='$id_user' and name='myself'");
        if ($query->num_rows() > 0){
            $row = $query->row();
            $session = $row->id;
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
    
    
    function get_my_products_and_cats($id_user){
        
    }
    
    /**
     * Save in database the a new product. Add stores and relation between user and store if it is necessary
     * @param int       $user user_id 
     * @param string    $image Url of the product picture
     * @param string    $price Product price
     * @param string    $title Product title
     * @param string    $description Product description
     * @param string    $url Product URL (URL when the user selects the photo)
     * @param string    $store_url Store url
     * @param string    $store_name Store name
     * @param string    $browser User browser
     * @param string    $status  public or private
     */
    
    function save_product($hex,$image,$price,$title,$description, $url, $store_url,$store_name, $browser, $status){
        
        //User_id
        $query = $this->db->query("SELECT id FROM mbf_user where hex=$hex");
        $result = $query->result();
        if ($query->num_rows() > 0){
            $user_id = $result[0]['id'];
        }else{
            return -1;
        }
        //$user_id = $this->session->userdata('user_id');
            
        //Get session user
        $query = $this->db->query("SELECT * FROM mbf_session where user='$user_id' and name='myself'");
        $row = $query->row();
        $session = $row->id;
        
        //Store
        $query = $this->db->query("SELECT * FROM mbf_store where url='$store_url'");
        if ($query->num_rows() > 0){
            $row = $query->row();
            $store = $row->id;
        
            //Check user-store
            $query = $this->db->query("SELECT * FROM mbf_user_store where store=$store AND user='$user_id'");
            if ($query->num_rows() == 0){
                //Insert User Store
                $query = $this->db->query("insert into mbf_user_store(store, user) values ($store, '$user_id')");
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
            $query = $this->db->query("insert into mbf_user_store(store, user) values ($store, '$user_id')");
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
        
        //Category-product
        $ci =& get_instance();
        $ci->load->model('Category_model');
        $my_products = $ci->Category_model->get_category_my_product($user_id);
        $data = array(
            'product'         => $title,
            'category'        => $image
        );
        $query = $this->db->query("insert into mbf_product_category(product, category) values ($product, $my_products)");
    }
}

?>