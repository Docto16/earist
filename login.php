<?php
// Start session
session_start();

// Check if user is already logged in
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header("Location: products.php");
    exit();
}

// Database credentials
$servername = "localhost"; // Change this if your database is hosted on a different server
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "earist"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escape user inputs for security
    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']);

    // Check for admin credentials first
    if ($email === "admin@admin" && $password === "admin123") {
        $_SESSION['loggedin'] = true;
        $_SESSION['user_id'] = 0; // Admin ID, can be anything or set another way
        $_SESSION['first_name'] = "Admin";
        $_SESSION['last_name'] = "";
        $_SESSION['email'] = $email;
        header("Location: admin.php");
        exit();
    }

    // Query to check if user exists with the provided credentials
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            // Password is correct, set session variables and redirect to dashboard or desired page
            $_SESSION['loggedin'] = true;
            $_SESSION['user_id'] = $row['user_id']; // Store user's ID
            $_SESSION['first_name'] = $row['first_name']; // Store user's first name
            $_SESSION['last_name'] = $row['last_name']; // Store user's last name
            $_SESSION['email'] = $email;
            header("Location: products.php");
            exit();
        } else {
            // Password is incorrect, display error message
            $_SESSION['error'] = "Invalid email or password. Please try again.";
        }
    } else {
        // User not found, display error message
        $_SESSION['error'] = "Invalid email or password. Please try again.";
    }
    header("Location: login3.php");
    exit();
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Earist Book Store</title>
<link rel="shorcut icon" type="x-icon" href="logo ng 11.png">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://kit.fontawesome.com/38741bd1fa.js" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="css/header.css">
<script src="https://kit.fontawesome.com/38741bd1fa.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body,h1,h2,h3,h4,h5,h6 {font-family: "Lato", sans-serif}
.w3-bar,h1,button {font-family: "Montserrat", sans-serif}
.fa-anchor,.fa-coffee {font-size:300px}

/* Adjust modal styles */
.w3-modal-content {
  max-width: 600px;
}

/* Hide avatar logo */
.avatar-logo {
  display: none;
}
.passwidth{
  width:260px;
}
.container{
    background-image: url(regisback.png);
    background-size: cover;
    background-position: center;
    background-attachment: scroll;
    background-repeat: no-repeat;
    display: flex;
    align-items: center;
    justify-content: center;
    justify-self: center;
    height: 130vh; 
    opacity: 1;
    position: relative;
}

.registration-form {
    position: absolute;
    background-color: #f8f8f8; 
    padding: 30px;
    border-radius: 15px; 
    border-style: inset;
    border-width: 6px;
    box-shadow: 0px 20px 20px rgba(12, 11, 11, 0.2); /* Fixed missing opacity value */
    border-color: rgb(0, 0, 0);
    font-size: 15px;
    opacity: 80%;
    color: rgb(228, 214, 214);
    margin-top: 300px; /* Adjusted to move the div further up */
}


.input-field{
    align-self: center;
    color: #000;
    padding: 10px;
    font-size: medium;
}
.input-group{
    padding: 2px;
    color: #000;
    position: relative;
    border-radius: 7px;
    font-size: 10px;
    text-align: left;
    font-family: 'Times New Roman', Times, serif;
}
.title{
    font-weight:900;
    color: #000;
    font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
    font-size: 40px;
    font-style: italic;
    position: relative;
    margin-top: 5px;
    text-align: center;
}
.logo{
    width: 50px;
    opacity:inherit;
}
.w3-margin{
    font-style: italic;
    font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
    font-weight: 600;
    justify-content: space-between;
    margin: 5px;
}
.signup{
    font-size: 22px;
    background-color: #080808;
    color: #ffffff;
    font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
    font-style: italic;
    font-weight: bolder;
}
.login{
    font-size: 22px;
    background-color: #000000;
    color: #ffffff;
    font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
    font-style: italic;
    font-weight: bolder;
    place-items: end;
}
.buttons{
    padding-top: 25px;
    padding-left: 25px;
    padding-right: 13px;
}
.signup:hover{
    background: #ff0000;
    color: #ffffff;
}
.login:hover{
    background: #ff0000;
    color: #ffffff;
}
.signin{
    font-size: 22px;
    background-color: #BC0000;
    color: #ffffff;
    font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
    font-style: italic;
    font-weight: bolder;
}
.background{
    background-size: cover;
    background-position: center;
    background-attachment: scroll;
    background-repeat: no-repeat;
    display: flex;
    align-items: center;
    justify-content: center;
    justify-self: center;
    height: 10vh; 
    opacity: 1;
    position: relative;
    background-color:  rgb(236, 221, 221);
}
</style>
</head>
<body>


<!-- Navbar -->
<div class="w3-top">
  <div class="w3-bar w3-black w3-left-align w3-large w3-padding-small">
    <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-red" href="javascript:void(0);" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
    <button onclick="window.location.href = 'index.php';" class="w3-button w3-padding-large">Home</button>
    <!-- <button onclick="window.location.href = 'cart.php';" class="w3-button w3-padding-large">Cart</button>
    <button onclick="window.location.href = 'products.php';" class="w3-button w3-padding-large">Products</button>
    <button onclick="window.location.href = 'orders.php';" class="w3-button w3-padding-large">Orders</button> -->
    <button onclick="document.getElementById('loginModal').style.display='block'" class="w3-bar-item w3-button w3-padding-large w3-large w3=margin-top w3-right">Login</button>
    <a href="registration.php" class="w3-button w3-padding-large w3-large w3-right">Register</a>
  </div>
</div>

<!-- Header -->
<header class="w3-container w3-center">
  <h1 class="w3-margin w3-text-white w3-jumbo" style="font-weight: 900; font-family:'Times New Roman', Times, serif; border: 2px solid rgb(255, 255, 255); border-style: inset;border-width: 4px;border-radius: 15px;">EARIST ONLINE BOOK STORE</h1>
  <p class="w3-xlarge w3-text-white" style="font-weight: bold; font-style: normal; font-family: 'Times New Roman', Times, serif;">Shop Now!</p>
</header>

<!-- Login Modal -->
<div class="w3-modal" id="loginModal">
  <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:0px; max-height:0px;">
    <div class="w3-center"><br>
      <!-- <span onclick="document.getElementById('loginModal').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span> -->
    </div>
    <div class="background">
      <div class="container">
        <div class="registration-form">
          <h1 class="title">Sign in to Your Account</h1>
          <div class="fcontainer">
            <form method="post" action="login.php">
              <div class="input-group">
                <div class="input-field">
                  <i class="fa-regular fa-user"></i>
                  <input type="email" name="email" size="35" placeholder="Email:">
                </div>
                <div class="input-field">
                  <i class="fa-regular fa-user"></i><BR>
                  <input type="password" name="password" id="password" class="passwidth" size="35" placeholder="Password:" required>
                  <span toggle="#password" class="fa fa-eye field-icon toggle-password"></span>
                  
                </div>
                

                <div class="buttons" style="display: flex; justify-content: space-between;">
                  <button class="signin" onclick="document.getElementById('loginModal').style.display='none'" type="button">Cancel</button>
                  <div style="width: 20px;"></div> <!-- Add space here -->
                  <button class="signin" type="submit">Sign In</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>



<!-- First Grid -->
<div class="w3-row-padding w3-padding-64 w3-container">
  <div class="w3-content">
    <div class="w3-twothird">
      <h1 style="font-weight: bolder;font-family: 'Times New Roman', Times, serif;">About Us</h1>
      <p class="w3-text-grey">Welcome to Earist Book Store Online, your trusted source for textbooks and reading materials tailored specifically to first-year students. As you begin your academic journey, we're here to provide you with the essential books you need for your courses. Our online store offers a carefully curated selection of textbooks for a variety of courses, ensuring that you have access to the most up-to-date and relevant materials for your classes You'll find the required and recommended books in our book store. Shopping with us is simple and convenient. Browse our website to easily find the books you need by course or subject and place your order in just a few clicks. We offer secure payment options and prompt delivery to your preferred location.</p>
    </div>

    <div class="w3-third w3-center">    
      <img src="https://i.ibb.co/hmvHSZy/download.png" alt="Book" class="icon-bigger" style="width: 400px;">
    </div>
  </div>
</div>

<!--second grid-->

<div class=" w3-light-grey w3-padding-64 w3-container">
  <div class="title">
    <a href="login.php" class="button">GET YOURS NOW!</a>

</div>
<div class="image-container">
  <img src="img/1.png" alt="Filipino sa Iba't Ibang Disiplina" class="fil-size">
  <img src="img/2.png" alt="Mathematics for College Readiness" class="math-size">
  <img src="img/3.png" alt="Communication in the Age of Globalization" class="purcom-size">
  <img src="img/4.png" alt="Database Management" class="dbmt-size">

</div>
</div>
<div class="w3-container w3-black w3-center w3-padding-10">
<h5 class="w3-margin " style="font-style: italic; font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;font-weight: 600;">Life is like a book that never ends. Chapters close, but not the book itself</h5>
</div>
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
<script>
        function validateForm() {
            var password = document.getElementById("password");
            var confirmPassword = document.getElementById("confirm_password");
            var passwordValue = password.value;
            var confirmValue = confirmPassword.value;

            if (passwordValue !== confirmValue) {
                alert("Passwords do not match.");
                setTimeout(function() {
                    window.location.href = 'registration.php';
                }, 5000); // 5000 milliseconds = 5 seconds
                return false;
            }
            return true;
        }

        // Function to toggle password visibility
        document.querySelectorAll('.toggle-password').forEach(function(button) {
            button.addEventListener('click', function() {
                var passwordInput = button.previousElementSibling;
                var fieldType = passwordInput.getAttribute('type');
                if (fieldType === 'password') {
                    passwordInput.setAttribute('type', 'text');
                } else {
                    passwordInput.setAttribute('type', 'password');
                }
            });
        });
    </script>
</body>
</html>
