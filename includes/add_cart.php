<?php
session_start();

// Check if $_SESSION['cart'] is set and initialize if not
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

// Check if $_SESSION['qty_array'] is set and initialize if not
if (!isset($_SESSION['qty_array'])) {
    $_SESSION['qty_array'] = array();
}

// Check if $_GET['id'] is set before accessing it
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];
    // Check if the product ID is not already in the cart
    if (!in_array($product_id, $_SESSION['cart'])) {
        // Add the product ID to the cart
        $_SESSION['cart'][] = $product_id;
        // Initialize the quantity for this product ID to 1
        $_SESSION['qty_array'][] = 1;
        $_SESSION['message'] = 'Product added to cart';
    } else {
        $_SESSION['message'] = 'Product already in cart';
    }
}

// Redirect back to index.php after processing
header('location: /index.php');
?>
