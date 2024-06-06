<?php
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
    $first_name = $conn->real_escape_string($_POST['first_name']);
    $last_name = $conn->real_escape_string($_POST['last_name']);
    $contact_number = $conn->real_escape_string($_POST['contact_number']);
    $address = $conn->real_escape_string($_POST['address']);
    $email = $conn->real_escape_string($_POST['email']);
    $student_number = $conn->real_escape_string($_POST['student_number']);
    $password = $conn->real_escape_string($_POST['password']);
    $confirm_password = $conn->real_escape_string($_POST['confirm_password']);

    // Check if email already exists in the database
    $check_email_query = "SELECT * FROM users WHERE email='$email'";
    $check_email_result = $conn->query($check_email_query);
    if ($check_email_result->num_rows > 0) {
        // Email already exists, display error message
        echo "Email already exists. Please choose a different email. Redirecting to registration page...";
        // Redirect to registration page after 2 seconds
        header("refresh:2;url=registration.php");
        exit();
    } else {
        // Check if passwords match
        if ($password !== $confirm_password) {
            die("Passwords do not match.");
        }
    
        // Hash the password for security
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
        // Query to insert user data into the database
        $sql = "INSERT INTO users (first_name, last_name, contact_number, address, email, student_number, password) VALUES ('$first_name', '$last_name', '$contact_number', '$address', '$email', '$student_number', '$hashed_password')";
    
        if ($conn->query($sql) === TRUE) {
            // Registration successful
            echo "Registration successful! Redirecting to login page...";
            // Redirect to login page after 2 seconds
            header("refresh:2;url=login.php");
            exit();
        } else {
            // Registration failed
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shorcut icon" type="x-icon" href="logo ng 11.png">
    <title>Registration</title>
    <script src="https://kit.fontawesome.com/38741bd1fa.js" crossorigin="anonymous"></script>
    <!-- <link rel="stylesheet" href="css/registration.css"> -->
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
      body,h1,h2,h3,h4,h5,h6 {font-family: "Lato", sans-serif}
      .w3-bar,h1,button {font-family: "Montserrat", sans-serif}
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
    height: 100vh; 
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
    margin-top: -10 0px; /* Adjusted to move the div further up */
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

    </style>
</head>

<body>   
    <div class="w3-bar">
        <div class="w3-bar w3-card w3-black w3-left-align w3-large w3-padding-small">
          <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-red" href="javascript:void(0);" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
          <a href="index.php" class="w3-bar-item w3-button w3-padding-large ">Home</a>
          <!-- <a href="#" class="w3-bar-item w3-button w3-padding-large">Products</a>
          <a href="#" class="w3-bar-item w3-button w3-padding-large">Orders</a>
          <a href="#" class="w3-bar-item w3-button w3-padding-large">Cart</a> -->
          <a href="login.php" class="w3-bar-item w3-button w3-padding-large w3-large w3=margin-top w3-right ">Login</a>
          <a href="index.php" class="w3-button w3-padding-large w3-large w3-right">Register</a>
        </div>
    </div>

    <!--signup form-->
    
    <div class="container">
        <div class="registration-form">
            <h1 class="title">Register</h1>
            <div class="fcontainer">
                <form method="post" action="registration.php" onsubmit="return validateForm()">
                    <div class="input-group">
                        <div class="input-field">
                            <i class="fa-regular fa-user"></i>
                            <input type="text" name="first_name" size="35" placeholder="First Name:">
                        </div>
    
                        <div class="input-field">
                            <i class="fa-regular fa-user"></i>
                            <input type="text" name="last_name" size="35" placeholder="Last Name:">
                        </div>
                        
                        <div class="input-field">
                            <i class="fa-regular fa-user"></i>
                            <input type="tel" name="contact_number" size="35" placeholder="Contact #:">
                        </div>
    
                        <div class="input-field">
                            <i class="fa-regular fa-user"></i>
                            <input type="text" name="address" size="35" placeholder="Address:">
                        </div>
    
                        <div class="input-field">
                            <i class="fa-regular fa-user"></i>
                            <input type="email" name="email" size="35" placeholder="Email:">
                        </div>
    
                        <div class="input-field">
                            <i class="fa-regular fa-user"></i>
                            <input type="text" name="student_number" size="35" placeholder="Student Number:">
                        </div>
    
                        <div class="input-field">
                            <i class="fa-regular fa-user"></i>
                            <input type="password" name="password" id="password" size="35" placeholder="Password:" required>
                            <span toggle="#password" class="fa fa-eye field-icon toggle-password"></span>
                        </div>

                        <div class="input-field">
                            <i class="fa-regular fa-user"></i>
                            <input type="password" name="confirm_password" id="confirm_password" size="35" placeholder="Re-Enter Password:" required>
                            <span toggle="#confirm_password" class="fa fa-eye field-icon toggle-password"></span>
                        </div>

                        <div class="buttons">
                            <button class="signup" type="submit">Sign up</button>
                            <button class="login w3-right" type="button" onclick="location.href='login.php';">Log in</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--quotes -->
    <div class="w3-container w3-black w3-center w3-padding-10">
        <h5 class="w3-margin ">Life is like a book that never ends. Chapters close, but not the book itself</h5>
    </div>
    <!--footer-->
    <footer class="w3-container w3-grey w3-padding-10 w3-center">  
        <div class="w3-xlarge w3-padding-5 w3-margin-top w3-border-black" >
          <img src="https://i.ibb.co/5nwknRj/logo-ng-11.png" alt="earist book store" class="logo";>
       </div>
       <div>
       </div class="logo">
       
       <p>@Group 11<a></a></p>
    </footer>
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