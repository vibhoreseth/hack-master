<?php

//if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
if(session_id() == '' || !isset($_SESSION)){session_start();}
include 'config.php';
?>

<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Products || DELL</title>
    <link rel="stylesheet" href="css/foundation.css" />
    <script src="js/vendor/modernizr.js"></script>
  </head>
  <style>
.wrap {
    padding: 40px;
    text-align: center;
}
hr {
    clear: both;
    margin-top: 40px;
    margin-bottom: 40px;
    border: 0;
    border-top: 1px solid #aaaaaa;
}
h1 {
    font-size: 30px;
    margin-bottom: 40px;
}
p {
    margin-bottom: 20px;
}
.btn {
    background: #428bca;
    border: #357ebd solid 1px;
    border-radius: 3px;
    color: #fff;
    display: inline-block;
    font-size: 14px;
    padding: 8px 15px;
    text-decoration: none;
    text-align: center;
    min-width: 60px;
    position: relative;
    transition: color .1s ease;
}
.btn:hover {
    background: #357ebd;
}
.btn.btn-big {
    font-size: 18px;
    padding: 15px 20px;
    min-width: 100px;
}
.btn-close {
    color: #aaaaaa;
    font-size: 30px;
    text-decoration: none;
    position: absolute;
    right: 5px;
    top: 0;
}
.btn-close:hover {
    color: #919191;
}
.modal:target:before {
    display: none;
}
.modal:before {
    content:"";
    display: block;
    background: rgba(0, 0, 0, 0.6);
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: 10;
}
.modal .modal-dialog {
    background: #fefefe;
    border: #333333 solid 1px;
    border-radius: 5px;
    margin-left: -200px;
    position: fixed;
    left: 50%;
    z-index: 11;
    width: 360px;
    -webkit-transform: translate(0, 0);
    -ms-transform: translate(0, 0);
    transform: translate(0, 0);
    -webkit-transition: -webkit-transform 0.3s ease-out;
    -moz-transition: -moz-transform 0.3s ease-out;
    -o-transition: -o-transform 0.3s ease-out;
    transition: transform 0.3s ease-out;
    top: 20%;
}
.modal:target .modal-dialog {
    top: -100%;
    -webkit-transform: translate(0, -500%);
    -ms-transform: translate(0, -500%);
    transform: translate(0, -500%);
}
.modal-body {
    padding: 20px;
}
.modal-header, .modal-footer {
    padding: 10px 20px;
}
.modal-header {
    border-bottom: #eeeeee solid 1px;
}
.modal-header h2 {
    font-size: 20px;
}
.modal-footer {
    border-top: #eeeeee solid 1px;
    text-align: right;
}

#loyal{
	font-size:70%;
}
</style>
  <body>

    <nav class="top-bar" data-topbar role="navigation">
      <ul class="title-area">
        <li class="name">
          <h1><a href="index.php">DELL<span id = "loyal">&nbsp;Loyal</span></a></h1>
        </li>
        <li class="toggle-topbar menu-icon"><a href="#"><span></span></a></li>
      </ul>

      <section class="top-bar-section">
      <!-- Right Nav Section -->
        <ul class="right">
          <li><a href="about.php">About</a></li>
          <li class='active'><a href="products.php">Products</a></li>
          <li><a href="lcart.php">View Cart</a></li>
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




    <div class="row" style="margin-top:10px;">
      <div class="small-12">
        <?php
          $i=0;
          $product_id = array();
          $product_quantity = array();

          $result = $mysqli->query('SELECT * FROM products');
          if($result === FALSE){
            die(mysql_error());
          }

          if($result){

            while($obj = $result->fetch_object()) {

              echo '<div class="large-4 columns">';
              echo '<p><h3>'.$obj->product_name.'</h3></p>';
              echo '<img src="images/products/'.$obj->product_img_name.'"/>';
              echo '<p><strong>Product Code</strong>: '.$obj->product_code.'</p>';
              echo '<p><strong>Description</strong>: '.$obj->product_desc.'</p>';
              echo '<p><strong>Units Available</strong>: '.$obj->qty.'</p>';
              echo '<p><strong>Price (Per Unit)</strong>: '.$currency.$obj->price.'</p>';



              if($obj->qty > 0){
                echo '<p><a href="update-lcart.php?action=add&id='.$obj->id.'"><input type="submit" value="Add To Cart" style="clear:both; background: #0078A0; border: none; color: #fff; font-size: 1em; padding: 10px;" /></a></p>';
              }
              else {
                echo 'Out Of Stock!';
              }
              echo '</div>';

              $i++;
            }

          }

          $_SESSION['product_id'] = $product_id;


          echo '</div>';
          echo '</div>';
          ?>

        <div class="row" style="margin-top:10px;">
          <div class="small-12">




        <footer style="margin-top:10px;">
           <p style="text-align:center; font-size:0.8em;clear:both;">&copy; DELL TEAM 06</p>
        </footer>

      </div>
    </div>
        
        <!-- Modal -->
<div class="modal" id="modal-one" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-header">
             <h2>WELCOME - LOYAL CUSTOMER</h2>
 <a href="#modal-one" class="btn-close" aria-hidden="true">×</a>

        </div>
        <div class="modal-body">
            <p>SPECIAL 15% discount on all orders</p>
        </div>
        <div class="modal-footer"> <a href="#modal-one" class="btn">Nice!</a>

        </div>
    </div>
</div>
<div class="wrap"> <a href="#" class="btn btn-big"></a>

</div>




    <script src="js/vendor/jquery.js"></script>
    <script src="js/foundation.min.js"></script>
    <script>
      $(document).foundation();
    </script>
  </body>
</html>
