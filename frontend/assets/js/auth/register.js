window.onload = function() {
    const form = document.getElementById('registerForm');
    const messageDiv = document.getElementById('message');

    form.addEventListener('submit', function(event) {
        event.preventDefault();

        const nome = document.querySelector('input[name="nome"]').value;
        const cognome = document.querySelector('input[name="cognome"]').value;
        const username = document.querySelector('input[name="username"]').value;
        const telefono = document.querySelector('input[name="telefono"]').value;
        const email = document.querySelector('input[name="email"]').value;
        const password = document.querySelector('input[name="password"]').value;
        const confirmPassword = document.querySelector('input[name="confirm_password"]').value;

        if (password !== confirmPassword) {
            messageDiv.innerHTML = `<div class="container alert alert-danger" role="alert">Le password non corrispondono</div>`;
            return;
        }

        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'http://localhost:8080/backend/api/v1/auth/register.php', true);
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    const data = JSON.parse(xhr.responseText);
                    if (data.status === 'success') {
                        messageDiv.innerHTML = `<div class="container alert alert-success" role="alert">Registrazione avvenuta con successo</div>`;
                        window.location.href = '/';
                    } else {
                        messageDiv.innerHTML = `<div class="container alert alert-danger" role="alert">Registrazione fallita: ${data.message}</div>`;
                    }
                } else {
                    messageDiv.innerHTML = `<div class="container alert alert-danger" role="alert">Registrazione fallita. Si prega di riprovare più tardi.</div>`;
                }
            }
        };
        xhr.send(JSON.stringify({
            nome: nome,
            cognome: cognome,
            username: username,
            telefono: telefono,
            email: email,
            password: password
        }));
    });
};
