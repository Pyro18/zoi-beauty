console.log('auth.js loaded');

// Funzione per l'invio del modulo di auth
function handleLoginFormSubmit(event) {
    event.preventDefault();

    // Ottenere i valori dei campi di input
    const userIdentifierInput = document.querySelector('input[name="userIdentifier"]');
    const passwordInput = document.querySelector('input[name="password"]');

    console.log('userIdentifierInput:', userIdentifierInput);
    console.log('passwordInput:', passwordInput);


    // Verificare se gli elementi sono stati trovati
    if (userIdentifierInput && passwordInput) {
        const userIdentifier = userIdentifierInput.value;
        const password = passwordInput.value;

        // Effettuare la richiesta XMLHttpRequest
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'http://localhost:8000/backend/api/v1/auth/login.php', true);
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    const data = JSON.parse(xhr.responseText);
                    if (data.status === 'success') {
                        alert('Login successful');
                        window.location.href = '/'; // redirect alla home page
                    } else {
                        alert('Login failed: ' + data.message);
                    }
                } else {
                    console.error('Error:', xhr.status, xhr.statusText);
                    alert('Login failed. Please try again later.');
                }
            }
        };
        xhr.send(JSON.stringify({
            userIdentifier: userIdentifier,
            password: password
        }));
    } else {
        console.error('Input fields not //found');
    }
}

// Assicurarsi che il codice venga eseguito dopo il caricamento della pagina
window.onload = function() {
    const form = document.querySelector('form');
    if (form) {
        // Aggiungi un listener per l'invio del modulo di auth
        form.addEventListener('submit', handleLoginFormSubmit);
    } else {
        console.error('Form element not found');
    }
};
