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

  <h1 class="signup-title">Create new ticket</h1>

  <form action="/actions/action_add_ticket.php" method="post" class="signup-form">

    <div class="flex">
      <div class="input-box">
        <span> Subject: </span>
        <input type="text" name="subject" placeholder="enter the subject">
      </div>

      <div class="input-box">
        <span> DateTime: </span>
        <input type="datetime-local" name="datetime" placeholder="enter the date/time">
      </div>

      <div class="input-box">
        <span> Department: </span>
        <select id="departments" name="department">
          <option value="notsure"> Not Sure </option>
          <option value="accounting"> Accounting </option>
          <option value="packaging"> Packaging </option>
          <option value="orders"> Orderd </option>
        </select>
      </div>

      <section id="messages">
        <?php foreach ($session->getMessages() as $messsage) { ?>
          <article class="<?=$messsage['type']?>">
            <?=$messsage['text']?>
          </article>
        <?php } ?>
      </section>

    </div>

    <input type="submit" value="Submit Ticket" class="btn" name="submit">

  </form>


  <section class="mytickets">
    <h2 class="title">My Tickets</h2>

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
        </div>

        <div>
          <form action="../actions/action_delete_ticket.php" method="post" class="delete">
            <input type="hidden" name="ticket_id" value="<?=$ticket_user->ticket_id?>">
            <input type="hidden" name="id" value="<?=$ticket->id?>">
            <input type="submit" value="Delete"> 
          </form>
        </div>

    </div>

    <?php } ?>
  </section>

</section>
      
<?php
  drawFooter($session);
?>