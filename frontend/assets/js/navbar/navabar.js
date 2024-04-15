function getCookie(cname) {
    let name = cname + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(';');
    for(let i = 0; i <ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

function logout() {
    let xhr = new XMLHttpRequest();
    xhr.open('GET', `http://localhost:8080/backend/api/v1/auth/logout.php`, true);

    xhr.onload = function() {
        if (xhr.status === 200) {
            let data = JSON.parse(xhr.responseText);
            if (data.status === 'success') {
                // elimina l'user_id dal cookie
                document.cookie = "user_id=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";

                // reload della pagina
                location.reload();
            } else {
                console.error('Failed to logout:', data.message);
            }
        } else {
            console.error('Request failed.  Returned status of ' + xhr.status);
        }
    };
    xhr.send();
}

window.onload = function() {
    // Funzione per caricare i dati dell'utente
    function loadUserData() {
        // prendo l'user_id dal cookie
        let user_id = getCookie('user_id');

        // controllo se l'utente è loggato
        if (user_id != "") {
            // l'utente è loggato, quindi carico i suoi dati
            let xhr = new XMLHttpRequest();
            xhr.open('GET', `http://localhost:8080/backend/api/v1/user/users.php?user_id=${user_id}`);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    let data = JSON.parse(xhr.responseText);
                    if (data.status === 'success') {
                        // Insert user avatar, name and dropdown menu into #user-info
                        document.getElementById('user-info').innerHTML = `
                            <div class="dropdown">
                                <img src="/frontend/assets/images/512x512.png" alt="User Avatar" class="rounded-circle dropdown-toggle" width="45" height="45" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                <span style="color: black">${data.data.nome} ${data.data.cognome}</span>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <li><a class="dropdown-item" href="/profile">Profile</a></li>
                                    <li><a class="dropdown-item" id="logout-link" href="#" onclick="logout()">Logout</a></li>
                                </ul>
                            </div>
                        `;

                        // aggiungo l'evento click al link di logout
                        var logoutLink = document.querySelector('#logout-link');
                        if (logoutLink) {
                            logoutLink.addEventListener('click', function(e) {
                                e.preventDefault();
                                logout();
                            });
                        }
                    } else {
                        console.error('Failed to fetch user data:', data.message);
                    }
                } else {
                    console.error('Request failed.  Returned status of ' + xhr.status);
                }
            };
            xhr.send();
        } else {
            document.getElementById('user-info').innerHTML = `
                    <a href="/login">
                        <i class="fa-solid fa-user fa-xl" style="color: black"></i>
                    </a>
            `;
        }
    }

    // caricamento dei dati dell'utente
    loadUserData();

};