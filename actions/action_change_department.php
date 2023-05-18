<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  require_once(__DIR__ . '/../database/connection.db.php');

  $db = getDatabaseConnection();

  $ticket_id = $_POST['ticket_id'];
  $department_name = $_POST['department'];

  $stmt = $db->prepare('UPDATE Ticket SET department = ? WHERE id = ?');
  $stmt->execute(array($department_name, $ticket_id));

  header('Location: ' . $_SERVER['HTTP_REFERER']);
?>