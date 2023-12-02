(function () {

    const tabsArray = document.getElementsByClassName("tabs");

    for (let i = 0; i < tabsArray.length; ++i) {
        init(tabsArray[i]);
    }

    function init(tabs) {
        const tabsMenu = tabs.querySelector(".tabs__menu");
        const tabsPanels = tabs.querySelector(".tabs__panels");

        openTab(tabs.dataset.defaultTabName);

        for (let i = 0; i < tabsMenu.childElementCount; ++i) {
            const tabsMenuItem = tabsMenu.children[i];
            tabsMenuItem.addEventListener("click", function (e) {
                openTab(tabsMenuItem.dataset.tabName);
            });
        }

        function openTab(tabName) {
            const tabsMenuItems = tabsMenu.getElementsByClassName("tabs-menu-item");
            for (let i = 0; i < tabsMenuItems.length; ++i) {
                const tabsMenuItem = tabsMenuItems[i];
                if (tabsMenuItem.dataset.tabName == tabName) {
                    tabsMenuItem.classList.add("tabs-menu-item--active");
                } else {
                    tabsMenuItem.classList.remove("tabs-menu-item--active");
                }
            }
            for (let i = 0; i < tabsPanels.childElementCount; ++i) {
                const tabsPanel = tabsPanels.children[i];
                if (tabsPanel.dataset.tabName == tabName) {
                    tabsPanel.classList.remove("tabs-panel--closed");
                } else {
                    tabsPanel.classList.add("tabs-panel--closed");
                }
            }
        }
    }

})()