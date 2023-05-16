<?php
declare(strict_types=1);

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

$encryptedId = str_replace("/pages/ticket.php?id=", "", $_SERVER['REQUEST_URI']);

$id = base64_decode(($encryptedId));

$id_int = (int) $id;

$ticket = Ticket::getTicket($db, $id_int);

$status = Status::getStatus($db, $ticket->status_id);
?>

<script>
  $(document).ready(function(){

    //make_chat_dialog_box(ticket_id, client_id, datetime, id);

    console.log('entro na pagina');
  });

  $(document).on('click', '.start_chat', function(){
    var ticket_id = $(this).data('ticket_id');
    var client_id = $(this).data('client_id');
    var datetime = $(this).data('datetime');
    var id = $(this).data('id');

    console.log(ticket_id);
    console.log(client_id);
    console.log(datetime);
    console.log(id);

    make_chat_dialog_box(ticket_id, client_id, datetime, id);

    console.log('Criou chat');
  });

  $(document).on('click', '.send_message', function(){
    console.log('Entrou na mensagem');

    var message = $('#message').val();
    var ticket_id = $(this).attr('data-ticket_id');
    var client_id = $(this).data('client_id');
    var datetime = $(this).data('datetime');
    var id = $(this).data('id');

    console.log(message);
    console.log(ticket_id);
    console.log(client_id);
    console.log(datetime);
    console.log(id);

    $.ajax({
      url:"../actions/action_add_message.php",
      method:"POST",
      data:{message:message, ticket_id:ticket_id, client_id:client_id, datetime:datetime, id:id},
      success:function(data)
      {
        $('#message').val('');
        $('#chat_history_'+client_id).html(data);
      }
    })


    // var to_user_id = $(this).attr('id');
    // var chat_message = $('#chat_message_'+to_user_id).val();
    // $.ajax({
    // url:"../actions/action_add_message.php",
    // method:"POST",
    // data:{to_user_id:to_user_id, chat_message:chat_message},
    // success:function(data)
    // {
    //   $('#chat_message_'+to_user_id).val('');
    //   $('#chat_history_'+to_user_id).html(data);
    // }
    // })
  });
</script>



<h1>
  <?= $ticket->subject ?>
</h1>
<h2> Department:
  <?= $ticket->department ?>
</h2>
<p>
  <?= $ticket->datetime ?>
</p>
<?php $status = Status::getStatus($db, $ticket->status_id); ?>
<h3> Ticket Status :
  <?= $status->stat ?>
</h3>

<p>
  <?= $ticket->description ?>
</p>
<div>
  <p> Anexos:
    <?= count($ticket->files) ?>
  </p>
  <?php foreach ($ticket->files as $file) { ?>
    
    <a class="file" href="/uploads/tickets/<?= $file['file_path'] ?>" target="_blank" rel="noopener noreferrer">
    <?php
      // check if file is an image from the file extension
      $file_extension = pathinfo($file['file_path'], PATHINFO_EXTENSION);
      if (in_array($file_extension, ['jpg', 'jpeg', 'png', 'gif'])) { ?>
        <img src="/uploads/tickets/<?= $file['file_path'] ?>" alt="" width="auto" height="100px">
      <?php } else { ?>
        <div class="file-icon">
          <i class="fas fa-file"></i>
        </div>
      <?php } ?>
    </a>
  <?php } ?>
</div>

<?php
$messages = Message::getMessages_from_ticket($db, $ticket->id);

foreach ($messages as $message) {
  $user = User::getUser($db, $message->user_id); ?>
  <h2>
    <?= $user->username ?> 
    <?= $message->text ?>
  </h2>

<?php } ?>

<button type="button" class="btn btn-info btn-xs start_chat" data-ticket_id="<?=$ticket->id?>" data-client_id="<?=$session->getID()?>" data-datetime="<?=$ticket->datetime?>" data-id="<?=$encryptedId?>">Show Real-Time Chat</button>

<div id="chat"></div>




<!-- Mensagens (antigo) -->

<!-- <section class="ticket-form">

  <form action="/actions/action_add_message.php" method="post" class="signup-form">

    <div class="input-box"><span> Message: </span><textarea name="message" cols="60" rows="8"></textarea></div>

    <input type="hidden" name="ticket_id" value="<?= $ticket->id ?>">
    <input type="hidden" name="client_id" value="<?= $session->getID() ?>">
    <input type="hidden" name="datetime" value="<?= $ticket->datetime ?>">
    <input type="hidden" name="id" value="<?= $encryptedId ?>">

    <section id="messages">
      <?php foreach ($session->getMessages() as $messsage) { ?>
        <article class="<?= $messsage['type'] ?>">
          <?= $messsage['text'] ?>
        </article>
      <?php } ?>
    </section>

    <input type="submit" value="Send Message" class="btn" name="submit">

  </form>

</section> -->

<?php
drawFooter($session);
?>