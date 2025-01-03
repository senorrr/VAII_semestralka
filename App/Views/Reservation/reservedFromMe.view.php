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
                <th>ID</th>
                <th>Inzerát ID</th>
                <th>Od</th>
                <th>Do</th>
                <th>Rezervoval</th>
                <th>Správa</th>
                <th>Status</th>
                <th>Celková cena</th>
                <th>Akcie</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $reservation): ?>
                <tr>
                    <td><?= $reservation['id'] ?></td>
                    <td><?= $reservation['advertId'] ?></td>
                    <td><?= $reservation['from'] ?></td>
                    <td><?= $reservation['to'] ?></td>
                    <td><?= $reservation['reservedBy'] ?></td>
                    <td><?= $reservation['message'] ?></td>
                    <td><?= $reservation['statusId'] ?></td>
                    <td><?= $reservation['totalCost'] ?></td>
                    <td>
                        <button class="btn btn-success btn-sm">Schváliť</button>
                        <button class="btn btn-danger btn-sm">Zamietnuť</button>
                        <button class="btn btn-primary btn-sm">Dokončiť</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>