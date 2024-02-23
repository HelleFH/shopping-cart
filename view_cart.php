<?php

include 'db.php';
?><?php include 'cart_logic.php'; ?>



<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Shopping Cart using Session in PHP</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


</head>

<body>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        td {
            text-align: center;
        }

        @media (min-width: 768px) {
            form {
                width: 80vw;
                margin: 0 auto;
            }
        }

        /* Table width for mobile */
        @media (max-width: 767px) {
            form {
                width: 100vw;
            }
        }
    </style>
    <div class="  w-screen">
        
        <?php include 'includes/nav.php'; ?>

        <?php
        if (isset($_SESSION['message'])) {
            ?>

            <?php
            // Unset session message after displaying
            unset($_SESSION['message']);
        }
        ?>
                        <tbody>
                        <form method="POST" action="">

        <?php include 'view_cart_table.php'; ?>
        <?php
        if (!empty($_SESSION['cart'])) {
            $total = 0; // Initialize total
            $index = 0;
            
            // Check if qty_array is set, if not, initialize it
            if (!isset($_SESSION['qty_array'])) {
                $_SESSION['qty_array'] = array_fill(0, count($_SESSION['cart']), 1);
            }
            
            // Query products from database based on session cart
            $sql = "SELECT * FROM products WHERE id IN (" . implode(',', $_SESSION['cart']) . ")";
            $stmt = $pdo->query($sql);
            
            // Loop through the results and display cart content
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                include 'view_cart_content.php'; // Assuming this file contains HTML for each cart item
                $index++;
                
                // Calculate subtotal for each item and add to total
                $subtotal = $_SESSION['qty_array'][$index] * $row['price'];
                $total += $subtotal;
            }
        } else {
            ?>
            <tr>
                <td colspan="6" class="text-center border border-gray-400">Your Cart is Empty</td>
            </tr>
            <?php
        }
        ?>

        </tbody>
        </table>
        <?php include 'view_cart_buttons.php'; ?>

    </form>
    </div>
    <script>
        // Set a timeout to hide the message after 3 seconds (adjust as needed)
        setTimeout(function () {
            var messageElement = document.getElementById("message");
            if (messageElement) {
                messageElement.style.display = "none";
            }
        }, 2000);
    </script>
</body>

</html>