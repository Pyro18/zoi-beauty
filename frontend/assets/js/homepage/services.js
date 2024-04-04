document.addEventListener("DOMContentLoaded", function() {
    let activeCategory = 1;
    let activeType = window.innerWidth >= 720 ? 1 : null;
    let activeServices = [];
    let booking = false;


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

        xhr.open('GET', `http://localhost:8000/backend/api/v1/services.php?category=${activeCategory}&type=${activeType}&services=${activeServices.join(',')}&booking=${booking}`, true);

        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4) {
                const response = JSON.parse(xhr.responseText);
                console.log(response);
                const services = response.data;

            }

        }

    };
});