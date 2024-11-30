<?php
/** @var Array $data */
/** @var \App\Core\LinkGenerator $link */
/** @var \App\Core\IAuthenticator $auth */ ?>


<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-11 col-md-6 col-lg-5 gy-2">
            <h2>Vitaj, <?= $auth->getLoggedUserName();  $auth->getLoggedUserSurname()?> toto je tvoj profil</h2>
            <div class="text-center text-danger bold">
                <?= @$data['message'] ?>
            </div>
            <form action="<?= $link->url("auth.edit") ?>" method="post">
                <div class="form-group">
                    <label for="name">Meno</label>
                    <input name="name" required class="form-control minSirka" autofocus autocomplete="on" placeholder="Zadajte meno" id="name" value="<?= $auth->getLoggedUserName() ?>">
                </div>
                <div class="form-group">
                    <label for="surname">Priezvisko</label>
                    <input name="surname" required class="form-control minSirka" placeholder="Zadajte priezvisko" id="surname" value="<?= $auth->getLoggedUserSurname() ?>">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input name="login" required type="email" class="form-control minSirka" id="email" placeholder="Zadajte email" value="<?= $auth->getLoggedUserEmail() ?>">
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
                </div>

                <div class="text-center">
                    <button name="remove" type="submit" class="btn btn-block bg-danger">Vymaž účet</button>
                    <button name="submit" type="submit" class="btn btn-block">Uložiť zmeny</button>
                </div>
            </form>
        </div>
    </div>
</div>

