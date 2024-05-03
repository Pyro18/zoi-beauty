<?php

class HomeController
{
  public function index() {
    //echo 'Home Test';
    $_SESSION['hide_navbar'] = false;
    require_once $_SERVER['DOCUMENT_ROOT'] . '/frontend/components/userpages/homepage/home.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/frontend/components/userpages/homepage/about.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/frontend/components/userpages/homepage/services.php';
    //require_once $_SERVER['DOCUMENT_ROOT'] . '/frontend/components/userpages/homepage/contacts.php';
  }
}