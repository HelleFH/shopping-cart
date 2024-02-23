
<div class="bg-white shadow-md rounded-lg overflow-hidden flex justify-center py-4 px-2">
                    <div class="w-full max-w-xs">
                        <a href="#" onclick="openLightbox('<?php echo $row['photo']; ?>')">
                            <img src="<?php echo $row['photo']; ?>" class="w-full h-48 object-cover object-center">
                        </a>
                        <div class="p-4 text-center">
                            <h4 class="font-semibold text-lg mb-2">
                                <?php echo $row['name']; ?>
                            </h4>
                            <p class="text-gray-600">£
                                <?php echo $row['price']; ?>
                            </p>
                            <button
                                class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow mt-4">
                                <a href="includes/add_cart.php?id=<?php echo $row['id']; ?>">Add to Cart</a>
                            </button>
                        </div>
                    </div>
                </div>