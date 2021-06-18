<?php

//if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
if(session_id() == '' || !isset($_SESSION)){session_start();}

?>

<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>DELL TEAM 6</title>
    <link rel="stylesheet" href="css/foundation.css" />
    <script src="js/vendor/modernizr.js"></script>
  </head>
  <style>
 .column {
    float: left;
    width: 33.33%;
}

/* Clear floats after the columns */
.row:after {
    content: "";
    display: table;
    clear: both;
}
.rand{
	   max-width: 100%;
    height: auto;
}
  </style>
  <body>
  
  

    <nav class="top-bar" data-topbar role="navigation">
      <ul class="title-area">
        <li class="name">
          <h1><a href="index.php">DELL ECOMMERCE STORE</a></h1>
        </li>
        <li class="toggle-topbar menu-icon"><a href="#"><span></span></a></li>
      </ul>

      <section class="top-bar-section">
      <!-- Right Nav Section -->
        <ul class="right">
          <li><a href="about.php">About</a></li>
          <li><a href="products.php">Products</a></li>
          <li><a href="cart.php">View Cart</a></li>
          <li><a href="orders.php">My Orders</a></li>
          <li><a href="contact.php">Contact</a></li>
          <?php

          if(isset($_SESSION['username'])){
            echo '<li><a href="account.php">My Account</a></li>';
            echo '<li><a href="logout.php">Log Out</a></li>';
          }
          else{
            echo '<li><a href="login.php">Log In</a></li>';
            echo '<li><a href="register.php">Register</a></li>';
          }
          ?>
        </ul>
      </section>
    </nav>
    
    <img data-interchange="[images/bolt-retina.jpg, (retina)], [images/dell-landscape.png, (large)], [images/bolt-mobile.png, (mobile)], [images/dell-landscape.png, (medium)]">
    <noscript><img src="images/dell-landscape.png"></noscript>


   <br><br> 
    

	<center><h1>Our Featured Products</h1></center>
	<div class="row">
  <div class="column"><img class="rand" src = "images/products/b2.jpg"height="178" width="178"></div>
  <div class="column"><img class="rand" src = "images/products/b4.jpg" height="178" width="178"></div>
  <div class="column"><img class="rand" src = "images/products/b7.jpg" height="178" width="178"></div>
</div>

    <div class="row" style="margin-top:10px;">
      <div class="small-12">

        <footer style="margin-top:10px;">
           <p style="text-align:center; font-size:0.8em;">&copy; DELL 2018 Team 06</p>
        </footer>

      </div>
    </div>
	


    <script src="js/vendor/jquery.js"></script>
    <script src="js/foundation.min.js"></script>
    <script>
      $(document).foundation();
    </script>
  </body>
</html>
