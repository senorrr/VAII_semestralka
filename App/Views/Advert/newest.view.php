<?php
/** @var \App\Core\LinkGenerator $link */
use App\Models\Advert;

?>

<?php
$adverts = Advert::getAll(orderBy: '`dateOfCreate` desc');
?>

<div class="container">
    <div class="row">
        <?php foreach ($adverts as $advert): ?>
            <div class="col-md-4">
                <a href="<?= $link->url('advert.index', ['id' => $advert->getId()]) ?>" class="text-decoration-none">
                    <div class="card mb-4 kategoria">
                        <div class="card-body">
                            <h2 class="card-title"><?= $advert->getTitle() ?></h2>
                            <p class="card-text"><?= $advert->getText() ?></p>
                        </div>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</div>
