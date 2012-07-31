<?php
/**
 * Model: Message
 * Create: 30/06/2011
 * Version: 1.0
 * Author: Nacho 
 *
 */

class Message_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
    }
    
     function add_message($session_id, $user_id,$text , $date = ""){
        if($date == "")    {   $date = date('Y-m-d H:i:s'); }
        
        $data = array(
        'session'   => $session_id,
        'user'      => $user_id,
        'text'      => $text,
        'date'      => $date
        );
        $this->db->insert('mbf_message', $data); 
        $message_id = $this->db->insert_id();
        return $message_id;
    }
    
    function get_messages_by_session($session_id, $last = 0){
        $sql = "select mbf_message.id, mbf_message.text, mbf_message.user, mbf_message.session, date_format(mbf_message.date, '%k:%i') as 'date', mbf_user.nick
                from mbf_user join mbf_message on mbf_user.id = mbf_message.user
                where mbf_message.session = $session_id";
        if ($last != 0){
            $sql .= " and mbf_message.id > $last";
        }
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }
    
    function get_notifications($user_id , $session_id = 0){
        if($session_id = 0){
            $sql = "select count(mbf_message.id)
                    from mbf_message join mbf_session_user
                    on mbf_message.session = mbf_session_user.session
                    where mbf_session_user.user = $user_id and date > last_visit and mbf_message.user != $user_id";
        }else{
            
        }
        
    }
    
}

?>