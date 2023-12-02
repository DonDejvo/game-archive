(function () {

    const deleteGameBtn = document.querySelector(".delete-game-btn");

    if (deleteGameBtn) {
        deleteGameBtn.addEventListener("click", function (e) {
            if (confirm("Game will be permanently deleted.")) {
                location.href = "delete-game.php?id=" + e.target.dataset.gameId;
            }
        })
    }

})()