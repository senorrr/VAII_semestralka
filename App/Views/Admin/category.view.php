<?php
/** @var Array $data */
/** @var \App\Core\LinkGenerator $link */
/** @var \App\Core\IAuthenticator $auth */

use App\Models\Category; ?>
<link href="../../../public/css/admin.css" rel="stylesheet">

<div class="container mt-3">
    <h2>Admin</h2>
    <div class="text-center text-vypis">
        <?php
        if (isset($data['message'])) {
            echo $data['message'];
        }
        ?>
    </div>
    <div>
        <form>
            <label for="spravovanie">Vyber spravovanie</label>
            <select name="spravovanie" class="form-control admin-nav" id="spravovanie">
                <option>Domov</option>
                <option selected>Kategórie</option>
                <option>Užívatelia</option>
            </select>
        </form>
    </div>

<div class="mx-2">
    <div class="row d-flex text-center text-vypis row-cols-1 justify-content-between">
        <div class="col-md-auto stlpec-admin">
            <form action="<?=$link->url("admin.category")?>" method="post">
                <div class="form-group">
                    <label for="pridanie">Pridanie kategorie</label>
                    <input name="novaKategoria"  type="text" class="form-control" id="pridanie" placeholder="Zadajte názov" required>
                    <input name="destination"  type="text" class="form-control" id="destination" placeholder="Zadajte url alebo cestu k obrazku" required>
                </div>
                <button type="submit" class="btn btn-primary">Pridaj</button>
            </form>
        </div>
        <div class="col-md-auto stlpec-admin">
            <form action="<?=$link->url("admin.category")?>" method="post">
                <div class="form-group">
                    <label for="zmenaNazvu">Zmena názvu kategórie</label>
                    <select name="staraKategoria" class="form-control" id="zmenaNazvu">
                        <?php foreach (Category::getAll() as $category): ?>
                            <option><?= $category->getName() ?></option>
                        <?php endforeach; ?>
                    </select>
                    <input name="novyNazov"  type="text" class="form-control" id="novyNazov" placeholder="Zadajte názov" required>
                </div>
                <button type="submit" class="btn btn-primary">Zmeň</button>
            </form>
        </div>
        <div class="col-md-auto stlpec-admin">
            <form action="<?=$link->url("admin.category")?>" method="post">
                <div class="form-group">
                    <label for="staraUrl">Zmena url kategórie</label>
                    <select name="staraUrl" class="form-control" id="staraUrl">
                        <?php foreach (Category::getAll() as $category): ?>
                            <option><?= $category->getName() ?></option>
                        <?php endforeach; ?>
                    </select>
                    <input name="novaUrl"  type="text" class="form-control" id="novaUrl" placeholder="Zadajte url" required>
                </div>
                <button type="submit" class="btn btn-primary">Zmeň</button>
            </form>
        </div>
        <div class="col-md-auto stlpec-admin">
            <form action="<?=$link->url("admin.category")?>" method="post">
                <div class="form-group">
                    <label for="odstranenie">Odstranenie kategórie</label>
                    <select name="odstranenie" class="form-control" id="odstranenie">
                        <?php foreach (Category::getAll() as $category): ?>
                            <option><?= $category->getName() ?></option>
                        <?php endforeach; ?>
                    </select>

                </div>
                <button type="submit" class="btn btn-primary">Odstráň</button>
            </form>
        </div>

        <div class="col-md-auto stlpec-admin">
            <a href="https://icons8.com/icons/set/motorcycle--static--white">
                stranka s ikonami
            </a>
        </div>
    </div>
</div>
</div>
