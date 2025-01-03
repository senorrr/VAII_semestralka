<?php
/** @var \App\Models\Reservation $data */
/** @var \App\Core\LinkGenerator $link */

use App\Models\Status;

?>

<div class="container mt-3">
    <h2 class="mb-4">Moje rezervácie</h2>
    <table class="table table-bordered table-striped text-center">
        <thead>
            <tr>
                <th>ID rezervácie</th>
                <th>Číslo inzerátu</th>
                <th>Od</th>
                <th>Do</th>
                <th>Stav rezervácie</th>
                <th>Cena</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($data as $reservation): ?>
            <tr>
                <td><?= $reservation->getId() ?></td>
                <td><?= $reservation->getAdvertId() ?></td>
                <td><?= date_format(date_create($reservation->getFrom()), 'd.m.Y') ?></td>
                <td><?= date_format(date_create($reservation->getTo()), 'd.m.Y') ?></td>
                <td><?= Status::getOne($reservation->getStatusId())->getPopis() ?></td>
                <td><?= $reservation->getTotalCost() ?></td>
                <td><button onclick="removeReservation(<?= $reservation->getId() ?>)">X</button></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>