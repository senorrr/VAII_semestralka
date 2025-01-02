<?php
/** @var Advert $data */
/** @var \App\Core\LinkGenerator $link */
/** @var \App\Core\IAuthenticator $auth */


use App\Models\Advert;
use App\Models\Category;
use App\Models\Photo;
use App\Models\User;
use App\Models\Village;

?>
<div class="container">
    <?php
    $advert = Advert::getOne($data);
    $images = Photo::getAll('`advertId` LIKE ?', [$data]);
    ?>
    <form action="<?=$link->url('advert.edit', [$advert->getId()])?>" id="velkaForm" method="post">
        <div class="d-flex justify-content-center text-nowrap mb-3">
            <input name="title"  type="text" class="form-control obmedzenie-sirky me-1" id="title" placeholder="Zadajte názov"
                   value="<?= $advert->getTitle() ?>" required>
        <h2 class="mt-2">- <?= date('d.m.Y', strtotime($advert->getDateOfCreate()))?></h2>
        </div>
        <div class="pozadieInzerat">
            <div class="row justify-content-around inzerat-oramovanie-edit">
                <div class="col-auto d-flex align-items-center">
                    <label for="category" class="mr-2">Kategória:</label>
                    <select name="category" class="form-control ms-1" id="category">
                        <?php foreach (Category::getAll() as $category): ?>
                            <option <?php if ($category->getId() == $advert->getCategoryId()) {
                                echo 'selected';
                            } ?>><?= $category->getName() ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            <h3 class="col-auto mt-2">Číslo inzerátu: <?= $advert->getId()?></h3>
            </div>

            <?php
            if (sizeof($images) > 0) {
                ?>
                <div id="carouselExampleIndicators" class="carousel slide d-flex">
                    <div class="carousel-indicators">
                        <?php
                        for ($i = 0; $i < sizeof($images); $i++) {
                            echo '<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="' . $i . '" class="' . ($i === 0 ? 'active' : '') .
                                '" aria-current="true" aria-label="Slide ' . ($i + 1) . '"></button>';
                        }
                        ?>
                    </div>
                    <div class="carousel-inner justify-content-center align-items-center">
                        <?php
                        $i = 0;
                        foreach ($images as $index => $image): ?>
                            <div class="carousel-item <?= $i === 0 ? 'active' : '' ?>">
                                <img class="d-block w-100 mx-auto" src="<?= $image->getUrl() ?>" alt="Slide <?= $index + 1 ?>">
                            </div>
                            <?php $i++?>
                        <?php endforeach; ?>
                    </div>
                    <button id="prev" class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button id="next" class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
                <?php
            }
            ?>
                <div class="inzerat-oramovanie-edit d-flex align-items-center">
                    <input class="form-control ms-3" type="url" placeholder="Zadajte url adresu fotky" name="url" id="url">
                    <button class="btn btn-primary ms-2" type="submit" name="submitPhoto">Pridaj fotku</button>
                    <button class="btn btn-danger mx-2" type="submit" name="submitRemovePhoto">Načítaj url fotky</button>
                </div>
            <div class="m-2">
                <textarea name="text"  maxlength="1500" class="form-control" id="description"
                          rows="5" placeholder="Zadajte popis"><?=$advert->getText() ?>
                </textarea>
            </div>
            <div class="row inzerat-oramovanie">
                <h3 class="col-3 col-sm-2 col-lg-1">Meno:</h3>
                <h3 class="col ms-2"><?=User::getOne($advert->getOwnerId())->getName() . " " . User::getOne($advert->getOwnerId())->getSurname()?></h3>
            </div>
            <div class="row inzerat-oramovanie-edit">
                <label for="lokalita" class="col-3 col-sm-2 col-lg-1 mt-2">Lokalita:</label>
                <div class="col">
                    <input class="form-control col obmedzenie-sirky" name="city" id="city" value="<?=Village::getOne($advert->getVillageId())->getName()?>">
                </div>
            </div>
            <div class="row inzerat-oramovanie-edit">
                <label for="cena" class="col-3 col-sm-2 col-lg-1 mt-2">Cena: </label>
                <div class="col">
                    <input class="form-control obmedzenie-sirky" name="price" id="price" required min="0" value="<?=$advert->getPrice()?>">
                </div>
            </div>
            <div class="inzerat-oramovanie-edit ps-2">
                <label class="form-check-label" for="monday">Pondelok</label>
                <input class="form-check-input" type="checkbox" id="monday" name="monday" <?= ($advert->getMonday() == 1 ? "checked" : '') ?>>

                <label class="form-check-label ps-4" for="tuesday">Utorok</label>
                <input class="form-check-input" type="checkbox" id="tuesday" name="tuesday" <?= ($advert->getTuesday() == 1 ? "checked" : '') ?>>

                <label class="form-check-label ps-4" for="wednesday">Streda</label>
                <input class="form-check-input" type="checkbox" id="wednesday" name="wednesday" <?= ($advert->getWednesday() == 1 ? "checked" : '') ?>>

                <label class="form-check-label ps-4" for="thursday">Štvrtok</label>
                <input class="form-check-input" type="checkbox" id="thursday" name="thursday" <?= ($advert->getThursday() == 1 ? "checked" : '') ?>>

                <label class="form-check-label ps-4" for="friday">Piatok</label>
                <input class="form-check-input" type="checkbox" id="friday" name="friday" <?= ($advert->getFriday() == 1 ? "checked" : '') ?>>

                <label class="form-check-label ps-4" for="saturday">Sobota</label>
                <input class="form-check-input" type="checkbox" id="saturday" name="saturday" <?= ($advert->getSaturday() == 1 ? "checked" : '') ?>>

                <label class="form-check-label ps-4" for="sunday">Nedeľa</label>
                <input class="form-check-input" type="checkbox" id="sunday" name="sunday" <?= ($advert->getSunday() == 1 ? "checked" : '') ?>>
            </div>

            <div class="row inzerat-oramovanie">
                <h3 class="col-3 col-sm-2 col-lg-1">Videnia: </h3>
                <h3 class="col ms-2"><?=$advert->getViews()?></h3>
            </div>
            <div class="d-flex justify-content-center">
                <button class="btn btn-success me-1" type="submit" name="submitAll"  id="submitAll">Uložiť</button>
                <button class="btn btn-danger" type="button" onclick="window.location.href='<?= $link->url('advert.index', [['id' => $advert->getId()]]) ?>'">Zrušiť</button>
            </div>
        </form>
    </div>
</div>

<script>
    //pridanie fotky
    document.addEventListener('DOMContentLoaded', function() {
        const pridaj = document.querySelector('button[name="submitPhoto"]');
        pridaj.addEventListener('click', function(event) {
            const urlInput = document.querySelector('input[name="url"]');
            if (urlInput.value.trim() === '') {
                event.preventDefault();
            }
        });

    });

    //ked zacnem editovat url adresu nech zmeni tlacidlo
    document.addEventListener('DOMContentLoaded', function() {
        const removePhotoButton = document.querySelector('button[name="submitRemovePhoto"]');
        const urlInput = document.querySelector('input[name="url"]');

        urlInput.addEventListener('input', function() {
            removePhotoButton.textContent = 'Načítaj url fotky';
        });
    });

    //zmenenie tlacidla podla toho ci je spravne nacitana url
    document.addEventListener('DOMContentLoaded', function() {
        const removePhotoButton = document.querySelector('button[name="submitRemovePhoto"]');
        const urlInput = document.querySelector('input[name="url"]');

        removePhotoButton.addEventListener('click', function(event) {
            const activeItem = document.querySelector('.carousel-item.active img');
            if (activeItem && urlInput.value !== activeItem.src) {
                event.preventDefault();
                urlInput.value = activeItem.src;
                removePhotoButton.textContent = 'Odstráň';
            }
            if (removePhotoButton.textContent !== 'Odstráň') {
                event.preventDefault();
            }
        });

        const prev = document.querySelector('.carousel-control-prev');
        prev.addEventListener('click', function() {
            removePhotoButton.textContent = 'Načítaj url fotky';
            urlInput.value = '';
        });

        const next = document.querySelector('.carousel-control-next');
        next.addEventListener('click', function() {
            removePhotoButton.textContent = 'Načítaj url fotky';
            urlInput.value = '';
        });
    });

</script>
