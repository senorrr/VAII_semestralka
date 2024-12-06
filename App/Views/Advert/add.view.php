<?php
/** @var Array $data */
/** @var \App\Core\LinkGenerator $link */
?>
<div class="container">
    <h2>Pridanie inzerátu</h2>
    <form action="<?= $link->url("advert.add") ?>" method="post">
        <div class="form-group">
            <label for="title">Názov</label>
            <input name="title"  type="text" class="form-control" id="title" placeholder="Zadajte názov"
                   value="<?= ($data!=null) ? $data['title'] : '' ?>">
        </div>
        <div class="form-group">
            <label for="category">Kategória</label>
            <select name="category" class="form-control" id="category">
                <option>Auto</option>
                <option>Domácnosť</option>
                <option>Náradie</option>
                <option>Elektronika</option>
                <option>Šport</option>
                <option>Pre deti</option>
                <option>Oslavy</option>
                <option>Oblečenie</option>
                <option>Služby</option>
                <option>Ostatné</option>
            </select>
        </div>
        <div class="form-group">
            <label for="price">Cena (€)</label>
            <input name="price"  type="number" class="form-control" id="price" min="0"
                   placeholder="Zadajte cenu"
                   value="<?= ($data!=null) ? $data['price'] : '' ?>">
        </div>
        <div class="form-group">
            <h3>Vyberte dni dostupnosti</h3>
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
        <div class="form-group">
            <label for="photos">Fotky</label>
            <input type="file" class="form-control-file" id="photos" multiple>
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