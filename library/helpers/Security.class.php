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
                return false;
            }
        }
    }

?>