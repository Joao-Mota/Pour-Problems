<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  require_once(__DIR__ . '/../database/connection.db.php');
  require_once(__DIR__ . '/../database/user.class.php');

  $db = getDatabaseConnection();

  // flag to check if register was successful
  $registerSuccess = true;

  // validate first_name field
  if(empty($_POST['first_name'])){
    $session->addFieldError('first_name', 'First name is required!');
    $registerSuccess = false;
  }

  // validate last_name field
  if(empty($_POST['last_name'])){
    $session->addFieldError('last_name', 'Last name is required!');
    $registerSuccess = false;
  }

  // validate email field
  if(empty($_POST['email'])){
    $session->addFieldError('email', 'Email is required!');
    $registerSuccess = false;
  }

  


  // // Check if all fields are filled
  // if(empty($_POST['first_name'] || $_POST['last_name'] || $_POST['email'] || $_POST['password'] || $_POST['confirm_password'])){
  //   $session->addMessage('error', 'All fields are required!');
  //   $registerSuccess = false;
  //   //print_r('All fields are required!');
  //   //header('Location: ' . $_SERVER['HTTP_REFERER']);
  //   //exit;
  // }

  // // Check if email is valid
  // else if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
  //   $session->addMessage('error', 'Invalid email!');
  //   $registerSuccess = false;
  //   //print_r('Invalid email!');
  //   //header('Location: ' . $_SERVER['HTTP_REFERER']);
  //   //exit;
  // }

  // // Check if password is valid
  // else if(strlen($_POST['password']) < 8){
  //   $session->addMessage('error', 'Password must be at least 8 characters long!');
  //   $registerSuccess = false;
  //   //print_r('Password must be at least 8 characters long!');
  //   //header('Location: ' . $_SERVER['HTTP_REFERER']);
  //   //exit;
  // }

  // // Check if passwords match
  // else if($_POST['password'] != $_POST['confirm_password']){
  //   $session->addMessage('error', 'Passwords do not match!');
  //   $registerSuccess = false;
  //   //print_r('Passwords do not match!');
  //   //header('Location: ' . $_SERVER['HTTP_REFERER']);
  //   //exit;
  // }
  
  // // Check if password contains at least one letter and one number
  // else if(!preg_match('/[A-Za-z].*[0-9]|[0-9].*[A-Za-z]/', $_POST['password'])){
  //   $session->addMessage('error', 'Password must contain at least one letter and one number!');
  //   $registerSuccess = false;
  //   //print_r('Password must contain at least one letter and one number!');
  //   //header('Location: ' . $_SERVER['HTTP_REFERER']);
  //   //exit;
  // }
  
  // // Check if username already exists
  // else if (getUserByUsername($_POST['username']) != null) {
  //   $session->addMessage('error', 'Username already exists!');
  //   $registerSuccess = false;
  //   //print_r('Username already exists!');
  //   //header('Location: ' . $_SERVER['HTTP_REFERER']);
  //   //exit;
  // }
  
  // // Check if email already exists
  // else if (getUserByEmail($_POST['email']) != null) {
  //   $session->addMessage('error', 'Email already exists!');
  //   $registerSuccess = false;
  //   //header('Location: ' . $_SERVER['HTTP_REFERER']);
  //   //exit;
  // }
  


  // Admins
  /*  
  $fullname_admin = 'Admin';
  $username_admin = 'admin';
  $email_admin = 'admin@pourproblems.com';
  $password_admin = password_hash('admin555', PASSWORD_DEFAULT);
  $role_id_admin = 1;

  if(getUserByEmail($email_admin) == null){
    try {
      $stmt = $db->prepare('INSERT INTO User (fullname, username, email, password, role_id) VALUES (?, ?, ?, ?, ?)');
      $stmt->execute(array($fullname_admin, $username_admin, $email_admin, $password_admin, $role_id_admin));
    }     
      
    catch (PDOException $e) {
      $session->addMessage('error', 'Nice try!');
      header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
  }
  */




  // Hash password
  if($registerSuccess){
    $fullname = $_POST['first_name'] . ' ' . $_POST['last_name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role_id = 3;
  
    $db = getDatabaseConnection();
  
    try {
      $stmt = $db->prepare('INSERT INTO User (fullname, username, email, password, role_id) VALUES (?, ?, ?, ?, ?)');
      $stmt->execute(array($fullname, $username, $email, $password, $role_id));
      $session->addMessage('success', 'Register successful!');
      header('Location: ../pages/login.php');
    }     
      
    catch (PDOException $e) {
      $session->addMessage('error', 'Register fds!');
      header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
  }
  else {
    $session->addMessage('error', 'The form was not filled correctly!');
    header('Location: ' . $_SERVER['HTTP_REFERER']);
  }
?>