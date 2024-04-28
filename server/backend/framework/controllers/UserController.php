<?php

class UserController
{
    public function profile()
    {
      $_SESSION['hide_navbar'] = false;
      require_once $_SERVER['DOCUMENT_ROOT'] . '/frontend/components/userpages/profile/profilo.php';
    }
}