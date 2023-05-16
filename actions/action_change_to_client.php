<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  require_once(__DIR__ . '/../database/connection.db.php');
  require_once(__DIR__ . '/../database/role.class.php');
  require_once(__DIR__ . '/../database/user.class.php');

  $db = getDatabaseConnection();

  $user_id = (int) $_POST['user_id'];

  $user = User::getUser($db, $user_id);

  $user->role_id = 3;

  $user->save($db);

  header('Location: ' . $_SERVER['HTTP_REFERER']);
?>