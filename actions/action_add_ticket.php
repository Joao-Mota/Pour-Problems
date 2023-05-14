<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  require_once(__DIR__ . '/../database/connection.db.php');
  require_once(__DIR__ . '/../database/ticket.class.php');
  require_once(__DIR__ . '/../database/ticket_user.class.php');

  $db = getDatabaseConnection();

  if(empty($_POST['subject'] || $_POST['datetime'])){
    $session->addMessage('error', 'All fields are required!');
    header('Location: ' . $_SERVER['HTTP_REFERER']);
  }



  $subject = strval($_POST['subject']);
  $description = strval($_POST['description']);
  $datetime = strval($_POST['datetime']);
  $department = strval($_POST['department']);
  $status_id = 1;

  try {
    $stmt = $db->prepare('INSERT INTO Ticket (subject, description, datetime, department, status_id) VALUES (?, ?, ?, ?, ?)');

    $stmt->execute(array($subject, $description, $datetime, $department, $status_id));
    }     
    
    catch (PDOException $e) {
      $session->addMessage('RIP', 'No ticket!');
    }



    $client_id = $session->getID();
    $agent_id = 0;

    try {
      $stmt = $db->prepare('INSERT INTO Ticket_User (client_id, agent_id) VALUES (?, ?)');
      $stmt->execute(array($client_id, $agent_id));
      
      $session->addMessage('success', 'Ticket Submited!');
      }     
      
    catch (PDOException $e) {
      $session->addMessage('RIP', 'No ticket!');
    }

  header('Location: ' . $_SERVER['HTTP_REFERER']);
?>