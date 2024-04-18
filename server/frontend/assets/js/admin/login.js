console.log('auth.js loaded');

// Funzione per l'invio del modulo di auth
function handleLoginFormSubmit(event) {
    event.preventDefault();

    // Ottenere i valori dei campi di input
    const emailInput = document.querySelector('input[name="email"]');
    const passwordInput = document.querySelector('input[name="password"]');

    console.log('emailInput:', emailInput);
    console.log('passwordInput:', passwordInput);

    if (emailInput && passwordInput) {
        const email = emailInput.value;
        const password = passwordInput.value;

        let messageDiv = document.getElementById('success-login');
        let errorDiv = document.getElementById('error-login');
        // Effettuare la richiesta XMLHttpRequest
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'http://localhost:8080/backend/api/v1/auth/admin_login.php', true);
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    const data = JSON.parse(xhr.responseText);
                    if (data.status === 'success') {
                         
                        window.location.href = '/admin/dashboard';
                    } else {
                        // Gestisci l'errore di login
                        errorDiv.innerHTML = `<div id="error-login" class="container alert alert-danger" role="alert">${data.message}</div>`;
                    }
                } else {
                    // Gestisci l'errore di rete
                    console.error('Error:', xhr.status, xhr.statusText);
                    errorDiv.innerHTML = `<div id="error-login" class="container alert alert-danger" role="alert">Login fallito. Si prega di riprovare più tardi.</div>`;
                }
            }
        };
        xhr.send(JSON.stringify({
            email: email,
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
