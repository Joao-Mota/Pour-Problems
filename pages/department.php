<?php
declare(strict_types=1);

require_once(__DIR__ . '/../utils/session.php');
$session = new Session();

if (!$session->isLoggedIn()) {
  header('Location: ../pages/login.php');
}

if (strpos($_SERVER['REQUEST_URI'], 'id=') === false) {
  header('Location: ../pages/departments.php');
}


require_once(__DIR__ . '/../database/connection.db.php');
require_once(__DIR__ . '/../temp/common.tpl.php');
require_once(__DIR__ . '/../database/user_department.class.php');
require_once(__DIR__ . '/../database/user.class.php');
require_once(__DIR__ . '/../database/department.class.php');


$db = getDatabaseConnection();

drawHeader($session);

$encryptedId = str_replace("/pages/department.php?id=", "", $_SERVER['REQUEST_URI']);

$id = base64_decode(($encryptedId));

$id_int = (int) $id;

$department_name = $_POST['name'];

$users = User_Department::getAgents_from_department($db, $id_int);
$departments = Department::getDepartments($db);
?>

<div class="heading">
  <h1>
    <?= $department_name ?> Department
  </h1>
</div>

<section class="ticket-form">

  <section class="agents">

    <?php foreach ($users as $user_department) {

      $user = User::getUser($db, $user_department->user_id);
      ?>

      <div class="user">
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
      </div>

    <?php } ?>
  </section>

</section>

<?php
drawFooter($session);
?>