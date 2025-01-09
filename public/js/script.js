document.addEventListener('DOMContentLoaded', function() {
//auth.edit
    document.getElementById('name').addEventListener('input', validateName);
    document.getElementById('surname').addEventListener('input', validateSurname);
    document.getElementById("newPassword").addEventListener("input", checkPasswords);
    document.getElementById("confirmPassword").addEventListener("input", checkPasswords);
    document.getElementById("newLogin").addEventListener("input", disableNewPassword);


    function disableNewPassword() {
        let oldMail = document.getElementById("login").value;
        let newMail = document.getElementById("newLogin").value;
        let newPassword = document.getElementById("newPassword");
        let confirmPassword = document.getElementById("confirmPassword");
        let submitBtn = document.getElementById("submitBtn");
        let newLoginHelp = document.getElementById('newLoginHelp');

        if (newMail !== '') {
            newPassword.value = '';
            confirmPassword.value = '';
            newPassword.disabled = true;
            confirmPassword.disabled = true;
        } else {
            newPassword.disabled = false;
            confirmPassword.disabled = false;
        }
        checkPasswords();

        if (oldMail === newMail) {
            newLoginHelp.textContent = "Starý a nový mail sú rovnaké!";
            submitBtn.disabled = true;
            submitBtn.classList.add("btn-disabled");
        } else {
            newLoginHelp.textContent = "";
            submitBtn.disabled = false;
            submitBtn.classList.remove("btn-disabled");
        }
    }

    function validateName() {
        let name = document.getElementById("name").value;
        let submitBtn = document.getElementById("submitBtn");
        let nameHelp = document.getElementById("nameHelp");

        if (name.trim() === '') {
            nameHelp.textContent = "Meno nemôže byť len z medzier!";
            submitBtn.disabled = true;
            submitBtn.classList.add("btn-disabled");
            return false
        } else {
            nameHelp.textContent = "";
            submitBtn.disabled = false;
            submitBtn.classList.remove("btn-disabled");
            return true
        }
    }

    function validateSurname() {
        let surname = document.getElementById("surname").value;
        let submitBtn = document.getElementById("submitBtn");
        let surnameHelp = document.getElementById("surnameHelp");

        if(surname ==='') {
            surnameHelp.textContent = "";
            submitBtn.disabled = false;
            submitBtn.classList.remove("btn-disabled");
            return false;
        }

        if (surname.trim() === '') {
            surnameHelp.textContent = "Priezvisko nemôže byť len z medzier!";
            submitBtn.disabled = true;
            submitBtn.classList.add("btn-disabled");
            return false
        } else {
            surnameHelp.textContent = "";
            submitBtn.disabled = false;
            submitBtn.classList.remove("btn-disabled");
            return true
        }
    }

    function checkPasswords() {
        let password = document.getElementById("oldPassword").value;
        let newPassword = document.getElementById("newPassword").value;
        let confirmPassword = document.getElementById("confirmPassword").value;
        let passwordHelp = document.getElementById("passwordHelp");
        let submitBtn = document.getElementById("submitBtn");

        if (newPassword === '' && confirmPassword === '') {
            passwordHelp.textContent = "";
            submitBtn.disabled = false;
            submitBtn.classList.remove("btn-disabled");
            return true;
        }
        if (newPassword !== confirmPassword) {
            passwordHelp.textContent = "Heslá sa nezhodujú!";
            submitBtn.disabled = true;
            submitBtn.classList.add("btn-disabled");
            return false;
        } else if (newPassword === confirmPassword) {
            if (password === newPassword) {
                passwordHelp.textContent = "Staré a nové heslo sa zhodujú!";
                submitBtn.disabled = true;
                submitBtn.classList.add("btn-disabled");
                return false;
            }
            passwordHelp.textContent = "";
            submitBtn.disabled = false;
            submitBtn.classList.remove("btn-disabled");
            return true;
        }
    }


    //auth.register

    document.getElementById("new_password").addEventListener("input", checkPasswordsRegister);
    document.getElementById("confirm_password").addEventListener("input", checkPasswordsRegister);

    function checkPasswordsRegister() {
        let password = document.getElementById("new_password").value;
        let confirmPassword = document.getElementById("confirm_password").value;
        let passwordHelp = document.getElementById("passwordHelp");
        let submitBtn = document.getElementById("submitBtn");

        if (password !== confirmPassword) {
            passwordHelp.textContent = "Heslá sa nezhodujú!";
            submitBtn.disabled = true;
            submitBtn.classList.add("btn-disabled");
            return false;
        } else {
            passwordHelp.textContent = "";
            submitBtn.disabled = false;
            submitBtn.classList.remove("btn-disabled");
            return true;
        }
    }


    //advert.edit

    //AJAX na odoslanie form
    document.getElementById('submitPhoto').addEventListener('click', function(event) {
        const urlInput = document.querySelector('input[name="url"]');
        if (urlInput.value.trim() !== '') {
            var url = urlInput.value;
            var formData = new FormData();
            var fetchUrl = 'http://127.0.0.1/?c=advert&a=addNewPhoto&0=' + '<?= $advert->getId()?>';
            formData.append('url', url);
            fetch(fetchUrl, {
                method: 'POST',
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    if (data['success'] === true) {
                        var carouselInner = document.querySelector('.carousel-inner');
                        var carouselIndicators = document.querySelector('.carousel-indicators');
                        var newItemIndex = carouselInner.children.length;

                        // novy  carousel item
                        var newItem = document.createElement('div');
                        newItem.classList.add('carousel-item');
                        newItem.innerHTML = `<img class="d-block w-100 mx-auto" src="${url}" alt="New Slide">`;
                        carouselInner.appendChild(newItem);

                        // novy ten spodny indicator
                        var newIndicator = document.createElement('button');
                        newIndicator.type = 'button';
                        newIndicator.dataset.bsTarget = '#carouselExampleIndicators';
                        newIndicator.dataset.bsSlideTo = newItemIndex;
                        newIndicator.setAttribute('aria-label', 'Slide ' + (newItemIndex + 1));
                        carouselIndicators.appendChild(newIndicator);

                        // ak je to prva fotka....
                        if (newItemIndex === 0) {
                            newItem.classList.add('active');
                            newIndicator.classList.add('active');
                            newIndicator.setAttribute('aria-current', 'true');
                        }

                        // nastav na najnovsiu fotku
                        var carousel = new bootstrap.Carousel(document.querySelector('#carouselExampleIndicators'));
                        carousel.to(newItemIndex);
                    }
                    var messageBox = document.getElementById('message');
                    messageBox.textContent = data['message'];
                });
        }
    });


    //AJAX na ziskanie nazvu mesta
    document.getElementById('city').addEventListener('input', function() {
        var text = document.getElementById('city');
        if (text.value.length > 2) {
            fetch('http://127.0.0.1/?c=Home&a=getCity', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(text.value)
            }).then(response => response.json()).then(cities => {
                const datalist = document.getElementById('cities');
                datalist.innerHTML = '';
                if (text.value !== cities[0]) {
                    cities.forEach(city => {
                        const option = document.createElement('option');
                        option.value = city;
                        datalist.appendChild(option);
                    });
                }
            })
        }
    });

    //ked zacnem editovat url adresu nech zmeni tlacidlo
    document.addEventListener('DOMContentLoaded', function() {
        const removePhotoButton = document.querySelector('button[name="submitRemovePhoto"]');
        const urlInput = document.querySelector('input[name="url"]');

        urlInput.addEventListener('input', function() {
            removePhotoButton.textContent = 'Načítaj url fotky';
        });
    });

    //zmenenie tlacidla podla toho ci je spravne nacitana url
    document.addEventListener('DOMContentLoaded', function() {
        const removePhotoButton = document.querySelector('button[name="submitRemovePhoto"]');
        const urlInput = document.querySelector('input[name="url"]');

        removePhotoButton.addEventListener('click', function(event) {
            const activeItem = document.querySelector('.carousel-item.active img');
            if (activeItem && urlInput.value !== activeItem.src) {
                event.preventDefault();
                urlInput.value = activeItem.src;
                removePhotoButton.textContent = 'Odstráň';
            }
            if (removePhotoButton.textContent !== 'Odstráň') {
                event.preventDefault();
            }
        });

        const prev = document.querySelector('.carousel-control-prev');
        prev.addEventListener('click', function() {
            removePhotoButton.textContent = 'Načítaj url fotky';
            urlInput.value = '';
        });

        const next = document.querySelector('.carousel-control-next');
        next.addEventListener('click', function() {
            removePhotoButton.textContent = 'Načítaj url fotky';
            urlInput.value = '';
        });
    });


    function renameFields() {
        var photoFields = document.getElementById('photos');
        var inputs = photoFields.getElementsByTagName('input');
        for (var i = 0; i < inputs.length; i++) {
            inputs[i].name = 'photo' + (i + 1);
            inputs[i].placeholder = 'Zadajte url adresu ' + (i + 1) + '. fotky';
        }
    }

    //advert.add
    document.getElementById('pridajFotku').addEventListener('click', function() {
        var photoFields = document.getElementById('photos');
        var newField = document.createElement('input');
        var count = photoFields.getElementsByTagName('input').length + 1;

        newField.name = 'photo' + count;
        newField.type = 'url';
        newField.className = 'form-control';
        newField.placeholder = 'Zadajte url adresu ' + count + '. fotky';
        newField.required = true;

        var newDiv = document.createElement('div');
        newDiv.className = 'col url-input d-flex align-items-center';
        newDiv.appendChild(newField);

        var removeButton = document.createElement('button');
        removeButton.className = 'btn btn-danger';
        removeButton.textContent = 'X';
        removeButton.setAttribute('onclick', 'removePhotoField(this)');

        newDiv.appendChild(removeButton);
        photoFields.appendChild(newDiv);
    });

    function removePhotoField(button) {
        var photoFields = document.getElementById('photos');
        photoFields.removeChild(button.parentNode);
        renameFields();
    }

    //admin.index

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





})