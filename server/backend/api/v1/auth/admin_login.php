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
        $email = isset($data['email']) ? checkInput($data['email']) : '';
        $password = isset($data['password']) ? checkInput($data['password']) : '';

        if (empty($email) || empty($password)) {
            echo createResponse('error', 'Missing email or password.', []);
            exit;
        }

        global $db;
        $sql = "SELECT * FROM admin WHERE email = :email";
        $query = $db->prepare($sql);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->execute();
        $admin = $query->fetch(PDO::FETCH_ASSOC);

        if ($admin) {
            if (password_verify($password, $admin['password'])) {
                session_start();
                $_SESSION['admin_id'] = $admin['id'];
                echo createResponse('success', 'Logged in successfully.', ['admin_id' => $admin['id']]);
            } else {
                echo createResponse('error', 'Incorrect password.', []);
            }
        } else {
            echo createResponse('error', 'Admin not found.', []);
        }
    } else {
        echo createResponse('error', 'Invalid request.', []);
        exit;
    }
} else {
    echo createResponse('error', 'Invalid request method.', []);
    exit;
}
