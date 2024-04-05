<?php

class LoginController
{
    public function index()
    {
        //echo 'Login Page';
        $_SESSION['hide_navbar'] = true;

        require_once $_SERVER['DOCUMENT_ROOT'] . '/frontend/components/userpages/auth/login.php';
    }



}