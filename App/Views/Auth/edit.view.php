<?php
/** @var Array $data */
/** @var \App\Core\LinkGenerator $link */
/** @var \App\Core\IAuthenticator $auth */
$user = \App\Models\User::getOne($auth->getLoggedUserId())
?>

<div class="text-center">

    <div class="d-inline-flex align-content-center justify-content-center mt-0 mojNavbar text-center">
    <a class="mojNavbar-text me-4" href="<?= $link->url("reservation.myReservations")?>"> <h4> Moje požičania</a>
    <a class="mojNavbar-text me-4" href="<?= $link->url('reservation.reservedFromMe')?>">Požičané odo mnňa</a>
    <?php
    if ($auth->isLogged() && $auth->getPermissionLevel() > 0) {
        echo '<a class="mojNavbar-text me-4" href="' . $link->url('admin.index') . ' ">Admin panel</a>';
    }
    ?>
    </div>
</div>



<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-11 col-md-6 col-lg-5 gy-2">
            <h2>Vitaj, <?= $user->getName() . ' '. $user->getSurname()?> toto je tvoj profil</h2>
            <div class="text-center text-vypis">
                <?php
                if (isset($data['message'])) {
                    echo $data['message'];
                }
                ?>            </div>
            <form action="<?= $link->url("auth.edit") ?>" method="post">
                <div class="form-group">
                    <label for="name">Meno</label>
                    <input name="name" required class="form-control minSirka" autofocus autocomplete="on" placeholder="Zadajte meno" id="name" value="<?= $user->getName() ?>">
                    <small id="nameHelp" class="form-text text-vypis"></small>
                </div>
                <div class="form-group">
                    <label for="surname">Priezvisko</label>
                    <input name="surname" required class="form-control minSirka" placeholder="Zadajte priezvisko" id="surname" value="<?= $user->getSurname() ?>">
                    <small id="surnameHelp" class="form-text text-vypis"></small>
                </div>
                <div class="form-group">
                    <label for="login">Email</label>
                    <input name="login" required type="email" class="form-control minSirka" id="login" placeholder="Zadajte email" value="<?= $user->getEmail() ?>" disabled>
                </div>
                <div class="form-group">
                    <label for="newLogin">Nový email</label>
                    <input name="newLogin" type="email" class="form-control minSirka" id="newLogin" placeholder="Zadajte nový email">
                    <small id="newLoginHelp" class="form-text text-vypis"></small>
                </div>
                <div class="form-group">
                    <label for="oldPassword">Heslo</label>
                    <input name="oldPassword" required type="password" class="form-control minSirka" id="oldPassword"
                           placeholder="Zadajte aktuálne heslo" title="Musí obsahovať minimálne 8 znakov a jedno veľké písmeno" pattern="(?=.*[A-Z]).{8,}"
                           autocomplete="password">

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