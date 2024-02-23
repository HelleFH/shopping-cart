<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the form was submitted and if $_POST['indexes'] is set and not empty
    if (isset($_POST['save']) && !empty($_POST['indexes'])) {
        // Loop through the indexes
        foreach ($_POST['indexes'] as $key) {
            // Update the quantity in the session
            $_SESSION['qty_array'][$key] = $_POST['qty_' . $key];
        }
        // Set a success message
        // Redirect back to the cart page
        header('location: view_cart.php');
        exit; // Make sure to exit after redirecting
    }
}
?>