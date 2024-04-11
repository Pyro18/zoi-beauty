<?php

class AdminController
{
    public function dashboard() {
        $_SESSION['hide_navbar'] = true;
        require_once $_SERVER['DOCUMENT_ROOT'] . '/frontend/components/adminpages/dashboard.php';
    }
}

