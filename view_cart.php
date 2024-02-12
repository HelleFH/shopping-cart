<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the form was submitted
    if(isset($_POST['save'])){
        // Loop through the indexes
        foreach($_POST['indexes'] as $key){
            // Update the quantity in the session
            $_SESSION['qty_array'][$key] = $_POST['qty_'.$key];
        }
        // Set a success message
        $_SESSION['message'] = 'Cart updated successfully';
        // Redirect back to the cart page
        header('location: view_cart.php');
        exit; // Make sure to exit after redirecting
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Shopping Cart using Session in PHP</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        td {
            text-align: center;
        }
        @media (min-width: 768px) {
            form {
                width: 80vw;
                margin:0 auto;
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
     <nav class=" mt-0 bg-gray-800 p-4">
            <div class="container mx-auto flex justify-between items-center">
                <a href="#" class="text-white text-2xl font-bold">Shopping Cart</a>
                <ul class="flex items-center space-x-4">
                    <li>
                        <a href="view_cart.php" class="relative flex items-center text-white">
                            <span class="absolute top-0 right-0 bg-red-500 text-white rounded-full px-2 py-1 text-xs"><?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?>
</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 11l2 2m0 0l-2 2m2-2H9.5a2.5 2.5 0 01-2.5-2.5c0-3 4-8 6-8s6 5 6 8a2.5 2.5 0 01-2.5 2.5zm-9 0V9a1 1 0 011-1h6a1 1 0 011 1v2"></path>
                            </svg>
                            <span class="ml-1">Cart</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        <?php
        if (isset($_SESSION['message'])) {
            ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline"><?php echo $_SESSION['message']; ?></span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                    <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <title>Close</title>
                        <path fill-rule="evenodd" d="M14.354 5.354a1 1 0 010 1.414L11.414 10l2.94 2.94a1 1 0 11-1.414 1.414L10 11.414l-2.94 2.94a1 1 0 01-1.414-1.414L8.586 10 5.646 7.06a1 1 0 111.414-1.414L10 8.586l2.94-2.94a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                </span>
            </div>
            <?php
            // Unset session message after displaying
            unset($_SESSION['message']);
        }
        ?>

        <a class="block mb-4 text-blue-500" href="index.php"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
        <form method="POST" action="">
            <table class="w-full border-collapse border border-gray-400">
                <thead>
                    <tr>
                        <th class="border border-gray-400"></th>
                        <th class="border border-gray-400"></th>
                        <th class="border border-gray-400">Product</th>
                        <th class="border border-gray-400">Price</th>
                        <th class="border border-gray-400">Quantity</th>
                        <th class="border border-gray-400">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Initialize total
                    $total = 0;
                    if (!empty($_SESSION['cart'])) {
                        // Database connection parameters
                        $host = 'ec2-52-54-200-216.compute-1.amazonaws.com';
                        $database = 'dd6lav3cfgc4im';
                        $user = 'fzqodqspncqlth';
                        $password = '822f15786751cd2dcac0646c6fee43a50d56f215812fc9034ab77b9f9c7a4e4d';
                        $port = '5432'; // PostgreSQL default port

                        try {
                            // Establishing the connection using PDO
                            $dsn = "pgsql:host=$host;port=$port;dbname=$database";
                            $pdo = new PDO($dsn, $user, $password);
                            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                            // Create array of initial qty which is 1
                            $index = 0;
                            if (!isset($_SESSION['qty_array'])) {
                                $_SESSION['qty_array'] = array_fill(0, count($_SESSION['cart']), 1);
                            }
                            $sql = "SELECT * FROM products WHERE id IN (" . implode(',', $_SESSION['cart']) . ")";
                            $stmt = $pdo->query($sql);
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                ?>
                                <tr>
                                    <td class="border border-gray-400">
                                        <a href="delete_item.php?id=<?php echo $row['id']; ?>&index=<?php echo $index; ?>"><span><i
                                                        class="fa fa-trash" aria-hidden="true"></i>
                                            </span></a>
                                    </td>
                                    <td class="border border-gray-400"><img src="<?php echo $row['photo']; ?>" alt="Product Image" class="w-16 h-16 object-cover"></td>
                                    <td class="border border-gray-400"><?php echo $row['name']; ?></td>
                                    <td class="border border-gray-400">£<?php echo number_format($row['price'], 2); ?></td>
                                    <input type="hidden" name="indexes[]" value="<?php echo $index; ?>">
                                    <td class="border border-gray-400">
    <div class="border border-gray-400 inline-block px-2">
        <input type="text" class="form-control w-12" style="text-align:center"
                value="<?php echo $_SESSION['qty_array'][$index]; ?>"
                name="qty_<?php echo $index; ?>">
    </div>
</td>



                                    <td class="border border-gray-400">
                                    £<?php echo number_format($_SESSION['qty_array'][$index] * $row['price'], 2); ?>
                                    </td>
                                    <?php $total += $_SESSION['qty_array'][$index] * $row['price']; ?>
                                </tr>
                            <?php
                                $index++;
                            }
                        } catch (PDOException $e) {
                            // Connection failed
                            echo "Connection failed: " . $e->getMessage();
                        }
                    } else {
                        ?>
                        <tr>
                            <td colspan="6" class="text-center border border-gray-400">No Item in Cart</td>
                        </tr>
                    <?php
                    }

                    ?>
                    <tr>
                    <td colspan="5" class="border border-gray-400 text-right pr-4"><b>Total</b></td>
                        <td class="border border-gray-400"><b>£<?php echo number_format($total, 2); ?></b></td>
                    </tr>
                </tbody>
            </table>
            <div class="mt-4 flex justify-end">
                <button type="submit" name="save" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Save Changes</button>
                <a href="clear_cart.php" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 ml-4">Clear Cart</a>
            </div>
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
