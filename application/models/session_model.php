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
        if(is_numeric($user)){
            $id_user = $user;
        }else{
            $id_user = $user->id;
        }
        $query = $this->db->query( "select mbf_session.id, mbf_session.name, mbf_session.store, mbf_session.user, date_format(mbf_session.date,'%e-%M-%Y') as 'date'
                                    from mbf_session_user join mbf_session
                                    on mbf_session_user.session = mbf_session.id
                                    where mbf_session_user.user =$id_user
                                    order by mbf_session.date");
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
        $hex = $this->rand_text(32,32);
         $data = array(
            "date"      =>  $date,
            "user"      =>  $user,
            "items"     =>  0,
            "name"      =>  $name,
            "hex"       =>  $hex
        );
        $this->db->insert('mbf_session', $data); 
        $session_id = $this->db->insert_id();
        $data['id'] = $session_id;
        return $data;
    }
    
    
    function add_session_user($session_id, $user_id){
        $data = array(
            "session"   =>  $session_id,
            "user"      =>  $user_id,
        );
        @$this->db->insert('mbf_session_user', $data);
    }
    
    function add_session_user_by_hex($user, $hex){
        //Get session
        $session = $this->get_session_by_hex($hex);
         $data = array(
            "session"   =>  $session->id,
            "user"      =>  $user,
        );
        @$this->db->insert('mbf_session_user', $data);
    }
    
    function get_session_by_hex($hex){
        $query = $this->db->query("SELECT * FROM mbf_session where hex='$hex'");
        $result = $query->result();
        if ($query->num_rows() > 0){
             return $result[0];
        }else{
            return array();
        }
    }
    
     function get_session_by_id($session_id){
        $query = $this->db->query("SELECT * FROM mbf_session where id=$session_id");
        $result = $query->result();
        if ($query->num_rows() > 0){
             return $result[0];
        }else{
            return array();
        }
    }
    function get_session($session_id){
        $query = $this->db->query(" SELECT mbf_session.id, mbf_session.date, mbf_session.user, mbf_session.name, mbf_session.store
                                    FROM mbf_session
                                    where mbf_session.id = $session_id");
        $result = $query->result();
        if ($query->num_rows() > 0){
             return $result[0];
        }else{
            return array();
        }
    }
    
    function get_session_and_store($session_id){
        $query = $this->db->query(" SELECT mbf_session.id, mbf_session.date, mbf_session.user, mbf_session.name, mbf_session.store, mbf_store.logo, mbf_store.url
                                    FROM mbf_session join mbf_store
                                    on mbf_store.id = mbf_session.store
                                    where mbf_session.id = $session_id");
        $result = $query->result();
        if ($query->num_rows() > 0){
             return $result[0];
        }else{
            return array();
        }
    }
    
    
    
    function check_user_session($user_id, $session_id){
        $query = $this->db->query("SELECT * FROM mbf_session_user where session = $session_id and user = $user_id");
        $result = $query->result();
        if ($query->num_rows() > 0){
             return true;
        }else{
            return false;
        }
    }
    
    function get_users($session_id){
        $query = $this->db->query( "SELECT * 
                                    FROM mbf_session_user join mbf_user
                                    on mbf_session_user.user = mbf_user.id
                                    where session = $session_id");
        $result = $query->result();
        if ($query->num_rows() > 0){
             return array();
        }else{
            return $result;
        }
    }
    
    private function rand_text($min = 10,$max = 20,$randtext = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890'){
        if($min < 1) $min=1;
        $varlen = rand($min,$max);
        $randtextlen = strlen($randtext);
        $text = '';
        for($i=0; $i < $varlen; $i++){
            $text .= substr($randtext, rand(1, $randtextlen), 1);
        }
        return $text;
    }
}

?>