<?php
   require_once("database.php");
   $breadCategoryID= filter_input(INPUT_POST, 'breadCategoryID');
   $breadID= filter_input(INPUT_POST, 'breadID');
   $breadCode= filter_input(INPUT_POST, 'breadCode');

   if ($breadCategoryID !=FALSE && $breadID !=FALSE){
      $query= "DELETE FROM bread WHERE breadCategoryID= :breadCategoryID AND breadID= :breadID";
      $statement= $db->prepare($query);
      $statement->bindValue(":breadCategoryID", $breadCategoryID);
      $statement->bindValue(":breadID", $breadID);
      $statement->execute();
      $statement->closeCursor();

      unlink("Images/".$breadCode.".jpg");
   }

   include("bread.php");
   exit();

?>