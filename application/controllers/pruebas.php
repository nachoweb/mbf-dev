<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pruebas extends CI_Controller {
    
     public function __construct(){
        parent::__construct();
        // Your own constructor code
    }
    
    public function path(){
        echo "ola";
        echo realpath("./images");
    }
}