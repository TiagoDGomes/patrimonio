<?php

function store_uploaded_image($html_element_name, $target_dir, $new_img_height, $preffix="") {
    $original_file = $_FILES[$html_element_name]["name"];
    $target_file = $target_dir . $preffix . basename($original_file);  
    
    if ((function_exists('imagecreatefromjpeg')) && (filesize($original_file) > pow(1024, 2))){              
        $image = new SimpleImage();
        $image->load($_FILES[$html_element_name]['tmp_name']);
        $image->resizeToHeight($new_img_height);
        $image->save($target_file);
    } else {
        if (move_uploaded_file($_FILES[$html_element_name]['tmp_name'], $target_file)) {
            trigger_error('Nao foi salvo',E_USER_WARNING);
        }
    }
    return $target_file; //return name of saved file in case you want to store it in you database or show confirmation message to user
}
    
if (function_exists('imagecreatefromjpeg')){  
   

    /*
    * File: SimpleImage.php
    * Author: Simon Jarvis
    * Copyright: 2006 Simon Jarvis
    * Date: 08/11/06
    * Link: http://www.white-hat-web-design.co.uk/blog/resizing-images-with-php/
    *
    * This program is free software; you can redistribute it and/or
    * modify it under the terms of the GNU General Public License
    * as published by the Free Software Foundation; either version 2
    * of the License, or (at your option) any later version.
    *
    * This program is distributed in the hope that it will be useful,
    * but WITHOUT ANY WARRANTY; without even the implied warranty of
    * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
    * GNU General Public License for more details:
    * http://www.gnu.org/licenses/gpl.html
    *
    */
    
    class SimpleImage {
    
        var $image;
        var $image_type;
    
        function load($filename) {
    
        $image_info = getimagesize($filename);
        $this->image_type = $image_info[2];
        if( $this->image_type == IMAGETYPE_JPEG ) {
    
            $this->image = imagecreatefromjpeg($filename);
        } elseif( $this->image_type == IMAGETYPE_GIF ) {
    
            $this->image = imagecreatefromgif($filename);
        } elseif( $this->image_type == IMAGETYPE_PNG ) {
    
            $this->image = imagecreatefrompng($filename);
        }
        }
        function save($filename, $image_type=IMAGETYPE_JPEG, $compression=75, $permissions=null) {
    
        if( $image_type == IMAGETYPE_JPEG ) {
            imagejpeg($this->image,$filename,$compression);
        } elseif( $image_type == IMAGETYPE_GIF ) {
    
            imagegif($this->image,$filename);
        } elseif( $image_type == IMAGETYPE_PNG ) {
    
            imagepng($this->image,$filename);
        }
        if( $permissions != null) {
    
            chmod($filename,$permissions);
        }
        }
        function output($image_type=IMAGETYPE_JPEG) {
    
        if( $image_type == IMAGETYPE_JPEG ) {
            imagejpeg($this->image);
        } elseif( $image_type == IMAGETYPE_GIF ) {
    
            imagegif($this->image);
        } elseif( $image_type == IMAGETYPE_PNG ) {
    
            imagepng($this->image);
        }
        }
        function getWidth() {
    
        return imagesx($this->image);
        }
        function getHeight() {
    
        return imagesy($this->image);
        }
        function resizeToHeight($height) {
    
        $ratio = $height / $this->getHeight();
        $width = $this->getWidth() * $ratio;
        $this->resize($width,$height);
        }
    
        function resizeToWidth($width) {
        $ratio = $width / $this->getWidth();
        $height = $this->getheight() * $ratio;
        $this->resize($width,$height);
        }
    
        function scale($scale) {
        $width = $this->getWidth() * $scale/100;
        $height = $this->getheight() * $scale/100;
        $this->resize($width,$height);
        }
    
        function resize($width,$height) {
        $new_image = imagecreatetruecolor($width, $height);
        imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());
        $this->image = $new_image;
        }      
    
    }




}
