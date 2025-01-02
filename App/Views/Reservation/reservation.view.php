<?php
/** @var Advert $data */
/** @var \App\Core\LinkGenerator $link */
?>

<div class="container">
    <h2 class="text-center">Rezervácia</h2>

    <div class="pozadieInzerat">
        <form id="reservationForm">
            <div class="form-group mt-2">
                <label for="from">Od</label>
                <input type="date" class="form-control" id="from" name="from" required>
            </div>
            <div class="form-group mt-2">
                <label for="to">Do</label>
                <input type="date" class="form-control" id="to" name="to" required>
            </div>
            <div class="form-group mt-2">
                <label for="message">Správa</label>
                <input type="text" class="form-control" id="message" name="message">
            </div>
            <button type="submit" class="btn btn-primary mt-2">Poslať</button>
        </form>
    </div>
</div>

