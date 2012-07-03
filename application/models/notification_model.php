<?php
/**
 * Model: Message
 * Create: 30/06/2011
 * Version: 1.0
 * Author: Nacho 
 *
 */

class Notification extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
    }
    
    function get_user_notifications(){
        
    }
    
    
}

?>