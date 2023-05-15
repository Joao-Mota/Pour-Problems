<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  require_once(__DIR__ . '/../database/connection.db.php');
  require_once(__DIR__ . '/../temp/common.tpl.php');
  require_once(__DIR__ . '/../database/user.class.php');
  

  $db = getDatabaseConnection();

  $users = User::getUsers($db);

  drawHeader($session); 
  ?>


<div class="heading">
  <h1>All Users</h1>
</div>

<section class="ticket-form">

  <section class="users">

    <?php foreach($users as $user) { 

        if($user->role_id == 1) { ?>
            <div class="user">
                <div class="question">
                <h3> <?= $user->username ?> </h3>

                <span class="icon"><i class="fas fa-sort-down"></i></span>
                </div>

                <div class="answer">
                <p> Name : <?= $user->fullname ?> </p>
                </div>
            </div>
        <?php } 
      
        else if($user->role_id == 2) { ?>
            <div class="user">
                <div class="question">
                <h3> <?= $user->username ?> </h3>

                <span class="icon"><i class="fas fa-sort-down"></i></span>
                </div>

                <div class="answer">
                <p> Name : <?= $user->fullname ?> </p>
                </div>
            </div>
        <?php }

        else { ?>
            <div class="user">
                <div class="question">
                <h3> <?= $user->username ?> </h3>

                <span class="icon"><i class="fas fa-sort-down"></i></span>
                </div>

                <div class="answer">
                <p> Name : <?= $user->fullname ?> </p>
                </div>
            </div>
        <?php }

    } ?>
  </section>

</section>
      
<?php
  drawFooter($session);
?>

<!-- <div>
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
</div> -->