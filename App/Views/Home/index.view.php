<?php use App\Models\Category;?>
<div class="">
    <h2>Na stránke je dostupných 0 inzerátov</h2>
</div>
<div class="container-fluid">
    <div class="row row-cols-1 row-cols-md-3 row-cols-lg-5 g-0 g mx-auto ">
        <?php foreach (Category::getAll() as $category): ?>
            <div class="col" >
                <div class="card kategoria">
                    <div><h2 class="card-title"><?= $category->getName() ?></h2></div>
                    <img class="card-img-bottom align-self-center" src="<?= $category->getDestinationOfPicture() ?>" alt="kategoria auto">
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>