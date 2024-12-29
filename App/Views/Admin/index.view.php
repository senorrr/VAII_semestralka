<?php
/** @var Array $data */
/** @var \App\Core\LinkGenerator $link */
/** @var \App\Core\IAuthenticator $auth */

use App\Models\Category; ?>
<link href="../public/css/admin.css" rel="stylesheet">

<div class="container">
    <h2>Admin</h2>

    Zmen aby len admin mohol prist

    <div>
        <form>
            <label for="spravovanie">Vyber spravovanie</label>
            <select name="spravovanie" class="form-control admin-nav" id="spravovanie">
                <option selected>Domov</option>
                <option>Kategórie</option>
                <option>Inzeráty</option>
            </select>
        </form>
    </div>
</div>


<script>
    document.getElementById('spravovanie').addEventListener('change', function() {
        var selectedValue = this.value;
        if (selectedValue === 'Kategórie') {
            window.location.href = 'http://localhost/?c=admin&a=category';
        } else if (selectedValue === 'Inzeráty') {
            window.location.href = 'inzeraty.php';
        } else if (selectedValue === 'Domov') {
            window.location.href = 'http://localhost/?c=admin';
        }
    });
</script>