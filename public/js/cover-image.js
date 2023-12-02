(function () {
    const coverImageInput = document.getElementById("cover-image");
    const coverImage = document.querySelector(".cover-image-container__image");
    const resetImageBtn = document.getElementById("reset-image-btn");

    if (coverImage != null) {
        coverImageInput.addEventListener("change", readFileToImage);
        if (resetImageBtn) {
            resetImageBtn.addEventListener("click", resetImage);
        }

        if (coverImage.dataset.url) {
            resetImage();
        }
    }

    function readFileToImage() {
        if (this.files && this.files[0]) {
            const reader = new FileReader();
            reader.addEventListener("load", (e) => {
                coverImage.hidden = false;
                coverImage.src = e.target.result;
                if (resetImageBtn) {
                    resetImageBtn.hidden = false;
                }
            });
            reader.readAsDataURL(this.files[0]);
        }
    }

    function resetImage() {
        coverImage.src = coverImage.dataset.url;
        coverImage.hidden = false;
        resetImageBtn.hidden = true;
    }
})()