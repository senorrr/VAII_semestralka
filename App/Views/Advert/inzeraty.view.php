<?php
/** @var \App\Core\LinkGenerator $link */
use App\Models\Advert;
use App\Models\Category;
use App\Models\Photo;
use App\Models\Village;

?>

<?php
if (isset($_GET["0"])) {
    $adverts = Advert::getAll(whereClause: '`categoryId` like ?', whereParams: [$_GET["0"]], limit: 100);
} else {
    $adverts = Advert::getAll(orderBy: '`dateOfCreate` asc', limit: 100);
}
?>

<div class="container">
    <div class="text-center">
        <h2> Inzeráty kategória
            <?php
                if (isset($_GET["0"])) {
                    echo Category::getOne($_GET["0"])->getName();
                }
            ?>
        </h2>
    </div>
    <div class="row">
        <?php foreach ($adverts as $advert): ?>
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
</div>
