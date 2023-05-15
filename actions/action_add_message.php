<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  require_once(__DIR__ . '/../database/connection.db.php');
  require_once(__DIR__ . '/../database/message.class.php');

  $db = getDatabaseConnection();

  $text = strval($_POST['message']);
  $ticket_id = strval($_POST['ticket_id']);
  $user_id = strval($_POST['client_id']);
  $datetime = strval($_POST['datetime']);


  $stmt = $db->prepare('INSERT INTO Message (text, datetime, user_id, ticket_id) VALUES (?, ?, ?, ?)');

  $stmt->execute(array($text, $datetime, $user_id, $ticket_id));


  header('Location: ../pages/ticket.php?id=' . $ticket_id);
?>