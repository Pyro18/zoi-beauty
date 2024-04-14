window.onload = function() {
    // ... existing code ...

    // Check if user is logged in
    if (sessionStorage.getItem('user_id')) {
        // User is logged in, fetch user data
        var xhr = new XMLHttpRequest();
        xhr.open('GET', `http://localhost:8080/backend/api/v1/user/users.php?user_id=${sessionStorage.getItem('user_id')}`);
        xhr.onload = function() {
            if (xhr.status === 200) {
                var data = JSON.parse(xhr.responseText);
                if (data.status === 'success') {
                    // Insert user avatar and name into #user-info
                    document.getElementById('user-info').innerHTML = `
                        <img src="/path/to/avatar.png" alt="User Avatar" class="rounded-circle" width="30" height="30">
                        <span>${data.data.nome} ${data.data.cognome}</span>
                    `;
                } else {
                    console.error('Failed to fetch user data:', data.message);
                }
            } else {
                console.error('Request failed.  Returned status of ' + xhr.status);
            }
        };
        xhr.send();
    } else {
        // User is not logged in, insert login button into #user-info
        document.getElementById('user-info').innerHTML = `
            <a href="/path/to/login.php" class="btn btn-primary">Login</a>
        `;
    }
};