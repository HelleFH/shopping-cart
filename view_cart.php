<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>
    <style>
        th {
            padding-right: 5em;
        }

        thead {
            height: 50px;
        }

        .cart_container {
            background-color: #fefbf1;
            display: flex;
            gap: 2em;
            padding: 2em;
            width: fit-content;
            margin: 0 auto;
        }

        .product_info {
            display: flex;
            align-items: center;
            padding-right: 3em;
            white-space: nowrap;
            gap: 1em;
            font-weight: 700;
        }

        .form-control {
            width: 2em;
        }

        .cart_buttons {
            display: flex;
            justify-content: flex-end;
            gap: 2em;
            margin-top: 2em;
        }
    </style>
    <?php include('nav.php'); ?>

    <div class="cart_container">
        <div>
            <?php
            if (isset($_SESSION['message'])) {
                ?>
                <div id="message">
                    <?php echo $_SESSION['message']; ?>
                </div>
            <?php
                // Unset session message
                unset($_SESSION['message']);
            }

            ?>
            <a class="back-button" href="index.php"><i class="fas fa-arrow-left"></i>
                Back</a>
            <form method="POST" action="">
                <table>
                    <h2>Cart Details</h2>

                    <thead>
                        <th></th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                    </thead>
                    <tbody>
                        <?php
                        //initialize total
                        $total = 0;
                        if (!empty($_SESSION['cart'])) {
                            //connection

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

                                // Connection successful
                                // echo "Connected successfully to PostgreSQL database!";

                                //create array of initial qty which is 1
                                $index = 0;
                                if (!isset($_SESSION['qty_array'])) {
                                    $_SESSION['qty_array'] = array_fill(0, count($_SESSION['cart']), 1);
                                }
                                $sql = "SELECT * FROM products WHERE id IN (" . implode(',', $_SESSION['cart']) . ")";
                                $stmt = $pdo->query($sql);
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    ?>
                                    <tr>
                                        <td>
                                            <a href="delete_item.php?id=<?php echo $row['id']; ?>&index=<?php echo $index; ?>"><span><i
                                                            class="fa fa-trash" aria-hidden="true"></i>
                                                </span></a>
                                        </td>
                                        <td class="product_info">
                                            <img src="<?php echo $row['photo']; ?>" alt="Product Image" width="50" height="50">
                                            <?php echo $row['name']; ?>
                                        </td>

                                        <td>
                                            <?php echo number_format($row['price'], 2); ?>
                                        </td>
                                        <input type="hidden" name="indexes[]" value="<?php echo $index; ?>">
                                        <td><input type="text" class="form-control"
                                                value="<?php echo $_SESSION['qty_array'][$index]; ?>"
                                                name="qty_<?php echo $index; ?>"></td>
                                        <td>
                                            <?php echo number_format($_SESSION['qty_array'][$index] * $row['price'], 2); ?>
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
                                <td colspan="4" class="text-center">No Item in Cart</td>
                            </tr>
                        <?php
                        }

                        ?>
                        <tr>
                            <td colspan="4" align="right"><b>Total</b></td>
                            <td><b>
                                        <?php echo number_format($total, 2); ?>
                                    </b></td>
                        </tr>
                    </tbody>
                </table>
                <div class="cart_buttons">
                    <button type="submit" name="save">Save Changes</button>
                    <button><a href="clear_cart.php"> Clear Cart</a></button>
                </div>

            </form>
        </div>
    </div>
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
