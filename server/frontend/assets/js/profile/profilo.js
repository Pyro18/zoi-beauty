console.log('Hello from profile.js');


function formataNumeroTelefono(telefono) { 
    if (telefono.length !== 10 || isNaN(telefono)) {
        console.error('Numero di telefono non valido');
        return telefono;
        
    }

    return '+39 ' + telefono.slice(0,3) + '-' + telefono.slice(3,6) + '-' + telefono.slice(6,10);
}

function userInfo() {
    let user_id = getCookie('user_id');
    console.log(user_id);
    if (user_id != "") {
        let xhr = new XMLHttpRequest();
        xhr.open('GET', `https://api.zoi-beauty.it/api/v1/user/users.php?user_id=${user_id}`, true);
        xhr.onload = function() {
            if (this.status == 200) {
                let response = JSON.parse(this.responseText);
                if (response.status === "success") {
                    let data = response.data;
                    console.log(data);
                    document.getElementById('nome').textContent = data.nome;
                    document.getElementById('cognome').textContent = data.cognome;
                    document.getElementById('username').textContent = data.username;
                    document.getElementById('email').textContent = data.email;
                    document.getElementById('telefono').textContent = formataNumeroTelefono(data.telefono);
                } else {
                    console.error('Errore nel recupero dei dati:', response.message);
                }
            } else {
                console.error('Errore: ' + this.status);
            }
        };
        xhr.send();
    }
}

function getUserActiveBookings(user_id) {
    return new Promise((resolve, reject) => {
        let xhr = new XMLHttpRequest();
        xhr.open('GET', `https://api.zoi-beauty.it/api/v1/service/booking.php?user_id=${user_id}`, true);
        xhr.onload = function() {
            if (xhr.status === 200) {
                try {
                    let data = JSON.parse(xhr.responseText);
                    if (data.status === 'success') {
                        resolve(data.data);
                    } else {
                        console.error('Errore nel recupero delle prenotazioni:', data.message);
                        reject(data.message);
                    }
                } catch (e) {
                    console.error('Errore nel parsing del JSON:', e);
                    console.log('Risposta del server:', xhr.responseText);
                    reject(e);
                }
            } else {
                console.error('Errore:', xhr.status, xhr.statusText);
                reject(new Error(xhr.statusText));
            }
        };
        xhr.send();
    });
}

function displayBookings(bookings) {
    let table = document.getElementById('prenotazioni-attive').getElementsByTagName('tbody')[0];

    while (table.rows.length > 0) {
        table.deleteRow(0);
    }

    for (let i = 0; i < bookings.length; i++) {
        let row = table.insertRow(i);

        let cell1 = row.insertCell(0);
        cell1.textContent = bookings[i].servizio_nome;

        let cell2 = row.insertCell(1);
        let data_ora = new Date(bookings[i].data_ora);
        cell2.textContent = data_ora.toLocaleDateString() + ' ' + data_ora.toLocaleTimeString();
    }
}




window.onload = function () {
    let user_id = getCookie('user_id');
    userInfo();
    getUserActiveBookings(user_id)
        .then(bookings => {
            displayBookings(bookings);
        })
        .catch(error => {
            console.error('Errore nel recupero delle prenotazioni:', error);
        });
}