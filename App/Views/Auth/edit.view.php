<?php
/** @var Array $data */
/** @var \App\Core\LinkGenerator $link */
/** @var \App\Core\IAuthenticator $auth */ ?>


<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-11 col-md-6 col-lg-5 gy-2">
            <h2>Vitaj, <?= $auth->getLoggedUserName();  $auth->getLoggedUserSurname()?> toto je tvoj profil</h2>
            <div class="text-center text-vypis">
                <?= @$data['message'] ?>
            </div>
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
                    <label for="email">Email</label>
                    <input name="login" required type="email" class="form-control minSirka" id="email" placeholder="Zadajte email" value="<?= $auth->getLoggedUserEmail() ?>" disabled>
                </div>
                <div class="form-group">
                    <label for="newEmail">Nový email</label>
                    <input name="newLogin" type="email" class="form-control minSirka" id="newEmail" placeholder="Zadajte nový email">
                </div>
                <div class="form-group">
                    <label for="password">Heslo</label>
                    <input name="passwordOld" required type="password" class="form-control minSirka" id="password" placeholder="Zadajte aktuálne heslo" title="Musí obsahovať minimálne 8 znakov a jedno veľké písmeno" autocomplete="new-password">
                    <!--TODO: do paternu daj toto: pattern="(?=.*[A-Z]).{8,}"   -->

                </div>
                <div class="form-group">
                    <label for="new_password">Nové heslo</label>
                    <input name="passwordNew" type="password" class="form-control minSirka" id="new_password" placeholder="Zadajte nové heslo">
                </div>

                <div class="form-group">
                    <label for="confirm_password">Zopakujte heslo</label>
                    <input name="passwordConfirm" type="password" class="form-control minSirka" id="confirm_password" placeholder="Zopakujte nové heslo">
                    <small id="passwordHelp" class="form-text text-vypis"></small>
                </div>

                <div class="text-center">
                    <button name="remove" type="submit" class="btn btn-block bg-danger">Vymaž účet</button>
                    <button name="submit" type="submit" class="btn btn-block" id="submitBtn">Uložiť zmeny</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('name').addEventListener('input', validateName);
    document.getElementById('surname').addEventListener('input', validateSurname);
    document.getElementById("new_password").addEventListener("input", checkPasswords);
    document.getElementById("confirm_password").addEventListener("input", checkPasswords);

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
        var password = document.getElementById("new_password").value;
        var confirmPassword = document.getElementById("confirm_password").value;
        var passwordHelp = document.getElementById("passwordHelp");
        var submitBtn = document.getElementById("submitBtn");

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
</script>

