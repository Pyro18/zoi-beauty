console.log('register.js loaded');

window.onload = function() {
    const form = document.querySelector('form');
    form.addEventListener('submit', function(event) {
        event.preventDefault();

        const username = document.querySelector('input[name="username"]').value;
        const email = document.querySelector('input[name="email"]').value;
        const password = document.querySelector('input[name="password"]').value;
        const confirmPassword = document.querySelector('input[name="confirm_password"]').value;

        if (password !== confirmPassword) {
            alert('Passwords do not match');
            return;
        }

        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'http://localhost:8000/backend/api/v1/auth/register.php', true);
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    const data = JSON.parse(xhr.responseText);
                    if (data.status === 'success') {
                        alert('Registration successful');
                        window.location.href = '/auth';
                    } else {
                        alert('Registration failed: ' + data.message);
                    }
                } else {
                    console.error('Error:', xhr.status, xhr.statusText);
                    alert('Registration failed. Please try again later.');
                }
            }
        };
        xhr.send(JSON.stringify({
            username: username,
            email: email,
            password: password
        }));
    });
};
