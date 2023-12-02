(function () {

    const formControlArray = document.getElementsByClassName("form-control");

    for (let i = 0; i < formControlArray.length; ++i) {
        init(formControlArray[i]);
    }

    function init(formControl) {
        if (formControl.classList.contains("required")) {
            const div = document.createElement("div");
            div.classList.add("form-control-group");

            const errorElem = document.createElement("span");
            errorElem.classList.add("form-control-error");
            errorElem.textContent = formControl.dataset.error;
            div.appendChild(errorElem);


            const requiredElem = document.createElement("span");
            requiredElem.textContent = "Required";
            requiredElem.classList.add("form-control-required");
            div.appendChild(requiredElem);

            formControl.appendChild(div);
        }
    }

})()