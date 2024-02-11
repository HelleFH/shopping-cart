<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Simple Shopping Cart using Session in PHP</title>
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Simple Shopping Cart</a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <!-- left nav here -->
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="active"><a href="view_cart.php"><span class="badge"><?php echo count($_SESSION['cart'] ?? []); ?></span> Cart <span class="glyphicon glyphicon-shopping-cart"></span></a></li>
                </ul>
            </div>
        </div>
    </nav>
    <h1 class="page-header text-center">Cart Details</h1>
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
            <?php 
            if(isset($_SESSION['message'])){
                ?>
                <div class="alert alert-info text-center">
                    <?php echo $_SESSION['message']; ?>
                </div>
                <?php
                unset($_SESSION['message']);
            }

            ?>
            <form method="POST" action="save_cart.php">
            <table class="table table-bordered table-striped">
                <thead>
                    <th></th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                </thead>
                <tbody>
                <?php
                // Initialize total
                $total = 0;
                if(!empty($_SESSION['cart'])){
                    // Database connection parameters
                    $host = "ec2-52-54-200-216.compute-1.amazonaws.com";
                    $port = "5432";
                    $dbname = "dd6lav3cfgc4im";
                    $user = "fzqodqspncqlth";
                    $password = "822f15786751cd2dcac0646c6fee43a50d56f215812fc9034ab77b9f9c7a4e4d";

                    try {
                        // Establishing a connection
                        $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";
                        $db = new PDO($dsn, $user, $password);
                        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        // Prepare SQL statement
                        $sql = "SELECT * FROM products WHERE id IN (".implode(',',$_SESSION['cart']).")";
                        $stmt = $db->prepare($sql);
                        $stmt->execute();

                        // Fetch results
                        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                            ?>
                            <tr>
                                <td>
                                    <a href="delete_item.php?id=<?php echo $row['id']; ?>&index=<?php echo $index; ?>" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span></a>
                                </td>
                    
                            <?php
                            $index ++;
                        }

                        // Close connection
                        $db = null;

                    } catch(PDOException $e) {
                        echo "Connection failed: " . $e->getMessage();
                        die();
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="4" class="text-center">No Item in Cart</td>
                    </tr>
                    <?php
                }
                ?>
               
</div>
</body>
</html>
