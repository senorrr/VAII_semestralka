<?php
/** @var Advert $data */
/** @var \App\Core\LinkGenerator $link */

use App\Models\Category;

?>
<div class="container">
    <?php $advert = \App\Models\Advert::getOne($_GET['id'])?>
    <h2>inzerát <?= $advert->getId()?></h2>
        <div class="form-group">
            <h3> Nazov: <?= $advert->getTitle()?> </h3>
            <h3> <?= $advert->getText()?> </h3>
        </div>
</div>