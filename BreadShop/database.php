<?php
   $local_dsn= 'mysql:host=localhost;port=3306;dbname=bread_shop';
   $local_username= 'bread_user';
   $local_password= 'pa55word';

   $dsn= $local_dsn;            
   $username= $local_username; 
   $password= $local_password;

   try{
    $db= new PDO($dsn, $username, $password);
   }
   catch (PDOException $exception){
    $error_message= $exception->getMessage();
    echo "There was an error connecting to the database";
    echo "Error Message: $error_message";
    exit();
   }
?>