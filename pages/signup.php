<?php
declare(strict_types=1);

require_once(__DIR__ . '/../utils/session.php');
$session = new Session();

require_once(__DIR__ . '/../database/connection.db.php');

require_once(__DIR__ . '/../temp/common.tpl.php');

$db = getDatabaseConnection();

drawHeader($session);
?>

<!-- get fields erros -->
<?php
$errorFields = $session->getFieldErrors();
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
        <input type="text" name="first_name" placeholder="enter your first name"
          data-state="<?php if (isset($errorFields['first_name'])) { ?>invalid<?php } ?>" value="<?= $session->getPreviousFirstNameField() ?>">
        <?php if (isset($errorFields['first_name'])) { ?>
          <p class="text-danger">
            <?= $errorFields['first_name'] ?>
          </p>
        <?php } ?>
      </div>

      <div class="input-box">
        <span> last name: </span>
        <input type="text" name="last_name" placeholder="enter your last name"
          data-state="<?php if (isset($errorFields['last_name'])) { ?>invalid<?php } ?>" value="<?= $session->getPreviousLastNameField() ?>">
        <?php if (isset($errorFields['last_name'])) { ?>
          <p class="text-danger">
            <?= $errorFields['last_name'] ?>
          </p>
        <?php } ?>
      </div>

      <div class="input-box">
        <span> username: </span>
        <input type="text" name="username" placeholder="enter your username"
          data-state="<?php if (isset($errorFields['username'])) { ?>invalid<?php } ?>" value="<?= $session->getPreviousUsernameField() ?>">
        <?php if (isset($errorFields['username'])) { ?>
          <p class="text-danger">
            <?= $errorFields['username'] ?>
          </p>
        <?php } ?>
      </div>

      <div class="input-box">
        <span> email: </span>
        <input type="email" name="email" placeholder="enter your email"
          data-state="<?php if (isset($errorFields['email'])) { ?>invalid<?php } ?>" value="<?= $session->getPreviousEmailField() ?>">
        <?php if (isset($errorFields['email'])) { ?>
          <p class="text-danger">
            <?= $errorFields['email'] ?>
          </p>
        <?php } ?>
      </div>

      <div class="input-box">
        <span> password: </span>
        <input type="password" name="password" placeholder="enter your password"
          data-state="<?php if (isset($errorFields['password'])) { ?>invalid<?php } ?>">
        <?php if (isset($errorFields['password'])) { ?>
          <p class="text-danger">
            <?= $errorFields['password'] ?>
          </p>
        <?php } ?>
      </div>

      <div class="input-box">
        <span> confirm password: </span>
        <input type="password" name="confirm_password" placeholder="confirm your password"
          data-state="<?php if (isset($errorFields['confirm_password'])) { ?>invalid<?php } ?>">
        <?php if (isset($errorFields['confirm_password'])) { ?>
          <p class="text-danger">
            <?= $errorFields['confirm_password'] ?>
          </p>
        <?php } ?>
      </div>

    </div>

    <button type="submit" value="Sign Up" class="btn" name="register">Sign Up</button>
  </form>

</section>


<?php
drawFooter($session);
?>