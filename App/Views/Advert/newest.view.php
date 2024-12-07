<?php
/** @var \App\Core\LinkGenerator $link */
use App\Models\Advert;
use App\Models\Village;

?>

<?php
$adverts = Advert::getAll(orderBy: '`dateOfCreate` asc');
?>

<div class="container">
    <div class="row">
        <?php foreach ($adverts as $advert): ?>
            <div class="col-lg-4">
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
                        <div class="card-footer text-muted text-center">
                            <small>Vytvorený: <?= $advert->getDateOfCreate() ?></small>
                            <small>Zobrazenia: <?= $advert->getViews() ?></small>
                        </div>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</div>
