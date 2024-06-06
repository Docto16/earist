<?php
// Start session
session_start();

// Check if the user is logged in
if(!isset($_SESSION['user_id'])) {
    // User is not logged in, redirect to login page
    header("Location: login.php");
    exit; // Ensure script stops execution after redirect
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

// Fetch data based on ID
$id = $_GET['id'];
$sql = "SELECT * FROM stock WHERE ID = $id";
$result = $conn->query($sql);

// Initialize variables
$name = "";
$stock = "";
$price = "";

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $name = $row['name'];
    $stock = $row['stock'];
    $price = $row['price'];
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Edit Product - Earist Book Store</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2>Edit Product</h2>
    <form action="update.php" method="post">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo $name; ?> " readonly>
        </div>
        <div class="form-group">
            <label for="stock">Stock:</label>
            <input type="number" class="form-control" id="stock" name="stock" value="<?php echo $stock; ?>">
        </div>
        <div class="form-group">
            <label for="price">Price:</label>
            <input type="text" class="form-control" id="price" name="price" value="<?php echo $price; ?>">
        </div>
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="admin.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>

</body>
</html>
