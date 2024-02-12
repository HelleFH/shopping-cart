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
    <?php include 'nav.php'; ?>

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

            echo '<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mx-auto space-x-4 px-6 pt-6 pb-4">';
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <div id="lightbox" class="hidden fixed top-0 left-0 w-full bg-black bg-opacity-75 flex justify-center items-center">
    <div class="relative">
        <button id="closeBtn" class="absolute top-0 right-0 m-4 text-white text-2xl">&times;</button>
        <img id="lightboxImg" src="" alt="Lightbox Image" class="max-w-full max-h-full">
    </div>
</div>
<style>
    /* Hide the lightbox by default */
    #lightbox.hidden {
        display: none;
    }
    #lightbox {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.75); /* Semi-transparent black background */
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999;
    }
    #lightboxContent {
    }
    /* Style for the lightbox image */
    #lightboxImg {
        max-width: 90%;
        max-height: 90vh; 
    }

    /* Style for the close button */
    #closeBtn {
        cursor: pointer;
        background: none;
        border: none;
        outline: none;
    }
</style>

                <div class="bg-white shadow-md rounded-lg overflow-hidden flex justify-center py-4 px-2">
                    <div class="w-full max-w-xs">
                    <a href="#" onclick="openLightbox('<?php echo $row['photo']; ?>')">
    <img src="<?php echo $row['photo']; ?>" class="w-full h-48 object-cover object-center">
</a>
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