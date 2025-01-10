<?php
/** @var Array $data */
/** @var \App\Core\LinkGenerator $link */

?>
<link href="../../../public/css/admin.css" rel="stylesheet">

<div class="container mt-3">
    <h2>Admin</h2>
    <div class="text-center text-vypis">
        <?php
        if (isset($data['message'])) {
            echo $data['message'];
        }
        ?>
    </div>
    <div>
        <form>
            <label for="spravovanie">Vyber spravovanie</label>
            <select name="spravovanie" class="form-control admin-nav" id="spravovanie">
                <option>Domov</option>
                <option>Kategórie</option>
                <option selected>Užívatelia</option>
            </select>
        </form>
    </div>

    <table class="table table-bordered table-hover table-light table-striped text-center">
        <thead class="thead-dark">
        <tr>
            <th>ID</th>
            <th>Meno</th>
            <th>Priezvisko</th>
            <th>Email</th>
            <th>Práva</th>
            <th>Akcie</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $users = \App\Models\User::getAll();

        foreach ($users as $user) {
            echo "<tr>";
            echo "<td>{$user->getId()}</td>";
            echo "<td>{$user->getName()}</td>";
            echo "<td>{$user->getSurname()}</td>";
            echo "<td>{$user->getEmail()}</td>";
            echo "<td>{$user->getPermissions()}</td>";
            echo "<td>
            <a href='" . $link->url('admin.givePermission', [$user->getId()])  . "' class='btn btn-success mt-1'>Zvýšiť hodnosť</a>
            <a href='" . $link->url('admin.takePermission', [$user->getId()]) . "' class='btn btn-warning mt-1'>Znížiť hodnosť</a>
            <a href='" . $link->url('admin.deleteUser', [$user->getId()]) .  "' class='btn btn-danger mt-1'>Vymazať</a>
          </td>";
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>
</div>
