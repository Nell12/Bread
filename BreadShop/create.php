<?php
   require_once("database.php");

   //get the breadCategoryName
   $query="SELECT * FROM breadCategories";
   $statement= $db->prepare($query);
   $statement->execute();
   $categories= $statement->fetchAll();
   $statement->closeCursor();

   if(!isset($breadCode)){$breadCode="";}
   if(!isset($breadName)){$breadName="";}
   if(!isset($breadDescription)){$breadDescription="";}
   if(!isset($breadPrice)){$breadPrice="";}
   if(!isset($error_message)){$error_message="";}

?>

<html>
    <head>
        <title>Add an item</title>
        <link rel="stylesheet" href="styles.css"/>
    </head>

    <body>
        <?php 
           session_start();
           include("header.php"); 
        ?>
        <h1 class="create" >Create Unique Bakeries for Bao</h1>

        <?php if(!empty($error_message)) { ?>
            <p style="color:red;">
               <strong> <?php echo htmlspecialchars($error_message); ?> </strong>
            </p>
        <?php } ?>

        <main class="create">
            <form id="create_form" enctype="multipart/form-data" action="create_product.php" method="post">
                <label>Category: </label>
                <!--Drop down-->
                <select name="breadCategoryID">
                   <?php foreach ($categories as $category):?>
                    <option value="<?php echo $category['breadCategoryID'];?>">
                       <?php echo $category['breadCategoryName']; ?>
                    </option>
                   <?php endforeach;?>
                </select>
                <br>

                <label>Bread Code:</label>
                <input id="breadCode" type="text" name="breadCode"
                value= "<?php echo htmlspecialchars($breadCode);?>"/>
                <span style="color: red; font-size: 15px">*</span>
                <br>

                <label>Name:</label>
                <input id="breadName" type="text" name="breadName"
                value= "<?php echo htmlspecialchars($breadName);?>"/>
                <span style="color: red; font-size: 15px">*</span>
                <br>

                <label>Description:</label>
                <input id="breadDescription" type="text" name="breadDescription"
                value= "<?php echo htmlspecialchars($breadDescription);?>"/>
                <span style="color:red; font-size: 15px">*</span>
                <br>

                <label>Price:</label>
                <input id="breadPrice" type="text" name="breadPrice"
                value= "<?php echo htmlspecialchars($breadPrice);?>"/> 
                <span style="color:red; font-size: 15px">*</span> 
                <br>
                
                <label>Please upload a picture</label>
                <br>
                <input id= "breadImage" type="file" name="userfile"/>
                <span style="color:red; font-size: 15px">*</span>
                <br>

                <input class= "create" id="create" type="submit" value="CREATE!"/>
                <input class= "create" id="reset" type="reset" value="Reset"/>
            </form>
        </main>

        <script>
            document.addEventListener("DOMContentLoaded", ()=>{
                const form= document.querySelector("#create_form");
                form.addEventListener("submit", submit =>{
                   let event= true;

                   const breadCode= document.querySelector("#breadCode");
                   const breadCodeText= breadCode.value;
                   const breadCodeSpan= breadCode.nextElementSibling;
                   if (breadCodeText == ""){
                       breadCodeSpan.innerHTML= "Please Enter a Value";
                       event= false;
                   }
                   else if (breadCodeText.length < 4 || breadCodeText.length >10){
                       breadCodeSpan.innerHTML= "Length must be between 4 and 10";
                       event= false;
                   }
                   else
                      breadCodeSpan.innerHTML= "*";


                   const breadName= document.querySelector("#breadName");
                   const breadNameText= breadName.value;               
                   const breadNameSpan= breadName.nextElementSibling;
                   if (breadNameText == ""){
                       breadNameSpan.innerHTML= "Please Enter a Value";
                       event= false;
                   }
                   else if (breadNameText.length < 10 || breadNameText.length >100){
                       breadNameSpan.innerHTML= "Length must be between 10 and 100";
                       event= false;
                   }
                   else
                      breadNameSpan.innerHTML= "*";


                   const breadDescription= document.querySelector("#breadDescription");
                   const breadDescriptionText= breadDescription.value;                   
                   const breadDescriptionSpan= breadDescription.nextElementSibling;
                   if (breadDescriptionText == ""){
                       breadDescriptionSpan.innerHTML= "Please Enter a Value";
                       event= false;
                   }
                   else if (breadDescriptionText.length < 10 || breadDescriptionText.length >255){
                       breadDescriptionSpan.innerHTML= "Length must be between 10 and 255";
                       event= false;
                   }
                   else
                      breadDescriptionSpan.innerHTML= "*";

                   const breadPrice= document.querySelector("#breadPrice");
                   const breadPriceText= breadPrice.value;
                   const breadPriceSpan= breadPrice.nextElementSibling;
                   if (breadPriceText == ""){
                       breadPriceSpan.innerHTML= "Please Enter a Value";
                       event= false;
                   }
                   else if (isNaN(parseFloat(breadPriceText))){
                       breadPriceSpan.innerHTML= "Please input a numeric value";
                       event= false;
                   }
                   else if (parseFloat(breadPriceText) > 100000){
                       breadPriceSpan.innerHTML= "Price must not exceed 10000";
                       event= false;
                   }
                   else if (parseFloat(breadPriceText) <= 0){
                       breadPriceSpan.innerHTML= "Price must not be 0 or negative";
                       event= false;
                   }
                   else
                      breadPriceSpan.innerHTML= "*";

                   const breadImage= document.querySelector("#breadImage");
                   const breadImageText= breadImage.value;                
                   const breadImageSpan= breadImage.nextElementSibling;
                   if (breadImageText == ""){
                    breadImageSpan.innerHTML= "Please upload an image";
                    event= false
                   }
                   else{
                    breadImageSpan.innerHTML= "*";
                   }

                   if (event)
                      submit.submit();
                   else
                      submit.preventDefault();
                });

                const reset= document.querySelector('#reset');
                reset.addEventListener("click", () => {
                    const form= document.querySelector('#create_form');
                    const spans= form.querySelectorAll('span');

                    for (let i=0; i<spans.length; i++){
                        spans[i].innerHTML="*";
                    }
                });
            });
        </script>
        <?php include("footer.php"); ?>
    </body>
</html>