<?php
   $last_name= filter_input(INPUT_POST, "last_name");
   $first_name= filter_input(INPUT_POST, "first_name");
   $address= filter_input(INPUT_POST, "address");
   $city= filter_input(INPUT_POST, "city");
   $state= filter_input(INPUT_POST, "state");
   $zip_code= filter_input(INPUT_POST, "zip_code");

   $ship_date= filter_input(INPUT_POST, "ship_date");
   $order_number= filter_input(INPUT_POST, "order_number");

   $package_length= filter_input(INPUT_POST, "package_length", FILTER_VALIDATE_FLOAT);
   $package_width= filter_input(INPUT_POST, "package_width", FILTER_VALIDATE_FLOAT);
   $package_weight= filter_input(INPUT_POST, "package_weight", FILTER_VALIDATE_FLOAT);


   $error_message= '';
   if($last_name==''){
    $error_message.= 'Please input your last name. ';
   }
   if($first_name==''){
    $error_message.= 'Please input your first name. ';
   }
   if($address==''){
    $error_message.='Please input an address. ';
   }
   if($city==''){
    $error_message.='Please input a city. ';
   }
   if($state==''){
    $error_message.='Please input a state. ';
   }
   else if(strlen($state) != 2){
    $error_message.='Please input a valid state. ';
   }
   if($zip_code===FALSE){
    $error_message.='Please input a zip code. ';
   }
   else if(!ctype_digit($zip_code)){
    $error_message.='Zip code must be solely digits. ';
   }
   else if (strlen($zip_code) != 5){
    $error_message.='Zip code length must be five. ';
   }
   if($ship_date==''){
    $error_message.='Please input a shipping date. ';
   }
   if($order_number==''){
    $error_message.='Please input the order number. ';
   }
   if($package_length===FALSE){
    $error_message.='Please input the package length in inches. ';
   }
   else if($package_length<=0 || $package_length>36){
    $error_message.='Allowable package length are between 1-36 inches. ';
   }
   if($package_width===FALSE){
    $error_message.='Please input the package width in inches. ';
   }
   else if($package_width<=0 || $package_width>36){
    $error_message.='Allowable package width are between 1-36 inches. ';
   }
   if($package_weight===FALSE){
    $error_message.='Please input the package weight in pounds. ';
   }
   else if($package_weight<=0 || $package_weight>150){
    $error_message.='Allowable package weight are between 1-150 pounds. ';
   }


   if ($error_message != ''){
    include("shipping.php");
    exit();
   }

   $package_length= number_format($package_length,2);
   $package_width= number_format($package_width,2);
   $package_weight= number_format($package_weight,2);

?>

<html>
    <head>
        <link rel="stylesheet" href="styles.css"/>
        <title>Order Confirmation</title>
    </head>
    <body>
        <?php 
             session_start();
             include("header.php"); 
        ?>

        <h2>Your Shipping Label</h2>
        <br>
        <label class= "label"><b>P</b></label>

        <main id="package">
            <label>Order #</label>
            <span> <?php echo htmlspecialchars($order_number); ?> </span>
            <br>
            <label>Package Weight:</label>
            <span> <?php echo htmlspecialchars($package_weight); ?> </span>
            <br>
            <label>Package Length:</label>
            <span> <?php echo htmlspecialchars($package_length); ?> </span>
            <br>
            <label>Package Width:</label>
            <span> <?php echo htmlspecialchars($package_width); ?> </span>
            <br>
            <br>
        </main>
        
        <main id="mail">
           <label id="USPS"><b>USPS PRIORITY MAIL</b></label>
           <br>
           <br>
           <label> FROM:</label>
           <span>520 Bao Ave, Newark, NJ, 13140</span>
           <br>
           <label>SHIP TO:</label>
           <span> <?php echo htmlspecialchars($first_name); ?> </span>
           <span> <?php echo htmlspecialchars($last_name); ?> </span>
           <br>
           <span> <?php echo htmlspecialchars($address); ?>, 
           <?php echo htmlspecialchars($city); ?>, 
           <?php echo htmlspecialchars($state); ?>, 
           <?php echo htmlspecialchars($zip_code); ?> </span>
           <br>
           <br>
           <label>Date:</label>
           <span> <?php echo htmlspecialchars($ship_date); ?> </span>
           </main>
           <br>
           <span>Tracking Number: 9499 9071 2345 6123 4567 81</span>
           <br>
           <img src="Images/barcode.jpg" alt="barcode" height=100/>
           <br>
           <br>
           <h2>Thank You for your order!</h2>
           <br>
    </body>
    <?php include("footer.php"); ?>
</html>
