<?php
/** @var Array $data */
/** @var \App\Core\LinkGenerator $link */

use App\Models\Category;

?>
<div class="container">
    <h2>Pridanie inzerátu</h2>
    pridaj required vsade!
    <form action="<?=''/* $link->url("advert.add")*/ ?>" method="post">
        <div class="form-group">
            <label for="title">Názov</label>
            <input name="title"  type="text" class="form-control" id="title" placeholder="Zadajte názov"
                   value="<?= ($data!=null) ? $data['title'] : '' ?>">
        </div>
        <div class="form-group">
            <label for="category">Kategória</label>
            <select name="category" class="form-control" id="category">
                <?php foreach (Category::getAll() as $category): ?>
                    <option><?= $category->getName() ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="price">Cena (€)</label>
            <input name="price"  type="number" class="form-control" id="price" min="0"
                   placeholder="Zadajte cenu"
                   value="<?= ($data!=null) ? $data['price'] : '' ?>">
        </div>
        <div class="form-group">
            <label for="city">Mesto</label>
            <input list="cities" name="city"  type="text" class="form-control" id="city"
                   placeholder="Zadajte mesto"
                   value="<?= ($data!=null) ? $data['city'] : '' ?>">
            <datalist id="cities">
            </datalist>
        </div>
        <div class="form-group">
            <label for="monday">Vyberte dni dostupnosti</label><br>
            <div class="form-check form-check-inline">
                <label class="form-check-label" for="monday">Pondelok</label>
                <input class="form-check-input" type="checkbox" id="monday" name="monday" <?= ($data!= null && isset($data['monday']) && $data['monday']=="on" ? "checked" : '') ?>>
            </div>
            <div class="form-check form-check-inline">
                <label class="form-check-label" for="tuesday">Utorok</label>
                <input class="form-check-input" type="checkbox" id="tuesday" name="tuesday" <?= ($data!= null && isset($data['tuesday']) && $data['tuesday']=="on" ? "checked" : '') ?>>
            </div>
            <div class="form-check form-check-inline">
                <label class="form-check-label" for="wednesday">Streda</label>
                <input class="form-check-input" type="checkbox" id="wednesday" name="wednesday" <?= ($data!= null && isset($data['wednesday']) && $data['wednesday']=="on" ? "checked" : '') ?>>
            </div>
            <div class="form-check form-check-inline">
                <label class="form-check-label" for="thursday">Štvrtok</label>
                <input class="form-check-input" type="checkbox" id="thursday" name="thursday" <?= ($data!= null && isset($data['thursday']) && $data['thursday']=="on" ? "checked" : '') ?>>
            </div>
            <div class="form-check form-check-inline">
                <label class="form-check-label" for="friday">Piatok</label>
                <input class="form-check-input" type="checkbox" id="friday" name="friday" <?= ($data!= null && isset($data['friday']) && $data['friday']=="on" ? "checked" : '') ?>>
            </div>
            <div class="form-check form-check-inline">
                <label class="form-check-label" for="saturday">Sobota</label>
                <input class="form-check-input" type="checkbox" id="saturday" name="saturday" <?= ($data!= null && isset($data['saturday']) && $data['saturday']=="on" ? "checked" : '') ?>>
            </div>
            <div class="form-check form-check-inline">
                <label class="form-check-label" for="sunday">Nedeľa</label>
                <input class="form-check-input" type="checkbox" id="sunday" name="sunday" <?= ($data!= null && isset($data['sunday']) && $data['sunday']=="on" ? "checked" : '') ?>>
            </div>
        </div>
        <div class="form-group"  id="photos">
            <label for="photo">Fotky</label>
            <?php
                if (sizeof($data) > 9) {
                    for ($i = 1; $i <= sizeof($data)-9; $i++) {
                        if (isset($data[$i])) {
                            echo '<div class="col url-input d-flex align-items-center">';
                            echo '<input type="url" name="photo' . $i . '" class="form-control" placeholder="Zadajte url adresu ' . $i . '. fotky" value="' . $data['photo'.$i] . '">';
                            echo '<button class="vymaz-but" onclick="removeField(this)">X</button>';
                            echo '</div>';
                        }
                    }
                }
            ?>
        </div>
        <button type="button" class="btn btn-primary text-center" id="pridajFotku" >Pridaj fotku</button>
        <div class="form-group">
            <label for="description">Popis</label>
            <textarea name="text"  maxlength="500" class="form-control" id="description"
                      rows="5" placeholder="Zadajte popis"><?= ($data!=null) ? $data['text'] : '' ?></textarea>
        </div>
        <div class="text-center">
            <button type="submit" name="submit" class="btn btn-primary text-center">Pridať Inzerát</button>
        </div>
    </form>
</div>

<script>
    document.getElementById('city').addEventListener('input', function() {
        var text = document.getElementById('city');
        if (text.value.length > 2) {
            fetch('http://localhost/?c=Home&a=getCity', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(text.value)
            }).then(response => response.json()).then(cities => {
                const datalist = document.getElementById('cities');
                datalist.innerHTML = '';
                cities.forEach(city => {
                    const option = document.createElement('option');
                    option.value = city;
                    datalist.appendChild(option);
                });

            }).catch((error) => {
                document.getElementById('result').innerText = 'Error: ' + error
            })
        }
    });
    /*if (text.value.length > 2) {
        alert('This is a pop-up message!');
        fetch('http://localhost/?c=Home&a=getCity', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(text)
        }).then(response => response.json()).then(data => {
            var city = document.getElementById('city');
            city.value = data;
        }).catch((error) => {
            document.getElementById('result').innerText = 'Error: ' + error
        })
    })*/

    function renameFields() {
        var photoFields = document.getElementById('photos');
        var inputs = photoFields.getElementsByTagName('input');
        for (var i = 0; i < inputs.length; i++) {
            inputs[i].name = 'photo' + (i + 1);
            inputs[i].placeholder = 'Zadajte url adresu ' + (i + 1) + '. fotky';
        }
    }

    document.getElementById('pridajFotku').addEventListener('click', function() {
        var photoFields = document.getElementById('photos');
        var newField = document.createElement('input');
        var count = photoFields.getElementsByTagName('input').length + 1;

        newField.name = 'photo' + count;
        newField.type = 'url';
        newField.className = 'form-control';
        newField.placeholder = 'Zadajte url adresu ' + count + '. fotky';
        //newField.required = true;

        var newDiv = document.createElement('div');
        newDiv.className = 'col url-input d-flex align-items-center';
        newDiv.appendChild(newField);

        var removeButton = document.createElement('button');
        removeButton.className = 'vymaz-but';
        removeButton.textContent = 'X';
        removeButton.addEventListener('click', function() {
            photoFields.removeChild(newDiv);
            renameFields();
        });

        newDiv.appendChild(removeButton);
        photoFields.appendChild(newDiv);
    });
</script>
