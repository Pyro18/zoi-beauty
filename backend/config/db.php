<?php

$config = array(
  'db_host' => '45.133.74.23',
  'db_name' => 'zoi_beauty',
  'db_user' => 'pyro',
  'db_pass' => 'cambiami123',
);

/*$config = array(
    'db_host' => 'localhost',
    'db_name' => 'zoi_beauty',
    'db_user' => 'root',
    'db_pass' => '',
);*/

try {
  $db = new PDO('mysql:host=' . $config['db_host'] . ';dbname=' . $config['db_name'], $config['db_user'], $config['db_pass']);
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo 'Connection failed: ' . $e->getMessage();
  exit;
}