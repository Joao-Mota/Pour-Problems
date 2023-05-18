<?php
declare(strict_types=1);

require_once(__DIR__ . '/../utils/session.php');
$session = new Session();

if (!$session->isLoggedIn()) {
  header('Location: ../pages/login.php');
}

require_once(__DIR__ . '/../database/connection.db.php');
require_once(__DIR__ . '/../temp/common.tpl.php');
require_once(__DIR__ . '/../database/department.class.php');


$db = getDatabaseConnection();

$departments = Department::getDepartments($db);

drawHeader($session);
?>

<div class="heading" style="background: url('../sources/heading_bg/departments.jpg');">
  <h1>Departments</h1>
</div>

<section class="ticket-form">

  <section class="users">

    <div>
      <form action="../actions/action_add_department.php" method="post" class="delete">
        <input type="submit" value="Create New Department">
        <input type="text" name="name" placeholder="department's name">
      </form>
    </div>

    <?php foreach ($departments as $department) { ?>

      <div class="user">
        <div class="question">
          <h3>
            <?= $department->name ?>
          </h3>

          <span class="icon"><i class="fas fa-sort-down"></i></span>
        </div>

        <div class="answer">
          <p> Id :
            <?= $department->id ?>
          </p>
        </div>

        <div>
          <form action="../actions/action_delete_department.php" method="post" class="delete">
            <input type="hidden" name="id" value="<?= $department->id ?>">
            <input type="submit" value="Delete">
          </form>
        </div>

        <div>
          <form action="../pages/department.php?id=<?= base64_encode(strval($department->id)) ?>" method="post"
            class="delete">
            <input type="hidden" name="id" value="<?= $department->id ?>">
            <input type="hidden" name="name" value="<?= $department->name ?>">
            <input type="submit" value="+Info">
          </form>
        </div>

      </div>

    <?php } ?>
  </section>

</section>

<?php
drawFooter($session);
?>