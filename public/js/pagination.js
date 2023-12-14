(function () {
    const paginationLinks = document.querySelectorAll(".pagination__item > a");
    const filterWidget = document.querySelector(".games-filter-widget");

    for (let i = 0; i < paginationLinks.length; ++i) {
        const elem = paginationLinks[i];
        elem.addEventListener('click', () => updateQueryParam('page', elem.dataset.page));
    }

    if (filterWidget) {

        const searchInput = filterWidget.querySelector("#search");
        const genreInput = filterWidget.querySelector("#genre");
        const filterInput = filterWidget.querySelector("#filter");
        const searchBtn = filterWidget.querySelector("#search-btn");

        searchBtn.addEventListener('click', () => updateQueryParam('search', searchInput.value));
        genreInput.addEventListener('change', () => updateQueryParam('genre', genreInput.value));
        filterInput.addEventListener('change', () => updateQueryParam('filter', filterInput.value));
    }

    function updateQueryParam(name, value) {
        const searchParams = new URLSearchParams(location.search);
        searchParams.set(name, value);
        location.search = searchParams.toString();
    }
})()