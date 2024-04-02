<?php
include '../../../config/db.php';
include '../../../config/request_db.php';
unset($_SESSION['username']);
unset($_SESSION['logged_in']);

session_destroy();

exit();