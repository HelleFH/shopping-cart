<?php
include 'includes/db/db.php';
?>
<?php include 'includes/cart_logic.php'; ?>

<?php include 'includes/header.php'; ?>


<body>
   
    <div class="w-screen">

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

                <?php include 'templates/view_cart_table.php'; ?>
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
                        include 'templates/view_cart_content.php'; // Assuming this file contains HTML for each cart item
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
        <?php include 'templates/view_cart_buttons.php'; ?>

        </form>
    </div>
    <script src="setTimeout.js"></script>

</body>

</html>