<?php

/** @var string $contentHTML */
/** @var \App\Core\IAuthenticator $auth */
/** @var \App\Core\LinkGenerator $link */
?>
<!DOCTYPE html>
<html lang="sk-SK">
<head>
    <title><?= \App\Config\Configuration::APP_NAME ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <link href="../public/css/index.css" rel="stylesheet">
    <link href="../public/css/hlavne.css" rel="stylesheet">

    <script src="public/js/script.js"></script>
</head>
<body class = "wrapper">
<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?= $link->url("home.index") ?>"><img class="logo" src="../resources/logo.png" alt="logo"> </a>
        <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto ">
                <li class="nav-item">
                    <a class="nav-link" href="#">Najnovšie inzeráty</a>
                </li>
                <?php if ($auth->isLogged()) { ?>

                <li class="nav-item">
                    <a class="nav-link" href="<?= $link->url("auth.logout") ?>">Odhlásenie</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="novyInzerat.html">Pridaj inzerát</a>
                    novy controller pre nove inzeraty...
                </li>
                <?php } else { ?>
                    <li>
                        <a class="nav-link" href="<?= \App\Config\Configuration::LOGIN_URL ?>">Prihlásenie</a>
                    </li>
                <?php } ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?= $link->url("home.contact") ?>">Kontakt</a>
                </li>

            </ul>
            <form class="d-flex" role="search">
                <input class="form-control" type="search" placeholder="napr. búracie kladivo" aria-label="Search">
                <button class="btn mx-1" type="submit" title="Hľadať"><img class= "vyhladanie" src="../resources/lupa.png" alt="vyhľadanie" ></button>
            </form>
        </div>
    </div>
</nav>

<div class="container-fluid mt-3">
    <div class="web-content">
        <?= $contentHTML ?>
    </div>
</div>
</body>
<footer>
    <div class="container-fluid d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
        <div class="col-md-4 d-flex align-items-center">
            <a href="https://github.com/senorrr" class="mb-3 me-2 mb-md-0 text-decoration-none lh-1">
                Peter Macko <img class= "ikona" src="../resources/github-mark.png" alt="github">
            </a>
            <span class="mb-3 mb-md-0 text-body-secondary">© 2024</span>
        </div>

        <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
            <li class="ms-3"><a class="text-body-secondary" href="#"><img src="../resources/facebook.png" alt="Facebook" class="ikona"></a></li>
            <li class="ms-3"><a class="text-body-secondary" href="#"><img src="../resources/twitter.png" alt="Twitter" class="ikona"></a></li>
            <li class="ms-3"><a class="text-body-secondary" href="#"><img src="../resources/instagram.png" alt="Instagram" class="ikona"></a></li>
        </ul>
    </div>
</footer>
</html>