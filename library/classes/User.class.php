<?php
    class User {
        private $username;
        private $firstName;
        private $lastName;
        private $email;
        private $password;

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
                    throw new Exception ("You must enter a username");
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
                    throw new Exception ("You must enter a first name");
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
                    throw new Exception ("You must enter a last name");
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
                    throw new Exception ("Email not valid");
                }

                $this->email = $email;

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

        public function register(){
            //connectie 
            $conn = @new PDO("mysql:host=localhost;dbname=focal","root", "");
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

            // query (sql injectie!!)

            // execute
            $result = $statement->execute();
            return $result;

            // antwoord geven
        }

        public function login(){
            session_start();
			$_SESSION['email'] = $this->email;
            header('Location: index.php');
        }
    }
?>