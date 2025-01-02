<?php
/** @var Advert $data */
/** @var \App\Core\LinkGenerator $link */
?>

<body>
    <div class="container mt-5">
        <h2 class="mb-4">Moje rezervácie</h2>
        <table class="table table-bordered table-striped text-center">
            <thead>
                <tr>
                    <th>ID rezervácie</th>
                    <th>Číslo inzerátu</th>
                    <th>Od</th>
                    <th>Do</th>
                    <th>Správa</th>
                    <th>Stav</th>
                    <th>Cena</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $reservation): ?>
                    <tr>
                        <td><?= $reservation->getId() ?></td>
                        <td><?= $reservation->getAdvertId() ?></td>
                        <td><?= $reservation->getFrom() ?></td>
                        <td><?= $reservation->getTo() ?></td>
                        <td><?= $reservation->getMessage() ?></td>
                        <td><?= $reservation->getStatus() ?></td>
                        <td><?= $reservation->getTotalCost() ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>