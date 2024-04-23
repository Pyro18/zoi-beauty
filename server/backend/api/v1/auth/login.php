<?php
include '../../../config/db.php';
include '../../../config/request_db.php';

function createResponse($status, $message, $data = null)
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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    if ($data) {
        $userIdentifier = isset($data['userIdentifier']) ? checkInput($data['userIdentifier']) : '';
        $password = isset($data['password']) ? checkInput($data['password']) : '';

        if (empty($userIdentifier) || empty($password)) {
            echo createResponse('error', 'Missing username/email or password.', []);
            exit;
        }

        global $db;
        $sql = "SELECT * FROM utenti WHERE username = :userIdentifier OR email = :userIdentifier";
        $query = $db->prepare($sql);
        $query->bindParam(':userIdentifier', $userIdentifier, PDO::PARAM_STR);
        $query->execute();
        $user = $query->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            if (password_verify($password, $user['password'])) {
                session_start();
                $_SESSION['user_id'] = $user['id'];
                setcookie('user_id', $user['id'], time() + (86400 * 30), "/"); 
                echo createResponse('success', 'Logged in successfully.', ['user_id' => $user['id'], 'nome' => $user['nome'], 'cognome' => $user['cognome']]);
            } else {
                echo createResponse('error', 'Incorrect password.', []);
            }
        } else {
            echo createResponse('error', 'User not found.', []);
        }
    } else {
        echo createResponse('error', 'Invalid request.', []);
        exit;
    }
} else {
    echo createResponse('error', 'Invalid request method.', []);
    exit;
}