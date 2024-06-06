<?php
// Start session
session_start();

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
$location = $_POST['location'];
$contactNumber = $_POST['contactNumber'];
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
        <p><strong>Transaction:</strong> <?php echo $transaction; ?></p>
        <p><strong>Location:</strong> <?php echo $location; ?></p>
        <p><strong>Contact Number:</strong> <?php echo $contactNumber; ?></p>
        <p><strong>Date:</strong> <?php echo date("Y-m-d H:i:s"); ?></p>
    </div>
    <div class="receipt-buttons">
        <form action="order1.php" method="POST">
            <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
            <input type="hidden" name="quantity" value="<?php echo $quantity; ?>">
            <input type="hidden" name="product_name" value="<?php echo $product_name; ?>">
            <input type="hidden" name="product_price" value="<?php echo $product_price; ?>">
            <input type="hidden" name="payment_method" value="<?php echo $payment_method; ?>">
            <input type="hidden" name="transaction" value="<?php echo $transaction; ?>">
            <input type="hidden" name="cart_id" value="<?php echo $cart_id; ?>">
            <input type="hidden" name="location" value="<?php echo $location; ?>">
            <input type="hidden" name="contactNumber" value="<?php echo $contactNumber; ?>">
            <button type="submit">Confirm Order</button>
        </form>
    </div>
</div>

</body>
</html>
