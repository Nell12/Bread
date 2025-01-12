<?php
   require_once('database.php');

   $breadCategoryID= filter_input (INPUT_GET, 'breadCategoryID', FILTER_VALIDATE_INT);

   if($breadCategoryID == false || $breadCategoryID == NULL){
       $breadCategoryID=1;
   }
   
   //preparing individual breadCategory
   $queryName= 'SELECT * from breadCategories WHERE breadCategoryID= :breadCategoryID';
   $statementName= $db->prepare($queryName);
   $statementName->bindValue(':breadCategoryID', $breadCategoryID);
   $statementName->execute();
   $breadNames= $statementName->fetch();
   $breadName= $breadNames['breadCategoryName'];
   $statementName->closeCursor();

   //preparing the breadCategories
   $queryCategory= 'SELECT * from breadCategories ORDER BY breadCategoryID';
   $statementCategory= $db->prepare($queryCategory);
   $statementCategory->execute();
   $categories= $statementCategory->fetchAll();
   $statementCategory->closeCursor();

   //preparing the breads
   $querybread= 'SELECT * from bread WHERE breadCategoryID= :breadCategoryID ORDER BY breadID';
   $statementbread= $db->prepare($querybread);
   $statementbread->bindValue(':breadCategoryID', $breadCategoryID);
   $statementbread->execute();
   $breads= $statementbread->fetchAll();
   $statementbread->closeCursor();
?>

<html>
    <head>
        <link rel="stylesheet" href="styles.css"/>
        <title>Bao's Menu</title>
    </head>

    <body>
        <?php 
           session_start();
           include("header.php"); 
        ?>
        <main>
            <h1 id="menu">Bao's Menu</h1>
            <aside>
                <h2 class="border">Item</h2>
                <nav class="list">
                    <ul>
                        <?php foreach ($categories as $breadCategory): ?>
                            <li>
                                <a class="list" href="?breadCategoryID=<?php echo $breadCategory['breadCategoryID']?>">
                                <?php echo $breadCategory['breadCategoryName']; ?> </a>
                            </li>
                        <?php endforeach; ?>    
                    </ul>
                </nav>
            </aside>

            <section>
                <h2 class="border"><?php echo $breadName; ?></h2>
                <table class= "table">
                    <tr>
                        <th id="th">Bread Code</th>
                        <th id="th">Bread Name</th>
                        <th id="th">Price</th>
                    </tr>

                    <?php foreach($breads as $bread): ?>
                        <tr>
                            <td id="td">
                                <form id="details" action="details.php" method="get">
                                    <input type="hidden" name="breadID" 
                                    value="<?php echo htmlspecialchars($bread['breadID']);?>"/>
                                    <input id="details_submit" type="submit" value="<?php echo $bread['breadCode'];?>"/>
                                </form>
                            </td>
                            <td id="td"><?php echo $bread['breadName']; ?></td>
                            <td id="td"><?php echo $bread['price']; ?></td>
                            <td> <img src= "Images/<?php echo $bread['breadCode']?>.jpg" alt= "<?php echo $bread['breadCode']?>" height=60 width=60/></td>

                            <?php if(isset($_SESSION['bread'])) { ?>
                               <td id="delete">
                                  <form id="delete_form" name="delete_form" action="delete_product.php" method="post">
                                    <input id="input_category" type="hidden" name="breadCategoryID"
                                      value="<?php echo $bread['breadCategoryID']; ?>"/>
                                    <input id="input_bread" type="hidden" name="breadID" 
                                      value="<?php echo $bread['breadID']; ?>" />
                                    <input id="input_breadcode" type="hidden" name="breadCode"
                                     value="<?php echo $bread['breadCode']; ?>"/>
                                    <input type="submit" value="DELETE"/>
                                  </form>
                               </td>
                            <?php } else {?>
                               <td>
                                <a href="authen_login.php">Login</a>
                               </td>
                            <?php } ?>
                        </tr>

                    <?php endforeach; ?>
                </table>
            </section>
        </main>
        <br>
        <br>
        
        <script>
            document.addEventListener("DOMContentLoaded", ()=>{
              delete_form= document.querySelectorAll("#delete_form");
                              
                  for(let i=0; i<delete_form.length; i++){
                     console.log(delete_form[i]);
                

                     delete_form[i].addEventListener("click", (event)=>{
                        const confirm_delete= confirm("Are you sure you want to delete this item?");
                        if (confirm_delete){
                            event.submit();
                        }
                        else {event.preventDefault()};
                     });
                  }
           });
        </script>

        <?php include("footer.php");?>
    </body>
</html>