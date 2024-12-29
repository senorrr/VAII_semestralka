<?php
/** @var Array $data */
/** @var \App\Core\LinkGenerator $link */
/** @var \App\Core\IAuthenticator $auth */

use App\Models\Category; ?>
<link href="../public/css/admin.css" rel="stylesheet">

<div class="container">
    <h2>Admin</h2>
    <div class="text-center text-vypis">
    </div>
    Zmen aby len admin mohol prist

    <div class="row d-flex text-center text-vypis row-cols-1 justify-content-between">
        <div class="col-md-3 stlpec-admin">
            <form action="<?=$link->url("admin.category")?>" method="post">
                <div class="form-group">
                    <label for="pridanie">Pridanie kategorie</label>
                    <input name="novaKategoria"  type="text" class="form-control" id="pridanie" placeholder="Zadajte názov"
                           value="" required>
                </div>
                <button type="submit" class="btn btn-primary">Pridaj</button>
            </form>
        </div>
        <div class="col-md-3 stlpec-admin">
            <form action="<?=$link->url("admin")?>" method="post">
                <div class="form-group">
                    <label for="zmena">Zmena kategorie</label>
                    <select name="category" class="form-control" id="zmena">
                        <?php foreach (Category::getAll() as $category): ?>
                            <option><?= $category->getName() ?></option>
                        <?php endforeach; ?>
                    </select>
                    <input name="novaKategoria"  type="text" class="form-control" id="pridanie" placeholder="Zadajte názov"
                           value="" required>
                </div>
                <button type="submit" class="btn btn-primary">Zmeň</button>
            </form>
        </div>
        <div class="col-md-3 stlpec-admin">
            <form action="<?=$link->url("admin.removeCategory")?>" method="post">
                <div class="form-group">
                    <label for="odstranenie">Odstranenie kategórie</label>
                    <select name="category" class="form-control" id="odstranenie">
                        <?php foreach (Category::getAll() as $category): ?>
                            <option><?= $category->getName() ?></option>
                        <?php endforeach; ?>
                    </select>

                </div>
                <button type="submit" class="btn btn-primary">Odstráň</button>
            </form>
        </div>
    </div>

</div>