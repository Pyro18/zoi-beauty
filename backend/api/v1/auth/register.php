<?php
include '../../../config/db.php';
include '../../../config/request_db.php';

function createResponse($status, $message, $data)
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

function registerUser($nome, $cognome, $username, $email, $password)
{
    global $db;

    $cleaned_nome = checkInput($nome);
    $cleaned_cognome = checkInput($cognome);
    $cleaned_username = checkInput($username);
    $cleaned_email = checkInput($email);
    $cleaned_password = checkInput($password);

    $email_hash = base64_encode($cleaned_email);
    $password_hash = password_hash($cleaned_password, PASSWORD_DEFAULT);

    $sql = "SELECT * FROM utenti WHERE email = :email";
    $query = $db->prepare($sql);
    $query->bindParam(':email', $email_hash, PDO::PARAM_STR);
    $query->execute();
    $row = $query->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        echo createResponse('error', 'User already exists.', []);
        exit;
    } else {
        $sql = "INSERT INTO utenti (nome, cognome, username, email, password) VALUES (:nome, :cognome, :username, :email, :password)";
        $query = $db->prepare($sql);
        $query->bindParam(':nome', $cleaned_nome, PDO::PARAM_STR);
        $query->bindParam(':cognome', $cleaned_cognome, PDO::PARAM_STR);
        $query->bindParam(':username', $cleaned_username, PDO::PARAM_STR);
        $query->bindParam(':email', $email_hash, PDO::PARAM_STR);
        $query->bindParam(':password', $password_hash, PDO::PARAM_STR);
        $query->execute();

        echo createResponse('success', 'User registered successfully.',
        ['nome' => $cleaned_nome, 'cognome' => $cleaned_cognome, 'username' => $cleaned_username, 'email' => $cleaned_email]);
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    if ($data) {
        $nome = isset($data['nome']) ? $data['nome'] : '';
        $cognome = isset($data['cognome']) ? $data['cognome'] : '';
        $username = isset($data['username']) ? $data['username'] : '';
        $email = isset($data['email']) ? $data['email'] : '';
        $password = isset($data['password']) ? $data['password'] : '';

        if (empty($nome) || empty($cognome) || empty($username) || empty($email) || empty($password)) {
            echo createResponse('error', 'Missing required fields.', $data);
            exit;
        }

        registerUser($nome, $cognome, $username, $email, $password);
    } else {
        echo createResponse('error', 'Invalid request.', $data);
        exit;
    }
} else {
    echo createResponse('error', 'Invalid request method.', [] );
    exit;
}