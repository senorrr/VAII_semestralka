<?php use App\Models\Category;
/** @var \App\Core\LinkGenerator $link */
?>
<div class="">
    <h2>Počet inzerátov na stránke: <?= sizeof(\App\Models\Advert::getAll())?></h2>
</div>
<div class="container-fluid">
    <div class="row row-cols-1 row-cols-md-3 row-cols-lg-5 g-0 g mx-auto">
        <?php foreach (Category::getAll() as $category): ?>
            <div class="col" >
                <a href="<?= $link->url("advert.inzeraty",[$category->getId()]) ?>">
                    <div class="card kategoria">
                        <div><h2 class="card-title"><?= $category->getName() ?></h2></div>
                        <img class="card-img-bottom align-self-center" src="<?= $category->getDestinationOfPicture() ?>" alt="kategoria auto">
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</div>