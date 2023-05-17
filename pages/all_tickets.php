<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  require_once(__DIR__ . '/../database/connection.db.php');
  require_once(__DIR__ . '/../temp/common.tpl.php');
  require_once(__DIR__ . '/../database/ticket_user.class.php');
  require_once(__DIR__ . '/../database/ticket.class.php');
  require_once(__DIR__ . '/../database/status.class.php');
  require_once(__DIR__ . '/../database/user.class.php');
  

  $db = getDatabaseConnection();

  $tickets_user = Ticket_User::getAllTickets_User($db);

  $all_status = Status::getAll_Status($db);

  drawHeader($session); 
  ?>


<div class="heading">
  <h1>All Tickets</h1>
</div>

<section class="ticket-form">

  <section class="mytickets">

    <?php foreach($tickets_user as $ticket_user) { 

      $ticket = Ticket::getTicket($db, $ticket_user->ticket_id);
      
      if($ticket_user->agent_id == NULL) {
        $agent_username = 'No Agent Assigned';
      }

      else {
        $user = User::getUser($db, $ticket_user->agent_id);

        $agent_username = $user->username;
      } ?> 
      
      <div class="all_ticket">

        <div class="question">
          <h3> <?= $ticket->subject ?> </h3>
        </div>

        <div class="answer">
          <p> Department : <?= $ticket->department ?> </p>
          <p> <?= $ticket->datetime ?> </p>
          <?php $status = Status::getStatus($db, $ticket->status_id); ?>
          <p> Ticket Status : <?= $status->stat ?> </p>
          <p> Agent Assigned : <?= $agent_username ?> </p>
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

        <div>
          <form action="../actions/action_change_status.php" method="post" class="delete">

            <input type="hidden" name="ticket_id" value="<?=$ticket->id?>">

            <select id="status" name="status">

              <?php foreach($all_status as $status) { ?>                                                              
                <option value="<?=$status->stat?>"> <?=$status->stat?> </option>
              <?php } ?>                     

            </select>

            <input type="submit" value="Change Status"> 

          </form>
        </div>

    </div>

    <?php } ?>
  </section>

</section>
      
<?php
  drawFooter($session);
?>