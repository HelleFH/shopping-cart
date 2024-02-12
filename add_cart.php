<?php
session_start();

// Check if $_SESSION['cart'] is set and initialize if not
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

// Check if $_GET['id'] is set before accessing it
if (isset($_GET['id'])) {
    // Check if the product ID is not already in the cart
    if (!in_array($_GET['id'], $_SESSION['cart'])) {
        array_push($_SESSION['cart'], $_GET['id']);
        $_SESSION['message'] = 'Product added to cart';
    } else {
        $_SESSION['message'] = 'Product already in cart';
    }
}

// Redirect back to index.php after processing
header('location: index.php');
?>
