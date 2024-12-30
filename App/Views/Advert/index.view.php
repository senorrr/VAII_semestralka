<?php
/** @var Advert $data */
/** @var \App\Core\LinkGenerator $link */

use App\Models\Advert;
use App\Models\Category;
use App\Models\Photo;
use App\Models\Village;

?>
<div class="container">
    <?php
    $advert = Advert::getOne($_GET['id']);
    $images = Photo::getAll('`advert` LIKE ?', [$_GET['id']]);
    ?>
    <h2 class="text-center"><?= $advert->getTitle()?> - <?= $advert->getDateOfCreate()?></h2>
    <div class="mx-5 pozadieInzerat">
        <h3>Kategória: <?=Category::getOne($advert->getCategoryId())->getName()?></h3>
        <h3>Lokalita: <?=Village::getOne($advert->getVillageId())->getName()?></h3>
        <h3>Cena: <?=$advert->getPrice()?>€</h3>
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
        <p>
            <?=$advert->getText()?>
        </p>
    </div>
</div>