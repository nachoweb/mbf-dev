<?php
/**
 * Model: Products
 * Create: 18/05/2011
 * Version: 1.0
 * Author: Nacho 
 *
 */

class Session_model extends CI_Model {

    function __construct(){
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
    }
    
    /**
     * Return the user sessions.
     * @param $user Can be id_user or user object
     * @return Array of objects
     */
    function get_sessions_by_user($user){
        $id_user = "";
        if(is_int($user)){
            $id_user = $user;
        }else{
            $id_user = $user->id;
        }
        $query = $this->db->query( "select *
                    from mbf_session_user join mbf_session join mbf_user
                    on mbf_session_user.session = mbf_session.id and mbf_session_user.user = mbf_user.id
                    where mbf_user.id = '$id_user'
                    order by date");
        return $query->result();
    }
    
    function get_sessions_notifications_by_user($user){
        $sessions = $this->get_sessions_by_user($user);
        foreach($session as $session){
            //Notifications:
            $products = 0;
            $stores = 0;
            $comments = 0;
        }
    }
    
    function get_session_notifications($session_id , $date){
        $notifications = array();
        $notifications['products'] = 0;
        $notifications['stores'] = 0;
        $notifications['commets'] = 0;
        
        $query = $this->db->query( "select * from mbf_product
                                    where session = $session_id" );
        $products_session = $query->result();
        //Products
        $query = $this->db->query( "select * from mbf_product
                                    where date > '$date' and session = $session_id" );
        $products = $query->result();
        
        //Stores
        foreach ($products as $product) {
            foreach($products_session as $product_session){
            }
        }
    }
    
    function add_session_with_store($name, $user, $store){
        $date = date("Y-n-d H:i:s");
         $data = array(
            "date"      =>  $date,
            "user"      =>  $user,
            "items"     =>  0,
            "name"      =>  $name,
            "store"     =>  $store
        );
        $this->db->insert('mbf_session', $data); 
        $session = $this->db->insert_id();
        return $session;
    }
    
     function add_session($name, $user){
        $date = date("Y-n-d H:i:s");
         $data = array(
            "date"      =>  $date,
            "user"      =>  $user,
            "items"     =>  0,
            "name"      =>  $name,
            "store"     =>  $store
        );
        $this->db->insert('mbf_session', $data); 
        $session = $this->db->insert_id();
        return $session;
    }
}

?>