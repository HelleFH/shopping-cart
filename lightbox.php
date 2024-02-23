<div id="lightbox"
                    class="hidden fixed top-0 left-0 w-full bg-black bg-opacity-75 flex justify-center items-center">
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
                        background-color: rgba(0, 0, 0, 0.75);
                        /* Semi-transparent black background */
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        z-index: 9999;
                    }

                    #lightboxContent {}

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