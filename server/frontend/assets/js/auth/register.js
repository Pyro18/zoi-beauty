window.onload = function() {
    const form = document.getElementById('registerForm');
    const messageModal = new bootstrap.Modal(document.getElementById('messageModal'), {});
    const modalMessageBody = document.getElementById('modalMessageBody');

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
            modalMessageBody.innerHTML = `<div class="alert alert-danger" role="alert">Le password non corrispondono</div>`;
            messageModal.show();
            return;
        }

        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'http://localhost:8080/backend/api/v1/auth/register.php', true);
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    console.log(xhr.responseText);
                    try {
                        const data = JSON.parse(xhr.responseText);
                        
                        if (data.status === 'success') {
                            modalMessageBody.innerHTML = `<div class="alert alert-success" role="alert">Registrazione avvenuta con successo</div>`;
                            messageModal.show();
                            setTimeout(() => {
                                sessionStorage.setItem('user_id', data.data.user_id);
                                window.location.href = '/login';
                            }, 2000);
                        } else {
                            modalMessageBody.innerHTML = `<div class="alert alert-danger" role="alert">Registrazione fallita: ${data.message}</div>`;
                            messageModal.show();
                        }
                    } catch (error) {
                        console.error('Error parsing JSON response:', error);
                        modalMessageBody.innerHTML = `<div class="alert alert-danger" role="alert">Errore nel parsing della risposta dal server</div>`;
                        messageModal.show();
                    }
                } else {
                    console.error('Error:', xhr.status, xhr.statusText);
                    modalMessageBody.innerHTML = `<div class="alert alert-danger" role="alert">Errore ${xhr.status}: ${xhr.statusText}</div>`;
                    messageModal.show();
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
