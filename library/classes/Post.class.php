<?php 

include_once('Db.class.php');

class Post {
    private $image;
    private $description;
    private $tags;
    private $category;
    private $width;
    private $height;
    private $fileName;
    private $imageFileType;
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
     * Get the value of tags
     */ 
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Set the value of tags
     *
     * @return  self
     */ 
    public function setTags($tags)
    {
        $this->tags = $tags;

        return $this;
    }
/**
     * Get the value of category
     */ 
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set the value of category
     *
     * @return  self
     */ 
    public function setCategory($category)
    {
        $this->category = $category;

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
                    $uploadOk = 1;
                } else {
                    throw new Exception ("Error uploading image");
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
                        $this->fileName = $fileName;
                        $this->imageFileType = $imageFileType;
                    }
                } else {
                    throw new Exception ("Error uploading image");
                }
            }
        }
    }
    public function postImg($email){
        //connectie 
        include_once('library/classes/Db.class.php');
        $conn = Db::getInstance();
        $userQ = "select id from users where email = :email";
        $user = $conn->prepare($userQ);
        
        $user->bindParam(":email", $email);
        $user->execute();
        $result = $user->fetch();  
        $userId = $result[0];
        $photo_url = "uploads/".$this->fileName.".".$this->imageFileType;
        $thmb_url = "uploads/".$this->fileName."_thmb.jpg";
        $statement = $conn->prepare("insert into posts (tags, photo_url, thmb_url, title, categories_id, users_id) values (:tags, :photo_url, :thmb_url, :title, :categories_id, :users_id)");

        $statement->bindParam(":tags", $this->tags);
        $statement->bindParam(":photo_url", $photo_url);
        $statement->bindParam(":thmb_url", $thmb_url);
        $statement->bindParam(":title", $this->description);
        $statement->bindParam(":categories_id", $this->category);
        $statement->bindParam(":users_id", $userId);
            // execute
        $result = $statement->execute();
        return $result;
    }

    /* Load results on feed */
    public static function loadPosts($limit, $currentUserID) {
        $conn = Db::getInstance();
        $statement = $conn->prepare("SELECT posts.id, posts.photo_url, posts.title, posts.datetime, users.username FROM ((posts INNER JOIN followers ON posts.users_id = followers.f_id) INNER JOIN users ON posts.users_id = users.id) WHERE followers.u_id = :currentUser ORDER BY posts.id  DESC LIMIT :limit");
        $statement->bindValue(':limit', $limit, PDO::PARAM_INT);
        $statement->bindValue(':currentUser', $currentUserID, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    /* get all posts */
    public static function getAll() {
        $conn = Db::getInstance();
        $statement = $conn->prepare("SELECT posts.id, posts.photo_url, posts.title, posts.datetime, posts.tags, users.username FROM posts  INNER JOIN users ON posts.users_id = users.id  ORDER BY posts.id DESC");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

     /* get all posts */
    public static function getPost($id) {
        $conn = Db::getInstance();
        $statement = $conn->prepare("SELECT * FROM posts WHERE id = :id ORDER BY id DESC");
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function time_elapsed_string($datetime, $full = false) {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);
        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;
        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }
        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }

}
    

?>