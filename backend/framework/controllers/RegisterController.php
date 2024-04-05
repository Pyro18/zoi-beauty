<?php

class RegisterController
{
    public function index()
    {
        //echo 'Register Page';
        $_SESSION['hide_navbar'] = true;
        require_once $_SERVER['DOCUMENT_ROOT'] . '/frontend/components/userpages/auth/register.php';
    }

    public function register()
    {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/backend/framework/models/User.php';

        $user = new User();

        $user->register($_POST['name'], $_POST['email'], $_POST['password']);

        header('Location: /auth');
    }
}