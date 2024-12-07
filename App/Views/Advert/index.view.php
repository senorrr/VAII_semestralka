<?php
/** @var Advert $data */
/** @var \App\Core\LinkGenerator $link */

use App\Models\Category;

?>
<div class="container">
    <h2>inzerát</h2>
        <?php $advert = \App\Models\Advert::getOne($data['id'])?>
        <div class="form-group">
            <h3 <?= $advert->getTitle()?>
            <h3 <?= $advert->getText()?>
            <h3 <?= $advert->getMonday()?>
        </div>
</div>