<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();
  
  $session->logout();

  header('Location: ' . 'http://' . $_SERVER['HTTP_HOST'] . '/pages/index.php');
?>