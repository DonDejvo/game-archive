const registerForm = document.getElementById("register-form");
const username = document.getElementById("username");
const password = document.getElementById("password");
const repeatPassword = document.getElementById("repeat-password");
const usernameErr = document.getElementById("username-error");
const passwordErr = document.getElementById("password-error");
const repeatPasswordErr = document.getElementById("repeat-password-error");

registerForm.addEventListener("submit", checkForm);

function checkForm(e) {
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
