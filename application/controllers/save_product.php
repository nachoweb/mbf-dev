<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Save_product extends CI_Controller {
    
    /**
     * This controller is used by bookmarklet for save products.
     * Example URL:
     *  http://www.mybuyfriends.com/save_products/save/1/image.jpg/22.90/title/description/product_url/store_url/store_name/browser
     * 
     * @author Nacho
     * @version 0.0.0
     */
    public function save($user,$image,$price,$title,$description, $url, $store_url,$store_name, $browser, $status){
        $this->load->model('Product_model');
        $this->Product_model->save_product($user,$image,$price,$title,$description, $url, $store_url,$store_name, $browser , $status);
    }
}
?>
