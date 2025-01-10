document.addEventListener('DOMContentLoaded', function() {
    // advert.edit

    // AJAX na odoslanie form
    /*
        \d+: Hľadá jednu alebo viac číslic.
        () : Zátvorky slúžia na zachytenie zhody, ktorú chceme extrahovať.
        (?!.*\d): Toto je negatívny lookahead, ktorý zabezpečuje, že za nájdenou zhodou už nie sú žiadne ďalšie číslice. Inými slovami, hľadá poslednú sekvenciu číslic v reťazci.
     */
    const submitPhotoButton = document.getElementById('submitPhoto');
    if (submitPhotoButton) {
        submitPhotoButton.addEventListener('click', function() {
            const urlInput = document.querySelector('input[name="url"]');
            if (urlInput.value.trim() !== '') {
                let url = urlInput.value;
                let formData = new FormData();
                const actualUrl = window.location.href;
                let match = actualUrl.match(/(\d+)(?!.*\d)/); //kod od umelej inteligencie
                let id = match ? match[0] : null;
                if (id) {
                    let fetchUrl = 'http://127.0.0.1/?c=advert&a=addNewPhoto&0=' + id;
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
                                let carouselElement = document.querySelector('#carouselExampleIndicators');

                                // Create carousel if it doesn't exist
                                if (!carouselElement) {
                                    const carouselHtml = `
                                <div id="carouselExampleIndicators" class="carousel slide d-flex">
                                    <div class="carousel-indicators"></div>
                                    <div class="carousel-inner justify-content-center align-items-center"></div>
                                    <button id="prev" class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button id="next" class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>
                            `;
                                    document.querySelector('.pozadieInzerat').insertAdjacentHTML('afterbegin', carouselHtml);
                                    carouselInner = document.querySelector('.carousel-inner');
                                    carouselIndicators = document.querySelector('.carousel-indicators');
                                    carouselElement = document.querySelector('#carouselExampleIndicators');
                                }

                                if (carouselInner && carouselIndicators) {
                                    let newItemIndex = carouselInner.children.length;

                                    // novy carousel item
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
                                    let carousel = bootstrap.Carousel.getInstance(carouselElement);
                                    if (!carousel) {
                                        carousel = new bootstrap.Carousel(carouselElement);
                                    }
                                    carousel.to(newItemIndex);
                                }
                            }
                            let messageBox = document.getElementById('message');
                            messageBox.textContent = data['message'];
                        });
                }
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
            const activeItem = document.querySelector('.carousel-item.active img');
            if (urlInput.value === activeItem.src) {
                removePhotoButton.textContent = 'Odstráň';

            } else {
                removePhotoButton.textContent = 'Načítaj url fotky';
            }
        });

        removePhotoButton.addEventListener('click', function(event) {
            const activeItem = document.querySelector('.carousel-item.active img');
            if (removePhotoButton.textContent === 'Načítaj url fotky') {
                event.preventDefault();
                urlInput.value = activeItem.src;
                removePhotoButton.textContent = 'Odstráň';
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
        addPhotoButton.addEventListener('click', function(event) {
            event.preventDefault();
            addPhotoField();
        });
    }

    function addPhotoField() {
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
        removeButton.addEventListener('click', function() {
            removePhotoField(newDiv);
        });

        newDiv.appendChild(removeButton);
        photoFields.appendChild(newDiv);
    }

    function removePhotoField(field) {
        let form = field.closest('form');
        let requiredFields = form.querySelectorAll('[required]');

        // Temporarily remove the required attribute
        requiredFields.forEach(function(input) {
            input.removeAttribute('required');
        });

        // Remove the photo field
        field.remove();

        // Add the required attribute back
        requiredFields.forEach(function(input) {
            input.setAttribute('required', 'required');
        });

        // Re-index the photo fields
        reindexPhotoFields();
    }

    function reindexPhotoFields() {
        let photoFields = document.getElementById('photos');
        let inputs = photoFields.getElementsByTagName('input');
        for (let i = 0; i < inputs.length; i++) {
            inputs[i].name = 'photo' + (i + 1);
            inputs[i].placeholder = 'Zadajte url adresu ' + (i + 1) + '. fotky';
        }
    }
});