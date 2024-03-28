<?php

class HomeController
{
  public function index() {
    //echo 'Home Test';
    $_SESSION['is_auth_page'] = false;
    require_once $_SERVER['DOCUMENT_ROOT'] . '/frontend/components/userpages/homepage/home.php';

  }
}