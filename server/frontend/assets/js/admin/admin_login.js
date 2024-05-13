console.log('admin_login.js loaded');



document.getElementById('adminLoginForm').addEventListener('submit', function(event) {
    event.preventDefault();

    const emailInput = document.querySelector('input[name="email"]');
    const passwordInput = document.querySelector('input[name="password"]');

    console.log('email:', emailInput.value);
    console.log('passwordInput:', passwordInput.value);

    let xhr = new XMLHttpRequest();
    xhr.open('POST', 'https://api.zoi-beauty.it/api/v1/auth/admin_login.php', true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.onload = function() {
        if (this.status == 200 && this.responseText) {
            try {
                let response = JSON.parse(this.responseText);
                if (response.status === 'success') {
                    document.getElementById('success-login').innerHTML = 'Login successful. Redirecting...';
                    setTimeout(function() {
                        window.location.href = '/admin/dashboard';
                    }, 2000);
                } else {
                    document.getElementById('error-login').innerHTML = 'Error: ' + response.message;
                    console.error('Server response:', response);
                }
            } catch (e) {
                console.error('Error parsing JSON:', e);
                document.getElementById('error-login').innerHTML = 'Error: Could not parse server response.';
            }
        } else {
            document.getElementById('error-login').innerHTML = 'Error: Could not connect to the server.';
        }
    }
    xhr.send(JSON.stringify({
        email: emailInput.value,
        password: passwordInput.value
    }));
});