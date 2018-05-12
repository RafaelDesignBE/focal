<?php

    include_once('library/classes/Db.class.php');

    class User {
        private $username;
        private $firstName;
        private $lastName;
        private $email;
        private $password;
        private $status;

        /**
         * Get the value of username
         */ 
        public function getUsername()
        {
                return $this->username;
        }

        /**
         * Set the value of username
         *
         * @return  self
         */ 
        public function setUsername($username)
        {
                if (empty($username)){
                    throw new Exception ("Please enter a username");
                }

                $this->username = $username;

                return $this;
        }

        /**
         * Get the value of firstName
         */ 
        public function getFirstName()
        {
                return $this->firstName;
        }

        /**
         * Set the value of firstName
         *
         * @return  self
         */ 
        public function setFirstName($firstName)
        {
                if (empty($firstName)){
                    throw new Exception ("Please enter a first name");
                }
                $this->firstName = $firstName;

                return $this;
        }

        /**
         * Get the value of lastName
         */ 
        public function getLastName()
        {
                return $this->lastName;
        }

        /**
         * Set the value of lastName
         *
         * @return  self
         */ 
        public function setLastName($lastName)
        {
                if (empty($lastName)){
                    throw new Exception ("Please enter a last name");
                }
                
                $this->lastName = $lastName;

                return $this;
        }

        /**
         * Get the value of email
         */ 
        public function getEmail()
        {
                return $this->email;
        }

        /**
         * Set the value of email
         *
         * @return  self
         */ 
        public function setEmail($email)
        {
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    throw new Exception ("Please enter a valid email");
                }

                $this->email = strtolower($email);

                return $this;
        }

        /**
         * Get the value of password
         */ 
        public function getPassword()
        {
                return $this->password;
        }

        /**
         * Set the value of password
         *
         * @return  self
         */ 
        public function setPassword($password)
        {
                $this->password = $password;

                return $this;
        }

        /**
         * Get the value of status
         */ 
        public function getStatus()
        {
                return $this->status;
        }

        /**
         * Set the value of status
         *
         * @return  self
         */ 
        public function setStatus($status)
        {
                $this->status = $status;

                return $this;
        }

        public function register(){
            //connectie 
            $conn = Db::getInstance();
            //$conn = new PDO("mysql:host=localhost;dbname=focal","root", "");
            $mailCheck = $conn->prepare('select email from users where email = :email');
            $mailCheck->bindParam(":email", $this->email);
            $mailCheck->execute();
            if( $mailCheck->rowCount() > 0 ) { // check if email is already found or not.
                throw new Exception ("That email address is already in use");
           }
           else {
                $statement = $conn->prepare("insert into users (username, first_name, last_name, email, password) values (:username, :firstName, :lastName, :email, :password)");
                $options = [
                    'cost' => 12,
                ];
                $hash = password_hash($this->password, PASSWORD_DEFAULT, $options);
                $statement->bindParam(":username", $this->username);
                $statement->bindParam(":firstName", $this->firstName);
                $statement->bindParam(":lastName", $this->lastName);
                $statement->bindParam(":email", $this->email);
                $statement->bindParam(":password", $hash);
                // execute
                $result = $statement->execute();
                $last_id = $conn->lastInsertId();
                $followSelf = $conn->prepare("insert into followers (u_id, f_id) values (:newUser, :newUser)");
                $followSelf->bindValue(':newUser', $last_id, PDO::PARAM_INT);
                $result = $followSelf->execute();
                return $result;
           }            
        }

        public function login(){
            $conn = Db::getInstance();
            $statement = $conn->prepare('select id from users where email = :email');
            $statement->bindParam(":email", $this->email);
            $statement->execute();
            $currentUserID = $statement->fetch(PDO::FETCH_ASSOC);
            session_start();
            $_SESSION['email'] = $this->email;
            $_SESSION['user_id'] = $currentUserID['id'];
            header('Location: index.php');
        }

        public function loginCheck () {
                $conn = Db::getInstance();
                        $query = "select password from users where email = :email";
                        $statement = $conn->prepare($query);
                        $statement->bindParam(":email", $this->email);
                        $statement->execute();
                        $result = $statement->fetch(PDO::FETCH_ASSOC);
                if(password_verify ( $this->password , $result["password"] )){
                                return true;
                        }
                        else {
                                throw new Exception ("Email and password do not match");
                        }
            }

        public static function loadProfile($userId) {
                $conn = Db::getInstance();
                $statement = $conn->prepare("SELECT users.username, users.profileText, users.email FROM users WHERE users.id = :id");
                $statement->bindValue(':id', $userId, PDO::PARAM_INT);
                $statement->execute();
                return $statement->fetchAll(PDO::FETCH_ASSOC);
        }

        public static function updateProfileText($userId, $profileText) {
                $conn = Db::getInstance();
                $statement = $conn->prepare("UPDATE users SET profileText=:profileText WHERE id = :id");
                $statement->bindValue(':id', $userId, PDO::PARAM_INT);
                $statement->bindValue(':profileText', $profileText, PDO::PARAM_STR);
                $statement->execute();
        } 

        public static function updateEmail($userId, $email) {
                $conn = Db::getInstance();
                $statement = $conn->prepare("UPDATE users SET email=:email WHERE id = :id");
                $statement->bindValue(':id', $userId, PDO::PARAM_INT);
                $statement->bindValue(':email', $email, PDO::PARAM_STR);
                $statement->execute();
        } 

        public static function followUser($userId, $currentUser){
                $conn = Db::getInstance();
                $statement = $conn->prepare("INSERT INTO followers (u_id, f_id) VALUES (:currentUser, :userID)");
                $statement->bindParam(":currentUser", $currentUser);
                $statement->bindParam(":userID", $userId);
                $result = $statement->execute();
        }

        public static function unfollowUser($userId, $currentUser){
                $conn = Db::getInstance();
                $statement = $conn->prepare("DELETE FROM followers WHERE u_id = :currentUser && f_id = :userID");
                $statement->bindParam(":currentUser", $currentUser);
                $statement->bindParam(":userID", $userId);
                $result = $statement->execute();
        }
        

    }
?>