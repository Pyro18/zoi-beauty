<?php

class LoginController
{
    public function index()
    {
        //echo 'Login Page';
        $_SESSION['is_auth_page'] = true;

        require_once $_SERVER['DOCUMENT_ROOT'] . '/frontend/components/userpages/auth/login.php';
    }



}