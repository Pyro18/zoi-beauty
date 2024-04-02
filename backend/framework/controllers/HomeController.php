<?php

class HomeController
{
  public function index() {
    //echo 'Home Test';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/frontend/components/userpages/homepage/home.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/frontend/components/userpages/homepage/about.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/frontend/components/userpages/homepage/services.php';

  }
}