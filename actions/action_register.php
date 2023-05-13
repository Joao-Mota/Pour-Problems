<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  require_once(__DIR__ . '/../database/connection.db.php');
  require_once(__DIR__ . '/../database/user.class.php');

  $db = getDatabaseConnection();


  if(empty($_POST['first_name'] || $_POST['last_name'] || $_POST['email'] || $_POST['password'] || $_POST['confirm_password'])){
    $session->addMessage('error', 'All fields are required!');
    //print_r('All fields are required!');
    //header('Location: ' . $_SERVER['HTTP_REFERER']);
    //exit;
  }

  if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
    $session->addMessage('error', 'Invalid email!');
    //print_r('Invalid email!');
    //header('Location: ' . $_SERVER['HTTP_REFERER']);
    //exit;
  }

  if(strlen($_POST['password']) < 8){
    $session->addMessage('error', 'Password must be at least 8 characters long!');
    //print_r('Password must be at least 8 characters long!');
    //header('Location: ' . $_SERVER['HTTP_REFERER']);
    //exit;
  }

  if($_POST['password'] != $_POST['confirm_password']){
    $session->addMessage('error', 'Passwords do not match!');
    //print_r('Passwords do not match!');
    //header('Location: ' . $_SERVER['HTTP_REFERER']);
    //exit;
  }
  
  if(!preg_match('/[A-Za-z].*[0-9]|[0-9].*[A-Za-z]/', $_POST['password'])){
    $session->addMessage('error', 'Password must contain at least one letter and one number!');
    //print_r('Password must contain at least one letter and one number!');
    //header('Location: ' . $_SERVER['HTTP_REFERER']);
    //exit;
  }
  
  
  $fullname = $_POST['first_name'] . ' ' . $_POST['last_name'];
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
  $role_id = 3;


  $db = getDatabaseConnection();


  // Check if username already exists
  $user = getUserByUsername($username);
  if ($user != null) {
    $session->addMessage('error', 'Username already exists!');
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
  }

  // Check if email already exists
  $user = getUserByEmail($email);
  if ($user != null) {
    $session->addMessage('error', 'Email already exists!');
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
  }



  // Hash password

  try {
    $stmt = $db->prepare('INSERT INTO User (fullname, username, email, password, role_id) VALUES (?, ?, ?, ?, ?)');
    $stmt->execute(array($fullname, $username, $email, $password, $role_id));
    $session->addMessage('success', 'Register successful!');
    header('Location: ../pages/login.php');
    }     
    
    catch (PDOException $e) {
      $session->addMessage('fds', 'Register fds!');
      header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

?>