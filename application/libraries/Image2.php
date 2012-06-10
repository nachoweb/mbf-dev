<?php
/* php image resizing class
About:
This is a php image resizing class. I wrote this class to make it easier to
properly resize images for my website. Before I wrote this class I manually
resized and compressed all images I put on my website. Right now I can make php
do it and still maintain proper proportions etc.
Right now it only works with the Jpeg image format, but I might make it work with
more formats soon (Jpeg is all I really need).

Required:
To make this image class work you will need the following software installed
- php, version 4.0.6 or later, with GD support
- GD version 2.0.1 or later, with Jpeg support
- and ofcourse a webserver

HowTo:
Using this image class is simple and straightforward, there are 3 steps which
have to take place for the class to work:
-  Load a image with the loadImage($path) function
-  Resize the image using any of the resize*(*) functions
-  Save a image with the saveImage($path, $quality=75)
-  Clear the memory of the image by using clearImage()
I have included a small example at the bottem of this file

License:
Do whatever you want with it aslong as you leave this statement intact 
and in the same file as the class definition.

Contact:
Got any questions, requests, changes or whatever, please contact me.

Greetings,
Timothy Kanters 
< tph.kanters@wanadoo.nl >
< http://www.TimothyKanters.com >
*/

class Image2
{
    var $image = FALSE;
    var $image_type = 2; //1=gif 2=jpeg, 3=png, 4=swf
    
    function loadImage($path)
    /*
    This function loads the image you want to resize.
    The function will return TRUE on a succes and FALSE on failure
    */
    {
        if ( $this->image ) {
            imagedestroy($this->image);
        }
        
        $img_sz = getimagesize($path);
        switch( $img_sz[2] ){
            case 1: 
                $this->image_type = "GIF";
                if ( !($this->image = imageCreateFromGif($path)) ) {
                    return FALSE;
                } else {
                    return TRUE;
                }
                break;
            case 2: 
                $this->image_type = "JPG";
                if ( !($this->image = imageCreateFromJpeg($path)) ) {
                    return FALSE;
                } else {
                    return TRUE;
                }
                break;
            case 3: 
                $this->image_type = "PNG";
                if ( !($this->image = imageCreateFromPng($path)) ) {
                    return FALSE;
                } else {
                    return TRUE;
                }
                break;
            case 4: 
                $this->image_type = "SWF";
                if ( !($this->image = imageCreateFromSwf($path)) ) {
                    return FALSE;
                } else {
                    return TRUE;
                }
                break;
            default:
                return FALSE;
        }
    }
    
    function saveImage($path, $quality=75)
    /*
    Save the image, to either a new or an already existing file.
    The quality setting determines the quality of the image (0 to 100).
    The function will return TRUE on a succes and FALSE on failure
    */
    {
        if (!$this->image) {
            return FALSE;
        }
        $fp = fopen($path, "w");
        if (!$fp) {
            return FALSE;
        } else {
            fclose($fp);
            if (!imageJpeg($this->image, $path, $quality)) {
                return FALSE;
            } else {
                return TRUE;
            }
        }
    }
    
    function clearImage()
    /*
    Clears the memory used for the image (if it is loaded)
    This function is required to ensure that there are no memory leaks!
    you have to run this function after your resizing is complete.
    The function always returns TRUE
    */
    {
        if ($this->image) {
            imagedestroy($this->image);
            $this->image = FALSE;
            return TRUE;
        } else {
            return TRUE;
        }
    }
    
    function getWidth()
    /*
    returns the width of the loaded image
    */
    {
        if (!$this->image) {
            return 0;
        }
        return imageSX($this->image);
    }
    
    function getHeight()
    /*
    returns the Height of the loaded image
    */
    {
        if (!$this->image) {
            return 0;
        }
        return imageSY($this->image);
    }
    
    function resizeW($newWidth)
    /*
    resizes an image accordingly to fit the newWidth and remain proportions
    */
    {
        if (!$this->image) {
            return FALSE;
        }
        $oldWidth = imageSX($this->image);
        $oldHeight = imageSY($this->image);
        $newHeight = ($oldHeight / ($oldWidth / $newWidth));
        
        $imageNew = ImageCreateTrueColor($newWidth, $newHeight);    
        imageCopyResampled($imageNew, $this->image, 0, 0, 0, 0, $newWidth, $newHeight, $oldWidth, $oldHeight);
        imageDestroy($this->image);
        $this->image = $imageNew;
        return TRUE;
    }
    
    function resizeH($newHeight)
    /*
    resizes an image accordingly to fit the newHeight and remain proportions
    */ 
    {
        if (!$this->image) {
            return FALSE;
        }
        $oldWidth = imageSX($this->image);
        $oldHeight = imageSY($this->image);
        $newWidth = ($oldWidth / ($oldHeight / $newHeight));
        
        $imageNew = ImageCreateTrueColor($newWidth, $newHeight);    
        imageCopyResampled($imageNew, $this->image, 0, 0, 0, 0, $newWidth, $newHeight, $oldWidth, $oldHeight);
        imageDestroy($this->image);
        $this->image = $imageNew;
        return TRUE;
    }
        
    function resizeWH($maxWidth, $maxHeight, $stretch=FALSE)
    /*
    resizes an image accordingly to fit the maxWidth and maxHeight.
    By default it retains proportions. If however stretch is set to TRUE it
    will stretch the image to the maxWidth and maxHeight.
    */ 
    {
        if (!$this->image) {
            return FALSE;
        }
        $oldWidth = imageSX($this->image);
        $oldHeight = imageSY($this->image);
        $newWidth= $maxWidth;
        $newHeight= $maxHeight;        
        if (!$stretch) {
            $ratio = $oldWidth / $oldHeight;
            if (($maxWidth  / $maxHeight) < $ratio) {
                $newHeight = ($oldHeight / ($oldWidth / $maxWidth));
            } else {
                $newWidth = ($oldWidth / ($oldHeight / $maxHeight));
            }
        }
        
        $imageNew = ImageCreateTrueColor($newWidth, $newHeight);
        imageCopyResampled($imageNew, $this->image, 0, 0, 0, 0, $newWidth, $newHeight, $oldWidth, $oldHeight);
        imageDestroy($this->image);
        $this->image = $imageNew;
        return TRUE;
    }
    
    function resizeCropped($width, $height)
    /*
    resizes an image to the width and height arguments.
    If needed parts of the image will be cropped to remain proportions
    ** note this is a function I quickly hacked in, I hope it works ok,
       but I haven't had a chance to properly test it, or to review the code I wrote here yet
    */
    {
        if (!$this->image) {
            return FALSE;
        }
        $oldWidth = imageSX($this->image);
        $oldHeight = imageSY($this->image);
        
        $ratioW = $oldWidth / $width;
        $ratioH = $oldHeight / $height;
        if ($ratioH > $ratioW) {
            // some parts from the height will have to be cut off
            $newWidth = $oldWidth;
            $newHeight = $height * $ratioW;
            $srcX = 0;
            $srcY = +($oldHeight - $newHeight) / 2;
        } else {
            // some parts from the width will have to be cut off
            $newWidth = $width * $ratioH;
            $newHeight = $oldHeight;
            $srcX = +($oldWidth - $newWidth) / 2;
            $srcY = 0;
        }
        $imageNew = ImageCreateTrueColor($newWidth, $newHeight);    
        imageCopyResized($imageNew, $this->image, 0, 0, $srcX, $srcY, $oldWidth, $oldHeight, $oldWidth, $oldHeight);
        imageDestroy($this->image);
        $this->image = $imageNew;
        
        // Now we are actually going to resample the image to the correct size        
        $oldWidth = $newWidth;
        $oldHeight = $newHeight;
        $newWidth = $width;
        $newHeight = $height;
                
        $imageNew = ImageCreateTrueColor($newWidth, $newHeight);    
        imageCopyResampled($imageNew, $this->image, 0, 0, 0, 0, $newWidth, $newHeight, $oldWidth, $oldHeight);
        imageDestroy($this->image);
        $this->image = $imageNew;
        
        return TRUE;    
    }
}
?>