<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  require_once(__DIR__ . '/../database/connection.db.php');

  require_once(__DIR__ . '/../temp/common.tpl.php');
  
  require_once(__DIR__ . '/../database/user.class.php');

  $db = getDatabaseConnection();

  drawHeader($session); 

  $user_array = User::getUser($db, $session->getId());
  $role_num = $user_array->role_id;


  if($role_num == 1){
    $role = "Admin";

  }
  else if($role_num == 2){
    $role = "Agent";
  }
  else{
    $role = "Client";
  }
  
?>

<div class="profile">

  <div class="profile_pic">
    <img src="/sources/profile_placeholder/profile_placeholder.png" alt="profile_pic">
  </div>

  
  <div class="profile_info">
    <div class="title"> 
      <h1> Information </h1> 
    </div>
    <table class="info">
      <tr>
        <th>Username:</th>
        <td><?php echo $user_array->username; ?></td>
      </tr>

      <tr>
        <th>Full Name:</th>
        <td><?php echo $user_array->fullname; ?></td>
      </tr>

      <tr>
        <th>Email:</th>
        <td><?php echo $user_array->email; ?></td>
      </tr>

      <tr>
        <th>Role:</th>
        <td><?php echo $role; ?></td>
      </tr>
    </table>

  </div>
  <div class="edit_profile">
    <a href="/actions/action_profile_edit.php"><i class="fas fa-user-pen"></i></a>
  </div>
</div>
    
<?php
  drawFooter($session);
?>