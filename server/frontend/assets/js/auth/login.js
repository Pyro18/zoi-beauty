console.log('login.js loaded');

const messageModal = new bootstrap.Modal(document.getElementById('messageModal'), {});
const modalMessageBody = document.getElementById('modalMessageBody');

// Funzione per l'invio del modulo di auth
function handleLoginFormSubmit(event) {
    event.preventDefault();

    // Ottenere i valori dei campi di input
    const userIdentifierInput = document.querySelector('input[name="userIdentifier"]');
    const passwordInput = document.querySelector('input[name="password"]');

    console.log('userIdentifierInput:', userIdentifierInput);
    console.log('passwordInput:', passwordInput);

    if (userIdentifierInput && passwordInput) {
        const userIdentifier = userIdentifierInput.value;
        const password = passwordInput.value;

        let messageDiv = document.getElementById('success-login');
        let errorDiv = document.getElementById('error-login');
        // Effettuare la richiesta XMLHttpRequest
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'http://localhost:8080/backend/api/v1/auth/login.php', true);
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    const data = JSON.parse(xhr.responseText);
                    if (data.status === 'success') {
                        modalMessageBody.innerHTML = `<div class="alert alert-success" role="alert">Registrazione avvenuta con successo</div>`;
                        messageModal.show();
                        setTimeout(() => {
                            window.location.href = '/';
                        }, 2000);
                    } else {
                        modalMessageBody.innerHTML = `<div class="alert alert-danger" role="alert">Autentificazione fallita: ${data.message}</div>`;
                        messageModal.show();
                    }
                } else {
                    console.error('Error:', xhr.status, xhr.statusText);
                    modalMessageBody.innerHTML = `<div class="alert alert-danger" role="alert">Errore</div>`;
                    messageModal.show();
                }
            }
        };
        xhr.send(JSON.stringify({
            userIdentifier: userIdentifier,
            password: password
        }));
    } else {
        console.error('Input fields not found');
    }
}

window.onload = function() {
    const form = document.querySelector('form');
    if (form) {
        form.addEventListener('submit', handleLoginFormSubmit);
    } else {
        console.error('Form element not found');
    }
};


