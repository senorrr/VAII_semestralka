<?php
/** @var Array $data */
/** @var \App\Core\LinkGenerator $link */
/** @var \App\Core\IAuthenticator $auth */ ?>

<div class="text-center">

<div class="d-inline-flex align-content-center justify-content-center mt-0 mojNavbar text-center">

    <a class="mojNavbar-text me-4" href="<?= $link->url("reservation.myReservations")?>"> <h4> Moje rezervácie</a>
    <a class="mojNavbar-text me-4" href="">Moje inzeráty</a>
</div>
</div>



<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-11 col-md-6 col-lg-5 gy-2">
            <h2>Vitaj, <?= $auth->getLoggedUserName();  $auth->getLoggedUserSurname()?> toto je tvoj profil</h2>
            <div class="text-center text-vypis">
                <?php
                if (isset($data['message'])) {
                    echo $data['message'];
                }
                ?>            </div>
            <form action="<?= $link->url("auth.edit") ?>" method="post">
                <div class="form-group">
                    <label for="name">Meno</label>
                    <input name="name" required class="form-control minSirka" autofocus autocomplete="on" placeholder="Zadajte meno" id="name" value="<?= $auth->getLoggedUserName() ?>">
                    <small id="nameHelp" class="form-text text-vypis"></small>
                </div>
                <div class="form-group">
                    <label for="surname">Priezvisko</label>
                    <input name="surname" required class="form-control minSirka" placeholder="Zadajte priezvisko" id="surname" value="<?= $auth->getLoggedUserSurname() ?>">
                    <small id="surnameHelp" class="form-text text-vypis"></small>
                </div>
                <div class="form-group">
                    <label for="login">Email</label>
                    <input name="login" required type="email" class="form-control minSirka" id="login" placeholder="Zadajte email" value="<?= $auth->getLoggedUserEmail() ?>" disabled>
                </div>
                <div class="form-group">
                    <label for="newLogin">Nový email</label>
                    <input name="newLogin" type="email" class="form-control minSirka" id="newLogin" placeholder="Zadajte nový email">
                    <small id="newLoginHelp" class="form-text text-vypis"></small>
                </div>
                <div class="form-group">
                    <label for="oldPassword">Heslo</label>
                    <input name="oldPassword" required type="password" class="form-control minSirka" id="oldPassword"
                           placeholder="Zadajte aktuálne heslo" title="Musí obsahovať minimálne 8 znakov a jedno veľké písmeno"
                           autocomplete="password">
                    <!--TODO: do paternu daj toto: pattern="(?=.*[A-Z]).{8,}"   -->

                </div>
                <div class="form-group">
                    <label for="newPassword">Nové heslo</label>
                    <input name="newPassword" type="password" class="form-control minSirka" id="newPassword" placeholder="Zadajte nové heslo">
                </div>

                <div class="form-group">
                    <label for="confirmPassword">Zopakujte heslo</label>
                    <input name="confirmPassword" type="password" class="form-control minSirka" id="confirmPassword" placeholder="Zopakujte nové heslo">
                    <small id="passwordHelp" class="form-text text-vypis"></small>
                </div>

                <div class="text-center mt-1">
                    <button name="remove" type="submit" class="btn btn-danger">Vymaž účet</button>
                    <button name="submit" type="submit" class="btn btn-primary" id="submitBtn">Uložiť zmeny</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('name').addEventListener('input', validateName);
    document.getElementById('surname').addEventListener('input', validateSurname);
    document.getElementById("newPassword").addEventListener("input", checkPasswords);
    document.getElementById("confirmPassword").addEventListener("input", checkPasswords);
    document.getElementById("newLogin").addEventListener("input", disableNewPassword);


    function disableNewPassword() {
        var oldMail = document.getElementById("login").value;
        var newMail = document.getElementById("newLogin").value;
        var newPassword = document.getElementById("newPassword");
        var confirmPassword = document.getElementById("confirmPassword");
        var submitBtn = document.getElementById("submitBtn");
        var newLoginHelp = document.getElementById('newLoginHelp');

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
        var name = document.getElementById("name").value;
        var submitBtn = document.getElementById("submitBtn");
        var nameHelp = document.getElementById("nameHelp");

        if (name.trim() === '') {
            nameHelp.textContent = "Meno nemôže byť len z medzier!";
            submitBtn.disabled = true;
            submitBtn.classList.add("btn-disabled");
            return false
        } else {
            nameHelp.textContent = "";
            submitBtn.disabled = false;
            submitBtn.classList.remove("btn-disabled");
            return true
        }
    }

    function validateSurname() {
        var surname = document.getElementById("surname").value;
        var submitBtn = document.getElementById("submitBtn");
        var surnameHelp = document.getElementById("surnameHelp");

        if (surname.trim() === '') {
            surnameHelp.textContent = "Priezvisko nemôže byť len z medzier!";
            submitBtn.disabled = true;
            submitBtn.classList.add("btn-disabled");
            return false
        } else {
            surnameHelp.textContent = "";
            submitBtn.disabled = false;
            submitBtn.classList.remove("btn-disabled");
            return true
        }
    }

    function checkPasswords() {
        var password = document.getElementById("oldPassword").value;
        var newPassword = document.getElementById("newPassword").value;
        var confirmPassword = document.getElementById("confirmPassword").value;
        var passwordHelp = document.getElementById("passwordHelp");
        var submitBtn = document.getElementById("submitBtn");

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
</script>

