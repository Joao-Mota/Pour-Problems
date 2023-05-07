<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  require_once(__DIR__ . '/../database/connection.db.php');
  require_once(__DIR__ . '/../database/user.class.php');

  $db = getDatabaseConnection();

  try {
    $stmt = $db->prepare("INSERT INTO user (name, username, email, password, role_id, department_id) VALUES (:name, :username, :email, :password, :role_id, :department_id)");
    $stmt ->bindParam(':name', $name);
    $stmt ->bindParam(':username', $username);
    $stmt ->bindParam(':email', $email);
    $stmt ->bindParam(':password', $password);
    $stmt ->bindParam(':role_id', $role_id);
    $stmt ->bindParam(':department_id', $department_id);
    $stmt->execute();
    } 
    
    catch (PDOException $e) {
      $session->addMessage('fds', 'Register fds!');
    }
  $session->addMessage('success', 'Register successful!');

  header('Location: ' . $_SERVER['HTTP_REFERER']);
?>