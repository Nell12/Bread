<?php
   function verify($breadCode){
       require("database.php");

       $query= "SELECT breadCode FROM bread WHERE breadCode= :breadCode";
       $statement= $db->prepare($query);
       $statement->bindValue(":breadCode", $breadCode);
       $statement->execute();
       $getdata= $statement->fetch();
       $statement->closeCursor();

       return $getdata;
   }
?>

<?php
   require_once("database.php");
   
   $breadCategoryID=htmlspecialchars(filter_input(INPUT_POST,"breadCategoryID"));
   $breadCode=htmlspecialchars(filter_input(INPUT_POST,"breadCode"));
   $breadName=htmlspecialchars(filter_input(INPUT_POST,"breadName"));
   $breadDescription=htmlspecialchars(filter_input(INPUT_POST,"breadDescription"));
   $breadPrice=htmlspecialchars(filter_input(INPUT_POST,"breadPrice",FILTER_VALIDATE_FLOAT));

   $error_message='';
   if($breadCategoryID==NULL || $breadCode==NULL || $breadName==NULL || $breadDescription==NULL || $breadPrice==FALSE){
      $error_message.= "Make sure you have a value for all categories. ";
   }
   if($breadPrice !=NULL && $breadPrice>100){
      $error_message.="Price must not exceed 100. ";
   }
   if($_FILES['userfile']['name']==NULL){
      $error_message.="Input an image. ";
   }
   
   $duplicate= verify($breadCode);
   if($duplicate!=NULL){
      $error_message.="Duplicate BreadCode. ";
   }

   if ($error_message != ''){
      include("create.php");
      exit();
     }
   
   $query="INSERT INTO bread 
          (breadCategoryID, breadCode, breadName, description, price, dateAdded)
          values
          (:breadCategoryID, :breadCode, :breadName, :breadDescription, :breadPrice, NOW())";
   $statement= $db->prepare($query);
   $statement->bindValue(":breadCategoryID", $breadCategoryID);
   $statement->bindValue(":breadCode", $breadCode);
   $statement->bindValue(":breadName", $breadName);
   $statement->bindValue(":breadDescription", $breadDescription);
   $statement->bindValue(":breadPrice", $breadPrice);

   $statement->execute();
   $statement->closeCursor();
   
   //import picture
   $info= pathinfo($_FILES['userfile']['name']);
   $ext=$info['extension'];
   $newname= "$breadCode.".$ext;

   $target_Path= "Images/".$newname;
   move_uploaded_file($_FILES["userfile"]["tmp_name"], $target_Path);
   
   echo "<h1>Successfully Created!!!</h1>";
   echo "<br>";
   echo "<h3><a href=\"create.php\">Click to go back</a></h3>";
?>