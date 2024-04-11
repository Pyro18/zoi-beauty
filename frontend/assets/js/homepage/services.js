/**
 * Questo script gestisce la visualizzazione dinamica di categorie, tipi e servizi su una pagina web.
 * Recupera i dati da un'API backend e aggiorna il DOM di conseguenza.
 * Gestisce anche le interazioni dell'utente come la selezione di una categoria, tipo o servizio.
 */

document.addEventListener("DOMContentLoaded", function() {
    // stati iniziali
    let activeCategory = 0; // La categoria attiva è impostata su tutti i servizi (0 = "TUTTI")
    let activeType = window.innerWidth >= 720 ? 1 : null;
    let activeServices = [];
    let booking = false;
    let categories = [];
    let types = [];
    let services = [];

    /**
     * Cambia la categoria attiva e aggiorna i tipi e i servizi di conseguenza.
     * @param {number} categoryId - L'ID della categoria da selezionare.
     */
    const switchCategory = (categoryId) => {
        activeCategory = categoryId;
        renderTypes(activeCategory);

        // Seleziona il primo tipo associato alla nuova categoria
        const firstType = types.find(type => type.category_id === categoryId);
        activeType = firstType ? firstType.id : null;

        // Chiama fetchServicesByType per ottenere i servizi aggiornati
        fetchServicesByType(activeType);
    };

    /**
     * Cambia il tipo attivo e aggiorna i servizi di conseguenza.
     * @param {number} typeId - L'ID del tipo da selezionare.
     */
    const switchType = (typeId) => {
        // Rimuovi la classe .Active da tutti gli elementi Type
        document.querySelectorAll('.Types .Type').forEach((typeElement) => {
            typeElement.classList.remove('Active');
        });

        if (activeType === typeId && window.innerWidth < 720) {
            activeType = null;
        } else {
            activeType = typeId;
        }

        if (activeType !== null) {
            fetchServicesByType(activeType);
            // Aggiungi la classe .Active all'elemento Type corrente
            const activeTypeElement = document.querySelector(`.Types .Type[data-id="${activeType}"]`);
            if (activeTypeElement) {
                activeTypeElement.classList.add('Active');
            }
        } else {
            fetchServicesByType(null); // Passa null per ottenere tutti i servizi
        }
    };

    /**
     * Cambia il servizio attivo.
     * @param {number} serviceId - L'ID del servizio da selezionare.
     */
    const switchService = (serviceId) => {
        if (activeServices.includes(serviceId)) {
            activeServices = activeServices.filter(id => id !== serviceId);
        } else {
            activeServices.push(serviceId);
        }
        renderServices();
    }

    /**
     * Alterna lo stato di prenotazione e re-renderizza i servizi.
     */
    const switchBooking = () => {
        booking = !booking;
        renderServices();
    }

    /**
     * Renderizza le categorie nel DOM.
     */
    const renderCategories = () => {
        const categoriesContainer = document.querySelector('.Categories');
        categoriesContainer.innerHTML = '';
        categories.forEach(category => {
            const categoryElement = document.createElement('div');
            categoryElement.classList.add('Category');
            categoryElement.innerHTML = `
                <img src="category${category.id}.png" alt="${category.name}">
                <p>${category.name}</p>
            `;
            categoryElement.addEventListener('click', () => {
                switchCategory(category.id);
            });
            categoriesContainer.appendChild(categoryElement);
        });
    };

    /**
     * Renderizza i tipi nel DOM.
     * @param {number} categoryId - L'ID della categoria per cui renderizzare i tipi.
     */
    const renderTypes = (categoryId) => {
        const typesContainer = document.querySelector('.Types');
        typesContainer.innerHTML = '';
        const filteredTypes = types.filter(type => type.category_id === categoryId || categoryId === 0);
        filteredTypes.forEach(type => {
            const typeElement = document.createElement('div');
            typeElement.classList.add('Type');
            typeElement.dataset.typeId = type.id; // Imposta l'attributo data-type-id
            typeElement.innerHTML = `
                <p class="Name">${type.name}</p>
                <div class="Contain"></div>
                <img class="Expand" src="expand.png" alt="Expand">
            `;
            typeElement.addEventListener('click', () => {
                switchType(type.id);
            });
            typesContainer.appendChild(typeElement);
        });
    };

    /**
     * Recupera i servizi per tipo dall'API backend.
     * @param {number|null} typeId - L'ID del tipo per cui recuperare i servizi, o null per recuperare tutti i servizi.
     */
    const fetchServicesByType = (typeId) => {
        const xhr = new XMLHttpRequest();
        const url = `http://localhost:8000/backend/api/v1/service/services.php?type_id=${typeId}`;

        xhr.open('GET', url, true);

        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                if (response.status === 'success') {
                    services = response.data.services; // Aggiorna i servizi con quelli ricevuti dall'API
                    renderServices(); // Re-renderizza i servizi aggiornati
                } else {
                    console.error('Errore nel caricamento dei servizi:', response.message);
                }
            }
        }

        xhr.send();
    };

    /**
     * Renderizza i servizi nel DOM.
     */
    const renderServices = () => {
        if (!services) {
            return;
        }
        const servicesContainer = document.querySelector('.Services .service-container');
        servicesContainer.innerHTML = '';

        services.forEach(service => {
            const price = parseFloat(service.price);
            const serviceElement = document.createElement('div');
            serviceElement.classList.add('Service');
            serviceElement.innerHTML = `
                <div class="Line">
                    <p class="Name">${service.name}</p>
                    <p class="Price">now €${price.toFixed(2)}</p>
                </div>
                <div class="Line">
                    <p class="Time">${Math.floor(service.duration / 60)} hrs ${service.duration % 60} mins</p>
                    <p class="Discount">save up to 20%</p>
                </div>
            `;
            serviceElement.addEventListener('click', () => {
                switchService(service.id);
            });
            servicesContainer.appendChild(serviceElement);
        });
    };

    /**
     * Recupera i dati iniziali dall'API backend.
     */
    const fetchData = () => {
        const xhr = new XMLHttpRequest();
        const url = `http://localhost:8000/backend/api/v1/service/services.php`;
        xhr.open('GET', url, true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    if (response.status === 'success') {
                        categories = response.data.categories;
                        types = response.data.types;
                        renderCategories();
                        renderTypes(activeCategory);
                        // Mostra i servizi del primo tipo solo dopo che i dati sono stati ricevuti
                        if (types.length > 0) {
                            activeType = types[0].id;
                            fetchServicesByType(activeType);
                        }
                    } else {
                        console.error('Errore nel caricamento dei dati:', response.message);
                    }
                } else {
                    console.error('Errore nella richiesta:', xhr.statusText);
                }
            }
        }
        xhr.send();
    };

    fetchData();

    // Re-renderizza i servizi quando la finestra viene ridimensionata
    window.addEventListener('resize', () => {
        if (window.innerWidth >= 720) {
            activeType = 0;
            renderServices();
        }
    });

    /**
     * Alterna il menu a discesa di un servizio.
     * @param {Element} serviceElement - L'elemento DOM del servizio.
     */
    const toggleDropdown = (serviceElement) => {
        const dropdown = serviceElement.querySelector('.Dropdown');
        dropdown.classList.toggle('open'); // Aggiungi o rimuovi la classe .open per mostrare o nascondere il menu a discesa
    };

    // Gestisci gli eventi di click sul documento
    document.addEventListener('click', (event) => {
        const target = event.target;
        if (target.classList.contains('Expand')) {
            const serviceElement = target.closest('.Service');
            toggleDropdown(serviceElement);
            target.classList.toggle('fa-chevron-down'); // Cambia l'icona dell'elemento cliccato
            target.classList.toggle('fa-chevron-up'); // da aperto a chiuso o viceversa
        }
    });

});