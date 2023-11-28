(function () {
    const deleteBtnArray = document.getElementsByClassName("delete-btn");
    const deleteDialogArray = document.getElementsByClassName("delete-dialog");
    const confirmDeleteBtnArray = document.getElementsByClassName("confirm-delete-btn");
    const cancelDeleteBtnArray = document.getElementsByClassName("cancel-delete-btn");

    for (let i = 0; i < deleteBtnArray.length; ++i) {

        deleteBtnArray[i].addEventListener("click", function (e) {
            deleteBtnArray[i].classList.add("btn--hidden");
            deleteDialogArray[i].hidden = false;
        });

        cancelDeleteBtnArray[i].addEventListener("click", function (e) {
            deleteBtnArray[i].classList.remove("btn--hidden");
            deleteDialogArray[i].hidden = true;
        });

        confirmDeleteBtnArray[i].addEventListener("click", function (e) {
            location = `delete-game.php?id=${deleteDialogArray[i].dataset.gameId}`;
        });
    }
})()