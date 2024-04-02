<?php
include '../../../config/db.php';
include '../../../config/request_db.php';
function createCallBack($status, $message, $data = null)
{
    return json_encode(array(
        'status' => $status,
        'message' => $message,
        'data' => $data
    ));
}

function checkInput($input)
{
    $scanned_input = strip_tags($input);
    return htmlentities($scanned_input, ENT_QUOTES, 'UTF-8');
}

function isIpBlocked($ip_address)
{
    global $db;
    $query = $db->prepare("SELECT * FROM ip_bloccati WHERE ip_address = :ip_address AND blocked_until > NOW()");
    $query->bindParam(':ip_address', $ip_address, PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);

    return $result ? true : false;
}

function logAccessAttempt($ip_address)
{
    global $db;
    $query = $db->prepare("INSERT INTO logs (ip_address) VALUES (:ip_address)");
    $query->bindParam(':ip_address', $ip_address, PDO::PARAM_STR);
    $query->execute();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isIpBlocked($_SERVER['REMOTE_ADDR'])) {
        echo createCallBack('error', 'Your IP is blocked! Try again later.', []);
        exit;
    }

    logAccessAttempt($_SERVER['REMOTE_ADDR']);


    $data = json_decode(file_get_contents('php://input'), true);
    if ($data) {
        $userIdentifier = isset($data['userIdentifier']) ? checkInput($data['userIdentifier']) : '';
        $password = isset($data['password']) ? checkInput($data['password']) : '';

        if (empty($userIdentifier) || empty($password)) {
            echo createCallBack('error', 'Missing username/email or password.', []);
            exit;
        }

        // Verifica l'utente nel database
        global $db;
        $sql = "SELECT * FROM utenti WHERE username = :userIdentifier OR email = :userIdentifier";
        $query = $db->prepare($sql);
        $query->bindParam(':userIdentifier', $userIdentifier, PDO::PARAM_STR);
        $query->execute();
        $user = $query->fetch(PDO::FETCH_ASSOC);


    if ($user) {
        // L'utente esiste, verifica la password
        if (password_verify($password, $user['password'])) {
            // Password corretta, avvia la sessione e restituisci il successo
            session_start();
            $_SESSION['user_id'] = $user['id'];
            echo createCallBack('success', 'Logged in successfully.', ['user_id' => $user['id']]);
        } else {
            // Password errata
            echo createCallBack('error', 'Incorrect password.', []);
        }
    } else {
        // Utente non trovato
        echo createCallBack('error', 'User not found.', []);
    }
    } else {
        echo createCallBack('error', 'Invalid request.', []);
        exit;
    }
} else {
    echo createCallBack('error', 'Invalid request method.', []);
    exit;
}
