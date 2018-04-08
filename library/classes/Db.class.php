<?php

class Db {
    private static $conn;


    /* 
    @return PDO connection
    -> if exists -> reutnr exisiting
    -> if !exists -> return new PDO
    */
    public static function getInstance(){
        include_once("settings/db.php");
        if( self::$conn == null ){              
            self::$conn = new PDO('mysql:host='.$db['host'].';dbname=focal',"root", "");
            return self::$conn;
            
        }
        else {
            return self::$conn;
            
        }
    }
}

?>