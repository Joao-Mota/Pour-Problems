<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  require_once(__DIR__ . '/../database/connection.db.php');
  require_once(__DIR__ . '/../temp/common.tpl.php');
  require_once(__DIR__ . '/../database/ticket.class.php');
  require_once(__DIR__ . '/../database/status.class.php');
  require_once(__DIR__ . '/../database/ticket_user.class.php');
  require_once(__DIR__ . '/../database/message.class.php');
  require_once(__DIR__ . '/../database/user.class.php');
  

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
    $messages = Message::getMessages_from_ticket($db, $ticket->id);

    foreach($messages as $message) { 
        $user = User::getUser($db, $message->user_id); ?>
        <h2> <?= $user->username ?> - <?= $message->text ?> </h2>

<?php } ?>

    
<section class="ticket-form">

  <form action="/actions/action_add_message.php" method="post" class="signup-form">

      <div class="input-box">
        <span> Message: </span>
        <textarea name="message" cols="60" rows="8"></textarea>
      </div>

      <input type="hidden" name="ticket_id" value="<?=$ticket->id?>">
      <input type="hidden" name="client_id" value="<?=$session->getID()?>">
      <input type="hidden" name="datetime" value="<?=$ticket->datetime?>">

      <section id="messages">
        <?php foreach ($session->getMessages() as $messsage) { ?>
          <article class="<?=$messsage['type']?>">
            <?=$messsage['text']?>
          </article>
        <?php } ?>
      </section>

    </div>

    <input type="submit" value="Send Message" class="btn" name="submit">

  </form>

</section>

<?php
  drawFooter($session);
?>