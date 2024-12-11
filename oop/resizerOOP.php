<?php
class Resizer{
    protected $image;
    protected $image_type;

    // accepted file types
    public function load($filename){
        $image_info = getimagesize($filename);
        $this->image_type = $image_info[2];
        if($this->image_type== IMAGETYPE_JPEG){
            $this->image = imagecreatefromjpeg($filename);
        }elseif ($this->image_type == IMAGETYPE_GIF){
            $this->image = imagecreatefromgif($filename);
        }elseif ($this->image_type== IMAGETYPE_PNG){
            $this->image = imagecreatefrompng($filename);
        }
    }

    // save the image
    public function save($filename, $image_type = IMAGETYPE_JPEG, $compression = 100) {   
        if($image_type==IMAGETYPE_JPEG){
            imagejpeg($this->image, $filename, $compression);
        }elseif ($image_type==IMAGETYPE_GIF){
            imagegif($this->image, $filename);
        }elseif ($image_type==IMAGETYPE_PNG){
            imagepng($this->image, $filename);
        }
    }

    // get the width of the image
    protected function getWidth(){
        return imagesx($this->image);
    }

    // get the height of the image
    protected function getHeight(){
        return imagesy($this->image);
    }

    // resize the image to a specific height
    public function resizeToHeight($height){
        $ratio = $height / $this->getHeight();
        $width = $this->getWidth() * $ratio;
        $this->resize((int)$width, (int)$height); 
    }
    
    // resize the image to a specific width
    public function resizeToWidth($width){
        $ratio = $width / $this->getWidth();
        $height = $this->getHeight() * $ratio;
        $this->resize((int)$width, (int)$height); 
    }

    // scale the image
    public function scale($scale){
        $width = $this->getWidth()*$scale/100;
        $height = $this->getHeight()*$scale/100;
        $this->resize($width, $height);
    }

    // resize the image
    public function resize($width, $height){
        $new_image = imagecreatetruecolor((int)$width, (int)$height);
        imagecopyresampled(
            $new_image, 
            $this->image, 
            0, 0, 0, 0,
            (int)$width, (int)$height,
            $this->getWidth(), 
            $this->getHeight()
        );
        $this->image = $new_image;
    }    
}