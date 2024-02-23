        // Set a timeout to hide the message after 3 seconds (adjust as needed)
        setTimeout(function () {
            var messageElement = document.getElementById("message");
            if (messageElement) {
                messageElement.style.display = "none";
            }
        }, 2000);