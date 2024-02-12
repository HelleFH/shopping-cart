<?php
session_start();


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
    <div class="container mx-auto">
        <nav class="navbar bg-gray-800 p-4">
            <style>
                .navbar {
                    margin-bottom: 2em;
                    /* Add margin bottom to navbar */
                }
            </style>
            <div class="container mx-auto flex justify-between items-center">
                <a href="#" class="text-white text-2xl font-bold">Shopping Cart</a>
                <ul class="flex items-center space-x-4">
                    <li>
                        <a href="view_cart.php" class="relative flex items-center text-white">
                            <span class="absolute top-0 right-0 bg-red-500 text-white rounded-full px-2 py-1 text-xs">
                            <?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?>
                            </span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 11l2 2m0 0l-2 2m2-2H9.5a2.5 2.5 0 01-2.5-2.5c0-3 4-8 6-8s6 5 6 8a2.5 2.5 0 01-2.5 2.5zm-9 0V9a1 1 0 011-1h6a1 1 0 011 1v2">
                                </path>
                            </svg>
                            <span class="ml-1">Cart</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        <?php
        // Info message
        if (isset($_SESSION['message'])) {
            ?>
            <div class="container mx-auto mt-8">
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-6">
                        <div id="message" class="alert-info text-center p-3">
                            <strong>
                                <?php echo $_SESSION['message']; ?>
                            </strong>
                        </div>
                    </div>
                </div>
            </div>

            <?php
            unset($_SESSION['message']);
        }
        // Fetch our products
        // Connection
        $host = 'ec2-52-54-200-216.compute-1.amazonaws.com';
        $database = 'dd6lav3cfgc4im';
        $user = 'fzqodqspncqlth';
        $password = '822f15786751cd2dcac0646c6fee43a50d56f215812fc9034ab77b9f9c7a4e4d';
        $port = '5432';

        try {
            $dsn = "pgsql:host=$host;port=$port;dbname=$database";
            $pdo = new PDO($dsn, $user, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT * FROM products";
            $stmt = $pdo->query($sql);

            echo '<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mx-auto space-x-4 px-6">';
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <div class="bg-white shadow-md rounded-lg overflow-hidden flex justify-center py-4 px-2">
                    <div class="w-full max-w-xs">
                    <img src="<?php echo $row['photo'] ?>" class="w-full h-48 object-cover object-center">
                        <div class="p-4 text-center">
                            <h4 class="font-semibold text-lg mb-2">
                                <?php echo $row['name']; ?>
                            </h4>
                            <p class="text-gray-600">$<?php echo $row['price']; ?></p>
                            <button class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow mt-4">
                                <a href="add_cart.php?id=<?php echo $row['id']; ?>">Add to Cart</a>
                            </button>
                        </div>
                    </div>
                </div>


                <?php
            }
            echo '</div>'; // Close grid
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
        // End product row 
        ?>
    </div>
</body>

<script>
            // Set a timeout to hide the message after 3 seconds (adjust as needed)
            setTimeout(function () {
                var messageElement = document.getElementById("message");
                if (messageElement) {
                    messageElement.style.display = "none";
                }
            }, 2000);
        </script>

</html>