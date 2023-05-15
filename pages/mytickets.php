<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  require_once(__DIR__ . '/../database/connection.db.php');
  require_once(__DIR__ . '/../temp/common.tpl.php');
  require_once(__DIR__ . '/../database/ticket_user.class.php');
  require_once(__DIR__ . '/../database/ticket.class.php');
  require_once(__DIR__ . '/../database/status.class.php');
  

  $db = getDatabaseConnection();

  $tickets_from_user = Ticket_User::getTickets_from_User($db, $session->getId());

  drawHeader($session); 
  ?>


<div class="heading">
  <h1>My Tickets</h1>
</div>

<section class="ticket-form">

  <section class="mytickets">

    <?php foreach($tickets_from_user as $ticket_user) { 

      $ticket = Ticket::getTicket($db, $ticket_user->ticket_id) ?> 
      
      <div class="ticket">

        <div class="question">
          <h3> <?= $ticket->subject ?> </h3>

          <span class="icon"><i class="fas fa-sort-down"></i></span>
        </div>

        <div class="answer">
          <p> Department : <?= $ticket->department ?> </p>
          <p> <?= $ticket->datetime ?> </p>
          <?php $status = Status::getStatus($db, $ticket->status_id); ?>
          <p> Ticket Status : <?= $status->stat ?> </p>
          <p> Anexos: <?= count($ticket->files) ?> </p>
        </div>

        <div>
          <form action="../actions/action_delete_ticket.php" method="post" class="delete">
            <input type="hidden" name="ticket_id" value="<?=$ticket_user->ticket_id?>">
            <input type="hidden" name="id" value="<?=$ticket->id?>">
            <input type="submit" value="Delete"> 
          </form>
        </div>

        <div>
          <form action="../pages/ticket.php?id=<?=base64_encode(strval($ticket->id))?>" method="post" class="delete">
            <input type="hidden" name="ticket_id" value="<?=$ticket_user->ticket_id?>">
            <input type="hidden" name="id" value="<?=$ticket->id?>">
            <input type="submit" value="+Info"> 
          </form>
        </div>

      </div>

    <?php } ?>
  </section>

</section>
      
<?php
  drawFooter($session);
?>