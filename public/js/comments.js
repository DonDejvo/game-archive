(function () {

    const deleteCommentBtnArray = document.getElementsByClassName("delete-comment-btn");

    for (let i = 0; i < deleteCommentBtnArray.length; ++i) {
        const btn = deleteCommentBtnArray[i];
        btn.addEventListener("click", function (e) {
            e.preventDefault();
            if (confirm("Comment will be permanently deleted.")) {
                location.href = "delete-comment.php?id=" + btn.dataset.commentId + "&gameId=" + btn.dataset.gameId;
            }
        });
    }

})()