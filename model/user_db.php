<?php
class UserDB {
    
    public static function getUsers() {
      $db = Database::getDB();

      $query = 'SELECT * FROM users
                ORDER BY lastName';
      $statement = $db->prepare($query);
      $statement->execute();
      $rows = $statement->fetchAll();
      $statement->closeCursor();
      
      $users = array();
      foreach($rows as $row) {
          $i = new User(
                  $row['firstName'], $row['lastName'],
                $row['userName'], $row['password']);
          $i->setID($row['userID']);
          $users[] = $i;
      }
      return $users;
  }

  public static function addUser($i) {
    $db = Database::getDB();
    
    $query = 'INSERT INTO users
                 (firstName, lastName, userName, email, password)
              VALUES
                 (:first_name, :last_name, :user_name, :email, :password)';
    $statement = $db->prepare($query);
    $statement->bindValue(':first_name', $i->getFirstName());
    $statement->bindValue(':last_name', $i->getLastName());
    $statement->bindValue(':user_name', $i->getUserName());
    $statement->bindValue(':password', $i->getPassword());
    $statement->execute();
    $statement->closeCursor();
}
   
    public static function authenticationUser($userEntry) {
        $db = Database::getDB();
        $query = 'SELECT password FROM users WHERE userName = :entry';
        $statement = $db->prepare($query);
        $statement->bindValue(':entry', $userEntry);
        $statement->execute();
        $hashed_password = $statement->fetch();
        $statement->closeCursor();
        return $hashed_password;
    }

    public static function authenticationUsername($userEntry) {
        $db = Database::getDB();
        $query = 'SELECT userName FROM users WHERE userName = :entry';
        $statement = $db->prepare($query);
        $statement->bindValue(':entry', $userEntry);
        $statement->execute();
        $username = $statement->fetch();
        $statement->closeCursor();
        return $username;
    }
    
    public static function changeUser($newUser, $oldUser) {
        $db = Database::getDB();
        $query = 'UPDATE users
                    SET userName = :newUser
                  WHERE userName = :oldUser'; 
        $statement = $db->prepare($query);
        $statement->bindValue(':newUser', $newUser);
        $statement->bindValue(':oldUser', $oldUser);
        $statement->execute();
        $statement->closeCursor();
    }

    public static function changePassword($hash, $user) {
        $db = Database::getDB();
        $query = 'UPDATE users
                    SET password = :newPass
                  WHERE userName = :user'; 
        $statement = $db->prepare($query);
        $statement->bindValue(':newPass', $hash);
        $statement->bindValue(':user', $user);
        $statement->execute();
        $statement->closeCursor();
    }

    public static function duplicateUser($userTest) {
        $db = Database::getDB();
        $query = 'SELECT userName FROM users
                  WHERE userName = :userTest'; 
        $statement = $db->prepare($query);
        $statement->bindValue(':userTest', $userTest);
        $statement->execute();
        $userResult = $statement->fetch();
        $statement->closeCursor();
        
        return $userResult;
    }


    public static function uploadImage($user_id, $image) {
        $db = Database::getDB();

        $query = 'UPDATE users SET image = :image
        WHERE userID = :user_id';
        $statement = $db->prepare($query);
        $statement->bindValue(':image', $image);
        $statement->bindValue(':user_id', $user_id);
        $statement->execute();
        $statement->closeCursor();
    }

    public static function fetchUserID($entry) {
        $db = Database::getDB();

        $query = 'SELECT userID FROM users
                  WHERE userName = :entry';
        $statement = $db->prepare($query);
        $statement->bindValue(':entry', $entry);
        $statement->execute();
        $userID = $statement->fetch();
        $statement->closeCursor();
        return $userID;
    }

    public static function fetchImage($user_id) {
        $db = Database::getDB();

        $query = 'SELECT image FROM users
                  WHERE userID = :user_id';
        $statement = $db->prepare($query);
        $statement->bindValue(':user_id', $user_id);
        $statement->execute();
        $image = $statement->fetch();
        $statement->closeCursor();
        return $image;
    }
}
?>

