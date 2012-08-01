<?php
/**
 * Model: Message
 * Create: 30/06/2011
 * Version: 1.0
 * Author: Nacho 
 *
 */

class Notification_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
    }
    
    function get_user_notifications($user_id, $myself_id){
        $this->load->model("Message_model");
        $this->load->model("Session_model");
        
        //Messages
       /* $sql = "select count(mbf_message.id) as 'messages'
                from  mbf_session_user left join mbf_message
                on mbf_session_user.session = mbf_message.session
                where mbf_session_user.user =$user_id
                group by mbf_session_user.session";*/
        $sql = "select count(*) as 'messages'
                from  mbf_session_user join mbf_message
                on mbf_session_user.session = mbf_message.session
                where mbf_session_user.user =$user_id and date > last_visit and mbf_message.user != $user_id
                ";
        $aux = $this->db->query($sql)->result();
        $notifications['messages'] = $aux[0]->messages;
        
        //Products       
       $sql =  "select count(*) as products
                from mbf_product join mbf_session_user
                on mbf_product.session = mbf_session_user.session
                where mbf_session_user.user = $user_id and date > last_visit and mbf_session_user.session != $myself_id
                and mbf_product.user != $user_id";
       $aux = $this->db->query($sql)->result();
       $notifications['products'] = $aux[0]->products;
       return $notifications;
   }
   
   function get_sessions_notifications($user_id, $myself_id){
        $notifications = array();
        $sql =  "select mbf_session_user.session, count(mbf_message.id) as 'messages'
                from  mbf_session_user join mbf_message
                on mbf_session_user.session = mbf_message.session
                where mbf_session_user.user =$user_id and mbf_message.date > mbf_session_user.last_visit and mbf_session_user.session != $myself_id and mbf_message.user != $user_id
                group by mbf_session_user.session";
        $query = $this->db->query($sql);
        $messages = $query->result();
      

       $sql = "select mbf_session_user.session, count(mbf_product.id) as 'products'
                from mbf_product join mbf_session_user
                on mbf_product.session = mbf_session_user.session
                where mbf_session_user.user = $user_id and date > last_visit and mbf_session_user.session != $myself_id and mbf_product.user != $user_id
                group by mbf_session_user.session";
       
       $query = $this->db->query($sql);
       $products = $query->result();
        
        foreach($messages as $message){
            $notifications['messages'][$message->session] = $message->messages;
        }
        foreach($products as $product){
            $notifications['products'][$product->session] = $product->products;
        }
        return $notifications;
   }
    
    
}

?>