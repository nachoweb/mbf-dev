<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Util {
    public function delete_dir($dir, $borrarme){
        if(!$dh = @opendir($dir)) return;
        while (false !== ($obj = readdir($dh))){
            if($obj=='.' || $obj=='..') continue;
            if (!@unlink($dir.'/'.$obj)) delete_dir($dir.'/'.$obj, true);
        }
        closedir($dh);
        if ($borrarme){
            @rmdir($dir);
        }
    }

}