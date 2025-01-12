<?php
   require_once("database.php");
   
   $breadID= filter_input(INPUT_GET, "breadID");

   $query= "SELECT * FROM bread WHERE breadID= :breadID";
   $statement= $db ->prepare($query);
   $statement->bindValue(":breadID", $breadID);
   $statement->execute();
   $bread= $statement->fetch();
   $statement->closeCursor();

?>

<html>
    <head>
        <title>Details</title>
        <link rel="stylesheet" href="styles.css"/>
    </head>
    <body>
       <?php 
            session_start();
            include("header.php"); 
        ?>

       <main id="bread_details">
           <img id="image" src="Images/<?php echo $bread["breadCode"];?>.jpg" alt="<?php echo $bread["breadName"];?>" length=400 width=400/>
           <br>
           <h1><?php echo $bread["breadName"]?></h1>
           <h3>Price: <?php echo $bread["price"];?></h3>
           <p>About the bread: <?php echo $bread["description"]; ?></p>
       </main>

       <script>
           document.addEventListener("DOMContentLoaded", ()=>{
              const image= document.querySelector("#image");

              image.addEventListener("mouseover", ()=>{
                 if (image.style.filter == ""){
                    image.style.filter= "grayscale(100%)";
                 }
              });

              image.addEventListener("mouseout", ()=>{
                 if(image.style.filter== "grayscale(100%)");
                    image.style.filter= "";
              });
           });
       </script>

       <?php include("footer.php"); ?>
    </body>
</html>