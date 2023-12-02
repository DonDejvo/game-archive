(function () {
    const toggleStarBtn = document.getElementById("toggle-star-btn");
    const starCountElem = document.getElementById("star-count");

    if (toggleStarBtn) {
        toggleStarBtn.addEventListener("click", toggleStar);
    }

    async function toggleStar() {
        let gameId = new URLSearchParams(location.search).get("id");
        let starCount = Number(starCountElem.textContent);

        const body = new URLSearchParams();
        body.append("gameId", gameId);

        let result = null;
        try {
            const response = await fetch("toggle-star.php", {
                method: 'POST',
                body
            });
            result = await response.json();
        } catch (err) {
            console.log(err);
        }

        if (result && result.data != null) {
            updateStarred(result.data.starred);
        }

        function updateStarred(value) {
            starCount += (value ? 1 : -1);

            starCountElem.textContent = starCount;
            toggleStarBtn.textContent = value ? "Unstar" : "Star";
        }
    }
})()