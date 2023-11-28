(function () {

    const selectContainerArray = document.getElementsByClassName("custom-select");

    for (let i = 0; i < selectContainerArray.length; ++i) {
        init(selectContainerArray[i]);
    }

    function init(selectContainer) {
        const defaultSelect = selectContainer.querySelector("select");

        const selectedItemElem = document.createElement("div");
        selectedItemElem.classList = "select-selected";
        selectedItemElem.innerHTML = defaultSelect.options[defaultSelect.selectedIndex].innerHTML;
        selectContainer.appendChild(selectedItemElem);

        const optionListElem = document.createElement("div");
        optionListElem.classList = "select-items select-hide";

        for (let i = 0; i < defaultSelect.childElementCount; ++i) {

            const optionElem = document.createElement("div");
            optionElem.innerHTML = defaultSelect.options[i].innerHTML;
            optionElem.dataset.value = defaultSelect.options[i].value;
            optionListElem.appendChild(optionElem);

            optionElem.addEventListener("click", function (e) {

                for (let j = 0; j < defaultSelect.childElementCount; ++j) {
                    if (defaultSelect.options[j].value == this.dataset.value) {
                        defaultSelect.selectedIndex = j;
                        selectedItemElem.innerHTML = this.innerHTML;
                        break;
                    }
                }
                selectedItemElem.click();

                defaultSelect.value = defaultSelect.options[defaultSelect.selectedIndex].value;
                console.log(defaultSelect.value);
                defaultSelect.dispatchEvent(new Event("change"));
            });
        }

        selectContainer.appendChild(optionListElem);

        selectedItemElem.addEventListener("click", function (e) {
            e.stopPropagation();
            closeAllSelect(selectContainer);
            this.nextSibling.classList.toggle("select-hide");
            this.classList.toggle("select-arrow-active");
        });

    }

    function closeAllSelect(selectContainer) {
        for (let i = 0; i < selectContainerArray.length; ++i) {
            if (selectContainer != selectContainerArray[i]) {
                const selectedItemElem = selectContainerArray[i].querySelector(".select-selected");
                const optionListElem = selectContainerArray[i].querySelector(".select-items");

                selectedItemElem.classList.remove("select-arrow-active");
                optionListElem.classList.add("select-hide");
            }
        }
    }

})()