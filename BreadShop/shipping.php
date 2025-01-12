<?php 
   if( !isset($last_name) ) {$last_name='';}
   if( !isset($first_name) ) {$first_name='';}
   if( !isset($address) ) {$address='';}
   if( !isset($city) ) {$city='';}
   if( !isset($state) ) {$state='';}
   if( !isset($zip_code) ) {$zip_code='';}
   if( !isset($ship_date) ) {$ship_date='';}
   if( !isset($order_number) ) {$order_number='';}
   if( !isset($package_length) ) {$package_length='';}
   if( !isset($package_width) ) {$package_width='';}
   if( !isset($package_weight) ) {$package_weight='';}
?>


<html>
    <head>
        <link rel="stylesheet" href="styles.css" />
        <title>Orders</title>
    </head>
    <body>
        <?php 
           session_start();
           include ("header.php"); 
         ?>
        <h1 class="ship">Please Input Your Information Below</h1>
        
        <?php if(!empty($error_message)) { ?>
            <p style="color:red;">
               <strong> <?php echo htmlspecialchars($error_message); ?> </strong>
            </p>
        <?php } ?>


       <form class="ship" action="shippinglabel.php" method="post">
        <h3 class="ship">Personal Information</h3>
           <br>
           <label>Last Name:</label>
           <input type="text" name="last_name"
           value="<?php echo htmlspecialchars($last_name); ?>"/>
           <label>First Name:</label>
           <input type="text" name="first_name"
           value="<?php echo htmlspecialchars($first_name); ?>"/>
           <br>

           <label>Address:</label>
           <input type="text" name="address"
           value="<?php echo htmlspecialchars($address); ?>"/>
           <br>
           <label>City:</label>
           <input type="text" name="city"
           value="<?php echo htmlspecialchars($city); ?>"/>
           <br>
           <label>State:</label>
           <input type="text" name="state"
           value="<?php echo htmlspecialchars($state); ?>"/>
           <br>
           <label>Zip Code:</label>
           <input type="text" name="zip_code"
           value="<?php echo htmlspecialchars($zip_code); ?>"/>
           <br>
           <br>

        <h3 class="ship">Shipping Details</h3>
           <br>
           <label>Ship Date:</label>
           <input type="date" name="ship_date"
           value="<?php echo htmlspecialchars($ship_date); ?>"/>
           <label>Order Number:</label>
           <input type="number" name="order_number"
           value="<?php echo htmlspecialchars($order_number); ?>" min="1"/>
           <br>
           <br>
        <h3 class="ship">Package Details</h3>
           <br>
           <label>Length of Package [inches]:</label>
           <input type="text" name="package_length"
           value="<?php echo htmlspecialchars($package_length); ?>"/>
           <br>
           <label>Width of Package [inches]:</label>
           <input type="text" name="package_width"
           value="<?php echo htmlspecialchars($package_width); ?>"/>
           <br>
           <label>Package Weight [pounds]:</label>
           <input type="text" name="package_weight"
           value="<?php echo htmlspecialchars($package_weight); ?>"/>

        <br>
        <br>
        <input type="submit" value="Place Order" />
        <input type="reset" value="Reset Input" />
       </form>
       <?php include("footer.php"); ?>
    </body>
</html>