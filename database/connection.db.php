<?php
  declare(strict_types = 1);

  

  function getDatabaseConnection() : PDO {
    $db = new PDO('sqlite:' . __DIR__ . '/../database/database.db');
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    return $db;
  }

  /* Get user by username */
  function getUserByUsername(string $username) : ?array {
    global $db;

    $stmt = $db->prepare('SELECT * FROM users WHERE username = ?');
    $stmt->execute(array($username));
    $user = $stmt->fetch();

    return $user;
  }

  /* Get user by email */
  function getUserByEmail(string $email) : ?array {
    global $db;

    $stmt = $db->prepare('SELECT * FROM users WHERE email = ?');
    $stmt->execute(array($email));
    $user = $stmt->fetch();

    return $user;
  }

?>