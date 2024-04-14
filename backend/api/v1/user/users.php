<?php
session_start();

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

function getUser($userId)
{
    global $db;

    $sql = "SELECT id, username, nome, cognome FROM utenti WHERE id = :userId";
    $query = $db->prepare($sql);
    $query->bindParam(':userId', $userId, PDO::PARAM_INT);
    $query->execute();
    $user = $query->fetch(PDO::FETCH_ASSOC);

    return $user;
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_SESSION['user_id'])) {
        $userId = $_SESSION['user_id'];
        $user = getUser($userId);

        if ($user) {
            echo createResponse('success', 'User fetched successfully.', $user);
        } else {
            echo createResponse('error', 'User not found.', []);
        }
    } else {
        echo createResponse('error', 'Missing user_id parameter.', []);
    }
} else {
    echo createResponse('error', 'Invalid request method.', []);
}