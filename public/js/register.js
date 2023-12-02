(function () {
    const registerForm = document.getElementById("register-form");
    const username = document.getElementById("username");
    const password = document.getElementById("password");
    const repeatPassword = document.getElementById("repeat-password");

    if (registerForm) {
        registerForm.addEventListener("submit", checkForm);
    }

    function checkForm(e) {
        const usernameErr = username.parentElement.querySelector(".form-control-error");
        const passwordErr = password.parentElement.querySelector(".form-control-error");
        const repeatPasswordErr = repeatPassword.parentElement.querySelector(".form-control-error");

        usernameErr.textContent = '';
        passwordErr.textContent = '';
        repeatPasswordErr.textContent = '';

        let success = true;

        if (username.value.length < 3 || username.value.length > 20) {
            usernameErr.textContent = 'Username must have 3 - 20 characters';
            success = false;
        }

        if (password.value.length < 8) {
            passwordErr.textContent = 'Password must have at least 8 characters';
            success = false;
        }

        if (repeatPassword.value !== password.value) {
            repeatPasswordErr.textContent = 'Passwords does not match';
            success = false;
        }

        if (!success) {
            e.preventDefault();
        }
    }

})()