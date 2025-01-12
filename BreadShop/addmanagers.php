<?php
   function add_bread_manager($email, $breadpassword, $first, $last) {
    require("database.php");

     $hash = password_hash($breadpassword, PASSWORD_DEFAULT);
     $query = 'INSERT INTO breadManagers (emailAddress, password, firstName, lastName)
              VALUES (:email, :password, :first, :last)';
     $statement = $db->prepare($query);
     $statement->bindValue(':email', $email);
     $statement->bindValue(':password', $hash);
     $statement->bindValue(':first', $first);
     $statement->bindValue(':last', $last);
     $statement->execute();
     $statement->closeCursor();
   }
   
   add_bread_manager("an246@njit.edu", "an246", "Aileen", "Ni");
   add_bread_manager("an24@njit.edu", "an24", "Alli", "Nin");
   add_bread_manager("an2@njit.edu", "an2", "Ai", "Lin");
   add_bread_manager("an@njit.edu", "an", "Eileen", "Li");
   

?>