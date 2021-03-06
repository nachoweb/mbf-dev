<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Save_product extends CI_Controller {
    
    /**
     * This controller is used by bookmarklet for save products.
     * Example URL:
     *  
     * 
     * @author Nacho
     * @version 0.0.0
     */
    //$user = "",$image = "",$price = "",$title = "",$description = "", $url = "", $store_url = "",$store_name = "", $browser = "", $status = "", $session = "", $myself = "", $category = ""
    public function save(){
        $this->load->library('session');
        $this->load->model('Product_model');
        //data = array($product_id , $user_id);
        $user =     $this->input->post("mbf-hex");
        $image =    $this->input->post('mbf-image');
        $price =    $this->utf8_urldecode($this->input->post('mbf-marklet-price'));
        $title =    $this->utf8_urldecode($this->input->post('mbf-marklet-title'));       
        $url =      $this->input->post('mbf-url');       
        $browser =  $this->input->post('mbf-marklet-browser');
        $status =   $this->input->post('mbf-marklet-status');
        $session =  $this->input->post('mbf-sessions');
        $myself =   $this->input->post('mbf-myself');
        $category = $this->input->post('mbf-categories');        
        $store_url = $this->input->post('mbf-marklet-shop');
        $store_name = $this->input->post('mbf-store-name');
        $description = $this->utf8_urldecode($this->input->post('mbf-marklet-comment'));
        $data =     $this->Product_model->save_product($user,$image,$price,$title,$description, $url, $store_url,$store_name, $browser , $status, $session, $myself, $category);      
        print_r($data);
        $this->save_img($image, $data['user_id'], $data['product_id']);
        echo $this->input->post('mbf-myself');
        echo $this->input->post("mbf-hex");
        //Analiticas
        
        $click = $this->check_sent($data['user_id'], $data['store']);     
        print_r($click);
        if(!is_int($click)){
            $this->saved_sent($data['user_id'],$click->product, $click->session);
        }
    }
    
    private function save_img($image, $dir, $file_new_name) { 
        $image = urldecode($image);
        $img_file = file_get_contents($image); 
        $image_path = parse_url($image);
        
        $img_path_parts = pathinfo($image_path['path']); 

        $filename = $img_path_parts['filename'];
        $img_ext = $img_path_parts['extension']; 
        //echo "---------USER ID: $user_id <br/>";
        $aux = "/images/products/".$dir."/";
        //echo $aux."<br/>";
        $path = $this->config->item('real_path').$aux;
        //echo "PATH: $path <br/>";
        $filex = $path ."/". $file_new_name . "." .$img_ext; 
        //echo $filex;
        $fh = fopen($filex, 'w'); 
        fputs($fh, $img_file); 
        fclose($fh); 
        $this->resize($filex,$path );
        $this->create_thumb($filex , $path, $file_new_name , $img_ext);
        return filesize($filex); 
    }
    
    private function resize($image, $path){
        $file_data = getimagesize($image);
        $params = array('name' => $image);
        echo "$image <br/>";
        $this->load->library('Image', $params, "resize");
        $width = $file_data[0];
        $height = $file_data[1];
       
        //Redimensionar original
        if($width > 400 || $height > 400){
            if($width > $height){
                if($width/$height >= 2){
                    $new_height = 300;
                }else{
                    $new_height = 400;
                }
                $this->resize->height($new_height);
            }else{
                if($height/$width >= 2){
                    $new_width = 300;
                }else{
                    $new_width = 400;
                }
                $this->resize->width($new_width);
            }
            $this->resize->save();
        }
    }
    
    private function create_thumb($image, $path, $filename, $extension){
        $x = 0; $y = 0;
        $params = array('name' => $image);
        $this->load->library('Image', $params, "thumb");
        $file_data = getimagesize($image);
        $width = $file_data[0];
        $height = $file_data[1];
         $this->thumb->name("thumbs/$filename");
         //Para posible crop
        if($width >= $height){
            //Redimensionamos
            $this->thumb->height(145);
            $this->thumb->save();
            //Crop
            $params = array('name' => "$path/thumbs/$filename.$extension");
            $this->load->library('Image', $params, "crop");
            $file_data = getimagesize($params['name']);
            $width = $file_data[0];
            $height = $file_data[1];
            $x =(int) (($width - 129) / 2);
            $x > 0 ? $x : 0;
            $this->crop->crop((int) $x,0);
            $this->crop->width(129);
            $this->crop->height(145);
            $this->crop->save();
        }else{
            //Redimensionamos
            $this->thumb->width(129);
            $this->thumb->save();
            //Crop
            $params = array('name' => "$path/thumbs/$filename.$extension");
            $this->load->library('Image', $params, "crop");
            $file_data = getimagesize($params['name']);
            $width = $file_data[0];
            $height = $file_data[1];
            $y = (int)(($height - 145) / 2);
            $y > 0 ? $y : 0;
            $this->crop->crop( 0 , $y);
            $this->crop->width(129);
            $this->crop->height(145);
            $this->crop->save();
        }
      /*  $x = 0;
        $y = 0;
        if( $width > 166)   {  $x = ($width - 166) / 2;      }
        if( $height > 187)  {  $y = ($height - 187) / 2;     }
        $this->image->crop($x,0);
        $this->image->height(187);
        $this->image->width(166);
        $this->image->name("thumbs/$filename");
        $this->image->save();*/
    }
    
    public function hola(){
        echo "HOLA";
    }
    
     public function saved_sent($user_id,$product_id, $session_id){
      
        $this->load->model('Ana_model');
        $this->Ana_model->add_saved_sent($user_id, $product_id, $session_id);
    }
    
    public function check_sent($user_id, $store){
        $this->load->model('Ana_model');
        echo "\n $user_id-$store-";
        if($user_id){
             $click = $this->Ana_model->get_st_click($user_id, $store);
             if(!is_null($click)){
                 return $click;
             }else{
                 return 0;
             }
        }
    }
    
    /*private function crop($params, $width = ""){
        $this->load->library('Image', $params, "crop");
        $file_data = getimagesize($params['name']);
        $width = $file_data[0];
        $height = $file_data[1];
        $x = ($width - 166) / 2;
        $this->crop->crop(($width/2)-80,0);
        $this->crop->width(166);
        $this->crop->height(187);
        $this->crop->save();
    }*/
    
    private function utf8_urldecode($str) {
        $str = preg_replace("/%u([0-9a-f]{3,4})/i","&#x\\1;",urldecode($str));
        return html_entity_decode($str,null,'UTF-8');;
    }
    
}
?>
