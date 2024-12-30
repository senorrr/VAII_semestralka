<?php
/** @var \App\Core\LinkGenerator $link */
/** @var Advert $data */
use App\Models\Advert;
use App\Models\Photo;
use App\Models\Village;

?>

<?php

?>

<div class="container">
    <div class="text-center">
        <h2> Inzeráty
        </h2>
    </div>
    <div class="row">
        <?php foreach ($data as $advert): ?>
            <div class="col-lg-4 align-items-stretch">
                <a href="<?= $link->url('advert.index', ['id' => $advert->getId()]) ?>" class="text-decoration-none">
                    <div class="card inzeratKarta">
                        <h2 class="card-title"><?= $advert->getTitle() ?></h2>
                        <div class="card-body">
                            <p class="card-text">
                                <?php
                                $text = $advert->getText();
                                if (strlen($text) > 60) {
                                    echo substr($text, 0, 60) . '...';
                                } else {
                                    echo $text;
                                }
                                ?>
                            </p>
                            <div class="card-text">
                                <small>Cena: <?= $advert->getPrice() ?></small><br>
                                <small>Mesto: <?= Village::getOne($advert->getVillageId())->getName() ?></small>
                            </div>
                        </div>
                        <?php
                        $images = Photo::getAll('`advert` LIKE ?', [$advert->getId()]);
                        if (sizeof($images) > 0) {
                            echo '<img src="'. $images[0]->getUrl() .'">';
                        }
                        ?>
                        <div class="card-footer text-muted text-center">
                            <small>Vytvorený: <?= date('d.m.Y H:i', strtotime($advert->getDateOfCreate())) ?></small>
                            <small>Zobrazenia: <?= $advert->getViews() ?></small>
                        </div>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="text-center">
        <nav aria-label="...">
            <ul class="pagination">
                <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1">Previous</a>
                </li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item active">
                    <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                </li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#">Next</a>
                </li>
            </ul>
        </nav>
        <?php
            //todo pridaj cisla stran a samotne strany
        ?>
    </div>
</div>
