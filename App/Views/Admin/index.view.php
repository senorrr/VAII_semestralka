<?php
/** @var Array $data */
/** @var \App\Core\LinkGenerator $link */
/** @var \App\Core\IAuthenticator $auth */


//todo pridaj uzivatelov
//todo pridaj xko ked je admin pri zobrazeni inzeratov
use App\Models\Category; ?>
<link href="../public/css/admin.css" rel="stylesheet">

<div class="container">
    <h2>Admin</h2>
    <div>
        <form>
            <label for="spravovanie">Vyber spravovanie</label>
            <select name="spravovanie" class="form-control admin-nav" id="spravovanie">
                <option selected>Domov</option>
                <option>Kategórie</option>
                <option>Uzivatelia</option>
            </select>
        </form>
    </div>
</div>