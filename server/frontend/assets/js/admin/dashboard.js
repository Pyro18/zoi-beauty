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

// Funzione per aggiungere una prenotazione
function addBooking(userId, serviceId, dateTime, userName, userSurname, userPhone, userEmail) {
    return new Promise((resolve, reject) => {
        let xhr = new XMLHttpRequest();
        let url;
        let data;

        if (userId) {
            // Se l'utente è registrato, utilizza l'endpoint delle prenotazioni degli utenti registrati
            url = `http://localhost:8080/backend/api/v1/service/booking.php`;
            data = {
                'utente_id': userId,
                'servizio_id': serviceId,
                'data_ora': dateTime
            };
        } else {
            // Se l'utente non è registrato, utilizza l'endpoint delle prenotazioni degli utenti non registrati
            url = `http://localhost:8080/backend/api/v1/service/booking_guest_user.php`;
            data = {
                'nome': userName,
                'cognome': userSurname,
                'telefono': userPhone,
                'email': userEmail,
                'data_ora': dateTime,
                'servizio_id': serviceId
            };
        }

        xhr.open('POST', url, true);
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.onload = function () {
            if (this.status === 200) {
                let response = JSON.parse(xhr.responseText);
                resolve(response);
            } else {
                reject(new Error(`Errore: ${this.status} ${this.statusText}`));
            }
        };
        xhr.onerror = function () {
            reject(new Error('Errore di rete'));
        };
        xhr.send(JSON.stringify(data));
    });
}


function populateServiceSelect() {
    let xhr = new XMLHttpRequest();
    xhr.open('GET', 'http://localhost:8080/backend/api/v1/service/services.php', true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            let response = JSON.parse(xhr.responseText);
            if (response.status === 'success') {
                let services = response.data.services;
                let select = document.getElementById('serviceSelect');
                select.innerHTML = '';
                services.forEach(service => {
                    let option = document.createElement('option');
                    option.value = service.id;
                    option.textContent = service.name;
                    select.appendChild(option);
                });
            } else {
                console.error('Errore nel recupero dei servizi:', response.message);
            }
        } else {
            console.error('Errore:', xhr.status, xhr.statusText);
        }
    };
    xhr.send();
}

// Chiamare la funzione quando il documento è pronto
document.addEventListener("DOMContentLoaded", populateServiceSelect);

// Funzione per ottenere tutte le prenotazioni
function getBookings(userId) {
    return new Promise((resolve, reject) => {
        let xhr = new XMLHttpRequest();
        xhr.open('GET', `http://localhost:8080/backend/api/v1/service/booking.php?user_id=${userId}`, true);
        xhr.onload = function () {
            if (xhr.status === 200) {
                try {
                    let data = JSON.parse(xhr.responseText);
                    if (data.status === 'success') {
                        resolve(data.data);
                    } else {
                        console.error('Error fetching bookings:', data.message);
                        reject(data.message);
                    }
                } catch (e) {
                    console.error('Error parsing JSON:', e);
                    console.log('Server response:', xhr.responseText);
                    reject(e);
                }
            } else {
                console.error('Error:', xhr.status, xhr.statusText);
                reject(new Error(xhr.statusText));
            }
        };
        xhr.send();
    });
}

// Funzione per ottenere le prenotazioni degli utenti non registrati
function getGuestBookings() {
    return new Promise((resolve, reject) => {
        let xhr = new XMLHttpRequest();
        xhr.open('GET', 'http://localhost:8080/backend/api/v1/service/booking_guest_user.php', true);
        xhr.onload = function () {
            if (xhr.status === 200) {
                try {
                    let data = JSON.parse(xhr.responseText);
                    if (data.status === 'success') {
                        resolve(data.data);
                    } else {
                        console.error('Error fetching guest bookings:', data.message);
                        reject(data.message);
                    }
                } catch (e) {
                    console.error('Error parsing JSON:', e);
                    console.log('Server response:', xhr.responseText);
                    reject(e);
                }
            } else {
                console.error('Error:', xhr.status, xhr.statusText);
                reject(new Error(xhr.statusText));
            }
        };
        xhr.send();
    });
}

// Funzione per eliminare un booking
function deleteBooking(bookingId, isGuest) {
    console.log('Deleting booking:', bookingId);
    console.log('isGuest:', isGuest);

    let xhr = new XMLHttpRequest();
    let url = isGuest ? `http://localhost:8080/backend/api/v1/service/booking_guest_user.php?bookingId=${bookingId}` : `http://localhost:8080/backend/api/v1/service/booking.php?booking_id=${bookingId}`;
    xhr.open('DELETE', url, true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            let data = JSON.parse(xhr.responseText);
            if (data.status === 'success') {
                // Ricarica le prenotazioni dopo l'eliminazione
                displayAllBookings();
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
function updateBooking(bookingId, dateTime, isGuest) {
    console.log('Updating booking:', bookingId, dateTime);
    console.log('isGuest:', isGuest);
    console.log('dateTime:', dateTime);
    return new Promise((resolve, reject) => {
        let xhr = new XMLHttpRequest();
        let url = isGuest ? 'http://localhost:8080/backend/api/v1/service/booking_guest_user.php' : 'http://localhost:8080/backend/api/v1/service/booking.php';
        xhr.open('PUT', url, true);
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.onload = function () {
            if (xhr.status === 200) {
                let data = JSON.parse(xhr.responseText);
                if (data.status === 'success') {
                    resolve(data);
                } else {
                    console.error('Error updating booking:', data.message);
                    reject(data.message);
                }
            } else {
                console.error('Error:', xhr.status, xhr.statusText);
                reject(xhr.statusText);
            }
        };
        let data = JSON.stringify({
            booking_id: bookingId,
            data_ora: dateTime,
        });
        xhr.send(data);
    }).catch(error => {
        console.error('Failed to update booking:', error);
    });
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

// !!!!!!! TODO - guardare inserimento !!!!!!!!!

// Funzione per visualizzare le prenotazioni
async function displayBookings(bookings) {
    let calendarEl = document.getElementById('calendar');
    let events = [];
    for (let i = 0; i < bookings.length; i++) {
        let booking = bookings[i];
        // Creazione di un oggetto Date dalla data e ora della prenotazione
        let bookingDate = new Date(booking.data_ora);
        // Formattazione della data come stringa ISO
        let isoDate = bookingDate.toISOString();
        console.log('isoDate:', isoDate);
        // Ottenimento dell'ora e dei minuti
        let hours = bookingDate.getHours();
        let minutes = bookingDate.getMinutes();
        // Formattazione dell'ora e dei minuti come stringa HH:MM
        let timeString = `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}`;
        // Ottenimento dei dettagli dell'utente e del servizio
        let userDetails;
        if (booking.utente_id) {
            try {
                userDetails = await getUserDetails(booking.utente_id);
            } catch (error) {
                console.error('Errore nell\'ottenere i dettagli dell\'utente:', error);
            }
        } else {
            // Se non c'è un utente_id, assumiamo che la prenotazione sia stata effettuata da un utente non registrato
            userDetails = {
                nome: booking.nome,
                cognome: booking.cognome,
                telefono: booking.telefono,
                email: booking.email
            };
        }
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
                            <i class="fa-solid fa-pencil" onclick="hideModal('${eventId}'); showUpdateModal(${booking.id}, '${booking.data_ora}', ${!booking.utente_id})"></i>
                        </p>
                        <button onclick="hideModal('${eventId}'); deleteBooking(${booking.id}, ${!booking.utente_id})">Elimina</button>
                    </div>
                </div>
            </div>
        `;
        document.body.appendChild(modal);
        events.push({
            id: eventId,
            title: `${userDetails.nome} ${userDetails.cognome} - ${timeString}`,
            start: isoDate,
            allDay: true,
        });
    }
    let calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'it',
        events: events,
        editable: true, // Abilita il trascinamento degli eventi
        eventClick: function (info) {
            let modal = new bootstrap.Modal(document.getElementById(info.event.id));
            modal.show();
        },
        // TODO - Aggiungi un listener per l'evento drop, al drop mandare la richiesta al server per aggiornare la prenotazione
        // https://fullcalendar.io/docs/eventDrop
        // (per ora non funziona)
        eventDrop: function (info) {
            let newDate = info.event.start.toISOString();
            let bookingId = parseInt(info.event.id.replace('event-', '')); // Rimuove 'event-' dall'ID

            // Aggiorna la prenotazione con la nuova data
            updateBooking(bookingId, newDate);
        }
    });
    calendar.render();
}

async function displayAllBookings() {
    let bookings = await getBookings();
    let guestBookings = await getGuestBookings();
    let allBookings = bookings.concat(guestBookings);
    await displayBookings(allBookings);
}

// Chiamare la funzione quando il documento è pronto
displayAllBookings();


function hideModal(modalId) {
    let modal = bootstrap.Modal.getInstance(document.getElementById(modalId));
    modal.hide();
}

// Funzione per mostrare il modale di aggiunta
function showAddModal() {
    // Mostra il modale
    let modal = new bootstrap.Modal(document.getElementById('addModal'));
    modal.show();

    // Aggiungi un listener per l'evento di input sulla barra di ricerca
    document.getElementById('searchUser').addEventListener('input', function () {
        let q = $(this).val();

        $.ajax({
            url: 'http://localhost:8080/backend/api/v1/user/users.php',
            type: 'GET',
            data: {
                q: q
            },
            dataType: 'json',
            success: function (data) {
                if (data.status === 'success') {
                    let datalist = document.getElementById('userList');
                    datalist.innerHTML = '';
                    data.data.forEach(user => {
                        let option = document.createElement('option');
                        option.value = user.nome + ' ' + user.cognome;
                        option.setAttribute('data-nome', user.nome);
                        option.setAttribute('data-cognome', user.cognome);
                        option.setAttribute('data-telefono', user.telefono);
                        option.setAttribute('data-email', user.email);
                        option.setAttribute('data-id', user.id);
                        datalist.appendChild(option);
                    });
                } else {
                    $('#searchUser').val('');
                }
            },
            error: function () {
                console.error('Error fetching user details');
            }
        });
    });

    document.getElementById('searchUser').addEventListener('input', function () {
        let inputVal = this.value;
        let options = document.querySelectorAll('#userList option');

        options.forEach(option => {
            if (option.value === inputVal) {
                document.getElementById('userName').value = option.getAttribute('data-nome');
                document.getElementById('userSurname').value = option.getAttribute('data-cognome');
                document.getElementById('userPhone').value = option.getAttribute('data-telefono');
                document.getElementById('userEmail').value = option.getAttribute('data-email');
                document.getElementById('userId').value = option.getAttribute('data-id'); // recupero l'id per l'invio della prenotazione
            }
        });
    });

}

// Aggiungi un listener per il click del pulsante di aggiunta
document.getElementById('addBookingButton').addEventListener('click', showAddModal);


// Chiamata alla funzione getBookings quando la pagina viene caricata
window.onload = function () {
    getBookings(); // true per includere le prenotazioni dei non utenti
    getGuestBookings(); // true per includere le prenotazioni dei non utenti
};

// Aggiungi un listener per l'evento di invio del form di aggiunta prenotazione
document.getElementById('addForm').addEventListener('submit', function (event) {
    event.preventDefault();

    let userId = document.getElementById('userId').value;
    let serviceId = document.getElementById('serviceSelect').value;
    let dateTime = document.getElementById('dateTime').value;
    let userName = document.getElementById('userName').value;
    let userSurname = document.getElementById('userSurname').value;
    let userPhone = document.getElementById('userPhone').value;
    let userEmail = document.getElementById('userEmail').value;

    addBooking(userId, serviceId, dateTime, userName, userSurname, userPhone, userEmail)
        .then(function (response) {
            console.log(response);
            // Aggiorna il calendario o mostra un messaggio di successo
            getBookings();
            getGuestBookings();
        })
        .catch(function (error) {
            console.error(error);
            // Mostra un messaggio di errore

        });
});


function logout() {
    let xhr = new XMLHttpRequest();
    xhr.open('POST', 'http://localhost:8080/backend/api/v1/auth/admin_logout.php', true);
    xhr.onload = function () {
        if (this.status == 200 && this.responseText) {
            try {
                let response = JSON.parse(this.responseText);
                if (response.status === 'success') {
                    window.location.href = '/admin/login';
                } else {
                    console.error('Server response:', response);
                }
            } catch (e) {
                console.error('Error parsing JSON:', e);
            }
        } else {
            console.error('Error connecting to the server.');
        }
    }
    xhr.send();
}

document.getElementById('logoutButton').addEventListener('click', function () {

    logout();
});


function displayUsers() {
    // Nascondi il calendario
    document.getElementById('calendar').style.display = 'none';

    let xhr = new XMLHttpRequest();
    xhr.open('GET', 'http://localhost:8080/backend/api/v1/user/users.php', true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            let response = JSON.parse(xhr.responseText);
            let users = response.data || response.users;
            if (users) {
                let table = '<table>';
                table += '<tr><th>ID</th><th>Name</th><th>Cognome</th><th>Numero di telefono</th><th>Email</th></tr>';
                for (let user of users) {
                    table += `<tr><td>${user.id}</td><td>${user.nome}</td><td>${user.cognome}</td><td>${user.telefono}</td><td>${user.email}</td></tr>`;
                }
                table += '</table>';

                // Mostra la tabella degli utenti
                let userTable = document.getElementById('userTable');
                userTable.innerHTML = table;
                userTable.style.display = 'block';
            } else {
                console.error('Error: users array not found in response', response);
            }
        }
    };
    xhr.send();

}

function displayObjects() {
    // Nascondi la tabella degli utenti
    document.getElementById('userTable').style.display = 'none';

    // Mostra il calendario
    document.getElementById('calendar').style.display = 'block';
}

// Aggiungi un gestore di eventi click al pulsante "Bookings"
document.getElementById('bookingsButton').addEventListener('click', displayObjects);

window.onload = function () {
    let usersButton = document.getElementById('usersButton');
    usersButton.addEventListener('click', displayUsers);

    let bookingsButton = document.getElementById('bookingsButton');
    bookingsButton.addEventListener('click', displayAllBookings);
}