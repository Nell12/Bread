<?php
   session_start();
   
   //Clear all session data
   $_SESSION=[];
   //clean up the sesson ID
   session_destroy();
   
   include("breadshop.php");
?>