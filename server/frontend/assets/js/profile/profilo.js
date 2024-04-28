console.log('Hello from profile.js');

function changeProfilePicture(userId, newProfilePicture) {
    $.ajax({
        url: 'https://localhost:8080/api/v1/user/users.php',
        type: 'POST',
        data: {
            user_id: userId,
            pfp: newProfilePicture
        },
        success: function(response) {
            // Aggiorna l'immagine del profilo nell'interfaccia utente
            $('#avatar').attr('src', newProfilePicture);
        },
        error: function(error) {
            console.error('Error:', error);
        }
    });
}

// Quando l'utente decide di cambiare l'immagine del profilo
$('#changeProfilePictureButton').on('click', function() {
    var userId = $('#userId').val();
    var newProfilePicture = $('#newProfilePicture').val();
    changeProfilePicture(userId, newProfilePicture);
});