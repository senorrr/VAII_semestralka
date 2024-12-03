<?php
/** @var Array $data */
/** @var \App\Core\LinkGenerator $link */
?>
<div class="container">
    <h2>Pridanie inzerátu</h2>
    <form>
        <div class="form-group">
            <label for="title">Názov</label>
            <input required type="text" class="form-control" id="title" placeholder="Zadajte názov">
        </div>
        <div class="form-group">
            <label for="category">Kategória</label>
            <select class="form-control" id="category">
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
            <input required type="number" class="form-control" id="price" min="0" placeholder="Zadajte cenu">
        </div>
        <div class="form-group">
            <h3>Vyberte dni dostupnosti</h3>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="monday" name="days" value="monday" required>
                <label class="form-check-label" for="monday">Pondelok</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="tuesday" name="days" value="tuesday">
                <label class="form-check-label" for="tuesday">Utorok</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="wednesday" name="days" value="wednesday">
                <label class="form-check-label" for="wednesday">Streda</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="thursday" name="days" value="thursday">
                <label class="form-check-label" for="thursday">Štvrtok</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="friday" name="days" value="friday">
                <label class="form-check-label" for="friday">Piatok</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="saturday" name="days" value="saturday">
                <label class="form-check-label" for="saturday">Sobota</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="sunday" name="days" value="sunday">
                <label class="form-check-label" for="sunday">Nedeľa</label>
            </div>
        </div>
        <div class="form-group">
            <label for="photos">Fotky</label>
            <input type="file" class="form-control-file" id="photos" multiple>
        </div>
        <div class="form-group">
            <label for="description">Popis</label>
            <textarea required maxlength="500" class="form-control" id="description" rows="5" placeholder="Zadajte popis"></textarea>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary text-center">Pridať Inzerát</button>
        </div>
    </form>
</div>