document.addEventListener('DOMContentLoaded', function() {
    // advert.edit

    // AJAX na odoslanie form
    const submitPhotoButton = document.getElementById('submitPhoto');
    if (submitPhotoButton) {
        submitPhotoButton.addEventListener('click', function() {
            const urlInput = document.querySelector('input[name="url"]');
            if (urlInput.value.trim() !== '') {
                let url = urlInput.value;
                let formData = new FormData();
                let fetchUrl = 'http://127.0.0.1/?c=advert&a=addNewPhoto&0=' + '<?= $advert->getId()?>';
                formData.append('url', url);
                fetch(fetchUrl, {
                    method: 'POST',
                    body: formData
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data['success'] === true) {
                            let carouselInner = document.querySelector('.carousel-inner');
                            let carouselIndicators = document.querySelector('.carousel-indicators');
                            let newItemIndex = carouselInner.children.length;

                            // novy  carousel item
                            let newItem = document.createElement('div');
                            newItem.classList.add('carousel-item');
                            newItem.innerHTML = `<img class="d-block w-100 mx-auto" src="${url}" alt="New Slide">`;
                            carouselInner.appendChild(newItem);

                            // novy ten spodny indicator
                            let newIndicator = document.createElement('button');
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
                            let carousel = new bootstrap.Carousel(document.querySelector('#carouselExampleIndicators'));
                            carousel.to(newItemIndex);
                        }
                        let messageBox = document.getElementById('message');
                        messageBox.textContent = data['message'];
                    });
            }
        });
    }

    // AJAX na ziskanie nazvu mesta
    const cityInput = document.getElementById('city');
    if (cityInput) {
        cityInput.addEventListener('input', function() {
            let text = document.getElementById('city');
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
    }

    // ked zacnem editovat url adresu nech zmeni tlacidlo
    const removePhotoButton = document.querySelector('button[name="submitRemovePhoto"]');
    const urlInput = document.querySelector('input[name="url"]');
    if (urlInput && removePhotoButton) {
        urlInput.addEventListener('input', function() {
            removePhotoButton.textContent = 'Načítaj url fotky';
        });

        // zmenenie tlacidla podla toho ci je spravne nacitana url
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
        if (prev) {
            prev.addEventListener('click', function() {
                removePhotoButton.textContent = 'Načítaj url fotky';
                urlInput.value = '';
            });
        }

        const next = document.querySelector('.carousel-control-next');
        if (next) {
            next.addEventListener('click', function() {
                removePhotoButton.textContent = 'Načítaj url fotky';
                urlInput.value = '';
            });
        }
    }

    // advert.add
    const addPhotoButton = document.getElementById('pridajFotku');
    if (addPhotoButton) {
        addPhotoButton.addEventListener('click', function() {
            let photoFields = document.getElementById('photos');
            let newField = document.createElement('input');
            let count = photoFields.getElementsByTagName('input').length + 1;

            newField.name = 'photo' + count;
            newField.type = 'url';
            newField.className = 'form-control';
            newField.placeholder = 'Zadajte url adresu ' + count + '. fotky';
            newField.required = true;

            let newDiv = document.createElement('div');
            newDiv.className = 'col url-input d-flex align-items-center';
            newDiv.appendChild(newField);

            let removeButton = document.createElement('button');
            removeButton.className = 'btn btn-danger';
            removeButton.textContent = 'X';
            removeButton.setAttribute('onclick', 'removePhotoField(this)');

            newDiv.appendChild(removeButton);
            photoFields.appendChild(newDiv);
        });
    }
});