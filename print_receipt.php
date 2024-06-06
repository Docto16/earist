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
    header("Location: login.php");
    exit;
}

$user = $_SESSION['user_id'];
$product_id = $_POST['product_id'];
$quantity = intval($_POST['quantity']);
$product_name = $_POST['product_name'];
$product_price = intval($_POST['product_price']);
$payment_method = $_POST['payment_method'];
$transaction = $_POST['transaction'];
$cart_id = $_POST['cart_id'];
$total_price = $quantity * $product_price;

$first_name = ucfirst(strtolower($_SESSION['first_name']));
$last_name = ucfirst(strtolower($_SESSION['last_name']));
$full_name = "$first_name $last_name";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Earist Book Store - Receipt</title>
    <link rel="stylesheet" type="text/css" href="css/header.css">
    <style>
        .receipt-container {
            text-align: center;
            margin-top: 50px;
        }
        .receipt-details {
            display: inline-block;
            text-align: left;
            border: 1px solid #000;
            padding: 20px;
            background-color: #f9f9f9;
        }
        .receipt-buttons {
            margin-top: 20px;
        }
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0,0.4);
            padding-top: 60px;
        }
        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
        .modal-input {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            box-sizing: border-box;
        }
    </style>
</head>
<body>

<div class="receipt-container">
    <h1>Receipt</h1>
    <div class="receipt-details">
        <p><strong>Customer Name:</strong> <?php echo $full_name; ?></p>
        <p><strong>Product Name:</strong> <?php echo $product_name; ?></p>
        <p><strong>Quantity:</strong> <?php echo $quantity; ?></p>
        <p><strong>Price per Item:</strong> <?php echo $product_price; ?></p>
        <p><strong>Total Price:</strong> <?php echo $total_price; ?></p>
        <p><strong>Payment Method:</strong> <?php echo $payment_method; ?></p>
        <p><strong>Date:</strong> <?php echo date("Y-m-d H:i:s"); ?></p>
        <p><strong><hr></strong></p>
    </div>
    <div class="receipt-buttons">
        <button onclick="window.print()">Print</button>
        <button id="confirmOrderBtn">Confirm Order</button>
    </div>
</div>

.




<div id="locationModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Set Location and Contact</h2>
        <form id="locationForm" action="print_receipt2.php" method="POST">
            <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
            <input type="hidden" name="quantity" value="<?php echo $quantity; ?>">
            <input type="hidden" name="product_name" value="<?php echo $product_name; ?>">
            <input type="hidden" name="product_price" value="<?php echo $product_price; ?>">
            <input type="hidden" name="payment_method" value="<?php echo $payment_method; ?>">
            <input type="hidden" name="transaction" value="<?php echo $transaction; ?>">
            <input type="hidden" name="cart_id" value="<?php echo $cart_id; ?>">
            <label for="location">Location:</label>


            <input type="text" id="location" name="location" class="modal-input" required>
            <label for="contactNumber">Contact Number:</label>
            <input type="text" id="contactNumber" name="contactNumber" class="modal-input" required>
            <button type="submit">Save</button>
        </form>
    </div>
</div>

<script>
var modal = document.getElementById("locationModal");
var confirmOrderBtn = document.getElementById("confirmOrderBtn");
var closeBtn = document.getElementsByClassName("close")[0];

confirmOrderBtn.onclick = function() {
    modal.style.display = "block";
}

closeBtn.onclick = function() {
    modal.style.display = "none";
}

window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>

</body>
</html>
