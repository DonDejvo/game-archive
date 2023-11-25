const sidebar = document.getElementById("sidebar");
const lightbox = document.getElementById("lightbox");
const menu = document.getElementById("menu");
const menuPath = document.getElementById("path");

const lightboxOpen = "lightbox-open";
const sidebarResponsiveOpen = "sidebar-responsive-open";

const menuIcon = "M4 6h16M4 12h16m-7 6h7";
const closeIcon = "M6 18L18 6M6 6l12 12";

let isNavOpen = false;

lightbox.addEventListener("click", toggleSidebar);
menu.addEventListener("click", toggleSidebar);

menuPath.setAttribute("d", menuIcon);

function toggleSidebar() {
    if (isNavOpen) {
        lightbox.classList.remove(lightboxOpen);
        sidebar.classList.remove(sidebarResponsiveOpen);
        menuPath.setAttribute("d", menuIcon);
    } else {
        lightbox.classList.add(lightboxOpen);
        sidebar.classList.add(sidebarResponsiveOpen);
        menuPath.setAttribute("d", closeIcon);
    }
    isNavOpen = !isNavOpen;
}