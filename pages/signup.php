<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  require_once(__DIR__ . '/../database/connection.db.php');


  require_once(__DIR__ . '/../temp/common.tpl.php');
  

  $db = getDatabaseConnection();

  drawHeader($session);
?>

<div class="heading" style="background:url(/sources/heading_bg/signup-slide-bg.jpg) no-repeat;">
  <h1>Sign Up</h1>
</div>

<section class="signup">

  <h1 class="signup-title">Sign Up Now!</h1>

  <form action="/actions/action_register.php" method="post" class="signup-form">

    <div class="flex">
      <div class="input-box">
        <span> first name: </span>
        <input type="text" name="first_name" placeholder="enter your first name">
      </div>

      <div class="input-box">
        <span> last name: </span>
        <input type="text" name="last_name" placeholder="enter your last name">
      </div>

      <div class="input-box">
        <span> username: </span>
        <input type="text" name="username" placeholder="enter your username">
      </div>

      <div class="input-box">
        <span> email: </span>
        <input type="email" name="email" placeholder="enter your email">
      </div>

      <div class="input-box">
        <span> password: </span>
        <input type="password" name="password" placeholder="enter your password">
      </div>

      <div class="input-box">
        <span> confirm password: </span>
        <input type="password" name="confirm_password" placeholder="confirm your password">
      </div>


    </div>

    <input type="submit" value="Sign Up" class="btn" name="register">

  </form>

</section>


<?php
  drawFooter();
?>