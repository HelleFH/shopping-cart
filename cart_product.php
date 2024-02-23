<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">
                    <?php echo $_SESSION['message']; ?>
                </span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                    <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20">
                        <title>Close</title>
                        <path fill-rule="evenodd"
                            d="M14.354 5.354a1 1 0 010 1.414L11.414 10l2.94 2.94a1 1 0 11-1.414 1.414L10 11.414l-2.94 2.94a1 1 0 01-1.414-1.414L8.586 10 5.646 7.06a1 1 0 111.414-1.414L10 8.586l2.94-2.94a1 1 0 011.414 0z"
                            clip-rule="evenodd" />
                    </svg>
                </span>
            </div>