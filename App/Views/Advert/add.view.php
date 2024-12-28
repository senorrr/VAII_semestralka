<?php
/** @var Array $data */
/** @var \App\Core\LinkGenerator $link */

use App\Models\Category;

?>
<div class="container">
    <h2>Pridanie inzerátu</h2>
    pridaj required vsade!
    <form action="<?=''/* $link->url("advert.add")*/ ?>" method="post">
        <div class="form-group">
            <label for="title">Názov</label>
            <input name="title"  type="text" class="form-control" id="title" placeholder="Zadajte názov"
                   value="<?= ($data!=null) ? $data['title'] : '' ?>">
        </div>
        <div class="form-group">
            <label for="category">Kategória</label>
            <select name="category" class="form-control" id="category">
                <?php foreach (Category::getAll() as $category): ?>
                    <option><?= $category->getName() ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="price">Cena (€)</label>
            <input name="price"  type="number" class="form-control" id="price" min="0"
                   placeholder="Zadajte cenu"
                   value="<?= ($data!=null) ? $data['price'] : '' ?>">
        </div>
        <div class="form-group">
            <label for="city">Mesto</label>
            <input name="city"  type="text" class="form-control" id="city"
                   placeholder="Zadajte mesto"
                   value="<?= ($data!=null) ? $data['city'] : '' ?>">
            <label for="cityZip">PSČ</label>
            <input name="cityZip"  type="text" class="form-control" id="cityZip"
                   placeholder="Zadajte PSČ"
                   value="<?= ($data!=null) ? $data['cityZip'] : '' ?>">
        </div>
        <div class="form-group">
            <label for="monday">Vyberte dni dostupnosti</label><br>
            <div class="form-check form-check-inline">
                <label class="form-check-label" for="monday">Pondelok</label>
                <input class="form-check-input" type="checkbox" id="monday" name="monday" <?= ($data!= null && isset($data['monday']) && $data['monday']=="on" ? "checked" : '') ?>>
            </div>
            <div class="form-check form-check-inline">
                <label class="form-check-label" for="tuesday">Utorok</label>
                <input class="form-check-input" type="checkbox" id="tuesday" name="tuesday" <?= ($data!= null && isset($data['tuesday']) && $data['tuesday']=="on" ? "checked" : '') ?>>
            </div>
            <div class="form-check form-check-inline">
                <label class="form-check-label" for="wednesday">Streda</label>
                <input class="form-check-input" type="checkbox" id="wednesday" name="wednesday" <?= ($data!= null && isset($data['wednesday']) && $data['wednesday']=="on" ? "checked" : '') ?>>
            </div>
            <div class="form-check form-check-inline">
                <label class="form-check-label" for="thursday">Štvrtok</label>
                <input class="form-check-input" type="checkbox" id="thursday" name="thursday" <?= ($data!= null && isset($data['thursday']) && $data['thursday']=="on" ? "checked" : '') ?>>
            </div>
            <div class="form-check form-check-inline">
                <label class="form-check-label" for="friday">Piatok</label>
                <input class="form-check-input" type="checkbox" id="friday" name="friday" <?= ($data!= null && isset($data['friday']) && $data['friday']=="on" ? "checked" : '') ?>>
            </div>
            <div class="form-check form-check-inline">
                <label class="form-check-label" for="saturday">Sobota</label>
                <input class="form-check-input" type="checkbox" id="saturday" name="saturday" <?= ($data!= null && isset($data['saturday']) && $data['saturday']=="on" ? "checked" : '') ?>>
            </div>
            <div class="form-check form-check-inline">
                <label class="form-check-label" for="sunday">Nedeľa</label>
                <input class="form-check-input" type="checkbox" id="sunday" name="sunday" <?= ($data!= null && isset($data['sunday']) && $data['sunday']=="on" ? "checked" : '') ?>>
            </div>
        </div>
        <div class="form-group row">
            <label for="photo">Fotky</label>
            <div class="col" id="photos">
                <input name="photo1"  type="url" class="form-control" id="photo" placeholder="Zadajte url adresu 1. fotky">
            </div>
            <div class="col"><button>Vymaz</button> </div>
            <button type="button" class="btn btn-primary text-center" id="pridajFotku" >Pridaj fotku</button>
        </div>
        <div class="form-group">
            <label for="description">Popis</label>
            <textarea name="text"  maxlength="500" class="form-control" id="description"
                      rows="5" placeholder="Zadajte popis"><?= ($data!=null) ? $data['text'] : '' ?></textarea>
        </div>
        <div class="text-center">
            <button type="submit" name="submit" class="btn btn-primary text-center">Pridať Inzerát</button>
        </div>
    </form>
</div>

<script>
    document.getElementById('pridajFotku').addEventListener('click', function() {
        var photoFields = document.getElementById('photos');
        var newField = document.createElement('input');
        var count = photoFields.getElementsByTagName('input').length + 1;

        newField.name = 'photo' + count;
        newField.type = 'url';
        newField.className = 'form-control';
        newField.placeholder = 'Zadajte url adresu ' + count + '. fotky';
        //todo pridaj required
        photoFields.appendChild(newField);
    });
</script>