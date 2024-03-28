<?php

unset($_SESSION['username']);
unset($_SESSION['logged_in']);

session_destroy();

exit();