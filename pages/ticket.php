<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  require_once(__DIR__ . '/../database/connection.db.php');
  require_once(__DIR__ . '/../temp/common.tpl.php');
  require_once(__DIR__ . '/../database/ticket.class.php');
  require_once(__DIR__ . '/../database/status.class.php');
  require_once(__DIR__ . '/../database/ticket_user.class.php');
  

  $db = getDatabaseConnection();

  drawHeader($session); 

  $id = (int) $_POST['id'];

  $ticket = Ticket::getTicket($db, $id);

  $status = Status::getStatus($db, $ticket->status_id);
?>

<h1> <?= $ticket->subject ?> </h1>
<h2> Department: <?= $ticket->department ?> </h2>
<p> <?= $ticket->datetime ?> </p>
<?php $status = Status::getStatus($db, $ticket->status_id); ?>
<h3> Ticket Status : <?= $status->stat ?> </h3>

<p> <?= $ticket->description ?> </p>
    
<?php
  drawFooter($session);
?>