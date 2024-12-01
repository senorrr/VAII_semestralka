<?php

/** @var Array $data */
/** @var \App\Core\LinkGenerator $link */
?>


<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-11 col-md-6 col-lg-5 gy-2">
            <h2 class="text-center">Registrovať sa</h2>
            <div class="text-center text-danger bold">
                <?= @$data['message'] ?>
            </div>
            <form action="<?= $link->url("auth.register") ?>" method="post">
                <div class="form-group">
                    <label for="name">Meno</label>
                    <input name="name" required class="form-control minSirka" autofocus autocomplete="on" placeholder="Zadajte meno" id="name">
                </div>
                <div class="form-group">
                    <label for="surname">Priezvisko</label>
                    <input name="surname" required class="form-control minSirka" placeholder="Zadajte priezvisko" id="surname">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input name="login" required type="email" class="form-control minSirka" id="email" placeholder="Zadajte email">
                </div>
                <div class="form-group">
                    <label for="new_password">Heslo</label>
                    <input name="password" required type="password" class="form-control minSirka" id="new_password" placeholder="Zadajte heslo" title="Musí obsahovať minimálne 8 znakov a jedno veľké písmeno" autocomplete="new-password">
                    <!--TODO: do paternu daj toto: pattern="(?=.*[A-Z]).{8,}"   -->

                </div>
                <div class="form-group">
                    <label for="confirm_password">Zopakujte heslo</label>
                    <input name="passwordConfirm" required type="password" class="form-control minSirka" id="confirm_password" placeholder="Zopakujte heslo">
                    <small id="passwordHelp" class="form-text text-danger"></small>
                </div>
                <div class="text-center medzera">
                    <h3>Registráciou súhlasíte so spracovaním osobných údajov</h3>
                </div>
                <div class="text-center">
                    <button name="submit" type="submit" class="btn btn-disabled" id="submitBtn">Vytvoriť účet</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    document.getElementById("new_password").addEventListener("input", checkPasswords);
    document.getElementById("confirm_password").addEventListener("input", checkPasswords);

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