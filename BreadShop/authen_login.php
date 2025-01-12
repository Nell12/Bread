<?php
   if (!isset($error_message)){
    $error_message= "You must log in to continue";
   }
   if(!isset($email)){
    $email= "";
   }
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="styles.css"/>
        <title>Login</title>
    </head>

    <body>
        <?php include ("header.php"); ?>
        <main>
            <h1 style="color: orange">Please Login</h1>

            <?php 
                if($error_message !="") { ?>
                <p style="color: red">
                   <?php echo htmlspecialchars($error_message); ?>
                </p>
            <?php } ?>

            <form action="authentication.php" method="post">
                <label>Email Address:</label>
                <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>"/>
                <br>

                <label>Password:</label>
                <input type="password" name="password" value=""/>
                <br>

                <input type="submit" value="Login"/>
                <input type="reset" value="Reset"/>
            </form>
        </main>
        <?php include("footer.php"); ?>
    </body>
</html>
