(function () {
    const paginationLinks = document.querySelectorAll(".pagination__item > a");
    const searchInput = document.getElementById("search");
    const genreInput = document.getElementById("genre");
    const filterInput = document.getElementById("filter");

    for (let i = 0; i < paginationLinks.length; ++i) {
        const elem = paginationLinks[i];
        elem.addEventListener('click', () => updateQueryParam('page', elem.dataset.page));
    }

    if (paginationLinks.length) {
        if (searchInput) {
            const searchBtn = document.getElementById("search-btn");
            searchBtn.addEventListener('click', () => updateQueryParam('search', searchInput.value));
        }

        if (genreInput) {
            genreInput.addEventListener('change', () => updateQueryParam('genre', genreInput.value));
        }

        if (filterInput) {
            filterInput.addEventListener('change', () => updateQueryParam('filter', filterInput.value));
        }
    }

    function updateQueryParam(name, value) {
        const searchParams = new URLSearchParams(location.search);
        searchParams.set(name, value);
        location.search = searchParams.toString();
    }
})()