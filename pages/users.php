<?php
declare(strict_types=1);

require_once(__DIR__ . '/../utils/session.php');
$session = new Session();

if (!$session->isLoggedIn()) {
  header('Location: ../pages/login.php');
}

require_once(__DIR__ . '/../database/connection.db.php');
require_once(__DIR__ . '/../temp/common.tpl.php');
require_once(__DIR__ . '/../database/user.class.php');
require_once(__DIR__ . '/../database/department.class.php');
require_once(__DIR__ . '/../database/user_department.class.php');


$db = getDatabaseConnection();

$users = User::getUsers($db);

$departments = Department::getDepartments($db);

drawHeader($session);
?>


<div class="heading">
  <h1>All Users</h1>
</div>

<section class="ticket-form">

  <section class="users">

    <?php foreach ($users as $user) {

      if ($user->role_id == 1) { ?>
        <div class="user">
          <div class="question">
            <h3>
              <?= $user->username ?>
            </h3>

            <span class="icon"><i class="fas fa-sort-down"></i></span>
          </div>

          <div class="answer">
            <p> Name :
              <?= $user->fullname ?>
            </p>
          </div>

          <div>
            <form action="../actions/action_change_role.php" method="post" class="delete">

              <input type="hidden" name="user_id" value="<?= $user->id ?>">
              <input type="hidden" name="role_id" value="2">

              <input type="submit" value="Make Agent">

            </form>
          </div>
        </div>
      <?php } else if ($user->role_id == 2) { ?>
          <div class="agent">
            <div class="question">
              <h3>
              <?= $user->username ?>
              </h3>
            </div>

            <div class="answer">
              <p> Name :
              <?= $user->fullname ?>
              </p>
            </div>

            <div>
              <form action="../actions/action_assign_department.php" method="post" class="delete">

                <input type="hidden" name="user_id" value="<?= $user->id ?>">

                <select id="departments" name="department">

                <?php foreach ($departments as $department) { ?>
                    <option value="<?= $department->name ?>"> <?= $department->name ?> </option>
                <?php } ?>

                </select>

                <input type="submit" value="Assign Department">

              </form>
            </div>

            <div>
              <form action="../actions/action_change_role.php" method="post" class="delete">

                <input type="hidden" name="user_id" value="<?= $user->id ?>">
                <input type="hidden" name="role_id" value="1">

                <input type="submit" value="Make Admin">

              </form>
            </div>

            <div>
              <form action="../actions/action_change_role.php" method="post" class="delete">

                <input type="hidden" name="user_id" value="<?= $user->id ?>">
                <input type="hidden" name="role_id" value="3">

                <input type="submit" value="Make Client">

              </form>
            </div>
          </div>
      <?php } else { ?>
          <div class="user">
            <div class="question">
              <h3>
              <?= $user->username ?>
              </h3>

              <span class="icon"><i class="fas fa-sort-down"></i></span>
            </div>

            <div class="answer">
              <p> Name :
              <?= $user->fullname ?>
              </p>
            </div>

            <div>
              <form action="../actions/action_change_role.php" method="post" class="delete">

                <input type="hidden" name="user_id" value="<?= $user->id ?>">
                <input type="hidden" name="role_id" value="2">

                <input type="submit" value="Make Agent">

              </form>
            </div>
          </div>
      <?php }

    } ?>
  </section>

</section>

<?php
drawFooter($session);
?>