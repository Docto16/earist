<?php
// Start session
session_start();

// Check if the user is logged in
if(isset($_SESSION['user_id'])) {
    // User is logged in, get user's name from session and capitalize it
    $first_name = ucfirst(strtolower($_SESSION['first_name']));
    $last_name = ucfirst(strtolower($_SESSION['last_name']));
    // Generate welcome message
    $welcome_message = "Welcome, $first_name $last_name!";
} else {
    // User is not logged in, redirect to login page
    header("Location: login.php");
    exit; // Ensure script stops execution after redirect
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Earist Book Store - Products</title>
<link rel="shorcut icon" type="x-icon" href="logo ng 11.png">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://kit.fontawesome.com/38741bd1fa.js" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="css/header.css">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body, h1, h2, h3, h4, h5, h6 {
    font-family: "Lato", sans-serif;
}
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
        <button id="productsButton" class="w3-button w3-padding-large active">Products</button>
        <button onclick="window.location.href = 'cart.php';" class="w3-button w3-padding-large">Cart</button>
        <button onclick="window.location.href = 'orders.php';" class="w3-button w3-padding-large">Orders</button>
        <a href="logout.php" class="w3-bar-item w3-button w3-padding-large w3-large w3=margin-top w3-right">Logout</a>
        <!-- <a href="registration.php" class="w3-button w3-padding-large w3-large w3-right">Register</a> -->
    </div>
</div>
<!-- Navbar on small screens -->
<div id="navDemo" class="w3-bar-block w3-white w3-hide w3-hide-large w3-hide-medium w3-large">
    <a href="cart.php" class="w3-bar-item w3-button w3-padding-large">Cart</a>
    <a href="products.php" class="w3-bar-item w3-button w3-padding-large active">Products</a>
    <a href="orders.php" class="w3-bar-item w3-button w3-padding-large">Orders</a>
    <button href="logout.php" class="w3-bar-item w3-button w3-padding-large w3-large w3=margin-top">Logout</button>
    <!-- <a href="registration.php"class="w3-button w3-red w3-padding-large w3-large w3-right">Register</a> -->
</div>

<!-- Header -->
<header class="w3-container w3-center">
    <h1 class="w3-margin w3-text-white w3-jumbo" style="font-weight: 900; font-family:'Times New Roman', Times, serif; border: 2px solid rgb(255, 255, 255); border-style: inset;border-width: 4px;border-radius: 15px;">EARIST ONLINE BOOK STORE</h1>
    <p class="w3-xlarge w3-text-white" style="font-weight: bold; font-style: normal; font-family: 'Times New Roman', Times, serif;"><?php echo $welcome_message; ?></p>
</header>

<!-- Your Cart Content Here -->

<!-- Footer -->
<footer class="w3-container w3-grey w3-padding-30 w3-center">  
    <div class="w3-xlarge w3-padding-5 w3-margin-top w3-border-black">
        <img src="https://i.ibb.co/5nwknRj/logo-ng-11.png" alt="earist book store" class="logo" style="width: 50px; opacity:inherit;">
    </div>
    <div>
    </div class="logo">
    <div class="w3-light-grey w3-padding-64 w3-container">
        <div class="title">
            <h1>GET YOURS NOW!</h1>
        </div>
        <div class="image-container">
            <a href="v1.php" class="button">
                <img src="img/1.png" alt="Filipino sa Iba't Ibang Disiplina" class="fil-size">
            </a> 
            <a href="v2.php" class="button">
                <img src="img/2.png" alt="Database Management" class="fil-size">
            </a>
            <a href="v3.php" class="button">
                <img src="img/3.png" alt="Communication in the Age of Globalization" class="fil-size">
            </a>
            <a href="v4.php" class="button">
                <img src="img/4.png" alt="Another Product" class="fil-size">
            </a>
            <a href="v5.php" class="button">
                <img src="img/5.png" alt="Communication in the Age of Globalization" class="fil-size">
            </a>
        </div>
        <br><br>
        <div class="image-container">
            <a href="v6.php" class="button">
                <img src="img/6.png" alt="Mathematics for College Readiness" class="fil-size">
            </a> 
            <a href="v7.php" class="button">
                <img src="img/7.png" alt="Database Management" class="fil-size">
            </a> 
            <a href="v8.php" class="button">
                <img src="img/8.png" alt="Filipino sa Iba't Ibang Disiplina" class="fil-size">
            </a> 
            <a href="v9.php" class="button">
                <img src="img/9.png" alt="Mathematics for College Readiness" class="fil-size">
            </a>
        </div>
    </div>
    <div class="w3-container w3-black w3-center w3-padding-10">
        <h5 class="w3-margin" style="font-style: italic; font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;font-weight: 600;">Life is like a book that never ends. Chapters close, but not the book itself</h5>
    </div>
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
