document.addEventListener("DOMContentLoaded", function() {
    let activeCategory = 1;
    let activeType = window.innerWidth >= 720 ? 1 : null;
    let activeServices = [];
    let booking = false;
    let categories = [];
    let types = [];
    let services = [];

    const switchCategory = (category) => {
        activeType = window.innerWidth >= 720 ? categories[category - 1].types[0] : null;
        activeCategory = category;
        renderServices();
    }

    const switchType = (type) => {
        if (activeType === type && window.innerWidth < 720) {
            activeType = null;
        } else {
            activeType = type;
        }
        renderServices();
    }

    const switchService = (service) => {
        if (activeServices.includes(service)) {
            activeServices = activeServices.filter(serverId => serverId !== service);
        } else {
            activeServices.push(service);
        }
        renderServices();
    }

    const switchBooking = () => {
        booking = !booking;
        renderServices();
    }

    const renderServices = () => {
        const xhr = new XMLHttpRequest();
        let url = `http://localhost:8000/backend/api/v1/service/services.php`;

        // Aggiungi il parametro del tipo se è stato selezionato
        if (activeType !== null) {
            url += `?type_id=${activeType}`;
        }

        xhr.open('GET', url, true);

        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                services = response.data;

                // Get the reference to the DOM element where you want to render the services
                const servicesContainer = document.getElementById('services-container');

                // Clear the previous content
                servicesContainer.innerHTML = '';

                // Iterate over the services and create HTML elements for each
                services.forEach(service => {
                    const serviceElement = document.createElement('div');
                    serviceElement.classList.add('service');

                    // Add the service name as text
                    const serviceName = document.createElement('p');
                    serviceName.textContent = service.name;
                    serviceElement.appendChild(serviceName);

                    // Add the service price
                    const servicePrice = document.createElement('p');
                    servicePrice.textContent = `Price: $${service.price}`;
                    serviceElement.appendChild(servicePrice);

                    // Add the service duration
                    const serviceDuration = document.createElement('p');
                    serviceDuration.textContent = `Duration: ${service.duration} minutes`;
                    serviceElement.appendChild(serviceDuration);

                    // Add the service element to the services container
                    servicesContainer.appendChild(serviceElement);
                });
            } else if (xhr.readyState === 4) {
                console.error('Si è verificato un errore durante la richiesta AJAX');
            }
        }

        xhr.send();
    };

    renderServices();

    window.addEventListener('resize', () => {
        if (window.innerWidth >= 720) {
           activeType = categories[activeCategory - 1].types[0];
           renderServices();
        }
    });
});