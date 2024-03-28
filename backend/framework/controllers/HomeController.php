<?php

class HomeController
{
  public function index() {
    //echo 'Home Test';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/frontend/components/userpages/homepage/home.php';

  }
}