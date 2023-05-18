<?php
declare(strict_types=1);

require_once(__DIR__ . '/../utils/session.php');
$session = new Session();

require_once(__DIR__ . '/../database/connection.db.php');
require_once(__DIR__ . '/../database/status.class.php');

$db = getDatabaseConnection();

$ticket_id = $_POST['ticket_id'];
$status_stat = $_POST['status'];

$status = Status::getStatus_from_name($db, $status_stat);

$stmt = $db->prepare('UPDATE Ticket SET status_id = ? WHERE id = ?');

$stmt->execute(array($status->id, $ticket_id));

header('Location: ' . $_SERVER['HTTP_REFERER']);
?>