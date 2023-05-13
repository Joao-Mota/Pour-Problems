<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  require_once(__DIR__ . '/../database/connection.db.php');
  require_once(__DIR__ . '/../temp/common.tpl.php');
  require_once(__DIR__ . '/../database/ticket_user.class.php');
  require_once(__DIR__ . '/../database/ticket.class.php');
  

  $db = getDatabaseConnection();

  $tickets_from_user = Ticket_User::getTickets_from_User($db, $session->getID());
  $tickets = Ticket::getAllTickets($db);


  drawHeader($session); 
  ?>


<div class="heading">
  <h1>My Tickets</h1>
</div>

<section class="signup">

  <h1 class="signup-title">Create new ticket</h1>

  <form action="/actions/action_add_ticket.php" method="post" class="signup-form">

    <div class="flex">
      <div class="input-box">
        <span> Subject: </span>
        <input type="text" name="subject" placeholder="enter the subject">
      </div>

      <div class="input-box">
        <span> DateTime: </span>
        <input type="text" name="datetime" placeholder="enter the date/time">
      </div>

      <section id="messages">
        <?php foreach ($session->getMessages() as $messsage) { ?>
          <article class="<?=$messsage['type']?>">
            <?=$messsage['text']?>
          </article>
        <?php } ?>
      </section>

    </div>

    <input type="submit" value="Submit Ticket" class="btn" name="register">

  </form>

  <?php foreach($tickets as $ticket) { ?> 
      <article>
        <h1> <?= $ticket->id ?> </h1>
        <h2> <?= $ticket->subject ?> </h2>
        <p> <?= $ticket->datetime ?> </p>
      </article>
    <?php } ?>

</section>
      
<?php
  drawFooter($session);
?>