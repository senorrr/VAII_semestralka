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
<div class="container mt-3">
    <div class="text-center text-vypis">
        <?php
        if (isset($data['message'])) {
            echo $data['message'];
        }
        ?>
    </div>
    <?php
    $advert = Advert::getOne($data['id']);
    $images = Photo::getAll('`advertId` LIKE ?', [$data['id']]);
    ?>
    <h2 class="text-center"><?= $advert->getTitle()?> - <?= date('d.m.Y', strtotime($advert->getDateOfCreate()))?></h2>
    <div class="pozadieInzerat">
        <div class="row d-flex justify-content-around inzerat-oramovanie">
            <h3 class="col-auto">Kategória: <?=Category::getOne($advert->getCategoryId())->getName()?></h3>
            <h3 class="col-auto">Číslo inzerátu: <?= $advert->getId()?></h3>
        </div>
        <?php
        if (sizeof($images) > 0) {
            ?>
            <div id="carouselExampleIndicators" class="carousel slide d-flex">
                <div class="carousel-indicators">
                    <?php
                    for ($i = 0; $i < sizeof($images); $i++) {
                        echo '<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="' . $i . '" class="' . ($i === 0 ? 'active' : '') . '" aria-current="true" aria-label="Slide ' . ($i + 1) . '"></button>';
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
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
            <?php
        }
        ?>
        <p class="mx-4 mt-2">
            <?=$advert->getText()?>
        </p>
        <div class="row inzerat-oramovanie">
            <h3 class="col-2 col-sm-2 col-lg-1">Meno:</h3>
            <h3 class="col"><?=User::getOne($advert->getOwnerId())->getName() . " " . User::getOne($advert->getOwnerId())->getSurname()?></h3>
        </div>
        <div class="row inzerat-oramovanie">
            <h3 class="col-2 col-sm-2 col-lg-1">Lokalita:</h3>
            <h3 class="col"><?=Village::getOne($advert->getVillageId())->getName()?></h3>
        </div>
        <div class="row inzerat-oramovanie">
            <h3 class="col-2 col-sm-2 col-lg-1">Cena: </h3>
            <h3 class="col"><?=$advert->getPrice()?>€</h3>
        </div>
        <div class="row inzerat-oramovanie justify-content-start " >
            <h3 class="col-auto">Dostupné dni:
                <?php
                if ($advert->getMonday() == 1) {
                    echo '<h3 class="col-auto">Pondelok</h3>';
                }
                if ($advert->getTuesday() == 1) {
                    echo '<h3 class="col-auto">Utorok</h3>';
                }
                if ($advert->getWednesday() == 1) {
                    echo '<h3 class="col-auto">Streda</h3>';
                }
                if ($advert->getThursday() == 1) {
                    echo '<h3 class="col-auto">Štvrtok</h3>';
                }
                if ($advert->getFriday() == 1) {
                    echo '<h3 class="col-auto">Piatok</h3>';
                }
                if ($advert->getSaturday() == 1) {
                    echo '<h3 class="col-auto">Sobota</h3>';
                }
                if ($advert->getSunday() == 1) {
                    echo '<h3 class="col-auto">Nedeľa</h3>';
                }
                ?>
            </h3>
        </div>
        <div class="row inzerat-oramovanie">
            <h3 class="col-auto col-xs-1 col-sm-3 col-md-2 col-lg-auto">Zobrazenia: </h3>
            <h3 class="col"><?=$advert->getViews()?></h3>
        </div>
        <div class="d-flex justify-content-center">
            <button class="btn btn-success me-1" onclick="window.location.href='<?= $link->url('reservation.new', [$advert->getId()]) ?>'">Požičať</button>
            <?php
                if ($auth->isLogged() && $auth->getLoggedUserId() == $advert->getOwnerId()) {
                    echo '<button class="btn btn-primary me-1" onclick="window.location.href=\'' . $link->url('advert.edit', [$advert->getId()]) . '\'">Edituj</button>';
                    echo '<button class="btn btn-danger" onclick="window.location.href=\'' . $link->url('advert.remove', [[$advert->getId()]]) . '\'">Vymaž</button>';

                }
            ?>
            <!--<button class="btn btn-info">Kontaktuj</button>-->

        </div>
    </div>
</div>