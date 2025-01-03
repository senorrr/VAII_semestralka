<?php
/** @var Advert $data */
/** @var \App\Core\LinkGenerator $link */
?>

<div class="container mt-3">
    <h2 class="text-center">Vytvorenie požičania inzerátu číslo: <?=$data['advertId']?></h2>
    <div class="text-center text-vypis">
        <?php
        if (isset($data['message'])) {
            echo $data['message'];
        }
        ?>
    </div>
    <div class="pozadieInzerat">
        <form id="reservationForm" method="post" action="<?= $link->url('reservation.new', [$data['advertId']])?>">
            <div class="form-group d-flex align-items-center my-2">
                <label for="from" class="me-2">Dátum požičania od:</label>
                <input type="date" class="form-control" id="from" name="from" required style="width: auto;"
                       min="<?php echo (new DateTime('now'))->format('Y-m-d'); ?>">
            </div>

            <div class="form-group d-flex align-items-center my-2">
                <label for="to" class="me-2">Dátum požičania do:</label>
                <input type="date" class="form-control" id="to" name="to" required style="width: auto;"
                       min="<?php echo (new DateTime('now'))->format('Y-m-d'); ?>">
            </div>

            <div class="form-group d-flex align-items-center my-2">
                <label for="textMessage" class="me-2">Správa</label>
                <input type="text" class="form-control" id="textMessage" maxlength="200" name="textMessage" >
            </div>

            <button type="submit" class="btn btn-primary">Poslať</button>
        </form>
    </div>
</div>
