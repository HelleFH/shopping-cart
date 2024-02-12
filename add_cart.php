
<?php
session_start();
//initialize cart if not set or is unset
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

//unset quantity only when clearing the cart
if (isset($_GET['clear_cart'])) {
    unset($_SESSION['qty_array']);
    // Redirect to prevent resubmission on page refresh
    header('Location: index.php');
    exit();
}

// Check if product ID is provided and add it to the cart
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $product_id = $_GET['id'];
    // Add the product to the cart
    $_SESSION['cart'][] = $product_id;
    $_SESSION['message'] = 'Product added to cart successfully';
    // Redirect to prevent resubmission on page refresh
    header('Location: index.php');
    exit();
}
?>
