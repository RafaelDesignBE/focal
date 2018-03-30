<?php
    class Security {
        public $password;
        public $passwordRepeat;

        public function passwordsCheck(){
            if ($this->passwordLenght() && $this->passwordsAreEqual()){
                return true;
            }
            else {
                return false;
            }
        }

        private function passwordLenght(){
            if (strlen($this->password) <= 8) {
                throw new Exception ("Passwords must be at least 8 characters");
                return false;
            }
            else {
                return true;
            }
        }

        private function passwordsAreEqual(){
            if ($this->password == $this->passwordRepeat){
                return true;
            }
            else {
                throw new Exception ("Passwords don't match");
                return false;
            }
        }
    }

?>