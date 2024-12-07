<?php
/** @var \App\Core\LinkGenerator $link */
use App\Models\Advert;
use App\Models\Village;

?>

<?php
$adverts = Advert::getAll(orderBy: '`dateOfCreate` desc');
?>

<div class="container">
    <div class="row">
        <?php foreach ($adverts as $advert): ?>
            <div class="col-md-4 text-center">
                <a href="<?= $link->url('advert.index', ['id' => $advert->getId()]) ?>" class="text-decoration-none">
                    <div class="card mb-4 inzerat">
                        <div class="card-body">
                            <h2 class="card-title"><?= $advert->getTitle() ?></h2>
                            <p class="card-text"><?php
                                $text = $advert->getText();
                                if (strlen($text) > 50) {
                                    echo substr($text, 0, 50) . '...';
                                } else {
                                    echo $text;
                                }
                                ?>
                            </p>
                            <small>Mesto: <?= Village::getOne($advert->getVillageId())->getName() ?></small>
                            <div class="card-footer text-muted">
                                <small>Vytvorený: <?= $advert->getDateOfCreate() ?></small>
                                <small>Zobrazenia: <?= $advert->getViews() ?></small>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</div>
