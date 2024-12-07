<?php
/** @var \App\Core\LinkGenerator $link */
use App\Models\Advert;

?>

<div class="container">

    <?php
    $adverts = Advert::getAll(orderBy: '`dateOfCreate` desc');
    foreach ($adverts as $advert):
        ?>
        <a href="<?= $link->url('advert.index',['id' => $advert->getId()])?>">
        <div class="col" >
            <div class="card kategoria">
                <h2>inzerát <?= $advert->getId() ?></h2>
                <h3>Nazov: <?= $advert->getTitle() ?></h3>
                <h3><?= $advert->getText() ?></h3>
            </div>
        </div>
        </a>
    <?php endforeach; ?>
</div>
