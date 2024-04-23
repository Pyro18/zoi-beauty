// Funzione per ottenere tutte le prenotazioni
function getBookings() {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'http://localhost:8080/backend/api/v1/service/booking.php', true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            var data = JSON.parse(xhr.responseText);
            if (data.status === 'success') {
                displayBookings(data.data);
            } else {
                console.error('Error fetching bookings:', data.message);
            }
        } else {
            console.error('Error:', xhr.status, xhr.statusText);
        }
    };
    xhr.send();
}

// Funzione per ottenere i dettagli dell'utente
function getUserDetails(user_id) {
    return new Promise(function(resolve, reject) {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', `http://localhost:8080/backend/api/v1/user/users.php?user_id=${user_id}`, true); // Include user_id in the request
        xhr.onload = function() {
            if (xhr.status === 200) {
                var data = JSON.parse(xhr.responseText);
                if (data.status === 'success') {
                    resolve(data.data);
                } else {
                    console.error('Error fetching user details:', data.message);
                    reject(data.message);
                }
            } else {
                console.error('Error:', xhr.status, xhr.statusText);
                reject(xhr.statusText);
            }
        };
        xhr.send();
    });
}

// Funzione per ottenere i dettagli del servizio
function getServiceDetails(service_id) {
    return new Promise(function(resolve, reject) {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', `http://localhost:8080/backend/api/v1/service/services.php?service_id=${service_id}`, true);
        xhr.onload = function() {
            if (xhr.status === 200) {
                var data = JSON.parse(xhr.responseText);
                if (data.status === 'success') {
                    resolve(data.data);
                } else {
                    console.error('Error fetching service details:', data.message);
                    reject(data.message);
                }
            } else {
                console.error('Error:', xhr.status, xhr.statusText);
                reject(xhr.statusText);
            }
        };
        xhr.send();
    });
}

// Funzione per visualizzare le prenotazioni
async function displayBookings(bookings) {
    var calendarEl = document.getElementById('calendar');

    var events = [];
    for (let i = 0; i < bookings.length; i++) {
        let booking = bookings[i];

        // Creazione di un oggetto Date dalla data e ora della prenotazione
        var bookingDate = new Date(booking.data_ora);

        // Ottenimento dell'ora e dei minuti
        var hours = bookingDate.getHours();
        var minutes = bookingDate.getMinutes();

        // Formattazione dell'ora e dei minuti come stringa HH:MM
        var timeString = `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}`;

        // Ottenimento dei dettagli dell'utente e del servizio
        var userDetails = await getUserDetails(booking.utente_id);
        var serviceDetails = await getServiceDetails(booking.servizio_id);

        // Creazione di un ID univoco per l'evento
        var eventId = `event-${i}`;

        // Creazione del modale con i dettagli dell'utente
        var modal = document.createElement('div');
        modal.classList.add('modal');
        modal.setAttribute('id', eventId);
        modal.innerHTML = `
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">${userDetails.nome} ${userDetails.cognome}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Nome: ${userDetails.nome}</p>
                        <p>Cognome: ${userDetails.cognome}</p>
                        <p>Telefono: ${userDetails.telefono}</p>
                        <p>Email: ${userDetails.email}</p>
                        <p>Data e ora: ${booking.data_ora}</p>
                    </div>
                </div>
            </div>
        `;
        document.body.appendChild(modal);

        events.push({
            id: eventId,
            title: `${userDetails.nome} ${userDetails.cognome} - ${timeString}`,
            start: booking.data_ora,
            allDay: true
        });
    }

    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        events: events,
        eventClick: function(info) {
            var modal = new bootstrap.Modal(document.getElementById(info.event.id));
            modal.show();
        }
    });

    calendar.render();
}

// Chiamata alla funzione getBookings quando la pagina viene caricata
window.onload = getBookings;