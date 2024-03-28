<?php

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

function isIpBlocked($ip_address): bool
{
    global $db;
    $query = $db->prepare("SELECT * FROM ip_bloccati WHERE ip_address = :ip_address AND blocked_until > NOW()");
    $query->bindParam(':ip_address', $ip_address, PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);

    return (bool)$result;
}

function logAccessAttempt($ip_address): void
{
    global $db;
    $query = $db->prepare("INSERT INTO logs (ip_address) VALUES (:ip_address)");
    $query->bindParam(':ip_address', $ip_address, PDO::PARAM_STR);
    $query->execute();
}

function registerUser($username, $email, $password)
{
    global $db;

    $cleaned_username = checkInput($username);
    $cleaned_email = checkInput($email);
    $cleaned_password = checkInput($password);

    $email_hash = base64_encode($cleaned_email);
    $password_hash = password_hash($cleaned_password, PASSWORD_DEFAULT);
    $ip_address = $_SERVER['REMOTE_ADDR'];

    $sql = "SELECT * FROM utenti WHERE email = :email";
    $query = $db->prepare($sql);
    $query->bindParam(':email', $email_hash, PDO::PARAM_STR);
    $query->execute();
    $row = $query->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        echo createCallBack('error', 'User already exists.', []);
        exit;
    } else {
        $sql = "INSERT INTO utenti (username, email, password, ip_address) VALUES (:username, :email, :password, :ip_address)";
        $query = $db->prepare($sql);
        $query->bindParam(':username', $cleaned_username, PDO::PARAM_STR);
        $query->bindParam(':email', $email_hash, PDO::PARAM_STR);
        $query->bindParam(':password', $password_hash, PDO::PARAM_STR);
        $query->bindParam(':ip_address', $ip_address, PDO::PARAM_STR);
        $query->execute();

        echo createCallBack('success', 'User registered successfully.', []);
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isIpBlocked($_SERVER['REMOTE_ADDR'])) {
        echo createCallBack('error', 'Your IP is blocked! Try again later.', []);
        exit;
    }

    logAccessAttempt($_SERVER['REMOTE_ADDR']);

    $data = json_decode(file_get_contents('php://input'), true);
    if ($data) {
        $username = isset($data['username']) ? $data['username'] : '';
        $email = isset($data['email']) ? $data['email'] : '';
        $password = isset($data['password']) ? $data['password'] : '';

        if (empty($username) || empty($email) || empty($password)) {
            echo createCallBack('error', 'Missing required fields.', []);
            exit;
        }

        registerUser($username, $email, $password);
    } else {
        echo createCallBack('error', 'Invalid request.', []);
        exit;
    }
} else {
    echo createCallBack('error', 'Invalid request method.', []);
    exit;
}

