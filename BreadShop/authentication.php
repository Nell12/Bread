<?php
   function login($email, $breadpassword){
    require("database.php");

    $query='SELECT * FROM breadManagers WHERE emailAddress= :email';
    $statement= $db->prepare($query);
    $statement->bindValue(':email', $email);
    $statement->execute();

    $row= $statement->fetch();
    $statement->closeCursor();

    //check if password matches
    if($row === false){
        //email not there
        return false;
    }
    else{
        $hash= $row['password'];
        return password_verify($breadpassword, $hash);
    }
   }

   function getName($email){
    require("database.php");

    $query= 'SELECT * FROM breadManagers WHERE emailAddress= :email';
    $statement= $db->prepare($query);
    $statement->bindValue(':email', $email);
    $statement->execute();

    $row= $statement->fetch();
    $statement->closeCursor();

    $name='';
    $name.=$row['firstName']." ";
    $name.=$row['lastName']." ";
    $name.="(".$row['emailAddress'].")";

    return $name;
   }
?>

<?php

   //Slide 22
   $email= filter_input(INPUT_POST, 'email');
   $password= filter_input (INPUT_POST, 'password');

   $error_message='';

   if(login($email, $password)){
    //create session
    session_start();

    $name= getName($email);
    $message= "Welcome ".$name."!!!";
    $_SESSION['bread']= $message;

    include ("authen_success.php");
    exit();
   }
   else if ($email == NULL || $password ==NULL){
    $error_message= 'You have empty inputs!!! ';
   }
   else{
    $error_message.= 'Invalid credentials. ';
   }

   if($error_message != ""){
    include("authen_login.php");
    exit();
   }

?>