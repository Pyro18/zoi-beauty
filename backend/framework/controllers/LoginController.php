<?php

class LoginController
{
    public function index()
    {
        //echo 'Login Page';

        require_once $_SERVER['DOCUMENT_ROOT'] . '/frontend/components/userpages/auth/login.php';
    }



}