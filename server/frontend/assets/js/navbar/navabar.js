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
    xhr.open('GET', `https://api.zoi-beauty.it/api/v1/auth/logout.php`, true);

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
    function loadUserData() {
        // l'user_id dal cookie
        let user_id = getCookie('user_id');

        if (user_id != "") {
            // l'utente è loggato, quindi carico i suoi dati
            let xhr = new XMLHttpRequest();
            xhr.open('GET', `https://api.zoi-beauty.it/api/v1/user/users.php?user_id=${user_id}`);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    let data = JSON.parse(xhr.responseText);
                    if (data.status === 'success') {
                        // Genera un numero casuale tra 1 e 9
                        let randomImageNumber = Math.floor(Math.random() * 9) + 1;

                        // Insert user image, name and dropdown menu into #user-info
                        document.getElementById('user-info').innerHTML = `
                            <div class="dropdown">
                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="/frontend/assets/images/profile/${randomImageNumber}.png" width="45" height="45" style="border-radius: 50%;">
                                    <span class="ms-2">${data.data.nome} ${data.data.cognome}</span>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <li><a class="dropdown-item" href="/user/profilo">Profilo</a></li>
                                    <li><a class="dropdown-item" id="logout-link" href="#" onclick="logout()">Logout</a></li>
                                </ul>
                            </div>
                        `;

                        // aggiungo l'evento click al link di logout
                        let logoutLink = document.querySelector('#logout-link');
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