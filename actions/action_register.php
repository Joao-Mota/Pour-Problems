<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  require_once(__DIR__ . '/../database/connection.db.php');
  require_once(__DIR__ . '/../database/user.class.php');

  $db = getDatabaseConnection();

  $fullname = $_POST['first_name'] . ' ' . $_POST['last_name'];
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $confirm_password = $_POST['confirm_password'];
  $role_id = 1;
  $department_id = null;

  // Check if username already exists
  $user = User::getUserByUsername($username);
  if ($user != null) {
    $session->addMessage('error', 'Username already exists!');
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
  }

  // Check if email already exists
  $user = User::getUserByEmail($email);
  if ($user != null) {
    $session->addMessage('error', 'Email already exists!');
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
  }

  // Check if passwords match
  if ($password != $confirm_password) {
    $session->addMessage('error', 'Passwords do not match!');
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
  }

  // Check if password is strong enough
  if (strlen($password) < 8) {
    $session->addMessage('error', 'Password must be at least 8 characters long!');
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
  }

  // Check if password contains at least one number
  if (!preg_match("#[0-9]+#", $password)) {
    $session->addMessage('error', 'Password must contain at least one number!');
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
  }

  // Check if password contains at least one letter
  if (!preg_match("#[a-zA-Z]+#", $password)) {
    $session->addMessage('error', 'Password must contain at least one letter!');
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
  }

  // Check if password contains at least one special character
  if (!preg_match("#\W+#", $password)) {
    $session->addMessage('error', 'Password must contain at least one special character!');
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
  }

  // Hash password
  $password = password_hash($password, PASSWORD_DEFAULT); 

  try {
    $stmt = $db->prepare("INSERT INTO user ($fullname, username, email, password, role_id, department_id) VALUES (:$fullname, :username, :email, :password, :role_id, :department_id)");
    $stmt ->bindParam(':fullname', $fullname);
    $stmt ->bindParam(':username', $username);
    $stmt ->bindParam(':email', $email);
    $stmt ->bindParam(':password', $password);
    $stmt ->bindParam(':role_id', $role_id);
    $stmt ->bindParam(':department_id', $department_id);
    $stmt ->execute();
    }     
    catch (PDOException $e) {
      $session->addMessage('fds', 'Register fds!');
    }
  $session->addMessage('success', 'Register successful!');

  header('Location: ' . $_SERVER['HTTP_REFERER']);
?>