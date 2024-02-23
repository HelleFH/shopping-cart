<?php
session_start();
include 'db.php';
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
        <?php include 'includes/nav.php'; ?>
        <?php include 'message.php'; ?>

        <?php 
            $sql = "SELECT * FROM products";
            $stmt = $pdo->query($sql);

            echo '<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mx-auto space-x-4 px-6 pt-6 pb-4">';
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>
                
                <?php include 'lightbox.php'; ?>
                <?php include 'product.php'; ?>
                <?php
            }
            echo '</div>'; // Close grid
      
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
<script>
    // Function to open the lightbox with the specified image URL
    function openLightbox(imageUrl) {
        document.getElementById('lightboxImg').src = imageUrl;
        document.getElementById('lightbox').classList.remove('hidden');
    }

    // Function to close the lightbox
    function closeLightbox() {
        document.getElementById('lightbox').classList.add('hidden');
    }

    // Add event listener to close button
    document.getElementById('closeBtn').addEventListener('click', closeLightbox);
</script>

</html>