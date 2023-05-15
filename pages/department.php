<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  require_once(__DIR__ . '/../database/connection.db.php');
  require_once(__DIR__ . '/../temp/common.tpl.php');
  require_once(__DIR__ . '/../database/user_department.class.php');
  require_once(__DIR__ . '/../database/user.class.php');


  $db = getDatabaseConnection();

  drawHeader($session); 

  $encryptedId = str_replace("/pages/department.php?id=", "", $_SERVER['REQUEST_URI']);

  $id = base64_decode(($encryptedId));

  $id_int = (int) $id;

  $department_name = $_POST['name'];

  $users = User_Department::getUsers_from_department($db, $id_int);
?>

<div class="heading">
  <h1> <?=$department_name?> Department </h1>
</div>

<section class="ticket-form">

  <section class="users">

    <?php foreach($users as $user_department) { 
      
      $user = User::getUser($db, $user_department->user_id);
      ?>     

        <div class="user">
            <div class="question">
            <h3> <?= $user->username ?> </h3>

            <span class="icon"><i class="fas fa-sort-down"></i></span>
            </div>

            <div class="answer">
            <p> Email : <?=$user->email?></p>
            </div>
        </div>

    <?php } ?>
  </section>

</section>
    
<?php
  drawFooter($session);
?>