// Funzione per ottenere tutte le prenotazioni
function getBookings() {
    let xhr = new XMLHttpRequest();
    xhr.open('GET', 'http://localhost:8080/backend/api/v1/service/booking.php', true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            let data = JSON.parse(xhr.responseText);
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

// Funzione per eliminare un booking
function deleteBooking(bookingId) {
    let xhr = new XMLHttpRequest();
    xhr.open('DELETE', `http://localhost:8080/backend/api/v1/service/booking.php?booking_id=${bookingId}`, true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            let data = JSON.parse(xhr.responseText);
            if (data.status === 'success') {
                // Ricarica le prenotazioni dopo l'eliminazione
                getBookings();
            } else {
                console.error('Error deleting booking:', data.message);
            }
        } else {
            console.error('Error:', xhr.status, xhr.statusText);
        }
    };
    xhr.send();
}



// Funzione per modificare un booking
function updateBooking(bookingId, dateTime) {
    let xhr = new XMLHttpRequest();
    xhr.open('PUT', 'http://localhost:8080/backend/api/v1/service/booking.php', true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.onload = function () {
        if (xhr.status === 200) {
            let data = JSON.parse(xhr.responseText);
            if (data.status === 'success') {
                // Ricarica le prenotazioni dopo la modifica
                getBookings();
            } else {
                console.error('Error updating booking:', data.message);
            }
        } else {
            console.error('Error:', xhr.status, xhr.statusText);
        }
    };
    let data = JSON.stringify({
        booking_id: bookingId,
        data_ora: dateTime,
    });
    xhr.send(data);o
}

// Funzione per mostrare il modale di modifica
function showUpdateModal(bookingId, dateTime) {
    // Mostra il modale
    let modal = new bootstrap.Modal(document.getElementById('updateModal'));
    modal.show();

    // Imposta i valori predefiniti nel modale
    document.getElementById('updateDateTime').value = dateTime;

    // Aggiungi un listener per l'evento di submit del form
    document.getElementById('updateForm').addEventListener('submit', function (event) {
        event.preventDefault();
        updateBooking(
            bookingId,
            document.getElementById('updateDateTime').value
        );
        modal.hide();
    });
}


// Funzione per ottenere i dettagli dell'utente
function getUserDetails(user_id) {
    return new Promise(function (resolve, reject) {
        let xhr = new XMLHttpRequest();
        xhr.open('GET', `http://localhost:8080/backend/api/v1/user/users.php?user_id=${user_id}`, true); // Include user_id in the request
        xhr.onload = function () {
            if (xhr.status === 200) {
                let data = JSON.parse(xhr.responseText);
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
    return new Promise(function (resolve, reject) {
        let xhr = new XMLHttpRequest();
        xhr.open(
            'GET',
            `http://localhost:8080/backend/api/v1/service/services.php?service_id=${service_id}`,
            true
        );
        xhr.onload = function () {
            if (this.status === 200) {
                let serviceDetails = JSON.parse(this.responseText);
                resolve(serviceDetails.data);
            } else {
                reject(new Error(`Errore: ${this.status} ${this.statusText}`));
            }
        };
        xhr.onerror = function () {
            reject(new Error('Errore di rete'));
        };
        xhr.send();
    });
}



// Funzione per visualizzare le prenotazioni
async function displayBookings(bookings) {
    let calendarEl = document.getElementById('calendar');

    let events = [];
    for (let i = 0; i < bookings.length; i++) {
        let booking = bookings[i];

        // Creazione di un oggetto Date dalla data e ora della prenotazione
        let bookingDate = new Date(booking.data_ora);

        // Ottenimento dell'ora e dei minuti
        let hours = bookingDate.getHours();
        let minutes = bookingDate.getMinutes();

        // Formattazione dell'ora e dei minuti come stringa HH:MM
        let timeString = `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}`;

        // Ottenimento dei dettagli dell'utente e del servizio
        let userDetails = await getUserDetails(booking.utente_id);
        let serviceDetails = await getServiceDetails(booking.servizio_id);

        // Creazione di un ID univoco per l'evento
        let eventId = `event-${i}`;

        // Creazione del modale con i dettagli dell'utente
        let modal = document.createElement('div');
        modal.classList.add('modal');
        modal.setAttribute('id', eventId);
        modal.innerHTML = `
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">${booking.servizio_nome}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Nome: ${userDetails.nome}</p>
                        <p>Cognome: ${userDetails.cognome}</p>
                        <p>Telefono: ${userDetails.telefono}</p>
                        <p>Email: ${userDetails.email}</p>
                        <p>Data e ora: ${booking.data_ora}
                            <i class="fa-solid fa-pencil" onclick="hideModal('${eventId}'); showUpdateModal(${booking.id}, '${booking.data_ora}')"></i>
                       
                        </p>
                        <button onclick="deleteBooking(${booking.id})">Elimina</button>
                    </div>
                </div>
            </div>
        `;

        document.body.appendChild(modal);

        events.push({
            id: eventId,
            title: `${userDetails.nome} ${userDetails.cognome} - ${timeString}`,
            start: booking.data_ora,
            allDay: true,
        });
    }

	let calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        events: events,
        eventClick: function (info) {
            let modal = new bootstrap.Modal(document.getElementById(info.event.id));
            modal.show();
        },
    });

    calendar.render();
}

function hideModal(modalId) {
    let modal = bootstrap.Modal.getInstance(document.getElementById(modalId));
    modal.hide();
}


// Chiamata alla funzione getBookings quando la pagina viene caricata
window.onload = getBookings;
