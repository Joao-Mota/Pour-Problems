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

  drawHeader($session); 
  ?>


<div class="heading">
  <h1>Submit a Ticket</h1>
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
        <span> Department: </span>
        <select id="departments" name="department">
          <option value="notsure"> Not Sure </option>
          <option value="accounting"> Accounting </option>
          <option value="packaging"> Packaging </option>
          <option value="orders"> Orderd </option>
        </select>
      </div>

      <div class="input-box">
        <span> Description: </span>
        <textarea name="description" cols="60" rows="8"></textarea>
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

</section>
      
<?php
  drawFooter($session);
?>