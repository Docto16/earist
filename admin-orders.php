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
<title>Earist Book Store - Admin Orders</title>
<link rel="shortcut icon" type="image/x-icon" href="logo ng 11.png">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://kit.fontawesome.com/38741bd1fa.js" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="css/header.css">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
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
.btn-edit {
    background-color: #007bff;
    border: none;
    color: white;
    padding: 10px 20px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
    border-radius: 5px;
}
.btn-edit:hover {
    background-color: #0056b3;
}
</style>
</head>
<body>

<!-- Navbar -->
<div class="w3-top">
    <div class="w3-bar w3-black w3-left-align w3-large w3-padding-small">
      <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-red" href="javascript:void(0);" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
      <button onclick="window.location.href = 'admin.php';" class="w3-button w3-padding-large">Products</button>
      <button id="ordersButton" class="w3-button w3-padding-large active">Orders</button>
      <a href="logout.php" class="w3-bar-item w3-button w3-padding-large w3-large w3=margin-top w3-right">Logout</a>
    </div>
  </div>
  <!-- Navbar on small screens -->
  <div id="navDemo" class="w3-bar-block w3-white w3-hide w3-hide-large w3-hide-medium w3-large">
    <a href="admin.php" class="w3-bar-item w3-button w3-padding-large">Product</a>
    <a href="logout.php" class="w3-bar-item w3-button w3-padding-large w3-large w3=margin-top w3-right">Logout</a>
  </div>
</div>

<!-- Header -->
<header class="w3-container w3-center">
  <h1 class="w3-margin w3-text-white w3-jumbo" style="font-weight: 900; font-family:'Times New Roman', Times, serif; border: 2px solid rgb(255, 255, 255); border-style: inset;border-width: 4px;border-radius: 15px;">EARIST ONLINE BOOK STORE</h1>
  <p class="w3-xlarge w3-text-white" style="font-weight: bold; font-style: normal; font-family: 'Times New Roman', Times, serif;">Your Cart</p>
  <div class=" w3-light-grey w3-padding-64 w3-container">
    <h2>Orders Details</h2>
    <div class="row mb-3">
        <div class="col-md-3">
            <select id="statusFilter" class="form-control">
                <option value="">-- Status --</option>
                <?php
                // Fetch distinct statuses for the dropdown
                $sql = "SELECT DISTINCT st.status AS order_status FROM status st";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<option value='{$row['order_status']}'>{$row['order_status']}</option>";
                    }
                }
                ?>
            </select>
        </div>
    </div>
    <table id="ordersTable" class="display">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Product Image</th>
                <th>Customer Name</th>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Total Price</th>
                <th>Status</th>
                <th>Method of Transaction</th>
                <th>Address</th>
                <th>Contact #</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
            // Fetch data from orders table along with product and user details
            $sql = "SELECT o.order_id, o.user_id, u.first_name, u.last_name,o.address,o.contact, o.product_id, o.quantity, o.status, o.payment, o.transac, s.name, s.price, s.stock, st.status AS order_status
                    FROM orders o 
                    INNER JOIN stock s ON o.product_id = s.product_id 
                    INNER JOIN status st ON o.status = st.id
                    INNER JOIN users u ON o.user_id = u.user_id";

            $result = $conn->query($sql);

            if ($result && $result->num_rows > 0) {
                $rowCount = $result->num_rows; // Get the number of rows returned by the query

                // Loop through each row
                for ($i = 0; $i < $rowCount; $i++) {
                    // Fetch the current row
                    $row = $result->fetch_assoc();
                    $order_id = $row["order_id"];
                    $product_id = $row["product_id"];
                    $quantity = $row["quantity"];
                    $product_name = $row["name"];
                    $product_image = $row["product_id"];
                    $product_price = $row["price"];
                    $product_stock = $row["stock"];
                    $product_status = $row["status"];
                    $order_status = $row["order_status"];
                    $payment_method = $row["payment"];
                    $transaction_method = $row["transac"];
                    $first_name = $row["first_name"];
                    $last_name = $row["last_name"];
                    $address = $row["address"];
                    $contact = $row["contact"];

                    $prc = $product_price * $quantity;
                    $update_stock = $product_stock - $quantity;

                    echo "<tr>";
                    // Display order_id using a loop from 1 to $rowCount
                    echo "<td>" . ($i + 1) . "</td>";
                    // Display product image
                    echo "<td><img src='img/{$product_image}.png' style='width: 200px;'></td>";
                    // Display customer name
                    echo "<td>{$first_name} {$last_name}</td>";
                    // Display product name
                    echo "<td>{$product_name}</td>";
                    // Display quantity
                    echo "<td>{$quantity}</td>";
                    // Display total price
                    echo "<td>{$prc}</td>";
                    // Display payment method
                    echo "<td>{$payment_method}</td>";
                    // Display transaction method
                    echo "<td>{$transaction_method}</td>";
                    // Display order status
                    echo "<td>{$order_status}</td>";
                    // Display order status
                    echo "<td>{$address}</td>";
                    // Display order status
                    echo "<td>{$contact}</td>";
                    // Display edit button
                    echo "<td><a href='admin-edit-orders.php?id={$order_id}' class='btn btn-primary btn-edit'>Update</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='10'>No items in the orders</td></tr>";
            }
            ?>

        </tbody>
    </table>
  </div>
</header>

<!-- Footer -->
<footer class="w3-container w3-grey w3-padding-30 w3-center ">  
  <div class="w3-xlarge w3-padding-5 w3-margin-top w3-border-black">
    <img src="https://i.ibb.co/5nwknRj/logo-ng-11.png" alt="earist book store" class="logo" style="width: 50px; opacity:inherit;">
 </div>
 <div>

 </div class="logo">
 
 <p>@Group 11<a></a></p>
</footer>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {
    var table = $('#ordersTable').DataTable();

    // Event listener for the dropdown filter
    $('#statusFilter').on('change', function () {
        table.column(6).search(this.value).draw();
    });
});
</script>

</body>
</html>
