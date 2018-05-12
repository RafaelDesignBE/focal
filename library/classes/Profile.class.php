<?php 

include_once('Db.class.php');

class Profile {
    
    public static function loadProfile($userId) {
        $conn = Db::getInstance();
        $statement = $conn->prepare("SELECT users.username FROM users WHERE users.id = :id");
        $statement->bindValue(':id', $userId, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

}
    

?>