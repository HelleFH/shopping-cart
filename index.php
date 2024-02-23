<?php
session_start();
include 'includes/db/db.php';
?>

<?php include 'includes/header.php'; ?>

<body>
    <div class="container mx-auto">
        <?php include 'includes/nav.php'; ?>
        <?php include 'templates/message.php'; ?>

        <?php 
            $sql = "SELECT * FROM products";
            $stmt = $pdo->query($sql);

            echo '<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mx-auto space-x-4 px-6 pt-6 pb-4">';
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>
                
                <?php include 'templates/lightbox.php'; ?>
                <?php include 'templates/product.php'; ?>
                <?php
            }
            echo '</div>'; 
      
        ?>
    </div>
</body>

<script src="public/js/setTimeout.js"></script>
<script src="public/js/lightbox.js"></script>


</html>