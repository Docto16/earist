<?php
// Start session
session_start();

// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "earist";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // User is not logged in, redirect to login page
    header("Location: login.php");
    exit; // Ensure script stops execution after redirect
}

$user = $_SESSION['user_id'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Earist Book Store - Cart</title>
<link rel="shorcut icon" type="x-icon" href="logo ng 11.png">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://kit.fontawesome.com/38741bd1fa.js" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="css/header.css">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body,h1,h2,h3,h4,h5,h6 {font-family: "Lato", sans-serif}
.w3-bar,h1,button {font-family: "Montserrat", sans-serif}
.fa-anchor,.fa-coffee {font-size:300px}
.w3-bar, h1, button {
    font-family: "Montserrat", sans-serif;
}
.fa-anchor, .fa-coffee {
    font-size: 300px;
}
.w3-bar .w3-button {
    background-color: black;
    color: white;
}
.w3-button.active {
    background-color: #2E2E2E;
    color: white;
}
</style>
</head>
<body>

<!-- Navbar -->
<div class="w3-top">
    <div class="w3-bar w3-black w3-left-align w3-large w3-padding-small">
      <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-red" href="javascript:void(0);" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
      <!-- <button onclick="window.location.href = 'index.php';" class="w3-button w3-padding-large">Home</button> -->
      <button onclick="window.location.href = 'products.php';" class="w3-button w3-padding-large">Products</button>
      <button onclick="window.location.href = 'cart.php';" class="w3-button w3-padding-large">Cart</button>
      <button id="ordersButton" class="w3-button w3-padding-large active">Orders</button>
      <!-- <button onclick="window.location.href = 'orders.php';" class="w3-button w3-padding-large">Orders</button> -->
      <a href="logout.php" class="w3-bar-item w3-button w3-padding-large w3-large w3=margin-top w3-right">Logout</a>
      <!-- <a href="registration.php" class="w3-button w3-padding-large w3-large w3-right">Register</a> -->
    </div>
  </div>
  <!-- Navbar on small screens -->
  <div id="navDemo" class="w3-bar-block w3-white w3-hide w3-hide-large w3-hide-medium w3-large">
    <a href="cart.php" class="w3-bar-item w3-button w3-padding-large;">Cart</a>
    <a href="products.php" class="w3-bar-item w3-button w3-padding-large">Product</a>
    <a href="orders.php" class="w3-bar-item w3-button w3-padding-large">Orders</a>
    <a href="logout.php" class="w3-bar-item w3-button w3-padding-large w3-large w3=margin-top w3-right">Logout</a>
    <!-- <a href="registration.php"class="w3-button w3-red w3-padding-large w3-large w3-right">Register</a> -->
  </div>
</div>

<!-- Header -->
<header class="w3-container w3-center">
  <h1 class="w3-margin w3-text-white w3-jumbo" style="font-weight: 900; font-family:'Times New Roman', Times, serif; border: 2px solid rgb(255, 255, 255); border-style: inset;border-width: 4px;border-radius: 15px;">EARIST ONLINE BOOK STORE</h1>
  <p class="w3-xlarge w3-text-white" style="font-weight: bold; font-style: normal; font-family: 'Times New Roman', Times, serif;">Your Cart</p>
  <div class=" w3-light-grey w3-padding-64 w3-container">
    <h2>Orders Details</h2>
    <?php
    // Fetch data from carts table for the logged-in user
    $sql = "SELECT o.order_id, o.product_id, o.quantity, o.status, s.name, s.price, s.stock, st.status AS order_status
        FROM orders o 
        INNER JOIN stock s ON o.product_id = s.product_id 
        INNER JOIN status st ON o.status = st.id
        WHERE o.user_id = $user";


    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Fetch product details
            $product_id = $row["product_id"];
            $quantity = $row["quantity"];
            $product_name = $row["name"];
            $product_image = $row["product_id"];
            $product_price = $row["price"];
            $product_stock = $row["stock"];
            $product_status = $row["status"];
            $product_status = $row["order_status"];

            $prc=$product_price*$quantity;

            $update_stock = $product_stock - $quantity;

            // UPDATE `stock` SET `stock` = '106' WHERE `stock`.`ID` = 1;
            $sql_update = "UPDATE stock SET stock = '$update_stock' WHERE product_id = '$product_id'";
            // Display product image
            echo "<img src='img/{$product_image}.png' style='width: 200px;'>";

            // Display product name
            // echo $user."user<br>";
            // echo $product_id."prod<br>";
            // echo $quantity."q<br>";
            // echo $cart_id ."cart<br>";
            // echo $product_name."pn<br>";

            echo "<h6>$product_name</h6>";
            // Display quantity in cart
            echo "<p>Quantity: $quantity</p>";
            // Display product stock
            echo "<p>TOTAL PRICE: $prc</p>";
            // Display product stock
            echo "<p>Updated Stock: $update_stock</p>";
            // Display product Status
            echo "<p>STATUS: $product_status</p>";

            

            // Buttons for managing cart and confirmation alert
            // echo "<button onclick='cancelItem({$product_id})'>Cancel Order</button>";
            ?>
            <!-- <form action='order1.php' method='POST'>
              <input type='hidden' name='product_id' value='<?php echo $product_id; ?>'>
              <input type='hidden' name='quantity' value='<?php echo $quantity; ?>'>
              <input type='hidden' name='product_name' value='<?php echo $product_name; ?>'>
              <input type='hidden' name='product_price' value='<?php echo $product_price; ?>'>
              <button type='submit'>Buy Now</button>
            </form> -->
            <?php
            echo "<hr style='border-top: 1px solid #000;'>";
        }
    } else {
        echo "<p>No items in your cart</p>";
    }
    ?>
  </div>
</header>

<!-- Your Cart Content Here -->

<!-- Footer -->
<footer class="w3-container w3-grey w3-padding-30 w3-center ">  
  <div class="w3-xlarge w3-padding-5 w3-margin-top w3-border-black">
    <img src="https://i.ibb.co/5nwknRj/logo-ng-11.png" alt="earist book store" class="logo" style="width: 50px; opacity:inherit;">
 </div>
 <div>

 </div class="logo">
 
 <p>@Group 11<a></a></p>
</footer>

<script>
// Used to toggle the menu on small screens when clicking on the menu button
function myFunction() {
  var x = document.getElementById("navDemo");
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
  } else { 
    x.className = x.className.replace(" w3-show", "");
  }
}
</script>

</body>
</html>
