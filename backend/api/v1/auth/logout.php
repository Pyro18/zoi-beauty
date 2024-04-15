<?php
session_start();

include '../../../config/db.php';
include '../../../config/request_db.php';
unset($_SESSION['user_id']);
unset($_SESSION['logged_in']);

session_destroy();



echo json_encode(array(
    'status' => 'success',
    'message' => 'Logged out successfully.'
));

exit();