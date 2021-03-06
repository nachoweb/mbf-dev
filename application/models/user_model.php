<?php
/**
 * Model: user
 * Create: 18/05/2011
 * Version: 0.0
 * Author: Nacho 
 *
 */

class User_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
    }
    
    /**
     * Return the object user by user_id
     * @param int $user_id user_id
     * @return Object user 
     */
    function get_user_by_id($user_id) {
        $query = $this->db->query("SELECT * FROM mbf_user where id=$user_id");
        $result = $query->result();
        if ($query->num_rows() > 0){
             return $result[0];
        }else{
            return array();
        }
    }
    
    
    function get_user_by_email($email){
        $query = $this->db->query("SELECT * FROM mbf_user where email='$email'");
        $result = $query->result();
        if ($query->num_rows() > 0){
            return $result[0];
        }else{
            return null;
        }
    }
    
    /**
     * Return an array of objects user with are in the session
     * @param int $session
     * @return array of objects user
     */
    function get_users_by_session($session_id){
        $query = $this->db->query("select *
                        from mbf_session_user join mbf_user join mbf_session
                        on mbf_session_user.user = mbf_user.id and mbf_session_user.session = mbf_session.id
                        where mbf_session.id = $session_id");
        return $query->result();
    }
    
    
    /**
     * checks if an email is already in use
     * @param string $email 
     * @return boolean true if it is already in use
     */
    function check_existing_email($email){
        $sql = "SELECT * from mbf_user WHERE email='$email'";
        $query = $query = $this->db->query($sql);
        if ($query->num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }
    
    /**
     * Registers a new user
     * @param associative array $user_data User datas
     * @return int $user_id 
     */
       
    function register_user($user_data){
        $this->db->insert('mbf_user', $user_data); 
        $user_id = $this->db->insert_id();
        return $user_id;
    }
    
    /**
     * Checks if the login is correct
     * @param string $email
     * @param string $password
     * @return int ID for successfull login, -1 if not.
     */
    
    function check_login($email, $password){
        $sql = "SELECT * from mbf_user WHERE email='$email' and password='$password'";
        $query = $query = $this->db->query($sql);
        if ($query->num_rows() > 0){
            $row = $query->row();
            return $row;
        }else{
            return -1;
        }
    }
    
    function get_user_id_by_category($category_id){
        $query = $this->db->query('SELECT * FROM mbf_category where id='.$category_id);
        $result = $query->result();
        if ($query->num_rows() > 0){
             return $result[0];
        }else{
            return -1;
        }
    }
    
    function get_hex($user_id){
        $query = $this->db->query("SELECT hex FROM mbf_user where id=$user_id");
        $result = $query->result();
        if ($query->num_rows() > 0){
             return $result[0];
        }else{
            return -1;
        }
    }
    
    function refresh_last_visit($user_id, $date){
        $data = array(
                'last_visit' => $date
        );
        $this->db->where('id', $user_id);
        $this->db->update('mbf_user', $data); 
    }
    
    function get_user_session($user_id){
        $query = $this->db->query("SELECT * from mbf_session where mbf_session.user=$user_id and name='myself'");
        $result = $query->result();
        if ($query->num_rows() > 0){
             return $result[0]->id;
        }else{
            return -1;
        }
    }
    
    function delete_user($user_id){
        $sql = "DELETE FROM mbf_user WHERE id=$user_id";
        $query = $this->db->query($sql);
        
        $sql = "DELETE from mbf_product WHERE user=$user_id";
        $query = $this->db->query($sql);
        
        $sql = "DELETE from mbf_SESSION_USER where user=$user_id";
        $query = $this->db->query($sql);
        
        $sql = "DELETE from mbf_category where user=$user_id";
        $query = $this->db->query($sql);
    }
    
    /**
     * Obtenemos usuario o un campo de esto a través del token
     * @param type $hex The user's token
     * @param type $field The field that u want to get
     * @return User object or user field 
     */
    
    function get_user_by_hex($hex, $field = ""){
        //User_id
        $query = $this->db->query("SELECT id FROM mbf_user where hex='$hex'");
        $result = $query->result();
        if ($query->num_rows() > 0){
            if($field == ""){
                return $result[0];
            }else{
                return $result[0]->$field;
            }           
        }else{
            return -1;
        }
    }
    
    function activate($user_id){
        $query = $this->db->query("update mbf_user set activated=1 where id=$user_id");
        return $this->db->affected_rows();
    }
    
    function set_password($user_id, $password){
        $query = $this->db->query("update mbf_user set password='$password' where id=$user_id");
        return $this->db->affected_rows();
    }
    
}

?>