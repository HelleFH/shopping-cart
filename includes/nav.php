<nav class=" mt-0 bg-gray-600 p-4">
            <div class="container mx-auto flex justify-between items-center">
            <a href="index.php" class="text-white text-2xl font-bold pl-4 hover:text-gray-300">Products</a>
                <ul class="flex items-center space-x-4">
                    <li>
                        <a href="view_cart.php" class="relative flex items-center text-white">
                          

                            <span class="ml-1 hover:text-gray-300">Cart</span>
                            <span class=" top-0 right-0 bg-red-500 text-white rounded-full px-2 py-1 text-xs ml-2 hover:font-bold ">
                                <?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?>
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
