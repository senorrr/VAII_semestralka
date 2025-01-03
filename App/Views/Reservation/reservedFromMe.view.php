<?php
/** @var \App\Models\Reservation $data */
/** @var \App\Core\LinkGenerator $link */

use App\Models\Status;

?>
<div class="container mt-4">
    <h2 class="mb-4">Požičané odo mňa</h2>
    <table class="table table-bordered table-striped text-center">
        <thead>
        <tr>
            <th class="d-none d-md-table-cell">ID</th>
            <th class="d-none d-md-table-cell">Inzerát ID</th>
            <th>Od</th>
            <th>Do</th>
            <th>Rezervoval</th>
            <th class="d-none d-lg-table-cell">Správa</th>
            <th>Status</th>
            <th>Celková cena</th>
            <th>Akcie</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($data as $reservation): ?>
            <tr>
                <td class="d-none d-md-table-cell"><?= $reservation['id'] ?></td>
                <td class="d-none d-md-table-cell"><?= $reservation['advertId'] ?></td>
                <td><?= date_format(date_create($reservation['from']), 'd.m.Y') ?></td>
                <td><?= date_format(date_create($reservation['to']), 'd.m.Y') ?></td>
                <td><?= $reservation['reservedBy'] ?></td>
                <td class="d-none d-lg-table-cell"><?= $reservation['message'] ?></td>
                <td><?= Status::getOne($reservation['statusId'])->getPopis() ?></td>
                <td><?= $reservation['totalCost'] ?></td>
                <td>
                    <button type="button" class="btn btn-success btn-sm mb-1"
                            onclick="window.location.href='<?= $link->url('reservation.changeStatus', ['approve', $reservation['id']]) ?>'">Schváliť</button>

                    <button type="button" class="btn btn-danger btn-sm mb-1"
                            onclick="window.location.href='<?= $link->url('reservation.changeStatus', ['cancel', $reservation['id']]) ?>'">Zamietnuť</button>
                    <button type="button" class="btn btn-primary btn-sm"
                            onclick="window.location.href='<?= $link->url('reservation.changeStatus', ['finish', $reservation['id']]) ?>'">Dokončiť</button>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>