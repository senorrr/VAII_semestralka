<?php
/** @var Advert $data */
/** @var \App\Core\LinkGenerator $link */

use App\Models\Category;

?>
<div class="container">
    <?php $advert = \App\Models\Advert::getOne($_GET['id'])?>
    <h1 class="text-center"><?= $advert->getTitle()?></h1>
    <div class="mx-5 pozadieInzerat">
        <p>
            <?=$advert->getText()?>
        </p>
        <h3>Kategória: <?=Category::getOne($advert->getCategoryId())->getName()?></h3>
        <h3>Lokalita: <?=\App\Models\Village::getOne($advert->getVillageId())->getName()?></h3>
        <h3>Cena: <?=$advert->getPrice()?>€</h3>

    </div>
</div>