document.addEventListener('DOMContentLoaded', function() {
    // auth.edit
    const nameInput = document.getElementById('name');
    if (nameInput) {
        nameInput.addEventListener('input', validateName);
    }

    const surnameInput = document.getElementById('surname');
    if (surnameInput) {
        surnameInput.addEventListener('input', validateSurname);
    }

    const newPasswordInput = document.getElementById("newPassword");
    if (newPasswordInput) {
        newPasswordInput.addEventListener("input", checkPasswords);
    }

    const confirmPasswordInput = document.getElementById("confirmPassword");
    if (confirmPasswordInput) {
        confirmPasswordInput.addEventListener("input", checkPasswords);
    }

    const newLoginInput = document.getElementById("newLogin");
    if (newLoginInput) {
        newLoginInput.addEventListener("input", disableNewPassword);
    }

    function disableNewPassword() {
        let oldMail = document.getElementById("login").value;
        let newMail = document.getElementById("newLogin").value;
        let newPassword = document.getElementById("newPassword");
        let confirmPassword = document.getElementById("confirmPassword");
        let submitBtn = document.getElementById("submitBtn");
        let newLoginHelp = document.getElementById('newLoginHelp');

        if (newMail !== '') {
            newPassword.value = '';
            confirmPassword.value = '';
            newPassword.disabled = true;
            confirmPassword.disabled = true;
        } else {
            newPassword.disabled = false;
            confirmPassword.disabled = false;
        }
        checkPasswords();

        if (oldMail === newMail) {
            newLoginHelp.textContent = "Starý a nový mail sú rovnaké!";
            submitBtn.disabled = true;
            submitBtn.classList.add("btn-disabled");
        } else {
            newLoginHelp.textContent = "";
            submitBtn.disabled = false;
            submitBtn.classList.remove("btn-disabled");
        }
    }

    function validateName() {
        let name = document.getElementById("name").value;
        let submitBtn = document.getElementById("submitBtn");
        let nameHelp = document.getElementById("nameHelp");

        if (name.trim() === '') {
            nameHelp.textContent = "Meno nemôže byť len z medzier!";
            submitBtn.disabled = true;
            submitBtn.classList.add("btn-disabled");
            return false;
        } else {
            nameHelp.textContent = "";
            submitBtn.disabled = false;
            submitBtn.classList.remove("btn-disabled");
            return true;
        }
    }

    function validateSurname() {
        let surname = document.getElementById("surname").value;
        let submitBtn = document.getElementById("submitBtn");
        let surnameHelp = document.getElementById("surnameHelp");

        if (surname === '') {
            surnameHelp.textContent = "";
            submitBtn.disabled = false;
            submitBtn.classList.remove("btn-disabled");
            return false;
        }

        if (surname.trim() === '') {
            surnameHelp.textContent = "Priezvisko nemôže byť len z medzier!";
            submitBtn.disabled = true;
            submitBtn.classList.add("btn-disabled");
            return false;
        } else {
            surnameHelp.textContent = "";
            submitBtn.disabled = false;
            submitBtn.classList.remove("btn-disabled");
            return true;
        }
    }

    function checkPasswords() {
        let password = document.getElementById("oldPassword").value;
        let newPassword = document.getElementById("newPassword").value;
        let confirmPassword = document.getElementById("confirmPassword").value;
        let passwordHelp = document.getElementById("passwordHelp");
        let submitBtn = document.getElementById("submitBtn");

        if (newPassword === '' && confirmPassword === '') {
            passwordHelp.textContent = "";
            submitBtn.disabled = false;
            submitBtn.classList.remove("btn-disabled");
            return true;
        }
        if (newPassword !== confirmPassword) {
            passwordHelp.textContent = "Heslá sa nezhodujú!";
            submitBtn.disabled = true;
            submitBtn.classList.add("btn-disabled");
            return false;
        } else if (newPassword === confirmPassword) {
            if (password === newPassword) {
                passwordHelp.textContent = "Staré a nové heslo sa zhodujú!";
                submitBtn.disabled = true;
                submitBtn.classList.add("btn-disabled");
                return false;
            }
            passwordHelp.textContent = "";
            submitBtn.disabled = false;
            submitBtn.classList.remove("btn-disabled");
            return true;
        }
    }

    // auth.register
    const newPasswordRegisterInput = document.getElementById("new_password");
    if (newPasswordRegisterInput) {
        newPasswordRegisterInput.addEventListener("input", checkPasswordsRegister);
    }

    const confirmPasswordRegisterInput = document.getElementById("confirm_password");
    if (confirmPasswordRegisterInput) {
        confirmPasswordRegisterInput.addEventListener("input", checkPasswordsRegister);
    }

    function checkPasswordsRegister() {
        let password = document.getElementById("new_password").value;
        let confirmPassword = document.getElementById("confirm_password").value;
        let passwordHelp = document.getElementById("passwordHelp");
        let submitBtn = document.getElementById("submitBtn");

        if (password !== confirmPassword) {
            passwordHelp.textContent = "Heslá sa nezhodujú!";
            submitBtn.disabled = true;
            submitBtn.classList.add("btn-disabled");
            return false;
        } else {
            passwordHelp.textContent = "";
            submitBtn.disabled = false;
            submitBtn.classList.remove("btn-disabled");
            return true;
        }
    }
});