<?php
/** @var Array $data */
/** @var \App\Core\LinkGenerator $link */
/** @var \App\Core\IAuthenticator $auth */

use App\Models\Category; ?>
<link href="../public/css/admin.css" rel="stylesheet">

<div class="container">
    <h2>Admin</h2>
    <div class="text-center text-vypis">
        <?php
        if (isset($data['message'])) {
            echo $data['message'];
        }
        ?>
    </div>
    Zmen aby len admin mohol prist
    <div>
        <form>
            <label for="spravovanie">Vyber spravovanie</label>
            <select name="spravovanie" class="form-control admin-nav" id="spravovanie">
                <option>Domov</option>
                <option selected>Kategórie</option>
                <option>Inzeráty</option>
            </select>
        </form>
    </div>


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
                    <select name="category" class="form-control" id="zmenaNazvu">
                        <?php foreach (Category::getAll() as $category): ?>
                            <option><?= $category->getName() ?></option>
                        <?php endforeach; ?>
                    </select>
                    <input name="novaNazov"  type="text" class="form-control" id="pridanie" placeholder="Zadajte názov"
                           value="" required>
                </div>
                <button type="submit" class="btn btn-primary">Zmeň</button>
            </form>
        </div>
        <div class="col-md-auto stlpec-admin">
            <form action="<?=$link->url("admin.category")?>" method="post">
                <div class="form-group">
                    <label for="zmena">Zmena url kategórie</label>
                    <select name="category" class="form-control" id="zmena">
                        <?php foreach (Category::getAll() as $category): ?>
                            <option><?= $category->getName() ?></option>
                        <?php endforeach; ?>
                    </select>
                    <input name="novaKategoria"  type="text" class="form-control" id="pridanie" placeholder="Zadajte url" required>
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
    </div>
</div>

<script>
    document.getElementById('spravovanie').addEventListener('change', function() {
        var selectedValue = this.value;
        if (selectedValue === 'Kategórie') {
            window.location.href = 'http://localhost/?c=admin&a=category';
        } else if (selectedValue === 'Inzeráty') {
            window.location.href = 'inzeraty.php';
        } else if (selectedValue === 'Domov') {
            window.location.href = 'http://localhost/?c=admin';
        }
    });
</script>