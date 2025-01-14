<?php

/** @var Array $data */
/** @var \App\Core\LinkGenerator $link */

use App\Config\Configuration;

?>


<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-11 col-md-6 col-lg-5">
            <h2 class="text-center">Prihlásenie</h2>
            <div class="text-center text-vypis">
                <?php
                if (isset($data['message'])) {
                    echo $data['message'];
                }
                ?>
            </div>
            <form method="post" action="<?= $link->url("login") ?>">
                <div class="form-signin" >
                    <label for="email">Email</label>
                    <input name="login" type="email" required autofocus class="form-control minSirka" id="email"
                           placeholder="Zadajte email" value="<?= ($data['login'] ?? '')?>">
                </div>
                <div class="form-signin">
                    <label for="password">Heslo</label>
                    <input name="password" type="password" required class="form-control minSirka" id="password"
                           placeholder="Zadajte heslo">
                </div>
                <div class="text-center mt-1">
                    <button name="submit" type="submit" class="btn btn-primary">Prihlás</button>
                    <button onclick="window.location.href='<?= $link->url("auth.register")?>' "
                            type="button" class="btn btn-primary">Vytvoriť nový účet</button>
                </div>
            </form>
        </div>
    </div>
</div>

