<?php 
class Upload {
    private $image;
    private $description;
    private $width;
    private $height;
    /**
     * Get the value of image
     */ 
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set the value of image
     *
     * @return  self
     */ 
    public function setImage($image)
    {
        if (empty($image)){
            throw new Exception ("An error uploading image");
        }
        $this->image = $image;

        return $this;
    }

    /**
     * Get the value of description
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */ 
    public function setDescription($description)
    {
        if (empty($description)){
            throw new Exception ("Please add a description");
        }
        $this->description = $description;

        return $this;
    }

/**
     * Get the value of width
     */ 
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * Set the value of width
     *
     * @return  self
     */ 
    public function setWidth($width)
    {
        $this->width = $width;

        return $this;
    }

    /**
     * Get the value of height
     */ 
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Set the value of height
     *
     * @return  self
     */ 
    public function setHeight($height)
    {
        $this->height = $height;

        return $this;
    }

    public function saveImg() {
        if(isset($_POST)) {
            $target_dir = "uploads/";
            $fileName = md5(microtime());
            $target_file = $target_dir . basename($this->image["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            // Check if image file is an image
            if(isset($_POST["submit"])) {
                $check = getimagesize($this->image["tmp_name"]);
                if($check !== false) {
                    echo "File is an image - " . $check["mime"] . ".";
                    $uploadOk = 1;
                } else {
                    echo "File is not an image.";
                    $uploadOk = 0;
                }
            }
        
            // Check if file already exists
            if (file_exists($target_file)) {
                throw new Exception ("Error uploading image");
                $uploadOk = 0;
            }
            // Check file size
            if ($this->image["size"] > 2097152) {
                throw new Exception ("Upload size limit is 2MB");
                $uploadOk = 0;
            }
            // Allow only jpg, pbg and gif
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
                throw new Exception ("Image must be JPG, PNG or GIF");
                $uploadOk = 0;
            }
            $target_file = $target_dir .$fileName.".".$imageFileType;
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                throw new Exception ("Error uploading image");
            // if everything is ok, try to upload file
            } else {
                // upload full image to /uploads
                if (move_uploaded_file($this->image["tmp_name"], $target_file)) {
                    echo "file uploaded";
                    $name = $target_file;
                    list($img_width, $img_height) = getimagesize($name); // get sizes of image
                    $img_ratio = $img_width/$img_height; // get aspect ratio of image
                    
                    // scale image to thmb size with corrrect aspect ratio
                    if ($this->width/$this->height > $img_ratio) {
                        $this->width = $this->height*$img_ratio;
                    } else {
                        $this->height = $this->width/$img_ratio;
                    }
                    
                    // create resized image
                    $output_image = imagecreatetruecolor($this->width, $this->height);
                    switch ($imageFileType) {
                        case "gif"  : $image = imagecreatefromgif($name); $check = 1; break;
                        case "jpeg" : $image = imagecreatefromjpeg($name); $check = 1; break;
                        case "jpg" : $image = imagecreatefromjpeg($name); $check = 1; break;
                        case "png"  : $image = imagecreatefrompng($name); $check = 1; break;
                        default : $check = 0;
                    }
                    
                    // save resized image
                    if($check == 1){
                        imagecopyresampled($output_image, $image, 0, 0, 0, 0, $this->width, $this->height, $img_width, $img_height);
                        imagejpeg( $output_image,"./uploads/".$fileName."_thmb.jpg" );
                    }
                } else {
                    throw new Exception ("Error uploading image");
                }
            }
        }
    }
}
    

?>