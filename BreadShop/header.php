<header>
    <head>
       <img class="banner" src="Images/Bao.jpg" alt="Logo" height=85/>
    </head>

    <body>
       <h1 class="banner">Bao</h1>

       <?php if(isset($_SESSION['bread'])){
        echo "<h3 style=\"color: purple\">";
        echo htmlspecialchars($_SESSION['bread']);
        echo "</h3>";
       } ?>
    
       <nav class="banner">
          <ul>
             <li>Home Page: <a href= "breadshop.php">Bao</a></li>
             <li>Menu: <a href='bread.php'>Treats</a>

             <?php if(isset($_SESSION['bread'])) { ?>
                <li>Shipping: <a href= "shipping.php">Place Order</a></li>
                <li>Create a Product: <a href= "create.php">Create</a></li>
                <li><a href="authen_logout.php">LogOut</a></li>
             <?php } else { ?>
                <li><a href="authen_login.php">LogIn to View More Options</a></li>
             <?php } ?>
          </ul>
       </nav>
    </body>

<header>