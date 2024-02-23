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